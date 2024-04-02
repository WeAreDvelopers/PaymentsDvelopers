@extends('layouts.app')
@section('assets')

@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card mb-4">
                <div class="card-header d-flex pb-0">
                    <div class="col-6">
                        <h5>Cadastro</h5>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.formas_pagamentos.store')}}" id="formStore">
                        @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="status" id="flexSwitchCheckDefault" checked="" value="ativo">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Ativo</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-12 col-sm-4">
                            <label for="">Empresa * </label>
                            <select name="id_empresa" id="" class="form-select"> 
                                <option value="">Selecionar Empresa:</option>
                                @foreach ($empresas as $emp)
                                    <option value="{{ $emp->id }}"> {{ ucfirst(mb_strtolower($emp->nome)) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-sm-4">
                            <label for="">Gateway * </label>
                            <select name="id_gateway" id="" class="form-select"> 
                                <option value="">Selecionar Gateway:</option>
                                @foreach ($gateways as $gat)
                                    <option value="{{ $gat->id }}"> {{ ucfirst(mb_strtolower($gat->descricao)) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-sm-8">
                            <label for="">Descrição * </label>
                            <input type="text" name="descricao" required class="form-control">
                        </div>
                        <div class="col-4 col-sm-4">
                            <label for="">Tipo * </label>
                            <select name="tipo" id="" class="form-select"> 
                                <option value="">Selecionar:</option>
                                <option value="credito">Crédito</option>
                                <option value="debito">Débito</option>
                            </select>
                        </div>
                        <div class="col-12 col-sm-3">
                            <label for="">Taxa Real</label>
                            <input type="text" name="taxa_real" class="form-control cad-form moneyMask">
                        </div>
                        <div class="col-12 col-sm-3">
                            <label for="">Taxa Porcentagem</label>
                            <input type="text" name="taxa_porc" class="form-control cad-form">
                        </div>
                    </div>
                    <div class="row mt-3 border-top pt-5 mt-5">
                        <div class="col">
                            <a href="{{route('admin.formas_pagamentos.index')}}" class="btn btn-primary">Voltar</a>
                        </div>
                        <div class="col text-end">
                            <button class="btn btn-success" type="submit">Salvar</button>
                        </div>
                    </div>
                    </form>
               </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalBandeira" tabindex="-1" aria-labelledby="ModalBandeiraLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalBandeiraLabel">Criar Bandeira</h5>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
      </div>
      <div class="modal-body">
      <form action="{{route('admin.formas_pagamentos.storeBandeira')}}" id="formStoreBandeira" method="POST"
          enctype="multipart/form-data">
              @csrf
              <div class="container row">
                <input type="hidden" name="id">
                <div class="col-sm-12 col-12 mt-3">
                  <label for="" class="titulo">Título: *</label>
                  <input type="text" name="nome" class="form-control cad-form" required>
                </div>
                <div class="col-8 mt-3">
                    <label for="" class="titulo">Imagem da bandeira: *</label>
                    <div class="imagens position-relative">
                        <div class="profile">
                            <img src="" alt="" style="display:none;" class="mb-4">
                            <div class="icon-foto btn-secondary btn">
                                <i class="fas fa-images pr-2"></i> Clique aqui para selecionar uma imagem
                            </div>
                            <input type="file" id="uploadArquivos">
                            <input type="hidden" name="file" value="">
                        </div>
                    </div>
                </div>
              </div>
              <div class="container row mt-3">
                  <div class="col-12 text-end">
                      <button type="submit" class="btn btn-primary" id="btnEnviarReuniao">Salvar</button>
                  </div>
              </div>
          </form>
      </div>
    </div>
  </div>
</div>



@endsection

@section('scripts')

<script>
      $("#formStore").submit(function (e) {
        e.preventDefault();
        $("span.error").remove()
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function (data) {
                console.log(data);
            
                    // Aqui você pode tratar a resposta da requisição AJAX
                    swal({
                title: "Parábens",
                text: "Cadastro realizado com sucesso!.",
                icon: "success",
                }).then(function() {
                    location.reload();
                });
            },
            error: function (err) {
                console.log(err);

                if (err.status == 422) { // when status code is 422, it's a validation issue
                    console.log(err.responseJSON);
                    $('#success_message').fadeIn().html(err.responseJSON.message);
                    // you can loop through the errors object and show it to the user
                    console.warn(err.responseJSON.errors);
                    // display errors on each form field
                    $.each(err.responseJSON.errors, function (i, error) {
                        var el = $(document).find('[name="' + i + '"]');
                        el.after($('<span class="error" style="color: red;">' + error[0] +
                            '</span>'));
                    });
                }
            }
        })
    })
</script>

@endsection