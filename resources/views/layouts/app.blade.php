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
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{asset('assets/nucleo-icons.css')}}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/40b7169917.js" crossorigin="anonymous"></script>
  <!-- Estilos CSS / TOGGLE-->
  <link rel="stylesheet" href="{{asset('css/toggle_Switch.css')}}">
  <link rel="stylesheet" href="{{asset('css/estilos.css')}}">
<!-- DataTables CSS -->
  <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">

  <link href="{{asset('assets/nucleo-svg.css')}}" rel="stylesheet" />
  @vite(['resources/scss/app.scss', 'resources/js/app.js'])

 
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
  <!-- Account MOney -->
  <script src="{{asset('assets/js/accounting.min.js')}}"></script>
  <!-- DataTables-->
  <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
  <!--   Core JS Files   -->
  <script src="{{asset('/assets/js/core/popper.min.js')}}"></script>
  <script src="{{asset('/assets/js/core/bootstrap.min.js')}}"></script>
  <script src="{{asset('/assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
  <script src="{{asset('/assets/js/plugins/smooth-scrollbar.min.js')}}"></script>

  
  <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script><!-- Custom Javascript -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/pt.js"></script>
  <script src="https://kit.fontawesome.com/40b7169917.js" crossorigin="anonymous"></script>
 
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

  


</script>

@yield('scripts')
@stack('scripts')
</body>

</html>