@extends('layouts.app')

@section('assets')

@endsection

@section('content')
<div class="row">
    <div class="col-6">
        <div class="card">
            <form action="{{route('admin.integracoes.store')}}" id="formStore">
                @csrf
                <input type="hidden" name="id_integracao" value="{{$integracao?->id}}">
                <input type="hidden" name="token_public" value="">
                
             
      
                <div class="card-header border-bottom">
                    <div class="row justify-content-center">
                        <div class="col-6"><img src="{{asset('img/integracoes/eadsimples.png')}}" class="w-100" alt=""></div>
                    </div>

                </div>
                <div class="card-body">

                    <div class="row mb-3">
                        <div class="col">
                            <h5>Parametros</h5>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">Status</div>
                        <div class="col-8">
                            <div class="form-check form-switch">
                                <input class="form-check-input status-categoria" type="checkbox" name="status" role="switch" value="ativo" 
                                @if($integracao->status == 'ativo') checked  @endif >
                                <label class="form-check-label" for="flexSwitchCheckChecked">Inativo</label>
                            </div>

                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">Ambiente</div>
                        <div class="col-8">
                            <select name="ativado" id="" class="form-select">
                                <option value="sandbox" @if($integracao?->parametros?->ativado == 'sandbox') selected @endif>Sandbox (teste)</option>
                                <option value="producao" @if($integracao?->parametros?->ativado == 'producao') selected @endif>Produção</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-4">Endpoint Produção</div>
                        <div class="col-8">
                            <input type="text" class="form-control" name="endpoint_producao" value="{{$integracao->parametros?->endpoint_producao}}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">Endpoint Sandbox</div>
                        <div class="col-8">
                            <input type="text" class="form-control" name="endpoint_sandbox" value="{{$integracao->parametros?->endpoint_sandbox}}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">Client Secret</div>
                        <div class="col-8">
                            <input type="text" class="form-control" name="token_private" value="{{$integracao->parametros?->token_private}}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">Cliente ID</div>
                        <div class="col-8">
                            <input type="text" class="form-control" name="cliente_id" value="{{$integracao->parametros?->cliente_id}}">
                        </div>
                    </div>
                   
                </div>
                <div class="card-footer border-top">
                    <div class="row">
                        <div class="col">
                            <a href="{{route('admin.integracoes.index')}}" class="btn btn-secondary">Voltar</a>
                        </div>
                        <div class="col text-end">
                            <button type="submit" class="btn btn-success">Salvar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $("body").on('submit', '#formStore', function(e) {
        e.preventDefault();
        $("span.error").remove();
        $(this).find('.loading').show();
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function(data) {
                console.log(data);
                $('.loading').hide();

                swal({
                    title: "Parabéns",
                    text: "Integração atualizada com sucesso.",
                    icon: "success",
                })
            },
            error: function(err) {
                console.log(err);
                $('.loading').hide();
                if (err.status == 422) { // when status code is 422, it's a validation issue
                    console.log(err.responseJSON);
                    $('#success_message').fadeIn().html(err.responseJSON.message);
                    // you can loop through the errors object and show it to the user
                    console.warn(err.responseJSON.errors);
                    // display errors on each form field
                    $.each(err.responseJSON.errors, function(i, error) {
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