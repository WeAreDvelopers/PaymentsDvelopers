@extends('layouts.app')
@section('assets')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css" integrity="sha512-zxBiDORGDEAYDdKLuYU9X/JaJo/DPzE42UubfBw9yg8Qvb2YRRIQ8v4KsGHOx2H1/+sdSXyXxLXv5r7tHc9ygg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
.containerUpload {
  background-color: transparent;
  text-transform: uppercase;
  text-align: center;
  display: block;
  cursor: pointer;
  position: relative;
}
.containerUpload i{
  font-size: 20px;
}

.containerUpload p{
  font-size: 12px;
}
.containerUpload input{
  position: absolute;
  width: 100%;
  height: 100%;
  opacity: 0;
  top:0;
  left: 0;
  cursor: pointer;
}

.foto-img{
  height: 250px;
  max-width: 250px;
  object-fit: none;
  border-radius: 50%;
  border: 2px solid #D3D3D3;
}

.foto-close{
  display: block;
  width: 260px;
}

.foto-close i{
  float: right;
  color: #E41DA0;
}

.profile input {
    position: absolute;
    opacity: 0;
    width: 100%;
    height: 100%;
    z-index: 10;
    left: 0;
    top: 0;
    cursor: pointer;
}
        
.custom-select {
    position: relative;
    display: inline-block;
    width: 100%;
}
.custom-select-selected {
    display: flex;
}

.custom-select-options {
    position: absolute;
    border: 1px solid #ccc;
    border-top: none;
    border-radius: 0 0 4px 4px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 100%;
    background: #fff;
}

.custom-select-option {
    padding: 8px;
    cursor: pointer;
}
.custom-select-options img{
    width: 70px;
}

#imgBandeira{
    width: 70px;
}
</style>
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
                    <form action="{{route('admin.formas_pagamentos.update', $forma_pagamento->id)}}" id="formStore">
                        @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="status" id="flexSwitchCheckDefault" @if ($forma_pagamento->status == 'ativo')checked="" value="ativo" @endif>
                            <label class="form-check-label" for="flexSwitchCheckDefault">@if ($forma_pagamento->status == 'ativo') Ativo @else Inativo @endif</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-12 col-sm-4">
                            <label for="">Empresa * </label>
                            <select name="id_empresa" id="" class="form-select"> 
                                <option value="">Selecionar Empresa:</option>
                                @foreach ($empresas as $emp)
                                    <option value="{{ $emp->id }}" @if ($forma_pagamento->id_empresa == $emp->id) selected @endif> {{ ucfirst(mb_strtolower($emp->nome)) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-sm-4">
                            <label for="">Gateway * </label>
                            <select name="id_gateway" id="" class="form-select"> 
                                <option value="">Selecionar Gateway:</option>
                                @foreach ($gateways as $gat)
                                    <option value="{{ $gat->id }}" @if ($forma_pagamento->id_gateway == $gat->id) selected @endif> {{ ucfirst(mb_strtolower($gat->descricao)) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-sm-4">
                            <label for="">Bandeira * </label>
                            <a href="#" class="" data-bs-toggle="modal" data-bs-target="#ModalBandeira">
                                Criar Bandeira
                            </a>
                            <div class="" id="viewBandeira">
                                @include('admin.formas_pagamentos._bandeiras')
                            </div>

                            
                        </div>
                        <div class="col-12 col-sm-8">
                            <label for="">Descrição * </label>
                            <input type="text" name="descricao" required class="form-control" value="{{$forma_pagamento->descricao}}">
                        </div>
                        <div class="col-4 col-sm-4">
                            <label for="">Tipo * </label>
                            <select name="tipo" id="" class="form-select"> 
                                <option value="">Selecionar:</option>
                                <option value="credito" @if ($forma_pagamento->tipo == 'credito') selected @endif>Crédito</option>
                                <option value="debito" @if ($forma_pagamento->tipo == 'debito') selected @endif>Débito</option>
                            </select>
                        </div>
                        <div class="col-12 col-sm-3">
                            <label for="">Taxa Real</label>
                            <input type="text" name="taxa_real" class="form-control cad-form" value="{{getMoney($forma_pagamento->taxa_real)}}">
                        </div>
                        <div class="col-12 col-sm-3">
                            <label for="">Taxa Porcentagem</label>
                            <input type="text" name="taxa_porc" class="form-control cad-form" value="{{getMoney($forma_pagamento->taxa_porc)}}">
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

<div class="modal" id="modalProfile" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Imagem</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="upload-result"></div>
        <div class="row">
          <div class="col text-center">
            <button class="btn btn-icon btn-primary rotate" data-angle="-90"><i class="fas fa-undo"></i></button>
          
            <button class="btn btn-icon btn-primary rotate" data-angle="90"><i class="fas fa-undo fa-flip-horizontal"></i></button>
          </div>
        </div>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary close-modal" data-bs-dismiss="modal" aria-label="Close">Close</button>
        <button type="button" class="btn btn-primary saveResult">Salvar</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
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
                text: "Atualização realizado com sucesso!.",
                icon: "success",
                }).then((result) => {
                            window.location.href = data.url;
                      
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
<script>
    function createCroppie() {
        var $uploadCrop;

        function initCroppie() {
            $uploadCrop = $('#upload-result').croppie({
                enableExif: true,
                enableOrientation: true,
                viewport: {
                    width: 200,
                    height: 100,
                },
                boundary: {
                    width: 300,
                    height: 300
                }
            });
        }
        initCroppie();

        function resetCroppie() {
            $uploadCrop.croppie('destroy');
            initCroppie();
        }

        $("body").on('click', '.rotate', function (e) {
            e.preventDefault();
            $uploadCrop.croppie('rotate', $(this).data('angle'));
        });

        $('#modalProfile').on('hidden.bs.modal', function () {
            resetCroppie();
        });

        $('body').on('change', '#uploadArquivos', function () {
            $(".loading").show(0);
            var data = new FormData();
            $.each($(this)[0].files, function (i, file) {
                data.append('file', file);
            });
            data.append('_token', '{{ csrf_token() }}');

            $.ajax({
                url: '{{ route("admin.formas_pagamentos.uploadProfile") }}',
                type: 'POST',
                cache: false,
                contentType: false,
                processData: false,
                data: data,
                success: function (result) {
                    console.log(result);
                    $('#uploadArquivos').val('');
                    $("#modalProfile").modal('show');

                    $uploadCrop.croppie('bind', {
                        url: '{{asset("storage/profiles/")}}/' + result,
                    });

                    $(".loading").hide(0);
                },
                error: function (result) {
                    swal("Opa!", "Algo deu errado.", "info");
                    $(".loading").hide(0);
                }
            });
        });

        $("body").on('click', '.saveResult', function (e) {
            $uploadCrop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (resp) {
                $(".profile img").show();
                $(".profile img").attr('src', resp)
                $("input[name='file']").val(resp)
                $("#modalProfile").modal('hide');
            });
        });
    }

    // Chame a função createCroppie
    createCroppie();

    $("#formStoreBandeira").submit(function (e) {
    e.preventDefault();
    $("span.error").remove();

    $.ajax({
        type: "POST",
        url: $(this).attr('action'),
        data: $(this).serialize(),
        success: function (data) {
            $("#ModalBandeira").modal('hide');
            $(".modal-backdrop").hide();
            $("#viewBandeira").empty();
            $("#viewBandeira").html(data);
            $("#formStoreBandeira")[0].reset();
            $(".disabled").remove();
        },
        error: function (xhr, status, error) {
            console.log("erro");
        }
    });
});



$("body").on('click', '.custom-select-selected', function (event) {
    var options = document.querySelector('.custom-select-options');
    options.style.display = (options.style.display === 'block') ? 'none' : 'block';
});


$("body").on('click', '.custom-select-option', function (event) {
    var selectedValue = $(this).data('value');
    var selectedText = $(this).text();
    var srcValue = $(this).find("img").attr("src");
    var options = document.querySelector('.custom-select-options');
    var imagem = document.getElementById("imgBandeira");
    var text = document.getElementById("textBandeira");
    options.style.display = "none";
    if (srcValue){
        imagem.style.display = "block";
        imagem.src = srcValue;
    }
    else{
        imagem.style.display = "none";
    }
    text.textContent = selectedText;
    $("#opcoes").val(selectedValue);
});

</script>
@endsection