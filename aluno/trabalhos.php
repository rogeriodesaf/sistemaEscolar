<?php $painel_atual = "Aluno";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Trabalhos</title>
<link rel="stylesheet" type="text/css" href="css/provas_bimestrais.css"/>
</head>

<body>
<?php require "topo.php"; ?>


<div id="caixa_preta">
</div><!-- caixa_preta -->

<div id="box">
<?php if($_GET['pg'] == 'trabalhos_bimestrais'){ ?>
<h1><strong>Trabalhos bimestrais lançados no sistema!</strong></h1>

<?php
$sql_1 = "SELECT * FROM trabalhos_bimestrais WHERE status = 'Ativo' AND curso = '$serie'";
$result_1 = mysqli_query($conexao, $sql_1);
if(mysqli_num_rows($result_1) == ''){
	echo "<h2>No momento não existe nenhum trabalho lançado no sistema!</h2>";
}else{
		while($res_1 = mysqli_fetch_assoc($result_1)){
?>
<table width="955" border="0">
  <tr>
    <td width="150">Nº do trabalho</td>
    <td width="189">Disciplina</td>
    <td width="420">Tema</td>
    <td width="260">Data max. de entrega:</td>
    <td width="170">Bimestre:</td>
  </tr>
  <tr>
    <td><?php echo $id = $res_1['id']; ?></td>
    <td><?php echo $disciplina = $res_1['disciplina']; ?></td>
    <td><?php echo $res_1['tema']; ?></td>
    <td><?php echo $res_1['data_entrega']; ?></td>
    <td><h2><?php echo $res_1['bimestre']; ?>º Bimestre</h2></td>
  </tr>
  <tr>
    <td><a href="detalhes_do_trabalho.php?id=<?php echo $res_1['id']; ?>&pg=trabalho_bimestral" rel="superbox[iframe][515x400]">Mais detalhes</a></td>
    <?php
	$sql_2 = "SELECT * FROM envio_de_trabalhos_bimestrais WHERE id_trabalho = ".$res_1['id']." AND aluno = '$code'";
	$result_2 = mysqli_query($conexao, $sql_2);
	if(mysqli_num_rows($result_2) >= '1'){
		echo "<td><h2><strong>Trabalho já enviado</strong></h2></td>";
	}else{
	?>
    <td colspan="2"><a href="enviar_trabalho.php?id=<?php echo $res_1['id']; ?>&pg=trabalho_bimestral&aluno=<?php echo $code; ?>&dis=<?php echo $res_1['disciplina']; ?>&entrega=<?php echo $res_1['data_entrega']; ?>" rel="superbox[iframe][400x190]">Enviar trabalho</a></td>
    <?php } ?>
    <td></td>
    <td>&nbsp;</td>
  </tr>
</table>
<?php }} ?>

<?php } ?>


<?php if($_GET['pg'] == 'trabalhos_extras'){ ?>
<h1><strong>Trabalhos extras lançados no sistema!</strong></h1>
<?php
$sql_1 = "SELECT * FROM trabalhos_extras WHERE status = 'Ativo' AND curso = '$serie'";
$result_1 = mysqli_query($conexao, $sql_1);
if(mysqli_num_rows($result_1) == ''){
	echo "<h2>No momento não existe nenhum trabalho lançado no sistema!</h2>";
}else{
		while($res_1 = mysqli_fetch_assoc($result_1)){
?>
<table width="955" border="0">
  <tr>
    <td width="150">Nº do trabalho</td>
    <td width="189">Disciplina</td>
    <td width="420">Tema</td>
    <td width="260">Data max. de entrega:</td>
  </tr>
  <tr>
    <td><?php echo $id = $res_1['id']; ?></td>
    <td><?php echo $disciplina = $res_1['disciplina']; ?></td>
    <td><?php echo $res_1['tema']; ?></td>
    <td><?php echo $res_1['data_entrega']; ?></td>
  </tr>
  <tr>
    <td><a href="detalhes_do_trabalho.php?id=<?php echo $res_1['id']; ?>&pg=trabalho_extras" rel="superbox[iframe][515x400]">Mais detalhes</a></td>
    <?php 
	$sql_2 = "SELECT * FROM envio_de_trabalhos_extras WHERE id_trabalho = ".$res_1['id']." AND aluno = '$code'";
	$result_2 = mysqli_query($conexao, $sql_2);
	if(mysqli_num_rows($result_2) >= '1'){
		echo "<td><h2><strong>Trabalho já enviado</strong></h2></td>";
	}else{
	?>
    <td colspan="2"><a href="enviar_trabalho.php?id=<?php echo $res_1['id']; ?>&pg=trabalho_extras&aluno=<?php echo $code; ?>&dis=<?php echo $res_1['disciplina']; ?>&entrega=<?php echo $res_1['data_entrega']; ?>" rel="superbox[iframe][400x190]">Enviar trabalho</a></td>
    <?php } ?>
    <td></td>
    <td>&nbsp;</td>
  </tr>
</table>
<?php }} ?>

<?php } ?>
</div><!-- box -->

</body>
</html>