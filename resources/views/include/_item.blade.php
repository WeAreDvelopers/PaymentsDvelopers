<input type="hidden" name="valor" value="{{$carrinho->valor_final}}">


<div class="row mt-sm-3 algin-items-center">
                <div class="col-sm-3 col-12 pt-4">
                @if($carrinho->produto->media)
                <img src="{{$produto->media->fullpatch()}}" class="img-fluid" >
                @endif
                </div>
                <div class="col-sm-9 col-12 pt-2 align-content-center">
                    <div class="row align-items-end">
                   
                    <div class="col-sm-4 col-12">
                        <label for="inputEmail4" class="form-label"></label>
                        <select class="form-select" aria-label="Default select example" name="numberTax" required name="parcelas">
                            <option value="1" selected>À Vista</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                    </div>
                 
                    <div class="col-sm-8 col-12 pt-4">
                    <div class="parcela-pagamento" id="valor-parcela">
                         por R$ {{getMoney($carrinho->valor_final)}}
                    </div>
                    
                  
                    </div>
                    </div>
                </div>
            </div>