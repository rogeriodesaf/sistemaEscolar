<?php $painel_atual = "Aluno";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php require "../config.php"; ?>
<link href="css/provas_bimestrais.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php require "topo.php"; ?>
<div id="caixa_preta">
</div><!-- caixa_preta -->

<?php if(@$_GET['pg'] == 'trabalhos_bimestrais'){ ?>

<div id="box">
<h1><strong>Trabalhos bimestrais lançados no sistema!</strong></h1>
<?php
$sql_1 = mysqli_query($conexao, "SELECT * FROM trabalhos_bimestrais WHERE status = 'Ativo' AND curso = '$serie'");
$conta_sql_1 = mysqli_num_rows($sql_1);
if($conta_sql_1 == ''){
	echo "<h2>No momento não existe nenhum trabalho lançado no sistema!</h2>";
}else{
 while($res_1 = mysqli_fetch_assoc($sql_1)){
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
    <td><h2><?php echo $id = $res_1['id']; ?></h2></td>
    <td><h2><?php echo $res_1['disciplina']; ?></h2></td>
    <td><h2><?php echo $res_1['tema']; ?></h2></td>
    <td><h2><?php echo $res_1['data_entrega']; ?></h2></td>
    <td><h2><?php echo $res_1['bimestre']; ?>º Bimestre</h2></td>
  </tr>
  <tr>
    <td><a href="detalhes_do_trabalho.php?id=<?php echo $res_1['id']; ?>&pg=trabalho_bimestral" rel="superbox[iframe][600x400]">Mais detalhes</a></td>
    <td colspan="2">
    <?php 
	$sql_status = mysqli_query($conexao, "SELECT * FROM envio_de_trabalhos_bimestrais WHERE aluno = '$code' AND status = 'Aguarda' OR status = 'Aceito' AND id_trabalho = '$id'");
	if(mysqli_num_rows($sql_status) >= '1'){ echo "<h2><strong>Você já enviou este trabalho</strong></h2>"; 
	}else{
	?>
    <a href="enviar_trabalho.php?id=<?php echo $res_1['id']; ?>&pg=trabalho_bimestral&aluno=<?php echo $code; ?>&dis=<?php echo $res_1['disciplina']; ?>" rel="superbox[iframe][400x190]">Enviar trabalho</a>
    <?php } ?>
    </td>
    <td></td>
    <td>&nbsp;</td>
  </tr>
</table>
	
<?php }}?>
</div><!-- box -->
<?php } ?>

<?php if(@$_GET['pg'] == 'trabalhos_extras'){ ?>

<div id="box">
<h1><strong>Trabalhos extras lançados no sistema!</strong></h1>
<?php
$sql_1 = mysqli_query($conexao, "SELECT * FROM trabalhos_extras WHERE status = 'Ativo' AND curso = '$serie'");
$conta_sql_1 = mysqli_num_rows($sql_1);
if($conta_sql_1 == ''){
	echo "<h2>No momento não existe nenhum trabalho lançado no sistema!</h2>";
}else{
 while($res_1 = mysqli_fetch_assoc($sql_1)){
?>
<table width="955" border="0">
  <tr>
    <td width="150">Nº do trabalho</td>
    <td width="189">Disciplina</td>
    <td width="420">Tema</td>
    <td width="260">Data max. de entrega:</td>
  </tr>
  <tr>
    <td><h2><?php echo $id = $res_1['id']; ?></h2></td>
    <td><h2><?php echo $res_1['disciplina']; ?></h2></td>
    <td><h2><?php echo $res_1['tema']; ?></h2></td>
    <td><h2><?php echo $res_1['data_entrega']; ?></h2></td>
  </tr>
  <tr>
    <td><a href="detalhes_do_trabalho.php?id=<?php echo $res_1['id']; ?>&pg=trabalho_bimestral" rel="superbox[iframe][600x400]">Mais detalhes</a></td>
    <td colspan="2">
    <?php 
	$sql_status = mysqli_query($conexao, "SELECT * FROM envio_de_trabalhos_extras WHERE aluno = '$code' AND status = 'Aguarda' OR status = 'Aceito' AND id_trabalho = '$id'");
	if(mysqli_num_rows($sql_status) >= '1'){ echo "<h2><strong>Você já enviou este trabalho</strong></h2>"; 
	}else{
	?>
    <a href="enviar_trabalho.php?id=<?php echo $res_1['id']; ?>&pg=trabalhos_extras&aluno=<?php echo $code; ?>&dis=<?php echo $res_1['disciplina']; ?>" rel="superbox[iframe][400x190]">Enviar trabalho</a>
    <?php } ?>
    </td>
    <td></td>
    <td>&nbsp;</td>
  </tr>
</table>
	
<?php }}?>
</div><!-- box -->
<?php } ?>


</body>
</html>