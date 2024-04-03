<!-- Preview MODAL -->



<div class="page-content container">

    <div class="page-header text-blue-d2">
        <h1 class="page-title text-secondary-d1">
            Pedido
            <small class="page-info">
                <i class="fa fa-angle-double-right text-80"></i>
                ID: 509-000{{$pedido->id}}
            </small>
        </h1>

        <div class="page-tools">
            <div class="action-buttons">
                <a class="btn bg-white btn-light mx-1px text-95" href="#" data-title="Print">
                    <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>
                    Print
                </a>
                <a class="btn bg-white btn-light mx-1px text-95" href="#" data-title="PDF">
                    <i class="mr-1 fa fa-file-pdf-o text-danger-m1 text-120 w-2"></i>
                    Export
                </a>
            </div>
        </div>
    </div>

    <div class="container px-0">
        <div class="row mt-4">

            <div class="col-12 col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="text-center text-150">
                            <i class="fa fa-book fa-2x text-success-m2 mr-1"></i>
                            <span class="text-default-d3">Payment Dvelopers </span>
                        </div>
                    </div>
                </div>
                <!-- .row -->

                <hr class="row brc-default-l1 mx-n1 mb-4" />


                <div class="row">

                    <div class="col-sm-6">
                            <div>
                                <span class="text-sm text-grey-m2 align-middle">To:</span>
                                <span class="text-600 text-110 text-blue align-middle">{{ $cliente->name}}</span>
                            </div>

                            <div class="text-grey-m2">
                                <div class="ms-4 my-3">
                                    {{ $dados_cliente->cpf }}
                                </div>
                                <div class="ms-4 my-1">
                                    Jacareí
                                </div>
                                <div class="my-1"><i class="fa fa-phone fa-flip-horizontal text-secondary"></i> <b class="text-600">{{ $dados_cliente->telefone }}</b></div>
                            </div>
                    </div>
                    <!-- /.col -->

                    <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                        <hr class="d-sm-none" />
                            <div class="text-grey-m2">
                                <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                    Invoice
                                </div>

                                <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">ID:</span> 509-000{{$pedido->id}}</div>

                                <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Data Venda:</span> 01/04/2023</div>

                                <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Status:</span> <button class="btn btn-sm btn-warning mt-3">Aprovado</button></div>
                            </div>
                    </div>
                    <!-- /.col -->
                </div>




                <div class="mt-4">

                    <div class="row text-600 text-white bgc-default-tp1 py-25">
                        <div class="d-none d-sm-block col-1">#</div>
                        <div class="col-9 col-sm-5">Produto</div>
                        <div class="d-none d-sm-block col-4 col-sm-2">Qtd</div>
                        <div class="d-none d-sm-block col-sm-2">Valor</div>
                        <div class="col-2 text-end px-5">Total</div>
                    </div>


                    <div class="text-95 text-secondary-d3">

                        <div class="row mb-2 mb-sm-0 py-25">
                            <div class="d-none d-sm-block col-1">{{ $pedido->produto->id}}</div>
                            <div class="col-9 col-sm-5">{{ $pedido->produto->nome}}</div>
                            <div class="d-none d-sm-block col-2"> {{ getmoney($pedido->qtd) }}</div>
                            <div class="d-none d-sm-block col-2 text-95">{{ getmoney($pedido->produto->valor) }}</div>
                            <div class="col-2 text-secondary-d2 text-end px-5">{{ getmoney($pedido->valor) }}</div>
                        </div>
                        
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

                            <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">
                                Extra note such as company or payment information...
                            </div>

                            <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">
                                <div class="row my-2">
                                    <div class="col-7 text-end">
                                        Sub_total
                                    </div>
                                    <div class="col-5 text-end">
                                        <span class="text-120 text-secondary-d1 text-end px-2">{{ getMoney($pedido->valor) }}</span>
                                    </div>
                                </div>

                                <div class="row my-2">
                                    <div class="col-7 text-danger text-end">
                                        cupom desconto
                                    </div>
                                    <div class="col-5 text-end text-danger pe-2">
                                        <span class="text-110 text-danger-d1 px-3">-{{ getMoney($pedido->valor_desconto) }}</span>
                                    </div>
                                </div>

                                <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                    <div class="col-7 text-dark text-end">
                                        Total
                                    </div>
                                    <div class="col-5 text-end text-dark">
                                        <span class="text-150 text-dark-d3">{{ getMoney($pedido->valor_final) }}</span>
                                    </div>
                                </div>
                            </div>

                    </div>


                    <hr />

                    <div class="row">

                        <div class="col-7">
                            <span class="text-secondary-d1 text-105">Sistema Dvelopers  - Ticket Pay</span>
                        </div>
                        <div class="col-4 text-end me-1">
                            <a href="#" class="btn btn-success btn-bold px-4 float-right mt-1 mt-lg-0">Pagar</a>
                        </div>
                        
                    </div>
            </div>



            </div>
        </div>
    </div>
</div>

