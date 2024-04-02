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
        <a href="{{route('admin.empresas.new')}}" class="btn btn-primary">Adicionar</a>
    </div>
                </div>
                <div class="p-4">

                    <div class="row bg-dark text-light m-0 py-2">
                        <div class="col-1">ID</div>
                        <div class="col-8">Nome</div>
                        <div class="col-1">Status</div>
                        <div class="col text-center">Ações</div>
                    </div>

                    @forelse($empresas as $key => $value)
                        <div class="row m-0 py-2 border-bottom align-items-center">
                            <div class="col-1">{{ $value->id }}</div>
                            <div class="col-8">{{ $value->nome }}</div>
                            <div class="col-1">{{ $value->status }}</div>
                            <div class="col text-center">
                                <a href="{{ route('admin.empresas.edit', $value->id) }}"
                                    class="btn btn-primary btn-icon-only m-0"><i class="fa fa-pencil bg-amarelo"></i></a>
                                <a href="{{ route('admin.empresas.show',$value->id) }}"
                                    class="btn btn-primary show btn-icon-only m-0"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('admin.empresas.delete',$value->id) }}"
                                    class="btn btn-danger btn-destroy  btn-icon-only m-0"><i
                                        class="fas fa-trash bg-rosa"></i></a>
                            </div>
                        </div>
                    @empty
                    <div class="row">
                        <div class="col">
                            Nenhum empresa encontrada
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalEmpresa" tabindex="-1" aria-labelledby="ModalEmpresa" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalEmpresaLabel">Empresa</h5>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
      </div>
      <div class="modal-body">
            <div class="container row">
                <input type="hidden" name="id">
                <div class="col-12 col-sm-6 mt-2">
                    <strong>Nome:</strong><Br>
                    <p class="text-xs font-weight-bold mb-0" id="nome"></p>
                </div>
                <div class="col-sm-4 col-12 mt-2">
                    <strong>Contato:</strong><Br>
                    <p class="text-xs font-weight-bold mb-0" id="contato"></p>
                </div>
                <div class="col-sm-6 col-12 mt-2">
                    <strong>Telefone:</strong><Br>
                    <p class="text-xs font-weight-bold mb-0" id="telefone"></p>
                </div>
                <div class="col-sm-6 col-12 mt-2">
                    <strong>CNPJ:</strong><Br>
                    <p class="text-xs font-weight-bold mb-0" id="cnpj"></p>
                </div>
                <div class="col-12 mt-2">
                    <strong>E-mail:</strong><Br>
                    <p class="text-xs font-weight-bold mb-0" id="email"></p>
                </div>
                <hr>
                <h5>Endereço</h5>
                <div class="col-sm-3 col-12 mt-2">
                    <strong>CEP:</strong><Br>
                    <p class="text-xs font-weight-bold mb-0" id="cep"></p>
                </div>
                <div class="col-sm-6 col-12 mt-2">
                    <strong>Endereço:</strong><Br>
                    <p class="text-xs font-weight-bold mb-0" id="endereco"></p>
                </div>
                <div class="col-sm-2 col-12 mt-2">
                    <strong>Número:</strong><Br>
                    <p class="text-xs font-weight-bold mb-0" id="numero"></p>
                </div>
                <div class="col-sm-4 col-12 mt-2">
                    <strong>Complemento:</strong><Br>
                    <p class="text-xs font-weight-bold mb-0" id="complete"></p>
                </div>
                <div class="col-sm-6 col-12 mt-2">
                    <strong>Cidade:</strong><Br>
                    <p class="text-xs font-weight-bold mb-0" id="cidade"></p>
                </div>
                <div class="col-sm-2 col-12 mt-2">
                    <strong>Estado:</strong><Br>
                    <p class="text-xs font-weight-bold mb-0" id="estado"></p>
                </div>
            </div>
            <div class="mt-5">
                <div class="col-12 text-end">
                    <a href="" class="btn btn-primary"><i class="fa fa-pencil"></i> Editar</a>
                </div>
            </div>
      </div>
    </div>
  </div>
</div>


@endsection

@section('scripts')
<script>

$("body").on('click', '.show', function (e) {
    e.preventDefault();
    var url = $(this).attr('href');
    $.get(url, function (data) {
        console.log(data)

        $("#ModalEmpresa").modal('show');

        $("#ModalEmpresa #nome").text(data.nome);
        $("#ModalEmpresa #contato").text(data.nome_contato);
        $("#ModalEmpresa #telefone").text(data.telefone);
        $("#ModalEmpresa #cnpj").text(data.cnpj);
        $("#ModalEmpresa #email").text(data.email);
        $("#ModalEmpresa #cep").text(data.cep);
        $("#ModalEmpresa #endereco").text(data.endereco);
        $("#ModalEmpresa #numero").text(data.numero);
        $("#ModalEmpresa #complemento").text(data.complemento);
        $("#ModalEmpresa #cidade").text(data.cidade);
        $("#ModalEmpresa #estado").text(data.estado);
       
    })
})
</script>
@endsection