@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <form id="cadastrar-produtos" action="{{route('admin.produtos.store')}}">
            @csrf
            <div class="card">
                <div class="card-body">



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
                                    <span class="titulo"> Status: </span>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="status" role="switch" value="ativo" id="flexSwitchCheckChecked" @if($produto->status == 'ativo') checked @endif >
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Ativo</label>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>

    <div class="col-12"></div>



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
    $("body").on('submit', '#cadastrar-produtos', function(e) {

        e.preventDefault();
        var formData = $(this).serialize();
        console.log(formData);

        $("#msg-error").addClass('d-none');

        $.ajax({
            url: '{{route("admin.produtos.store")}}',
            type: "POST",
            data: formData,
            success: function(response) {
                console.log(response);
                swal({
                    title: "Parábens",
                    text: "Cadastro realizado com sucesso!.",
                    icon: "success",
                });
                $("#cadastrar-produtos")[0].reset();
                $(".preview").html('')
            },

            error: function(response) {

                $("#msg-error ul").html('');
                var errors = $.parseJSON(response.responseText);
                $.each(errors.errors, function(k, v) {

                    $("#msg-error ul").append('<li class="text-white">' + v + '</li>')
                });
                $("#msg-error").removeClass('d-none')
            },
        });

    });
</script>
@endsection