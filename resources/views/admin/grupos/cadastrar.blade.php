@if(isset($grupo))
<a href="#" class="tooglegeCollapse float-right" data-target="#collapse-Grupo2"><i class="fas fa-times"></i></a>

<!--FORMULARIO EDITAR-->
    <form action="{{route('admin.grupos.update',['id'=>$grupo->id])}}" id="atualizar-grupos" enctype="multipart/form-data">
            @csrf
            <div class="row mt-2">

                <div class="form-group col-sm-5">
                    <span class="titulo"> Descriçao: *</span>
                    <input type="text" name="descricao" id="descricao" value="{{$grupo->descricao}}" class="form-control" required>  
                </div>

                <div class="col-sm-3 mt-4"> 
                    <button class="btn btn-warning" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
                </div>

            </div>

            </form>

@else
<a href="#" class="tooglegeCollapse float-right" data-target="#collapse-Grupo"><i class="fas fa-times"></i></a>

<!--FORMULARIO CADASTRO-->
        <form id="cadastrar-grupos" enctype="multipart/form-data">
        @csrf
        <div class="row mt-2">

            <div class="form-group col-sm-5">
                <span class="titulo"> Descrição: *</span>          
                <input type="text" name="descricao" id="descricao" class="form-control" required>  
            </div>

            <div class="col-sm-3 mt-4"> 
                <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Add +</button>
            </div>

        </div>

        </form>
@endif        


  