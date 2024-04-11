<!-- Preview MODAL -->


@extends('layouts.emails')

@section('content')
<div class="page-content container">

    <div class="page-header text-blue-d2">

        <h1 class="page-title text-secondary-d1">
            Pedido
            <small class="page-info text-uppercase">
                <i class="fa fa-angle-double-right text-80"></i>
                Nº: {{$pedido->numero_pedido}}
            </small>
        </h1>

        <div class="page-tools">
            
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

        </div>
    </div>

    <div class="container px-0">
        <div class="row mt-4">

            <div class="col-12 col-lg-12">
               
                <!-- .row -->

                <hr class="row brc-default-l1 mx-n1 mb-4" />


                <div class="row">

                    <div class="col-sm-6">
                            <div>
                                <span class="text-sm text-grey-m2 align-middle">Cliente:</span>
                                <span class="text-600 text-110 text-blue align-middle">{{ $pedido->cliente->name}}</span>
                            </div>

                            <div class="text-grey-m2">
                                <div class="ms-4 my-3">
                                    {{ $pedido->cliente->cpf ?? ''}}
                                </div>
                              
                                <div class="my-1"><i class="fa fa-phone fa-flip-horizontal text-secondary"></i> <b class="text-600">{{ $pedido->cliente->dados->telefone }}</b></div>
                            </div>
                    </div>
                    <!-- /.col -->

                    <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                        <hr class="d-sm-none" />
                            <div class="text-grey-m2">
                                <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                    Pedido
                                </div>

                                <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Nº:</span>{{$pedido->numero_pedido}}</div>

                                <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Data Venda:</span> {{$pedido->created_at->format('d/m/Y')}}</div>

                                <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i>
                                 <span class="text-600 text-90">Status:</span> 
                                 <span class="badge text-bg-success">Aprovado</span>

                                </div>
                            </div>
                    </div>
                    <!-- /.col -->
                </div>




                <div class="mt-4">

                    <div class="row text-600 text-white bg-primary py-25">
                        <div class="d-none d-sm-block col-1">#</div>
                        <div class="col-9 col-sm-5">Produto</div>
                        <div class="d-none d-sm-block col-4 col-sm-2 text-end">Qtd</div>
                        <div class="d-none d-sm-block col-sm-2 text-end">Valor</div>
                        <div class="col-2 text-end px-5">Total</div>
                    </div>


                    <div class="text-95 text-secondary-d3">
    @foreach ($pedido->itens as $k => $item)
                        <div class="row mb-2 mb-sm-0 py-25 border-bottom">
                            <div class="d-none d-sm-block col-1">{{ $item->produto->id}}</div>
                            <div class="col-9 col-sm-5">{{ $item->produto->nome}}</div>
                            <div class="d-none d-sm-block col-2 text-end">1</div>
                            <div class="d-none d-sm-block col-2 text-end">{{ getmoney($item->produto->valor,'R$') }}</div>
                            <div class="col-2 text-secondary-d2 text-end ">{{ getmoney($item->valor_final,'R$') }}</div>
                        </div>
                        @endforeach
                        
                    </div>




            <div class="row border-b-2 brc-default-l2"></div>

                    <!-- or use a table instead -->
                    <!--
            <div class="table-responsive">
                <table class="table table-striped table-borderless border-0 border-b-2 brc-default-l1">
                    <thead class="bg-none bgc-default-tp1">
                        <tr class="text-white">
                            <th class="opacity-2">#</th>
                            <th>Description</th>
                            <th>Qty</th>
                            <th>Unit Price</th>
                            <th width="140">Amount</th>
                        </tr>
                    </thead>

                    <tbody class="text-95 text-secondary-d3">
                        <tr></tr>
                        <tr>
                            <td>1</td>
                            <td>Domain registration</td>
                            <td>2</td>
                            <td class="text-95">$10</td>
                            <td class="text-secondary-d2">$20</td>
                        </tr> 
                    </tbody>
                </table>
            </div>
            -->

                    <div class="row mt-3">

                            <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-3 pt-2 mt-lg-0">
                               

                                <!-- <div class="row mt-2">
                                    <div class="col-6 mt-5">
                                        <h5 class="font-18">Meio de pagamento</h5>
                                    </div>
                                    <div class="col-5 mt-4">
                                        <img src="{{asset('img/integracoes/eadsimples.png')}}" class="img-fluid ">
                                    </div>
                                </div> -->
                            </div>

                            <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">

                                <div class="row my-2">
                                    <div class="col-7 text-end">
                                        Sub Total
                                    </div>
                                    <div class="col-5 text-end">
                                        <span class=" text-end ">{{ getMoney($pedido->valor,'R$') }}</span>
                                    </div>
                                </div>

                                <div class="row my-2">
                                    <div class="col-7  text-end">
                                        Desconto
                                    </div>
                                    <div class="col-5 text-end text-danger ">
                                        <span class=" text-danger-d1 ">-{{ getMoney($pedido->valor_desconto,'R$') }}</span>
                                    </div>
                                </div>

                                <div class="row my-2 align-items-center bgc-primary-l3 ">
                                    <div class="col-7 text-dark text-end">
                                       <strong> Total</strong>
                                    </div>
                                    <div class="col-5 text-end text-dark">
                                    <strong>{{ getMoney($pedido->valor_final,'R$') }}</strong>
                                    </div>
                                </div>
                            </div>

                    </div>


                    <hr class="border-5 border-dark border-top" />

                    <div class="row">

                        <div class="col-7">
                            <span class="text-secondary-d1 text-105 mt-2">Sistema Dvelopers  - Ticket Pay</span>
                        </div>

                        <!-- <div class="col-5 text-end">
                                <a class="btn bg-white btn-info mx-1px text-dark text-95" href="#" data-title="Print">
                            <i class="mr-1 fa fa-print text-primary-m1  w-2 me-4"></i>imprimir</a>
                        </div> -->
                        
                    </div>
            </div>



            </div>
        </div>
    </div>
</div>

@ensection