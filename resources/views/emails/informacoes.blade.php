@extends('layouts.emails')

@section('content')
<style>
    body {
      font-family: Arial, sans-serif;
    }
    .container {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
      background-color: #f2f2f2;
    }
    .header {
      background-color: #007BFF;
      color: #ffffff;
      text-align: center;
      padding: 10px;
    }
    .order-details {
      background-color: #ffffff;
      padding: 20px;
      border: 1px solid #e0e0e0;
    }
  </style>
<table width="100%" border="0" cellpadding="10">
  <tr>
    <td>Olá, {{explode(' ',$name)[0]}}!</td>
  </tr>

  <tr>
    <td width="100%"><div class="order-details">
      <h2>Número do Pedido: #{{str_replace("pay_","",$id_pedido)}}</h2>
      <p>Início do Plano: {{date('d/m/Y')}}<br />
        Fim do Plano: {{$vencimento}}
      </p>
      <h3>Itens do Pedido</h3>
      <ul>
        <li>Acesso 12 Meses Plataforma Números Não Mentem</li>
        <li>Plano Precificação</li>
      </ul>
      <h3>Total do Pedido</h3>
      <p>R$ {{number_format($total, 2, ",", ".")}}</p>
    </div></td>
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