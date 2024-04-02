@if(isset($usuario))
<a href="#" class="tooglegeCollapse float-right" data-target="#collapse-User2"><i class="fas fa-times"></i></a>
<!--FORMULARIO EDITAR-->
    <form action="{{route('admin.usuarios.update',['id'=>$usuario->id])}}" id="atualizar-usuarios" enctype="multipart/form-data">
            @csrf
            <div class="row mt-2">

                <div class="form-group col-sm-5">
                    <span class="titulo"> Nome: *</span>
                    <input type="text" name="name" id="name" value="{{$usuario->name}}" class="form-control" required>  
                </div>

                <div class="form-group col-sm-4 ">
                    <span class="titulo"> Email: *</span>
                    <input type="text" name="email" id="email" value="{{$usuario->email}}" class="form-control" required>
                </div>


                <div class="col-sm-2 mt-4"> 
                    <button class="btn btn-warning" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
                </div>

            </div>

            </form>

@else
<a href="#" class="tooglegeCollapse float-right" data-target="#collapse-User"><i class="fas fa-times"></i></a>
<!--FORMULARIO CADASTRO-->
        <form id="cadastrar-usuarios" enctype="multipart/form-data">
        @csrf
        <div class="row mt-2">

            <div class="form-group col-sm-5">
                <span class="titulo"> Nome: *</span>          
                <input type="text" name="name" id="name"  class="form-control" required>  
            </div>

            <div class="form-group col-sm-4 ">
                <span class="titulo"> Email: *</span>
                <input type="text" name="email" id="email"  class="form-control" required>
            </div>

            <div class="col-sm-2 mt-4 ms-5"> 
                <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Add +</button>
            </div>

        </div>

        </form>
@endif        


  