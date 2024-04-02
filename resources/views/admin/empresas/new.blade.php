@extends('layouts.app')


@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header d-flex pb-0">
                    <div class="col-6">
                        <h5>Cadastro</h5>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.empresas.store')}}" id="formStore">
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
                        <div class="col-12 col-sm-3">
                            <label for="">Empresa * </label>
                            <input type="text" name="nome" required class="form-control">
                        </div>
                        <div class="col-12 col-sm-3">
                            <label for="">Contato *</label>
                            <input type="text"  name="nome_contato" required class="form-control">
                        </div>
                        <div class="col-12 col-sm-3">
                            <label for="">Telefone *</label>
                            <input type="text" name="telefone_contato" required class="form-control phoneMask">
                        </div>
                        <div class="col-12 col-sm-3">
                            <label for="">CNPJ *</label>
                            <input type="text" name="cnpj" required class="form-control cnpjMask">
                        </div>
                        <div class="col-12 col-sm-3">
                            <label for="">E-mail *</label>
                            <input type="text" name="email_contato" required class="form-control">
                        </div>
                       
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <h6 class="border-bottom">Endereço</h6>
                          
                        </div>
                    <div class="col-12 col-sm-3">
                            <label for="">CEP *</label>
                            <div class="input-group ">
                            <input type="text" class="form-control cepMask border-radius-bottom-end-0" required name="cep" id="buscaCep">
                            <button class="btn btn-outline-primary mb-0" type="button" >  <i class="fa fa-search"></i></button>
                            </div>

                            
                        </div>
                        <div class="col-12 col-sm-3">
                            <label for="">Endereço *</label>
                            <input type="text" name="endereco" required class="form-control">
                        </div>
                        <div class="col-6 col-sm-3">
                            <label for="">Número *</label>
                            <input type="text" name="numero" required class="form-control">
                        </div>
                        <div class="col-3">
                            <label for="">Complemento</label>
                            <input type="text" name="complemento"  class="form-control">
                        </div>
                        <div class="col-3">
                            <label for="">Cidade *</label>
                            <input type="text" name="cidade" required class="form-control">
                        </div>
                        <div class="col-3">
                            <label for="">Estado * </label>
                            <input type="text" name="estado" required class="form-control">
                        </div>
                    </div>
                    <div class="row mt-3 border-top pt-5 mt-5">
                        <div class="col">
                            <a href="{{route('admin.empresas.index')}}" class="btn btn-primary">Voltar</a>
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