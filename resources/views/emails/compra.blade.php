@extends('layouts.emails')

@section('content')
<table width="100%" border="0" cellpadding="10">
  <tr>
    <td>Olá, {{explode(' ',$name)[0]}}!</td>
  </tr>

  <tr>
    <td width="100%"><p>Já está disponível para download o conteúdo adquirido: &ldquo;<strong>E-book  Checklist precificaçã</strong>o&rdquo;</p>
      <p>Clique no botão abaixo para fazer o download<br />
  </p></td>
  </tr> 
   <tr>
    <td align="center"  style="border-radius: 3px;">
        <a href="https://precificacao.numerosnaomentem.app.br/E-bookChecklistPrecificacao.pdf" target="_blank" style="font-size: 16px; color: #ffffff; text-decoration: none; padding: 15px 30px; display: inline-block; background-color:#002147" bgcolor="#002147">Baixar Agora</a>
      </td>
  </tr>
  <tr>
    <td><hr /></td>
    </tr>
  <tr>
    <td align="center">Caso você precise falar com o nosso suporte </td>
    </tr>
  <tr>
    <td align="center">envie um e-mail para suporte@numerosnaomentem.com.br <br />
      ou - envie uma mensagem via whatsapp (43) 99173-5094 </td>
    </tr>
 <tr>
    <td><hr /></td>
    </tr>
  <tr>
    <td align="center">&nbsp;</td>
    </tr>
  <tr>
    <td><p>Att, Equipe Números Não Mentem</p></td>
  </tr>
</table>
@endsection