@if(isset($produto))
<a href="#" class="tooglegeCollapse float-right" data-target="#collapse-Produto2"><i class="fas fa-times"></i></a>

<!--FORMULARIO EDITAR-->
    <form action="{{route('admin.produtos.update',['id'=>$produto->id])}}" id="atualizar-produtos" enctype="multipart/form-data">
            @csrf
            <div class="row mt-2">

                <div class="form-group col-sm-5">
                    <span class="titulo"> Descriçao: *</span>
                    <input type="text" name="descricao" id="descricao" value="{{$produto->descricao}}" class="form-control" required>  
                </div>


            

                <div class="form-group col-sm-3 me-5">
                <span class="titulo"> Valor: *</span>          
                <input type="text" name="valor" id="valor"  value="{{getMoney($produto->valor)}}"class="form-control moneyMask" required>  
            </div>

                <div class="col-sm-3 mt-4"> 
                    <button class="btn btn-warning" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
                </div>

            </div>

            </form>

@else
<a href="#" class="tooglegeCollapse float-right" data-target="#collapse-Produto"><i class="fas fa-times"></i></a>

<!--FORMULARIO CADASTRO-->
       
@endif        


  