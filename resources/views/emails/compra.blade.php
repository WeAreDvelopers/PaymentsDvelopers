<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Confirmação de Pedido</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }
    .container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
    }
    h1 {
        color: #333;
    }
    h2 {
        color: #555;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
</style>
</head>
<body>
<div class="container">
    <h1>Confirmação de Pedido</h1>
    <p>Caro {{explode(' ',$name)[0]}},</p>
    <p>Obrigado por fazer o seu pedido conosco. <br>
    Abaixo estão os detalhes do seu pedido:</p>
    <h2>Número do Pedido: {{$pedido['numero_pedido']}}</h2>
    <h2>Data do Pedido: 09 de abril de 2024</h2>
    <table>
        <thead>
            <tr>
                <th>Item</th>
                <th>Quantidade</th>
                <th>Preço Unitário</th>
            </tr>
        </thead>
        <tbody>
          @foreach($pedido['itens'] as $k => $v)
            <tr>
                <td>{{$v['produto']['nome']}}</td>
                <td>1</td>
                <td>R$ {{getMoney($v['valor_final'])}}</td>
            </tr>
          @endforeach
           
        </tbody>
    </table>
    <h2>Total do Pedido: R$ {{getMoney($pedido['valor_final'])}}</h2>
    <p>&nbsp;</p>
    <p>Atenciosamente,<br></p>
</div>
</body>
</html>