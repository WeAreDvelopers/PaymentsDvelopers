<?php

namespace App\Http\Controllers;

use App\Models\Carrinho;
use App\Models\Cupons;
use App\Models\Empresa;
use App\Models\EmpresaPagamento;
use App\Models\Empresas;
use App\Models\Leads;
use App\Models\Planos;
use App\Models\Produtos;
use App\Models\User;
use App\Models\UserComunicacao;
use App\Models\UserTempData;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PagamentoController extends Controller
{
    protected $bonus = null;
    protected $valor = 0;
    protected $vencimento = '';
    public $recorrencia = [
        'mensal'=>'MONTHLY',
        'anual'=>'YEARLY'];
        private $urlBase;
        private $token;
    
    
        public function __construct(){
            $this->urlBase = env('BASE_ASAAS'); 
            $this->token = env('TOKEN_ASAAS'); 
    }


    public function index(Request $request,$token = null){
      
       $produto = Produtos::where('token',$token)->first();
       $sessionID = session()->getId();
       $carrinho = Carrinho::updateOrCreate([
            'session_id'=>$sessionID,
        ],[
            'id_produto'=>$produto->id,
            'valor'=>$produto->valor,
            'valor_final'=>$produto->valor,
        ]);

     
        //$plano = Planos::where('slug',$subdomain)->first();

       $cupons = $produto->cupons;
       $totalDisponivel = 0;
       
        foreach($cupons as $k => $v){
          $totalDisponivel += $v->cuponsDisponiveis($produto->id);
        }

       
        return view('pagamento',compact('produto','totalDisponivel','carrinho'));
    }
    public function aplicarCupom(Request $request){
        $data = $request->except('_token');
        $carrinho = Carrinho::where('session_id',session()->getId())->first();

        
    }
    public function carrinho(Request $request){

        return view('include');
    }
    public function capturaLead(Request $request,$token = null){
        $data = $request->except('_token');
       
        $produto = Produtos::where('token',$token)->first();

       $lead = Leads::updateOrCreate([
            'id_empresa'    => $produto->id_empresa,
            'email'         => $data['email'],
            ],[
            'nome'          => $data['nome'],
            'telefone'      => $data['celular'],
        ]);

        $this->atualizaCarrinho([
            'id_lead'=>$lead->id
        ]);
    }
    public function atualizaCarrinho($array){
        $carrinho = Carrinho::updateOrCreate([
            'session_id'=>session()->getId(),
        ],$array);
    }
    public function createBaseAccount(Request $request,$token = null){
        $dados = $request->except('_token');
       
      
        $produto = Produtos::where('token',$token)->first();
       
       
        $companyInfo = $this->createBaseCompany($dados);
        $customerInfo = $this->createBaseCustomer($dados, $companyInfo);
         //dd($customerInfo);
        if($customerInfo['status'] == 'error'){
            return response()->json([
                'status' => 'error',
                'data'=> $customerInfo['data'],
            ]);
        }
        $customerInfo = $customerInfo['data'];
       
        $payment = $this->criarAssinatura($customerInfo['empresa']['id_asaas'], $companyInfo, $dados,$plano);
        if($payment['status'] == 'error'){
            return response()->json([
                'status' => 'error',
                'data'=> $payment['erros'],
            ]);
        }
        $customerInfo['id_pedido'] = $payment;
        $customerInfo['total'] = $this->valor;
        $customerInfo['vencimento'] = $this->vencimento;
       
        $this->sendMail($customerInfo,'bem_vindo');
        // $this->sendMail($customerInfo,'informacoes');
        if($this->bonus){
            $this->sendMail($customerInfo,'compra');
        }

        return response()->json([
            'status'    => 'ok',
            'message'   =>  'Payment created successfully!',
            'paymentInfo'   =>  $payment
        ]);
     }

     public function createBaseCompany($dados){
        $company = Empresa::create([
            'nome'  =>  $dados['nome'],
            'status'    =>  'ativo',
            'telefone'  =>  $dados['celular']
        ]);
        return $company->toArray();
     }

     public function createBaseCustomer($dados, $empresa){
        $now = Carbon::now();
        $checkCustomer = User::where('email', $dados['email'])->with('empresa')->first();
        $senha = Str::random(8);
        if($checkCustomer && $checkCustomer->empresa->id_asaas){
            //return $checkCustomer;
            $checkCustomer['id_asaas'] = $checkCustomer->empresa->id_asaas;
            return ['status'=>'ok','data'=>$checkCustomer->toArray()];
        }else{

            $costumer = User::create([
                'name'  => $dados['nome'],
                'email' =>  $dados['email'],
                'password'  =>  Hash::make($senha),
                'role'  =>  'user',
                'id_empresa'    =>  $empresa['id'],
            ]);
            
            $data = [
                "name"                  => $dados['nome'],
                "email"                 => $dados['email'],
                "mobilePhone"           => preg_replace("/[^0-9]/", "", $dados['celular']),
                "cpfCnpj"               => preg_replace("/[^0-9]/", "", $dados['cpf']),
            ];
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'access_token' => $this->token,
            ])->post($this->urlBase . '/customers', $data);
            if ($response->failed()) {
                //session()->flash('error', $response->json()['errors']);
                return ['status'=>'error','data'=>$response->json()['errors']];
                
            }

          

            $costumer->markEmailAsVerified();

            Empresas::where('id', $empresa['id'])->update([
                'id_asaas'  =>  $response->json()['id']
            ]);
            $costumer['senha'] = $senha;
            $costumer['empresa']['id_asaas'] = $response->json()['id'];

            UserComunicacao::create([
                'id_user' => $costumer->id
            ]);

    
            return ['status'=>'ok','data'=>$costumer->toArray()];
        }
        
        
     }
 
     public function sendMail($userInfo, $view){
     
        // $userInfo = $userInfo->toArray();
        $array =[
            'bem_vindo' => 'Seja bem-vindo(a)! (guarde este e-mail)',
            'informacoes' => 'Informações sobre o Pedido #'.str_replace("pay_","",$userInfo['id_pedido']['data']),
            'compra' => 'E-book Disponível',
        ];
        \Mail::send('emails.'.$view, $userInfo, function($message) use ($userInfo,$array,$view) {
            $message->to($userInfo['email'], $userInfo['name'])->subject($array[$view]);    
        });
     }

     public function criarAssinatura($id,$empresa,$data,$plano){
        $now = Carbon::now()->addYear();
        $remoteIp = $_SERVER['REMOTE_ADDR'];
        list($expiryMonth, $expiryYear) = explode('/', $data['cardExpDate']);
       
        if($plano->slug == 'pessoais'){
            $totalValue = $plano->valor;

            $dados = [
                "billingType" => "CREDIT_CARD",
                "cycle" =>"MONTHLY",
                "creditCard" => [
                    "holderName" => $data['cardHolderName'],
                    "number" => $data['cardNumber'],
                    "expiryMonth" => $expiryMonth,
                    "expiryYear" => $expiryYear,
                    "ccv" => $data['cardCcv']
                ],
                "creditCardHolderInfo" => [
                    "name" => $data['nome'],
                    "email" => $data['email'],
                    "cpfCnpj" => $data['cpf'],
                    "postalCode" => $data['cep'],
                    "addressNumber" => $data['numero'],
                    "phone" => $data['celular']
                ],
                "customer" => $id,
                "value" => $totalValue,
                "dueDate" => date('Y-m-d'),
                "description" => "Assinatura Números Não mentem",
               
                "remoteIp" => $remoteIp
            ];

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'access_token' => $this->token,
            ])->post($this->urlBase . '/subscriptions', $dados);
          
        }
        if($plano->slug == 'precificacao'){

            $totalValue = 116.40;
            if ($data['numberTax'] == 1) {
                $totalValue = 97.00;
            }
    
            if(@$data['bonus'] !== null){
                $totalValue += 7.90;
                $this->bonus = true;
    
            }
        $dados = [
            "billingType" => "CREDIT_CARD",
            "creditCard" => [
                "holderName" => $data['cardHolderName'],
                "number" => $data['cardNumber'],
                "expiryMonth" => $expiryMonth,
                "expiryYear" => $expiryYear,
                "ccv" => $data['cardCcv']
            ],
            "creditCardHolderInfo" => [
                "name" => $data['nome'],
                "email" => $data['email'],
                "cpfCnpj" => $data['cpf'],
                "postalCode" => $data['cep'],
                "addressNumber" => $data['numero'],
                "phone" => $data['celular']
            ],
            "customer" => $id,
            "value" => $totalValue,
            "dueDate" => date('Y-m-d'),
            "description" => "Assinatura Números Não mentem",
            "installmentCount"  =>  $data['numberTax'],
            "installmentValue"  =>  $totalValue / $data['numberTax'],
            "remoteIp" => $remoteIp
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'access_token' => $this->token,
        ])->post($this->urlBase . '/payments', $dados);
    }
       

        if ($response->failed()) {
            return ['status'=>'error','erros'=> $response->json()['errors']];
        }
        $response = $response->json();

        Empresa::where('id', $empresa['id'])->update([
           'id_subscriptions'=>$response['id'],
        ]);
        $empresaPagamento  = EmpresaPagamento::where('id_empresa',$empresa['id'])->count();
        if($empresaPagamento == 0){
           EmpresaPagamento::create([
               'id_empresa'        => $empresa['id'],
               'id_plano'          => $plano->id,
               'status'            => 'pago',
               'valor'             => $totalValue,
               'data_vencimento'   => $now->format('Y-m-d'),
               'metodo_pagamento'  => 'Asaas',
               'total_licencas'    => 1,
               'subscription'      => @$response['invoiceNumber'] ?? @$response['id'],
               'forma_pagamento'   => 'anual',
           ]);
       }
       $this->vencimento = $now->format('d/m/Y');
       $this->valor = $totalValue;
       
        return ['status'=>'ok','data'=> $response['id']];;
    }

    public function saveUserData(Request $request){
        $data = $request->except('_token');

        if(!$data['nome'] || !$data['email'] || !$data['celular']){
            response()->json(['error'   =>  'Bad Request'], 500);
        }

        $userTempData = UserTempData::create([
            'name'  =>  $data['nome'],
            'email' =>  $data['email'],
            'phone' =>  $data['celular'],
            'status'    =>  0,
            'advertise' =>  1
        ]);

        return response()->json(['sucess'   =>  $userTempData], 201);
    }

    private function updateUserTempData($email){
        $findUser = UserTempData::where('email', $email)->first();

        $findUser->update([
            'status'    =>  1
        ]);

        return true;
    }

    public function updateUserAdvertiseData($email){
        $findUser = UserTempData::where('email', $email)->first();

        $findUser->update([
            'advertise'    =>  0
        ]);

        return true;
    }

}
