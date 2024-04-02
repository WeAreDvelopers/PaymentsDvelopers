@extends('layouts.emails')

@section('content')
<table width="100%" border="0" cellpadding="10">
  <tr>
    <td colspan="2"><p>Olá, {{explode(' ',$name)[0]}} seja muito bem-vindo(a)! <br />
    </p></td>
  </tr>
  <tr>
    <td width="15%"><img src="{{asset('img/Claudia-Bharauna.png')}}" style="
    width: 100px;
    height: 95px;
" /></td>
    <td width="85%"><p>Aqui é a Claudia Bharaúna, CEO da <strong>N</strong>úmeros <strong>N</strong>ão <strong>M</strong>entem!</p>
      <p><em>Parabéns pela decisão de encarar os números do seu negócio e  estar comprometido(a) a gerar o lucro que você e sua empresa merecem!</em></p></td>
  </tr>
  <tr>
    <td colspan="2"><p><strong>Vamos aos primeiros passos:</strong></p></td>
  </tr>
  <tr>
    <td><strong>1º  Passo</strong></td>
    <td>Você pode <a href="https://app.numerosnaomentem.com.br" target="_blank">clicar aqui </a>para fazer o seu login na Números Não Mentem</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><table width="100%" border="0" cellspacing="5">
      <tr>
        <td width="33%"><strong>Acesse:</strong></td>
        <td width="67%"><a href="https://app.numerosnaomentem.com.br">https://app.numerosnaomentem.com.br</a></td>
      </tr>
      <tr>
        <td><strong>Login:</strong></td>
        <td>{{@$email}}</td>
      </tr>
      <tr>
        <td><strong>Senha:</strong></td>
        <td>{{@$senha}}</td><br>
        <small class="w-100">*Você poderá trocar essa senha posteriormente na plataforma.</small>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><strong>2º  Passo</strong></td>
    <td>Participe da comunidade <strong>VIP</strong> <strong>N</strong>úmeros <strong>N</strong>ão <strong>M</strong>entem </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><a href="https://chat.whatsapp.com/E6M69JUzOMZH7eXrliXsuY">https://chat.whatsapp.com/E6M69JUzOMZH7eXrliXsuY</a></td>
  </tr>
  <tr>
    <td colspan="2"><hr /></td>
    </tr>
  <tr>
    <td colspan="2" align="center"><span class="font-weight-bolder">Caso você precise falar com o nosso suporte </span></td>
    </tr>
  <tr>
    <td colspan="2" align="center">envie um e-mail para suporte@numerosnaomentem.com.br <br />
      ou - envie uma mensagem via whatsapp (43) 99173-5094 </td>
    </tr>
 <tr>
    <td colspan="2"><hr /></td>
    </tr>
  <tr>
    <td colspan="2" align="center"><h5>Agora você está pronto(a) para  começar!<br />
    </h5>
      <p class="float-left mt-3">Te Espero dentro da plataforma. </p></td>
    </tr>
  <tr>
    <td colspan="2"><p>Claudia Bharaúna<br />
      CEO – Números Não Mentem</p></td>
    </tr>
</table>
@endsection