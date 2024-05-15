@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <form id="atualizar-produtos" action="{{route('admin.produtos.update',['id'=>$produto->id])}}">
            @csrf
            <div class="card">
                <div class="card-body">

<div class="row">
    <div class="col-2">Preview</div>
    <div class="col"> <a href="{{route('site.pagamento',['token'=>$produto->token])}}" target="_blank" class="btn btn-sm btn-primary">
                                Link</a></div>
</div>

                    <div class="row">
                        <div class="col-auto">
                            <label for="exampleInputFile" class="control-label">
                                Imagem Produto <small>(500 x 500px)</small>
                            </label>
                            <x-upload-file target="logo" collum="id_media" :media="$produto" />

                        </div>
                        <div class="col">
                            <div class="row mt-2">
                                <div class="form-group col-sm-5">
                                    <span class="titulo"> Nome: *</span>
                                    <input type="text" name="nome"  value="{{$produto->nome}}" class="form-control" required>
                                </div>
                                <div class="form-group col-sm-5">
                                    <span class="titulo"> Descrição: *</span>
                                    <input type="text" name="descricao"  value="{{$produto->descricao}}" class="form-control" required>
                                </div>
                                <div class="form-group col-sm-3 me-5">
                                    <span class="titulo"> Valor: *</span>
                                    <input type="text" name="valor" id="valor" value="{{getMoney($produto->valor)}}" class="form-control moneyMask" required>
                                </div>
                                <div class="form-group col-sm-3 me-5">
                                    <span class="titulo"> Tipo:* </span>
                                    <div>
                                        <input type="radio" name="tipo" value="unico" @if($produto->tipo == 'unico') checked @endif required id=""> Pagamento Único<br>
                                        <input type="radio" name="tipo" value="recorrente" @if($produto->tipo == 'recorrente') checked @endif required id=""> Pagamento Recorrente
                                    </div>
                                </div>
                                <div class="form-group col-sm-3 me-5">
                                    <span class="titulo"> Máximo de Parcelas: *</span>
                                    <input type="number" name="max_parcelas" value="{{$produto->max_parcelas}}" class="form-control " required>
                                </div>

                                <div class="form-group col-sm-3 me-5">
                                    <span class="titulo"> Status: </span>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="status" role="switch" value="ativo" id="flexSwitchCheckChecked" @if($produto->status == 'ativo') checked @endif >
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Ativo</label>
                                    </div>
                                </div>
                                <div class="form-group col-sm-3 me-5">
                                    <input type="hidden" name="id" value="{{$produto->id}}">
                                </div>

                            </div>
                        </div>
                    </div>

    <div class="col-12"></div>



                </div>

            </div>


    </div>
    
    @if(empresa()->checkIntegracao('eadsimples')->status == 'ativo')
    <div class="card mt-3">
       <div class="card-body">
        <div class="row">
            <div class="col-2">
            <img src="{{asset('img/integracoes/eadsimples.png')}}" style="height: 50px; width: auto;" alt="">
            </div>
            <div class="col">
                    <p>Selecione o produto relacionado em sua conta do EAD Simples</p>
                    <select name="ead_simples_curso" id="" class="form-select">
                        <option value="">Selecione</option>
                        <option value="PROD1" @if($produto->produtosEadSimples->id_produto_ead == "PROD1") selected @endif >Produto 1</option>
                        <option value="PROD2" @if($produto->produtosEadSimples->id_produto_ead == "PROD2") selected @endif >Produto 2</option>
                        <option value="PROD3" @if($produto->produtosEadSimples->id_produto_ead == "PROD3") selected @endif >Produto 3</option>
                    </select>
            </div>
            </div>     
        </div>   
    </div>
    @endif


    <div class="card mt-3">
        <div class="card-body">

        <div class="row">

            <div class="col-sm-5">
                <h4>Popup</h4>
            </div>
            <div class="form-group col-sm-3 me-5">
                                    
                    <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="status_popup" role="switch" value="ativo" id="flexSwitchCheckChecked_popup" checked>
                            <label class="form-check-label" for="flexSwitchCheckChecked">Ativo</label>
                    </div>
             </div>

        </div>
          
            <div class="row">

                <div class="col-5 text-center">
                        <label for="exampleInputFile" class="control-label">
                                Imagem Produto <small>(500 x 500px)</small>
                        </label>
                        <x-upload-file target="logo" collum="id_popup" :media="$produto->popup" />

                </div>

                <div class="col-7">
    <!-- CONTEUDO SUMMER NOTE -->
                        <textarea id="summernote" name="informativo" class="form-control"  placeholder="Digite o conteudo do assunto" required >{{$produto->popup->informativo ?? ''}}</textarea>
                 </div>
            </div>

        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body text-end">

            <button class="btn btn-success m-0" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> Salvar</button>

        </div>
    </div>
    </form>
</div>
@endsection

@section('scripts')
<script>

$('#summernote').summernote({
       
       tabsize: 1,
       height: 120,
       
     });

// ATUALIZAR
    $("body").on('submit','#atualizar-produtos', function(e) {

    e.preventDefault();
    var formData = $(this).serialize();
    console.log(formData);

    $("#msg-error").addClass('d-none');

    $.ajax({

        url: $(this).attr('action'),  
        type: "POST",                
        data: formData,
        
        success: function(response) {
            
            console.log(response);
            swal({
                    title: "Parábens",
                    text: "Atualizado com sucesso!.",
                    icon: "success",
                }).then(function() {

                   // location.reload();
                    window.location.href = '{{route("admin.produtos.index")}}';
                });
          
        }, 

        error: function(response) {
            
            $("#msg-error ul").html('');
            var errors = $.parseJSON(response.responseText);
                $.each(errors.errors, function (k, v) {
                    
                    $("#msg-error ul").append('<li class="text-white">'+v+'</li>')
                });
                $("#msg-error").removeClass('d-none')     
        },      
    });
    });

   
</script>
@endsection