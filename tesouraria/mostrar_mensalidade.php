<?php
session_start();
$_SESSION['painel_atual'] = "tesouraria";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Tesouraria - <?php 
$nome = $_SESSION['nome'];
echo $nome; ?> </title>
<link href="css/index.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php if(@$_GET['status'] == 'mostra_fatura'){ ?>
<?php require "topo.php"; ?>
<div id="caixa_preta">
</div><!-- caixa_preta -->

<div id="box">
<h1>Resumo da cobrança <?php echo $mensalidade = $_GET['mensalidade']; ?></h1>
<?php

$sql_1 = "SELECT * FROM mensalidades WHERE code = '$mensalidade'";
$result_1 = mysqli_query($conexao, $sql_1);
while($res_1 = mysqli_fetch_assoc($result_1)){
	$matricula =  $res_1['matricula'];

$sql_2 = "SELECT * FROM estudantes WHERE code = '$matricula'";	
$result_2 = mysqli_query($conexao, $sql_2);
	while($res_2 = mysqli_fetch_assoc($result_2)){
?>
 <table width="950" border="0">
  <tr>
    <td colspan="4"><hr /></td>
  </tr>
  <tr>
    <td><strong>Número de matricula:</strong></td>
    <td><strong>Nome do aluno:</strong></td>
    <td><strong>Vencimento:</strong></td>
  </tr>
  <tr>
    <td><?php echo $matricula; ?></td>
    <td><?php echo $res_2['nome']; ?></td>
    <td><?php echo $res_1['vencimento']; ?></td>
  </tr>
  <tr>
    <td><strong>Valor:</strong></td>
    <td><strong>Status:</strong></td>
    <td><strong>Data do pagamento:</strong></td>
  </tr>
  <tr>
    <td>R$ <?php echo number_format($res_1['valor'],2); ?></td>
    <td><?php echo $res_1['status']; ?></td>
    <td><?php echo $res_1['data_pagamento']; ?></td>
  </tr>
  <tr>
    <td><strong>CPF:</strong></td>
    <td><strong>Curso:</strong></td>
  </tr>
  <tr>
    <td><?php echo $res_2['cpf']; ?></td>
    <td><?php echo $res_2['serie']; ?></td>
  </tr>
  <tr>
    <td><strong>Forma de pagamento:</strong></td>
    <td><?php echo $res_1['metodo_pagamento']; ?></td>
  </tr>
  <tr>
    <td colspan="4"><hr /></td>
  </tr>
  <?php if($res_1['status'] != 'Pagamento Confirmado'){ ?>
  <tr>
    <td colspan="4">| <a rel="superbox[iframe][270x180]" href="mostrar_mensalidade.php?mensalidade=<?php echo $mensalidade; ?>&status=baixa_mensalidade&valor=<?php echo $res_1['valor']; ?>&matricula=<?php echo $matricula; ?>">Informar pagamento</a> | <a rel="superbox[iframe][270x180]" href="mostrar_mensalidade.php?mensalidade=<?php echo $mensalidade; ?>&status=reajustar_mensalidade&valor=<?php echo $res_1['valor']; ?>">Reajustar valor de cobrança</a> | </td>
  </tr>  
  <?php } ?>
</table>
<?php }} ?>
<ul>
 <li>Lembrando que ao informar a baixa do pagamento, você será o responsável pela entrada do dinheiro em caixa.</li>
 <li>Não se esqueça que antes de você reajustar a mensalidade, você deve ter autorização da coordenação para executar tal função.</li>
 <li>Atenção, se você enviar um alerta de cobrança ao aluno você será a responsável por tal atitude.</li>
 <li>Caso tenha qualquer dúvida entre em contato com a coordenação.</li>
</ul>
</div><!-- box -->
<?php } ?>



<?php if($_GET['status'] == 'baixa_mensalidade'){ ?>
<?php require "../config.php"; ?>
<div id="box_baixa">

<?php if(isset($_POST['confirm'])){

$date = date("d/m/Y H:i:s");
$dia = date("d/m/Y");
$d = date("d");
$m = date("m");
$a = date("Y");
$forma_de_pagamento = $_POST['forma_de_pagamento'];
$mensalidade = $_GET['mensalidade'];
$matricula = $_GET['matricula'];
$valor = $_GET['valor'];

$sql_1 = "UPDATE mensalidades SET status = 'Pagamento Confirmado', data_pagamento = '$date', dia_pagamento = '$dia', metodo_pagamento = '$forma_de_pagamento', d_p = '$d', m_p = '$m', a_p = '$a' WHERE code = '$mensalidade'";
mysqli_query($conexao, $sql_1);


$sql_2 = "INSERT INTO fluxo_de_caixa (status, tipo, d, m, a, date_completo, date, codigo, descricao, valor, form_pag) VALUES ('Ativo', 'CRÉDITO', '$d', '$m', '$a', '$date', '$dia', 'mensalidade=$code', 'Mensalidade do aluno: $matricula Competencia: $m/$a', '$valor', '$forma_de_pagamento')";
mysqli_query($conexao, $sql_2);

	echo "<br><br>Operação realizada com sucesso!<br> Pressione F5 para mesclar a operação.";	
die;

}?>

<h1>Forma de pagamento</h1>
<form name="confirm" method="post" action="" enctype="multipart/form-data">
<select name="forma_de_pagamento">
 <option value="">Selecione</option>
 <option value="Cartão de crédito">Cartão de crédito</option>
 <option value="Cartão de débito">Cartão de débito</option>
 <option value="Dinheiro">Dinheiro</option>
 <option value="Cheque">Cheque</option>
</select>
<input class="select" type="submit" name="confirm" value="Confirmar" />
</form>
</div><!-- box_baixa -->
<?php } ?>




<?php if($_GET['status'] == 'reajustar_mensalidade'){ ?>

<?php require "../config.php"; ?>
<div id="box_baixa">
<?php if(isset($_POST['confirm'])){

$valor = $_POST['valor'];
$mensalidade = $_GET['mensalidade'];
$date = date("d/m/Y H:i:s");

$sql_1 = "UPDATE mensalidades SET valor = '$valor' WHERE code = '$mensalidade'";
mysqli_query($conexao, $sql_1);

$sql_2 = "INSERT INTO mural_coordenacao (date, status, curso, titulo) VALUES ('$date', 'Ativo', 'Não informado', 'A mensalidade de um aluno foi reajustada!')";
mysqli_query($conexao, $sql_2);

	echo "<br><br>Operação realizada com sucesso!<br> Pressione F5 para mesclar a operação.";	
die;

}?>
<h1>Reajustar valor da cobrança</h1>
<form name="confirm" method="post" action="" enctype="multipart/form-data">
<input type="text" name="valor" value="<?php echo $_GET['valor']; ?>" />
<input class="select" type="submit" name="confirm" value="Confirmar" />
</form>
</div><!-- box_baixa -->
<?php } ?>
</body>
</html>