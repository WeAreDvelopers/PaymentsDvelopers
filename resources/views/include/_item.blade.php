<input type="hidden" name="valor" value="{{$carrinho->valor_final}}">


<div class="row mt-sm-3 algin-items-center">
@if($totalDisponivel > 0)        
        <div class="col-sm-4">
            <div class="row align-items-end cupom">
                <div class="col-12">
                    <label for="">Cupom</label>
                    <input type="text" name="cupom" class="form-control form-control-sm" id="">
                </div>
                <div class="col-12 mt-3">
                    <button type="button" id="aplicarCupom" class="btn btn-primary m-0 btn-sm">Aplicar</button>
                </div>
                </div>
        </div>
            @endif
                <div class="col-sm-8 col-12 pt-2 align-content-center flex-grow-1">
                    <div class="row align-items-end">
                   @if($produto->tipo == 'unico')
                    <div class="col-sm-4 col-12">
                        <label for="inputEmail4" class="form-label"></label>
                        <select class="form-select" aria-label="Default select example" name="numberTax" required name="parcelas">
@for($i = 1; $i <= $produto->max_parcelas; $i++)
                            <option value="{{$i}}" >
                                @if($i == 1)
                                À Vista
                                @else
                                {{$i}}
                                @endif
                            </option>
@endfor
                            
                        </select>
                    </div>
                 @endif
                    <div class="col-sm-auto flex-grow-1">
                    <div class="parcela-pagamento text-center" id="valor-parcela">
                    @if($produto->tipo == 'unico')
                         por R$ {{getMoney($carrinho->valor_final)}}
                        @else
                        MENSALIDADE: <br> {{$produto->max_parcelas}}X DE R$ {{getMoney($carrinho->valor_final)}}
                        @endif
                            </div>
                    
                  
                    </div>
                    </div>
                </div>
            </div>