<?php

namespace App\Services;

use App\Models\ProdutosEADSimples;
use Illuminate\Support\Facades\Http;


use Illuminate\Support\Str;

class EadSimplesService{
    protected $apiUrl;
    protected $apiKey;

    protected $pedido;
    protected $integracao;
    public function __construct($integracao = null){
        $this->integracao = $integracao;
       
        $this->apiUrl = $integracao->parametros->apiUrl();
    }
    public function start($dados){
        $this->credenciais();
        $idAluno = $this->cadastrarAluno($dados);
        $this->matricularAluno($idAluno,$dados);
    }
    protected function credenciais(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $this->apiUrl . '/token',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => 'username='.$this->integracao->parametros->cliente_id.'&password='.$this->integracao->parametros->token_private.'&grant_type=password',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded'
          ),
        ));
        
        $response = json_decode(curl_exec($curl));
        
        curl_close($curl);

        $this->apiKey = $response->access_token;
    }
    public function cadastrarAluno($pedido)
    {
        $search = Http::withHeaders([
            'Authorization' => 'Bearer '.  $this->apiKey,
        ])->get($this->apiUrl . '/v1/cadastro/search/'.'DV_'.$pedido->cliente->id)->json();
     
        if(count($search) > 0){
           
            return $search[0]['Id'];
        };

        $senhaAluno = Str::random(8);
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.  $this->apiKey,
           
        ])->post($this->apiUrl . '/v1/cadastro/add', [

            'Nome'          => $pedido->cliente->name,
            'Email'         => $pedido->cliente->email,
            'Login'         => $pedido->cliente->email,
            'Senha'         => $senhaAluno,
            'IDExterno'     => 'DV_'.$pedido->cliente->id,
            // Outros campos de dados do aluno conforme necessário
        ]);
   
        return $response->json()['Id'];
    }

    public function matricularAluno($idAluno, $pedido)
    {
        $response = [];
        foreach($pedido->itens as $k => $v){
           $response[] = Http::withHeaders([
            'Authorization' => 'Bearer '.  $this->apiKey,
            ])->post($this->apiUrl . '/v1/matricula/add', [
                'CursoID'       => $v->produto->produtosEadSimples->id_produto_ead,
                'CadastroID'    => $idAluno
            ])->json();
        }
        return $response;
    }

    public function listarCursos()
    {
        $response = Http::get($this->apiUrl . '/cursos', [
            'api_key' => $this->apiKey,
        ]);

        return $response->json();
    }
    public function cadastrarProduto($dados){
        $integracao  = $this->integracao;
      
        ProdutosEADSimples::create([
            'id_integracao' => $integracao->id,
            'id_produto'    => $dados['id_produto'],
            'id_produto_ead'=> $dados['id_produto_ead'],
        ]);
    }
}
