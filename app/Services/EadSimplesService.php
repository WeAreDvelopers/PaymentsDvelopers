<?php

namespace App\Services;

use App\Models\ProdutosEADSimples;
use Illuminate\Support\Facades\Http;

class EadSimplesService{
    protected $apiUrl;
    protected $apiKey;

    protected $pedido;
    protected $integracao;
    public function __construct($integracao = null){
        $this->integracao = $integracao;
       
        $this->apiUrl = $integracao->parametros->apiUrl();
    }
    protected function credenciais(){
        $response = Http::post($this->apiUrl . '/alunos', [
            'api_key' => $this->apiKey,
            'nome' => $dadosAluno['nome'],
            'email' => $dadosAluno['email'],
            // Outros campos de dados do aluno conforme necessário
        ]);
    }
    public function cadastrarAluno($dadosAluno)
    {
        $response = Http::post($this->apiUrl . '/alunos', [
            'api_key' => $this->apiKey,
            'nome' => $dadosAluno['nome'],
            'email' => $dadosAluno['email'],
            // Outros campos de dados do aluno conforme necessário
        ]);

        return $response->json();
    }

    public function matricularAluno($idAluno, $idCurso)
    {
        $response = Http::post($this->apiUrl . "/cursos/{$idCurso}/matriculas", [
            'api_key' => $this->apiKey,
            'aluno_id' => $idAluno,
            // Outros parâmetros de matrícula conforme necessário
        ]);

        return $response->json();
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
