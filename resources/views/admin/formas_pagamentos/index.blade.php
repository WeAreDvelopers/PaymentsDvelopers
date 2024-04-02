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
                        <a href="{{route('admin.formas_pagamentos.new')}}" class="btn btn-primary">Adicionar</a>
                    </div>
                </div>
                <div class="p-4">

                    <div class="row bg-dark text-light m-0 py-2">
                        <div class="col-1">ID</div>
                        <div class="col">Empresa</div>
                        <div class="col">Descrição</div>
                        <div class="col">Tipo</div>
                        <div class="col-2 text-center">Status</div>
                        <div class="col-1 text-center">Ações</div>
                    </div>

                    @foreach($formas_pagamentos as $key => $value)
                        <div class="row m-0 py-2 border-bottom align-items-center">
                            <div class="col-1">{{ $value->id }}</div>
                            <div class="col">{{ $value->id_empresa }}</div>
                            <div class="col">{{ $value->descricao }}</div>
                            <div class="col">{{ $value->tipo }}</div>
                            <div class="col-2 text-center">{{ $value->status }}</div>
                            <div class="col-1 text-center">
                                <a href="{{ route('admin.formas_pagamentos.edit', $value->id) }}"
                                    class="btn btn-primary btn-icon-only m-0"><i class="fa fa-pencil bg-amarelo"></i></a>
                                <a href="{{ route('admin.formas_pagamentos.delete',$value->id) }}"
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


@endsection

@section('script')

@endsection