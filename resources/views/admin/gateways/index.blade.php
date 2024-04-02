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
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalGateway">
                            Adicionar
                        </button>
                    </div>
                </div>
                <div class="p-4">

                    <div class="row bg-dark text-light m-0 py-2">
                        <div class="col-1">ID</div>
                        <div class="col-4">Descrição</div>
                        <div class="col-3">Taxa Padrão</div>
                        <div class="col-1 text-center">Status</div>
                        <div class="col text-center">Ações</div>
                    </div>

                    @foreach($gateways as $key => $value)
                        <div class="row m-0 py-2 border-bottom align-items-center">
                            <div class="col-1">{{ $value->id }}</div>
                            <div class="col-4">{{ $value->descricao }}</div>
                            <div class="col-3">{{ $value->taxa_padrao }}</div>
                            <div class="col-1 text-center">{{ $value->status }}</div>
                            <div class="col text-center">
                                <a href="{{ route('admin.gateways.edit', $value->id) }}"
                                    class="btn btn-primary btn-icon-only m-0 edit"><i class="fa fa-pencil bg-amarelo"></i></a>
                                <a href="{{ route('admin.gateways.delete',$value->id) }}"
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

<div class="modal fade" id="ModalGateway" tabindex="-1" aria-labelledby="ModalReuniaoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalReuniaoLabel">Gateway</h5>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
      </div>
      <div class="modal-body">
      <form action="{{route('admin.gateways.store')}}" id="formGateway" method="POST"
          enctype="multipart/form-data">
              @csrf
              <div class="container row">
                <div class="col">
                    <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="status" id="flexSwitchCheckDefault" checked="" value="ativo">
                    <label class="form-check-label" for="flexSwitchCheckDefault">Ativo</label>
                    </div>
                </div>
              </div>
              <div class="container row">
                <input type="hidden" name="id">
                <div class="col-sm-12 col-12 mt-3">
                  <label for="" class="titulo">Descrição: *</label>
                  <input type="text" name="descricao" class="form-control cad-form" required>
                </div>
                <div class="col-sm-12 col-12 mt-3">
                  <label for="" class="titulo">Taxa Padrão *:</label>
                  <input type="text" name="taxa_padrao" class="form-control cad-form moneyMask" required>
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
$("#formGateway").submit(function (e) {
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
            $("#formGateway")[0].reset();
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

        $("#ModalGateway").modal('show');

        $("#formGateway").attr('action', '{{ route("admin.gateways.update") }}');
        $("#formGateway").append('<input type="hidden" name="_method" value="PUT">');
        $("#formGateway input[name='id']").val(data.id);
        $("#formGateway input[name='descricao']").val(data.descricao);

        var taxa = getMoney(data.taxa_padrao);
        $("#formGateway input[name='taxa_padrao']").val(taxa);
        
        $("#formGateway").addClass('show');
       
    })
})

$('#ModalGateway').on('hidden.bs.modal', function () {
      $("#formGateway")[0].reset();
      $("#formGateway").attr('action', '{{route("admin.gateways.store")}}');
      $("#formGateway input[name='_method']").remove();
  });
</script>

@endsection