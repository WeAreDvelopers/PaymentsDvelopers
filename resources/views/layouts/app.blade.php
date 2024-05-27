<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- TOKEN -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>
  {{config('APP_NAME')}}
  </title>
  <link rel="apple-touch-icon" sizes="57x57" href="{{asset('assets/img/favicon/apple-icon-57x57.png')}}">
  <link rel="apple-touch-icon" sizes="60x60" href="{{asset('assets/img/favicon/apple-icon-60x60.png')}}">
  <link rel="apple-touch-icon" sizes="72x72" href="{{asset('assets/img/favicon/apple-icon-72x72.png')}}">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/favicon/apple-icon-76x76.png')}}">
  <link rel="apple-touch-icon" sizes="114x114" href="{{asset('assets/img/favicon/apple-icon-114x114.png')}}">
  <link rel="apple-touch-icon" sizes="120x120" href="{{asset('assets/img/favicon/apple-icon-120x120.png')}}">
  <link rel="apple-touch-icon" sizes="144x144" href="{{asset('assets/img/favicon/apple-icon-144x144.png')}}">
  <link rel="apple-touch-icon" sizes="152x152" href="{{asset('assets/img/favicon/apple-icon-152x152.png')}}">
  <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/img/favicon/apple-icon-180x180.png')}}">
  <link rel="icon" type="image/png" sizes="192x192"  href="{{asset('assets/img/favicon/android-icon-192x192.png')}}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/img/favicon/favicon-32x32.png')}}">
  <link rel="icon" type="image/png" sizes="96x96" href="{{asset('assets/img/favicon/favicon-96x96.png')}}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/img/favicon/favicon-16x16.png')}}">
  <link rel="manifest" href="{{asset('assets/img/favicon/manifest.json')}}">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="{{asset('assets/img/favicon/ms-icon-144x144.png')}}">
  <meta name="theme-color" content="#ffffff">
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{asset('assets/css/nucleo-icons.css')}}" rel="stylesheet" />

  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/40b7169917.js" crossorigin="anonymous"></script>
  
  <!-- Estilos CSS / TOGGLE-->
  <link rel="stylesheet" href="{{asset('css/toggle_Switch.css')}}">
  <link rel="stylesheet" href="{{asset('css/estilos.css')}}">
<!-- DataTables CSS -->
  <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">

  <link href="{{asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />

<!-- include SUMMER NOTE css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<!-- CSS do Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

  <link href="{{asset('build/assets/app-c59b5838.css')}}" rel="stylesheet">

 
  @yield('assets')
  @stack('assets')
  <style>
    .navbar-vertical .navbar-nav .nav-item .nav-link .icon i {
      color: #1D3857 !important;
      font-size: 15px;
    }
  </style>
</head>

<body class="g-sidenav-show  bg-gray-100">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
    
    @include('layouts._aside')
  </aside>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
   
  <div class="row justify-content-end pt-4">
    
      <div class="col-2">
        @if(Auth::check())
          <form method="POST" action="{{ route('logout') }}">
          @csrf
            <button class="btn btn-secondary" type="submit"><i class="fa-solid fa-right-from-bracket mx-1"></i>Sair</button>
        
          </form>
    @endif
      </div>
  </div>

  <!-- CONTEUDO -->
    <div class="container-fluid py-2">
       @yield('content')
    </div>
  </main>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <!-- JavaScript do Bootstrap 5 (opcional, se você precisar de funcionalidades JS do Bootstrap) -->

  <!-- SUmmer Note -->
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
  <!-- Account MOney -->
  <script src="{{asset('assets/js/accounting.min.js')}}"></script>
  <!-- DataTables-->
  <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
  <!--   Core JS Files   -->
  <script src="{{asset('/assets/js/core/popper.min.js')}}"></script>
  
  <script src="{{asset('/assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
  <script src="{{asset('/assets/js/plugins/smooth-scrollbar.min.js')}}"></script>

  
  <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script><!-- Custom Javascript -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/pt.js"></script>
  <script src="https://kit.fontawesome.com/40b7169917.js" crossorigin="anonymous"></script>
  <script src="{{asset('build/assets/app-a83ed21d.js')}}"></script>
  <script>
   
   $("body").on('change' , '.form-switch .form-check-input',function(){
   
      if($(this).is(':checked')){
        $(this).siblings('label').html('Ativo')
        $(this).val('ativo');
      }else{
        $(this).siblings('label').html('Inativo')
        
      }
   })


    function getMoney(numero) {
         return new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(numero).replace('R$', '');
    }
// MASCARAS
    var SPMaskBehavior = function (val) {
      return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    },
    spOptions = {
      onKeyPress: function(val, e, field, options) {
          field.mask(SPMaskBehavior.apply({}, arguments), options);
        }
    };

    $('.phoneMask').mask(SPMaskBehavior, spOptions);
    $('.moneyMask').mask("#.##0,00", {reverse: true});
    $('.cepMask').mask('00000-000');
    $('.cpfMask').mask('000.000.000-00', {reverse: true});
    $('.cnpjMask').mask('00.000.000/0000-00', {reverse: true});
    $('.creditCardMask').mask('0000 0000 0000 0000');
    $('.expirationDateMask').mask('00/00');
    $('.celMask').mask('(00) 00000-0000');

// jQuery COLLAPSE  
$("body").on('click','.tooglegeCollapse',function(e){
        
        e.preventDefault();
        var alvo = $(this).data('target');
        $(".collapse").not(alvo).removeClass('show');
        $(alvo).toggleClass('show')
    })
   
// DESTROY
    $(".btn-destroy").click(function(e){
      var url = $(this).attr('href');
      e.preventDefault();
      $(this).closest('tr').addClass("remove-row");
      $(this).closest('.row').addClass("remove-row");
      swal({
        title: "Você tem certeza?",
        text: "Você removerá permanentemente este item",
        icon: "warning",
        dangerMode: true,
        buttons:{
          cancel: {
            text: "Cancel",
            value: null,
            visible: true,
            className: "",
            closeModal: true,
          },
          confirm: {
            text: "OK",
            value: true,
            visible: true,
            className: "",
            closeModal: true
          }
        }
      }) .then(willDelete => {
       if (willDelete) {

        $.ajax({
            url: url,
            type: 'GET',
            success: function(data){ 
                if (willDelete) {
                    $(".remove-row").remove();
                swal("Sucesso!", "Item removido com sucesso", "success");
                }
            },
            error: function(err) {
               var erro = err.responseJSON
                swal("Atenção!", erro.error, "error");
            }
        });

        
       }
     });
    })
    function buscaCep(cep) {
        $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {
            $("input[name='endereco']").val(dados.logradouro)
            $("input[name='bairro']").val(dados.bairro)
            $("input[name='cidade']").val(dados.localidade)
            $("input[name='estado']").val(dados.uf)

        });
    }
    $("#buscaCep").change(function () {
        buscaCep($(this).val())
    });

    $("#searchCep").click(function (e) {
        e.preventDefault();
        buscaCep($("#buscaCep").val())
    })

// GetMoney e SaveMoney
    function saveMoney($value) {

    if ($value === null) {
        return 0.00;
    }
    var $money = $value.replace(".", "");

    $money = $money.replace(",", ".", $money);

    return $money;
    }

    function getMoney($value) {

    if ($value === null) {
        return '';
    }

    return accounting.formatMoney($value,'', 2, ".", ",");
    }

  
    // CPF VALIDADOR
    $('#cpf').on('change', function() {

    var cpfInput = this.value;

    if (validaCPF(cpfInput)) { 
      
    return true

    } else {
      
        swal({
              title: "CPF inválido!",
              icon: "error",
              }).then(function() {
        
                $('#cpf').val('');
              });
    }
    });

    function validaCPF(cpf) {
    var Soma = 0
    var Resto

    var strCPF = String(cpf).replace(/[^\d]/g, '')

    if (strCPF.length !== 11)
      return false

    if ([
      '00000000000',
      '11111111111',
      '22222222222',
      '33333333333',
      '44444444444',
      '55555555555',
      '66666666666',
      '77777777777',
      '88888888888',
      '99999999999',
      ].indexOf(strCPF) !== -1)
      return false

    for (i=1; i<=9; i++)
      Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);

    Resto = (Soma * 10) % 11

    if ((Resto == 10) || (Resto == 11)) 
      Resto = 0

    if (Resto != parseInt(strCPF.substring(9, 10)) )
      return false

    Soma = 0

    for (i = 1; i <= 10; i++)
      Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i)

    Resto = (Soma * 10) % 11

    if ((Resto == 10) || (Resto == 11)) 
      Resto = 0

    if (Resto != parseInt(strCPF.substring(10, 11) ) )
      return false

    return true
    }

</script>

@yield('scripts')
@stack('scripts')
</body>

</html>