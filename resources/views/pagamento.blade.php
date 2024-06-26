@extends('layouts.pagamento')

@section('title',$produto->nome)
@section('pre-assets')

@endsection

@section('content')

<body>

    <header class="header-pagamento">
        <div class="row justify-content-center">
            <div class="col-auto text-center">

                <img src="{{asset($produto->media?->file)}}" class="img-fluid" alt="">

            </div>
        </div>

    </header>

    <div class="container fundo-pagamento" id="paymentBox">
        <form action="{{route('site.createBaseAccount',['token'=>$produto->token])}}" id="formPayment" class="">
            @csrf
            <div class="row p-sm-5 p-3 ">
                <div class="ownerInfo ">
                    <h6 class="text-center">Preencha o formulário para prosseguir com o pagamento </h6>

                    <div class="row mt-4">
                        <div class="col-sm-12 col-12">
                            <label for="inputEmail4" class="form-label">Nome Completo*</label>
                            <input type="text" class="form-control" placeholder="" value="{{$carrinho->lead?->nome}}" aria-label="First name" name="nome" id="nome" required>
                        </div>
                        <div class="col-sm-12 col-12 mt-sm-0 mt-3">
                            <label for="inputEmail4" class="form-label">Email*</label>
                            <input type="text" class="form-control" placeholder="teste@teste.com" value="{{$carrinho->lead?->email}}" aria-label="Last name" name="email" id="email" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-12 col-12">
                            <label for="inputEmail4" class="form-label">WhastApp*</label>
                            <input type="text" class="form-control phoneNumberMask" placeholder="(00) 00000-0000" value="{{$carrinho->lead?->telefone}}" aria-label="First name" name="celular" id="celular" required>
                        </div>
                        <!-- <div class="col-sm-6 col-12  mt-sm-0 mt-3">
                    <label for="inputEmail4" class="form-label">Ramo de Atividade</label>
                    <input type="text" class="form-control" placeholder="" aria-label="Last name" name="ramo" id="ramo">

                </div> -->
                    </div>
                    @if(!$carrinho->lead)
                    <div class="row">
                        <div class="col-12 text-center">
                            <button type="submit" class="mt-3 btn btn-primary" id="dataSave">Avançar</button>
                        </div>
                    </div>
                    @endif
                </div>



            </div>
            <div class="cardInfo  @if(!$carrinho->lead) d-none @endif ps-sm-5 pt-sm-3 p-3 xpto" id="cardInfo">
                <h1 class="title-pagamento ">Dados do Cartão</h1>
                <div class="row mt-sm-4 mt-0">
                    <div class="col-sm-6 col-12 mt-sm-0 mt-3">
                        <div class="row">
                            <div class="col-12">
                                <label for="inputEmail4" class="form-label">CPF*</label>
                                <input type="text" class="form-control cpfMask" placeholder="000.000.000-00" name="cpf" id="cpf" required>
                            </div>
                            <div class="col">
                                <label for="inputEmail4" class="form-label">Número do Cartão*</label>
                                <input type="text" class="form-control creditCardMask" placeholder="0000 0000 0000 0000" a name="cardNumber" id="cardNumber" required>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col">
                                <label for="inputEmail4" class="form-label">Nome impresso no Cartão*</label>
                                <input type="text" class="form-control " placeholder="" name="cardHolderName" id="cardHolderName" required>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-6">
                                <label for="inputEmail4" class="form-label">Validade*</label>
                                <input type="text" class="form-control expirationDateMask" placeholder="00/00" name="cardExpDate" id="cardExpDate" required>
                            </div>
                            <div class="col-6">
                                <label for="inputEmail4" class="form-label">Cód. de Segurança*</label>
                                <input type="number" class="form-control" placeholder="***" name="cardCcv" id="cardCcv" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-12 ">
                        <div class="row">
                            <div class="col mt-sm-0 mt-3">
                                <div class="imagens-cartao-pagamento">
                                    <img class="cartao-frente" src="{{asset('img/cartao-frente.svg')}}" alt="">
                                    <img class="cartao-verso" src="{{asset('img/cartao-verso.svg')}}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-sm-6 col-12">
                            <label for="inputEmail4" class="form-label">CEP Fatura*</label>
                            <input type="text" class="form-control cepMask" placeholder="00000-000" name="cep" id="cep" required>

                        </div>
                        <div class="col-sm-6 col-12">
                            <label for="inputEmail4" class="form-label">Número*</label>
                            <input type="number" class="form-control" placeholder="1234" name="numero" id="numero" required>
                        </div>
                    </div>
                </div>



                <hr class="my-5">



                <div class="row  mt-4">
                    @if($carrinho->produto->media)
                    <div class="col-sm-4">
                        <img src="{{$produto->media->fullpatch()}}" class="img-fluid">
                    </div>
                    @endif
                    <div class="col-auto">
                        <h4>{{$produto->nome}}</h4>

                        <p class="txt-pagamento">

                            {{$produto->descricao}}
                        </p>
                    </div>
                </div>

                <!-- <div class="row mt-4 ">
                <div class="col fundo-check">
                    <div class="form-check">
                        <label class="form-check-label" for="bonus">
                        <input class="form-check-input" type="checkbox" value="1" name="bonus" id="bonus">
                            Clique aqui para garantir seu checklist por apenas <span class="valor-checklist">R$7,90</span>
                        </label>
                    </div>
                </div>
            </div> -->
                <hr>


                <div id="carrinho">
                    @include('include._item')
                </div>

                <div class="result"></div>
                <hr class="my-5">
                <div class="row mt-3 justify-content-center align-items-center">
                    <div class="col-12 col-sm-auto">
                        <img src="{{asset('img/seloSeguranca.png')}}" alt="" class="img-selo">
                    </div>
                    <div class="col-12 col-sm-3">
                        <button class="btn btn-pagamento btn-success btn w-100" type="button" id="btnPayment">FINALIZAR</button>
                    </div>


                </div>
                <div id="loading" class="ms-3 pt-2 d-none">
                    <div class="row">
                        <div class="col-1">
                            <div class="spinner-border" role="status">
                                <!-- <span class="sr-only">...</span> -->
                            </div>
                        </div>
                        <div class="col-11 pt-1">
                            <p>Carregando...</p>
                        </div>
                    </div>

                </div>


            </div>
        </form>
    </div>

    <!-- Modal-->
    <div class="modal fade" id="exampleModalPopup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                </div>

                <div class="modal-body">

                    <div class="row">
                        <div class="col-sm-12">
                            @if(@$produto->popup?->media && $produto->popup->media?->file != "")
                            <img src="{{asset($produto->popup->media->fullpatch())}}" class="img-fluid" alt="">
                            @endif
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-12">
                            {!! $produto->popup->informativo ?? ''!!}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal-->
    <div class="modal fade" id="" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <!--   <div class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" role="dialog" aria-hidden="true" id="popup-pedido"> -->

        <div class="modal-dialog modal">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Popup</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close"><i class="fa-regular fa-circle-xmark"></i></button>
                </div>

                <div class="modal-body" id="conteudo-pedido">


                </div>

            </div>
        </div>
    </div>





</body>
@endsection


@section('scripts')
<script>
    // Mouse Leave
    function addEvent(obj, evt, fn) {
        if (obj.addEventListener) {
            obj.addEventListener(evt, fn, false);
        } else if (obj.attachEvent) {
            obj.attachEvent("on" + evt, fn);
        }
    }

    addEvent(window, "load", function(e) {
        addEvent(document, "mouseout", function(e) {
            e = e ? e : window.event;
            var from = e.relatedTarget || e.toElement;

            // Verifica se o mouse está saindo do viewport (janela)
            if (!from || from.nodeName === "HTML") {
                var mouseX = e.clientX;
                var mouseY = e.clientY;
                var windowWidth = window.innerWidth;
                var windowHeight = window.innerHeight;

                if (mouseX <= 0 || mouseX >= windowWidth || mouseY <= 0 || mouseY >= windowHeight) {
                    $('#exampleModalPopup').modal('show');
                }
            }
        });
    });

    function atualizarValorFinal() {
        const parcelas = $('select[name="numberTax"]').val();


        const valorTotal = $('input[name="valor"]').val();


        let valorPorParcela = (valorTotal / parcelas).toFixed(2);

        $('.parcela-pagamento').text('X de ' + new Intl.NumberFormat('pt-BR', {
            style: 'currency',
            currency: 'BRL'
        }).format(valorPorParcela));
    }

    $('body').on('change', 'select[name="numberTax"]', function() {
        atualizarValorFinal();
    });

    $('#bonus').change(function() {
        atualizarValorFinal();
    });

    $('body').on('click', '#aplicarCupom', function(e) {
        e.preventDefault()
        var cupom = $('input[name="cupom"]');


        if (cupom.val() == "") {
            cupom.addClass('error')
            return false;
        } else {
            cupom.removeClass('error')
        }
        var formData = new FormData();
        formData.append('_token', '{{csrf_token()}}');
        formData.append('cupom', cupom.val());
        formData.append('produto', '{{$produto->id}}');

        $.ajax({
            type: "POST",

            url: '{{route("site.aplicarCupom")}}',
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            success: function(data) {
                console.log(data)
                getCarrinho()
            },
            error: function(err) {
                var response = err.responseJSON;
                Swal.fire(
                    'Ops!',
                    response.msg,
                    'error'
                )
                $('#cupom').val('');
            }
        })

    });

    function getCarrinho() {
        $.get('{{route("site.carrinho")}}', function(data) {
            $("#carrinho").html(data);
        })
    }
    $('#dataSave').click(function(e) {
        const paymentData = document.querySelector(".cardInfo")
        const followbtn = document.querySelector('#dataSave');

        $('.ownerInfo input[required]').each(function() {
            if ($(this).val() == "") {
                $(this).addClass('error')
            } else {
                $(this).removeClass('error')
            }
        })
        if ($('.ownerInfo .error').length > 0) {
            $('.ownerInfo .error').closest('div').addClass('was-validated')
            return false;
        }
        $.ajax({
            type: "POST",
            url: "{{route('site.capturaLead',['token'=>$produto->token])}}",
            data: $('#formPayment').serialize(),
            success: function(data) {
                $(paymentData).removeClass('d-none')
                $(followbtn).addClass('d-none');
                $('html, body').animate({
                    scrollTop: $("#cardInfo").offset().top
                });
            },
            error: function(err) {
                Swal.fire(
                    'Ops!',
                    'Preencha todos os dados para prosseguir com o pagamento!',
                    'error'
                )
            }
        })
    })


    $("body").on('click', '#btnPayment', function(e) {
        e.preventDefault();

        $(".result").html('')
        $('#cardInfo input[required]').each(function() {
            if ($(this).val() == "") {
                $(this).addClass('error')
            } else {
                $(this).removeClass('error')
            }
        })
        if ($('#cardInfo .error').length > 0) {
            $('#cardInfo .error').closest('div').addClass('was-validated');
            $('html, body').animate({
                scrollTop: $("#cardInfo").offset().top
            });
            return false;
        }
        const btnPayment = document.querySelector('#btnPayment')
        const loadingElement = document.querySelector('#loading')
        const thankYou = document.querySelector('#thanksPage')
        const paymentElement = document.querySelector('#paymentBox')

        $(loadingElement).removeClass('d-none');
        btnPayment.setAttribute('disabled', 'disabled');

        $.ajax({
            type: "POST",
            url: $("#formPayment").attr('action'),
            data: $("#formPayment").serialize(),
            success: function(data) {
                console.log(data)
                $(loadingElement).addClass('d-none');
                btnPayment.removeAttribute('disabled');

                if (data.status == 'ok') {

                    window.location.href = data.url;


                } else {
                    var html = ''
                    $(data.data).each(function(i, v) {
                        html += '<div>' + v.description + '</div>';
                    })
                    $(".result").html(`<div class="alert alert-danger my-3" role="alert">
                    ` + html + `
                    </div>`);

                }
            },
            error: function(err) {
                $(loadingElement).addClass('d-none');
                btnPayment.removeAttribute('disabled');
                Swal.fire(
                    'Ops!',
                    'Algo deu errado, por favor tente novamente mais tarde!',
                    'error'
                )
            }
        })
    })
    $("body").on('focus', 'input[name="cardCcv"]', function(e) {
        $(".cartao-frente").animate({
            zIndex: 1
        })
        $(".cartao-verso").animate({
            zIndex: 10
        })
        // $(".cartao-verso").css('z-index','10')
    })
    $("body").on('focus', 'input[name="cardExpDate"], input[name="cardHolderName"]', function(e) {
        $(".cartao-frente").animate({
            zIndex: 10
        })
        $(".cartao-verso").animate({
            zIndex: 1
        })
        // $(".cartao-verso").css('z-index','10')
    })
</script>

@endsection