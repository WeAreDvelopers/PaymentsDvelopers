<?php

namespace App\Services;

use App\Models\Pedidos;

class APIManager
{
    protected $asaasService;
    protected $eadSimplesService;
    protected $integracao;

    // public function __construct(AsaasService $asaasService, EadSimplesService $eadSimplesService)
    // {
    //     $this->asaasService = $asaasService;
    //     $this->eadSimplesService = $eadSimplesService;
    // }
    
    public function start(Pedidos $pedido){
      
        $eadsimples = $pedido->empresa->checkIntegracao('eadsimples');
        $this->integracao = $eadsimples;
        if($eadsimples->status == "ativo"){
            $this->eaSimples($pedido);
        }
    }
    public function processarPagamento()
    {
        $service = new AsaasService();
        $service->processarPagamento();
    }

    public function eaSimples($pedido)
    {


        $service = new EadSimplesService($this->integracao);
        // Lógica para cadastrar aluno utilizando o serviço EadSimplesService
        $service->start($pedido);
    }
}
