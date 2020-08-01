<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Resultado da pesquisa</title>
<link href="css/resultado_da_pesquisa.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php require "topo.php"; ?>
<div id="caixa_preta">
</div><!-- caixa_preta -->

<div id="box">

<h1>Resultado da pesquisa para  <?php echo $q = $_GET['q']; ?></h1>
<ul>
<?php
$sql_1 = mysqli_query($conexao, "SELECT * FROM professores WHERE code = '$q' OR nome = '$q'");
if(mysqli_num_rows($sql_1) == ''){
	echo "<h2>Não foi encontrado nenhum professor.</h2>";
}else{
	while($res_1 = mysqli_fetch_assoc($sql_1)){
		$status = $res_1['status'];
			echo "<li><a rel='superbox[iframe][800x800]' href='mostrar_resultado.php?q=$q&s=professor&status=$status'><strong>Informações gerais sobre o professor</strong><a></li>";
		}
}
?>

<?php
$sql_1 = mysqli_query($conexao, "SELECT * FROM estudantes WHERE code = '$q' OR nome = '$q'");
if(mysqli_num_rows($sql_1) == ''){
	echo "<h2>Não foi encontrado nenhum estudante.</h2>";
}else{
	while($res_1 = mysqli_fetch_assoc($sql_1)){
		$curso = $res_1['serie'];
			echo "<li><a rel='superbox[iframe][800x600]' href='mostrar_resultado.php?q=$q&s=aluno&curso=$curso'><strong>Informações gerais sobre o estudante</strong><a></li>";
		}
}
?>

<?php
$sql_1 = mysqli_query($conexao, "SELECT * FROM mensalidades WHERE code = '$q'");
if(mysqli_num_rows($sql_1) == ''){
	echo "<h2>Não foi encontrado nenhuma cobrança.</h2>";
}else{
	while($res_1 = mysqli_fetch_assoc($sql_1)){
			echo "<li><a rel='superbox[iframe][970x270]' href='mostrar_resultado.php?q=$q&s=cobranca'><strong>Informações gerais sobre a cobrança</strong><a></li>";
		}
}
?>

</ul>
</div><!-- box -->

<?php require "rodape.php"; ?>
</body>
</html>