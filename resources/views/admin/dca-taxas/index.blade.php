@extends('layouts.app')


@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header d-flex pb-0">
                    <div class="col-6">
                        <h5>Lista</h5>
                    </div>
                    <div class="col-6 text-end">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalTaxas">
                            Adicionar
                        </button>
                    </div>
                </div>
                <div class="p-4">

                    <div class="row bg-dark text-light m-0 py-2">
                        <div class="col-1">ID</div>
                        <div class="col-3">Forma de Pagamento</div>
                        <div class="col-3">Taxa Real</div>
                        <div class="col-3">Taxa Real</div>
                        <div class="col text-center">Ações</div>
                    </div>

                    @foreach($dca_taxas as $key => $value)
                        <div class="row m-0 py-2 border-bottom align-items-center">
                            <div class="col-1">{{ $value->id }}</div>
                            <div class="col-3">{{ $value->forma_pagamento?->descricao }}</div>
                            <div class="col-3">{{ getMoney($value->taxa_porc) }}</div>
                            <div class="col-3">{{ getMoney($value->taxa_real) }}</div>
                            <div class="col text-center">
                                <a href="{{ route('admin.dca_taxas.edit', $value->id) }}"
                                    class="btn btn-primary btn-icon-only m-0 edit"><i class="fa fa-pencil bg-amarelo"></i></a>
                                <a href="{{ route('admin.dca_taxas.delete',$value->id) }}"
                                    class="btn btn-danger btn-destroy  btn-icon-only m-0"><i
                                        class="fas fa-trash bg-rosa"></i></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalTaxas" tabindex="-1" aria-labelledby="ModalTaxasLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalTaxasLabel">DCA Taxas</h5>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
      </div>
      <div class="modal-body">
      <form action="{{route('admin.dca_taxas.store')}}" id="formTaxas" method="POST"
          enctype="multipart/form-data">
              @csrf
              <div class="container row">
                <input type="hidden" name="id">
                <div class="col-12 col-sm-12">
                    <label for="">Forma de Pagamento * </label>
                    <select name="id_formas_pagamento" id="" class="form-select"> 
                        <option value="">Selecionar Forma de Pagamento:</option>
                        @foreach ($formas_pagamentos as $form)
                            <option value="{{ $form->id }}"> {{ ucfirst(mb_strtolower($form->descricao)) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-12 col-12 mt-3">
                  <label for="" class="titulo">Taxa Real *:</label>
                  <input type="text" name="taxa_real" class="form-control cad-form moneyMask" required>
                </div>
                <div class="col-sm-12 col-12 mt-3">
                  <label for="" class="titulo">Taxa Porc *:</label>
                  <input type="text" name="taxa_porc" class="form-control cad-form moneyMask" required>
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
$("#formTaxas").submit(function (e) {
    e.preventDefault();
    $("span.error").remove()
    $.ajax({
        type: "POST",
        url: $(this).attr('action'),
        data: $(this).serialize(),
        success: function (data) {
            console.log(data);
            if (data === "editado") {
                swal({
                    title: "Parabéns",
                    text: "Editado com sucesso!.",
                    icon: "success",
                }).then(function() {
                    location.reload();
                });
            } else {
                swal({
                    title: "Parabéns",
                    text: "Cadastro realizado com sucesso!.",
                    icon: "success",
                }).then(function() {
                    location.reload();
                });
            }
            $("#formTaxas")[0].reset();
            $(".disabled").remove();
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

$("body").on('click', '.edit', function (e) {
    e.preventDefault();
    var url = $(this).attr('href');
    $.get(url, function (data) {
        console.log(data)

        $("#ModalTaxas").modal('show');

        $("#formTaxas").attr('action', '{{ route("admin.dca_taxas.update") }}');
        $("#formTaxas").append('<input type="hidden" name="_method" value="PUT">');
        $("#formTaxas input[name='id']").val(data.id);
        $("#formTaxas select[name='id_formas_pagamento']").val(data.id_formas_pagamento);

        var taxaporc = getMoney(data.taxa_porc);
        $("#formTaxas input[name='taxa_porc']").val(taxaporc);

        var taxareal = getMoney(data.taxa_real);
        $("#formTaxas input[name='taxa_real']").val(taxareal);
        
        $("#formTaxas").addClass('show');
       
    })
})

$('#ModalTaxas').on('hidden.bs.modal', function () {
      $("#formTaxas")[0].reset();
      $("#formTaxas").attr('action', '{{route("admin.gateways.store")}}');
      $("#formTaxas input[name='_method']").remove();
  });
</script>

@endsection