<?php

namespace App\Http\Controllers;

use App\Models\Carrinho;
use App\Models\ClientesTokens;
use App\Models\Cupons;
use App\Models\DadosClientes;
use App\Models\Empresa;
use App\Models\EmpresaPagamento;
use App\Models\Empresas;
use App\Models\Leads;
use App\Models\Media;
use App\Models\Pedidos;
use App\Models\PedidosItens;
use App\Models\Planos;
use App\Models\Produtos;
use App\Models\User;
use App\Models\UserComunicacao;
use App\Models\UserTempData;
use App\Services\APIManager;
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
           // $this->token = env('TOKEN_ASAAS'); 
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
        $cupom = Cupons::where(['codigo'=>$data['cupom'],'id_produto'=>$data['produto']])->first();

        if(!$cupom){
                return response(['msg'=>'Cupom não encontrado'],422);
        }else{
           if($cupom->cuponsDisponiveis($data['produto']) < 0){
                return response(['msg'=>'Cupom inválido ou esgotado'],422);
           }
        }
        $valorFinal = $cupom->calculaDesconto();
        $this->atualizaCarrinho([
            'id_cupom'=>$cupom->id,
            'valor_final' => $valorFinal,

        ]);

    }
    public function carrinho(Request $request){
        $carrinho = Carrinho::where('session_id',session()->getId())->first();
        $produto = $carrinho->produto;

        $cupons = $produto->cupons;
        $totalDisponivel = 0;
        
         foreach($cupons as $k => $v){
           $totalDisponivel += $v->cuponsDisponiveis($produto->id);
         }

        return view('include._item',compact('carrinho','produto','totalDisponivel'));
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
       
        $empresa = $produto->empresa;
        // $companyInfo = $this->createBaseCompany($dados);
        $customerInfo = $this->createBaseCustomer($dados,$empresa);

        if($customerInfo['status'] == 'error'){
            return response()->json([
                'status' => 'error',
                'data'=> $customerInfo['data'],
            ]);
        }
        $customerInfo = $customerInfo['data'];
       
        //$payment = $this->criarAssinatura($customerInfo, $dados);
        $carrinho = Carrinho::where('session_id',session()->getId())->first();
        $pedido = $this->criaPedido($customerInfo, $carrinho);
        
        // if($payment['status'] == 'error'){
        //     return response()->json([
        //         'status' => 'error',
        //         'data'=> $payment['erros'],
        //     ]);
        // }
        $customerInfo['pedido'] = $pedido['pedido']->toArray();
        //$customerInfo['payment'] = $payment;
        $customerInfo['total'] = $this->valor;
        $customerInfo['vencimento'] = $this->vencimento;
       
        $this->sendMail($customerInfo,'compra');
        // $this->sendMail($customerInfo,'informacoes');
        if($this->bonus){
            $this->sendMail($customerInfo,'compra');
        }
dd('a');
        return response()->json([
            'status'    => 'ok',
            'message'   =>  'Payment created successfully!',
            'paymentInfo'   =>  @$payment,
            'url'           => $pedido['url'],
        ]);
     }

    //  public function createBaseCompany($dados){
    //     $company = Empresa::create([
    //         'nome'  =>  $dados['nome'],
    //         'status'    =>  'ativo',
    //         'telefone'  =>  $dados['celular']
    //     ]);
    //     return $company->toArray();
    //  }

     public function createBaseCustomer($dados,$empresa){
        $now = Carbon::now();
        $costumer = User::where('email', $dados['email'])->first();
        $senha = Str::random(8);
        $tokenAsaas = null;
        if($costumer){
            $tokenAsaas = $costumer->tokenAssas($empresa->id)->first();
        }else{
            $costumer = User::create([
                'name'  => $dados['nome'],
                'email' =>  $dados['email'],
                'password'  =>  Hash::make($senha),
                'role'  =>  'cliente',
            ]);
            DadosClientes::create([
                'id_user'=>$costumer->id,
                'cpf' => @$dados['cpf'],
                'telefone'=>$dados['celular'],
               
            ]);
            $costumer->markEmailAsVerified();

        }
        
        if($costumer && $tokenAsaas){
            //return $checkCustomer;
            $costumer['id_asaas'] = $tokenAsaas->id_asaas;
            return ['status'=>'ok','data'=>$costumer->toArray()];
        }else{

           
            
            $data = [
                "name"                  => $dados['nome'],
                "email"                 => $dados['email'],
                "mobilePhone"           => preg_replace("/[^0-9]/", "", $dados['celular']),
                "cpfCnpj"               => preg_replace("/[^0-9]/", "", $dados['cpf']),
            ];
          

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'access_token' => $empresa->token_asaas,
            ])->post($this->urlBase . '/customers', $data);


            if ($response->failed()) {
                //session()->flash('error', $response->json()['errors']);
                return ['status'=>'error','data'=>$response->json()];
                
            }

          

           
            ClientesTokens::create([
                'id_empresa'=>$empresa->id,
                'id_user'=>$costumer->id,
                'id_asaas'=>$response->json()['id'],
            ]);
           
            $costumer['id_asaas'] = $response->json()['id'];

         

    
            return ['status'=>'ok','data'=>$costumer->toArray()];
        }
        
        
     }
 
     public function sendMail($userInfo, $view){
       
       
        $logo = Media::find($userInfo['pedido']['empresa']['id_logo']);
        
        $userInfo['logo'] = $logo->fullpatch();
       
        $array = [
            'bem_vindo' => 'Seja bem-vindo(a)!',
            'informacoes' => 'Informações sobre o Pedido #'.$userInfo['pedido']['numero_pedido'],
        ];
        \Mail::send('emails.'.$view, $userInfo, function($message) use ($userInfo,$array,$view) {
            $message->to($userInfo['email'], $userInfo['name'])->subject($array['informacoes']);    
        });
     }

    public function criarAssinatura($customers,$data){

                 $id_asaas = $customers['id_asaas'];
                $now = Carbon::now()->addYear();
                $carrinho = Carrinho::where('session_id',session()->getId())->first();

                $remoteIp = $_SERVER['REMOTE_ADDR'];
                list($expiryMonth, $expiryYear) = explode('/', $data['cardExpDate']);
            
                if($carrinho->produto->tipo == 'recorrente'){
                    $totalValue = $carrinho->valor_final;

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
                        "customer" => $id_asaas,
                        "value" => $totalValue,
                        "dueDate" => date('Y-m-d'),
                        "description" => "Assinatura " . $carrinho->produto->name,
                        "maxPayments" => $carrinho->produto->max_parcelas,
                        "remoteIp" => $remoteIp
                    ];

                    $response = Http::withHeaders([
                        'Content-Type' => 'application/json',
                        'access_token' => $carrinho->produto->empresa->token_asaas,
                    ])->post($this->urlBase . '/subscriptions', $dados);
                
                }
                if($carrinho->produto->tipo == 'unico'){

                    $totalValue = $carrinho->valor_final;
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
                    "customer" => $id_asaas,
                    "value" => $totalValue,
                    "dueDate" => date('Y-m-d'),
                    "description" => $carrinho->produto->name,
                    "installmentCount"  =>  $data['numberTax'],
                    "installmentValue"  =>  $totalValue / $data['numberTax'],
                    "remoteIp" => $remoteIp
                ];

                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'access_token' => $carrinho->produto->empresa->token_asaas,
                ])->post($this->urlBase . '/payments', $dados);
            }
         
        
            if ($response->failed()) {
                return ['status'=>'error','erros'=> $response->json()];
            }
            $response = $response->json();
    
            $this->vencimento = $now->format('d/m/Y');
            $this->valor = $totalValue;


            
            return ['status'=>'ok',
            'data'=> $response['id'],
            'response'=>$response,
            'customer' => $customers
        ];;
    }
    public function criaPedido($user,Carrinho $carrinho){
        $pedidosTotal = Pedidos::where('id_empresa',$carrinho->produto->empresa->id)->count() + 1;
        $numero_pedido = Str::random(6) . '-'. str_pad($pedidosTotal , 4 , '0' , STR_PAD_LEFT);
        $pedido = Pedidos::create([
            'numero_pedido'     => strtoupper($numero_pedido),
            'id_user'           => $user['id'],
           'id_empresa'         =>$carrinho->produto->empresa->id,
            'id_cupom'          => $carrinho->id_cupom,
            'valor'             => $carrinho->valor,
            'valor_desconto'    => $carrinho->valor - $carrinho->valor_final,
            'valor_final'       =>  $carrinho->valor_final,
        ]);
        PedidosItens::create([
            'id_pedido'         => $pedido->id,
            'id_produto'        => $carrinho->id_produto,
            'valor'             => $carrinho->valor,
            'valor_desconto'    => $carrinho->valor - $carrinho->valor_final,
            'valor_final'       =>  $carrinho->valor_final,
        ]);
      
        $servico = new APIManager();
        $servico->start($pedido);
        return [
            'status'    =>  'ok',
            'pedido'    =>  $pedido,
            'url'       =>  route('site.obrigado',['pedido'=>$numero_pedido])
            ]
        ;;
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

    public function obrigado(Request $request,$pedido){

        $pedido = Pedidos::where('numero_pedido',$pedido)->first();
        
        // $servico = new APIManager();
        // $servico->start($pedido);
        return view('sucesso',compact('pedido'));
    }

}
