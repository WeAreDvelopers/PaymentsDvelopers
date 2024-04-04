@if(isset($cupom))
<a href="#" class="tooglegeCollapse float-end" data-target="#collapse-Categoria2"><i class="fas fa-times"></i></a>

<!--FORMULARIO EDITAR-->
    <form action="{{route('admin.cupons.update',['id'=>$cupom->id])}}" id="atualizar-cupons" enctype="multipart/form-data">
            @csrf
            <div class="row mt-2">
            <div class="form-group col-sm-12">
                <span class="titulo"> Produto: *</span>
                    <select class="form-select"  id="grupoSelect" name="id_produto" required>
                        <option value="" disabled selected>Selecione</option>
                    @foreach($produtos as $produto)
                        <option value="{{$produto->id}}" @if($cupom->id_produto == $produto->id) selected @endif>{{ $produto->descricao}}</option>
                    @endforeach
                   </select>
            </div>
            <div class="form-group col-sm-3">
                <span class="titulo"> Código: *</span>          
                <input type="text" name="codigo" value="{{$cupom->codigo}}"   class="form-control text-uppercase" required>  
            </div>
            <div class="form-group col-sm-3">
                <span class="titulo"> Valor: *</span>          
                <input type="text" name="valor" value="{{$cupom->valor}}"  class="form-control maskMoney" required>  
            </div>
            <div class="form-group col-sm-3">
                <span class="titulo"> Quantidade: *</span>          
                <input type="number" name="qtd" value="{{$cupom->qtd}}"   class="form-control" required>  
            </div>
            <div class="form-group col-sm-3">
                <span class="titulo"> Tipo: *</span>          
                <select name="tipo" required id="" class="form-select">
                    <option value="">Selecione</option>
                    <option value="porcentagem" @if($cupom->tipo == 'porcentagem') selected @endif>Porcentagem</option>
                    <option value="real" @if($cupom->tipo == 'real') selected @endif>Real</option>
                </select>
            </div>
          

               

                <div class="col-sm-3 mt-4"> 
                    <button class="btn btn-warning" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> Salvar</button>
                </div>

            </div>

            </form>

@else
<a href="#" class="tooglegeCollapse float-end" data-target="#collapse-Categoria"><i class="fas fa-times"></i></a>

<!--FORMULARIO CADASTRO-->
        <form id="cadastrar-cupons" enctype="multipart/form-data">
        @csrf
        <div class="row mt-2">
            <div class="form-group col-sm-12">
                <span class="titulo"> Produto: *</span>
                    <select class="form-select" id="grupoSelect" name="id_produto" required>
                        <option value="" disabled selected>Selecione</option>
                    @foreach($produtos as $grupo)
                        <option value="{{$grupo->id}}">{{ $grupo->nome}}</option>
                    @endforeach
                   </select>
            </div>
            <div class="form-group col-sm-3">
                <span class="titulo"> Código: *</span>          
                <input type="text" name="codigo"   class="form-control text-uppercase" required>  
            </div>
            <div class="form-group col-sm-3">
                <span class="titulo"> Valor: *</span>          
                <input type="text" name="valor"   class="form-control maskMoney" required>  
            </div>
            <div class="form-group col-sm-3">
                <span class="titulo"> Quantidade: *</span>          
                <input type="number" name="qtd"   class="form-control" required>  
            </div>
            <div class="form-group col-sm-3">
                <span class="titulo"> Tipo: *</span>          
                <select name="tipo" required id="" class="form-select">
                    <option value="">Selecione</option>
                    <option value="porcentagem">Porcentagem</option>
                    <option value="real">Real</option>
                </select>
            </div>
          
           

         

        </div>
<div class="row justify-content-between">
    <div class="col">
        <button type="button" class="tooglegeCollapse btn btn-secondary" >Cancelar</button>
    </div>
<div class="col text-end"> 
                <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> Salvar</button>
            </div>
</div>
        </form>
@endif        


  