<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Números Não Mentem</title>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="shortcut icon" href="{{asset('img/logo3.svg')}}" type="image/x-icon">
  

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  @vite(['resources/scss/app.scss', 'resources/js/app.js'])
  @yield('pre-assets')



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