<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="shortcut icon" href="{{asset('img/logo3.svg')}}" type="image/x-icon">
  

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <link href="{{asset('build/assets/app-c59b5838.css')}}" rel="stylesheet">
  @yield('pre-assets')

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

</head>

<body>

<div id="tudo">
<div id="conteudo">
  @yield('content')
  </div>
<footer>
  <div class="container" id="desenvolvido">
        <div class="row">
            <div class="col r">
                Desenvolvido por <a href="https://dvelopers.com.br" target="_blank"><img src="https://dvelopers.com.br/assets/img/logo-dvelopers.svg" alt=""></a>
            </div>
        </div>
    </div>
    </footer>
    </div>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.14/jquery.mask.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{asset('build/assets/app-a83ed21d.js')}}"></script>
  <script>
    $('.timeMask').mask('00:00');
    $('.dataMask').mask('00/00/0000');
    $('.dateTimeMask').mask('00/00/0000 00:00:00');
    $('.cepMask').mask('00000-000');
    $('.mixed').mask('AAA 000-S0S');
    $('.cpfMask').mask('000.000.000-00', {
      reverse: true
    });
    $('.creditCardMask').mask('0000 0000 0000 0000');
    $('.expirationDateMask').mask('00/00');
    $('.phoneNumberMask').mask('(00) 00000-0000');
    $('.maskMoney').mask('000.000.000.000.000,00', {
      reverse: true
    });
    $('.numberMask').mask("#.##0", {
      reverse: true
    });
    $('.money').mask('000.000.000.000.000,00', {
      reverse: true
    });
    $('.money2').mask("#.##0,00", {
      reverse: true
    });
  </script>
  @yield('scripts')
</body>

</html>