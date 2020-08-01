<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/relatorios.css" rel="stylesheet" type="text/css" />
<title>Administração</title>
</head>

<body>
<?php require "topo.php"; ?>
<div id="caixa_preta">
</div><!-- caixa_preta -->

<div id="box">
<?php if(@$_GET['tipo'] == 'alunos'){ ?>
<h1>Relatório de alunos</h1> 
<?php if(isset($_POST['button'])){

$tipo = $_POST['tipo'];
$serie = $_POST['serie'];

$s = base64_encode("SELECT * FROM estudantes WHERE status = '$tipo' AND serie = '$serie'");

echo "<script language='javascript'>window.location='relatorios.php?tipo=alunos&s=$s';</script>";

}?>
<form name="button" method="post" action="" enctype="multipart/form-data">
<table width="950" border="0">
  <tr>
    <td width="267"><strong>Status</strong></td>
    <td width="248"><strong>Série</strong></td>
    <td width="180">&nbsp;</td>
  </tr>
  <tr>
    <td><select name="tipo" size="1" id="select">
      <option value="Ativo">Alunos Ativos</option>
      <option value="Inativo">Alunos Inativos</option>
    </select></td>
    <td>
      <select name="serie" id="select2">
      <?php
      $sql_2 = mysqli_query($conexao, "SELECT * FROM cursos");
	  	while($res_2 = mysqli_fetch_assoc($sql_2)){
	  ?>
       <option value="<?php echo $res_2['curso']; ?>"><?php echo $res_2['curso']; ?></option>      
       <?php } ?>
      </select>
    </td>
    <td><input class="input" type="submit" name="button" id="button" value="Filtrar"></td>
  </tr>
</table>
</form>

<?php 
$s = base64_decode($_GET['s']);
$sql_1 = mysqli_query($conexao, $s);
if(mysqli_num_rows($sql_1) == ''){
	echo "Não existe resultados para o filtro selecionado";
}else{
?>
<table width="950" border="0">
  <tr>
    <td width="200"><strong>Nome:</strong></td>
    <td width="130"><strong>Nº de matricula:</strong></td>
    <td width="155"><strong>Série:</strong></td>
    <td width="194"><strong>Mensalidades pagas:</strong></td>
    <td width="149"><strong>Mensalidade devedoras:</strong></td>
  </tr>
  <?php while($res_1 = mysqli_fetch_assoc($sql_1)){ ?>
  <tr>
    <td><?php echo $res_1['nome']; ?></td>
    <td><?php echo $res_1['code']; ?></td>
    <td><?php echo $res_1['serie']; ?></td>
    <td><?php echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM mensalidades WHERE matricula = ".$res_1['code']." AND status = 'Pagamento Confirmado'")); ?></td>
    <td><?php echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM mensalidades WHERE matricula = ".$res_1['code']." AND status = 'Aguarda Pagamento'")); ?></td>
  </tr>
  <tr>
    <td colspan="5"><hr></td>
  </tr>
  <?php } ?>
  <tr>
   <td align="center" colspan="5"><a target="_blank" href="alunos_pg_impressao.php?s=<?php echo $_GET['s']; ?>">Imprimir relação completa do aluno</a></td>
  </tr>
</table>
<?php } ?>



<?php }// aqui fecha a pg alunos ?>



<?php if(@$_GET['tipo'] == 'professores'){ ?>
<h1>Relatório de professores</h1> 

<?php if(isset($_POST['button'])){

$tipo = $_POST['tipo'];
$serie = $_POST['serie'];

$sql_3 = mysqli_query($conexao, "SELECT * FROM professores WHERE status = '$tipo'");
if(mysqli_num_rows($sql_3) == ''){
echo "<script language='javascript'>window.location='relatorios.php?tipo=professores&s=nao_encontrado';</script>";
}else{
	while($res_3 = mysqli_fetch_assoc($sql_3)){

$s = base64_encode("SELECT * FROM disciplinas WHERE curso = '$serie'");

echo "<script language='javascript'>window.location='relatorios.php?tipo=professores&s=$s';</script>";

}}}?>
<form name="button" method="post" action="" enctype="multipart/form-data">
<table width="950" border="0">
  <tr>
    <td width="330"><strong>Status</strong></td>
    <td width="151"><strong>Curso:</strong></td>
    <td width="244">&nbsp;</td>
  </tr>
  <tr>
    <td><select name="tipo" size="1" id="select">
      <option value="Ativo">Professores Ativos</option>
      <option value="Inativo">Professores Inativos</option>
    </select></td>
    <td><select name="serie" id="serie">
      <?php
      $sql_2 = mysqli_query($conexao, "SELECT * FROM disciplinas");
	  	while($res_2 = mysqli_fetch_assoc($sql_2)){
	  ?>
      <option value="<?php echo $res_2['curso']; ?>"><?php echo $res_2['curso']; ?></option>
      <?php } ?>
    </select></td>
    <td><input class="input" type="submit" name="button" id="button" value="Filtrar"></td>
  </tr>
</table>
</form>

<?php

$s = base64_decode($_GET['s']);

$sql_1 = mysqli_query($conexao, $s);
if(mysqli_num_rows($sql_1) == '') { 
	
	echo "Não existe resultado para o filtro selecionado!";
}else{
?>
<table width="950" border="0">
  <tr>
    <td width="200"><strong>Disciplina/Curso:</strong></td>
    <td width="70"><strong>Código:</strong></td>
    <td width="150"><strong>Nome</strong></td>
    <td width="180"><strong>Formação:</strong></td>
    <td width="105"><strong>Salário:</strong></td>
  </tr>
<?php while($res_1 = mysqli_fetch_assoc($sql_1)){ ?>  
  <tr>
    <td><?php
			echo $res_1['disciplina'];
			echo " - ";
			echo $res_1['curso'];
			
	?></td>
    <td><?php echo $res_1['professor']; ?></td>
    <td><?php
    $sql_1_extra = mysqli_query($conexao, "SELECT * FROM professores WHERE code = ".$res_1['professor']."");
		while($res_extra = mysqli_fetch_assoc($sql_1_extra)){
	
	?>
    <?php echo $res_extra['nome']; ?></td>
    <td><?php echo $res_extra['formacao']; ?>/<?php echo $res_extra['graduacao']; ?></td>
    <td>R$ <?php echo number_format($res_extra['salario'],2); ?></td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="6"><hr></td>
  </tr>
<?php } ?>  
  <tr>
   <td align="center" colspan="6"><a target="_blank" href="professores_pg_impressao.php?s=<?php echo $_GET['s']; ?>">Imprimir relação completa</a></td>
  </tr>
</table>
<?php } ?>


<?php }// aqui a fecha a pg professor ?>






</div><!-- box -->





<?php require "rodape.php"; ?>
</body>
</html>