<style>
  td {
    padding-top: 5px;
  }
</style>

<table width="600" border="0" align="center" cellpadding="10" cellspacing="0" style="font-family:Arial, Helvetica, sans-serif" bgcolor="#fff">
  <tr>
    <td colspan="3" align="left" style="padding:0px; background: #ededed;"><img src="{{asset('img/email-bemvindo.jpg')}}" width="600" height="200"/></td>
  </tr>

  <tr>

        <td colspan="3" style="padding:20px"><p><strong>Olá, {{$sendName}}.</strong></p>
          <p>A partir de agora você está cadastrado em nossa base de dados.</p>
          <p>Abaixo estão os seus dados de acesso para usufluir de nosso site.</p>
          <p><strong>URL:</strong> <a href="{{$url}}">{{$url}}<br>
            </a><strong>Login:</strong> {{$sendMail}}<br>
          <strong>Senha:</strong> {{$senha}} </p>
          <p>&nbsp;</p>
          <p>Atenciosamente,</p>
          <p><strong>Equipe DCA</strong></p>
        <p>&nbsp;</p>
      </td>
  </tr>

</table>
