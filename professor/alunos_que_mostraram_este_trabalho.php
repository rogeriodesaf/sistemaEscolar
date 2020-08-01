<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/alunos_que_mostraram_este_trabalho.css"/>
<title>Alunos / Trabalhos</title>
</head>

<body>
<?php require "topo.php"; ?>

<div id="caixa_preta">
</div><!-- caixa_preta -->

<div id="box">
 <h1>Abaixo segue a lista dos alunos que enviaram o trabalho!</h1>
<?php  if($_GET['pg'] == 'trabalhos_bimestrais'){ ?>
<?php if(isset($_POST['button'])){

$code_aluno = $_POST['code_aluno'];
$nota = $_POST['nota'];
$id_trabalho = $_POST['id_trabalho'];
$disciplina = $_POST['disciplina'];
$bimestre = $_POST['bimestre'];

$sql_3 = "UPDATE envio_de_trabalhos_bimestrais SET status = 'Aceito', nota = '$nota' WHERE id = '$id_trabalho'";
mysqli_query($conexao, $sql_3);

$sql_4 = "INSERT INTO notas_trabalhos (code, bimestre, disciplina, nota) VALUES ('$code_aluno', '$bimestre',  '$disciplina', '$nota')";
mysqli_query($conexao, $sql_4);

  echo "<script language='javascript'>window.window.location='';</script>";


}?>


<?php

$id = $_GET['id'];

$sql_1 = "SELECT * FROM envio_de_trabalhos_bimestrais WHERE id_trabalho = '$id'";
$result = mysqli_query($conexao, $sql_1);
if(mysqli_num_rows($result) == ''){
	 echo "<h2>No momento não existe nenhum trabalho enviados para ser corrigido!</h2>";	 
}else{
	while($res_1 = mysqli_fetch_assoc($result)){
		
$sql_1_extra = "SELECT * FROM trabalhos_bimestrais WHERE id = '$id'";
$result_2 = mysqli_query($conexao, $sql_1_extra);
	while($res_1_extra = mysqli_fetch_assoc($result_2)){
?>

<form name="" method="post" action="" enctype="multipart/form-data">

<table width="955" border="0">
  <tr>
    <td width="107">Código:</td>
    <td width="302">Nome do aluno:</td>
    <td width="100">Trabalho:</td>
    <td width="144">Data de envio:</td>
    <td width="156">Nota:</td>
    <td width="170">&nbsp;</td>
  </tr>
  <tr>

  <input type="hidden" name="code_aluno" value="<?php  echo $res_1['aluno']; ?>" />
  <input type="hidden" name="disciplina" value="<?php  echo $res_1['disciplina']; ?>" />
  <input type="hidden" name="id_trabalho" value="<?php  echo $res_1['id']; ?>" />
  <input type="hidden" name="bimestre" value="<?php  echo $res_1_extra['bimestre']; ?>" />
    <td><h3><?php  echo $code_aluno = $res_1['aluno']; ?></h3></td>
    <td><h3>
     <?php 
     $sql_2 = "SELECT * FROM estudantes WHERE code = '$code_aluno'";	 		$result_2 = mysqli_query($conexao, $sql_2);
	 	while($res_2 = mysqli_fetch_assoc($result_2)){
			echo $res_2['nome'];
		}
	 ?>
    </h3></td>
    <td><a href="../trabalhos_alunos/<?php  echo $res_1['trabalho']; ?>" target="_blank">Ver</a></td>
    
    <td><h3><?php  echo $res_1['date']; ?></h3></td>
    
    <?php 
	if($res_1['status'] != 'Aguarda'){ 
	$nota = $res_1['nota'];
	echo "<td><h3>Corrigido - Nota: $nota</h3></td>";
	}else{
	
	?>
    <td><input name="nota" type="text" id="textfield" size="2"></td>
    <td><input type="submit" name="button" id="button" value="Concretizar"></td>
    <?php  } ?>
    
    <td> <a href="alunos_que_mostraram_este_trabalho.php?pg=excluir&id=<?php  echo $res_1['id']; ?>&id_t=<?php  echo $res_1['id_trabalho']; ?>"><img src="../img/deleta.png" width="22" border="0" title="Excluir trabalho" /></a></td>
    
   <?php  if($res_1['status'] != 'Aguarda'){ ?>
      
   <td><a href="alterar_nota_trabalho.php?pg=trabalho_bimestral&id=<?php  echo $res_1['id']; ?>&aluno=<?php  echo $res_1['aluno']; ?>&disciplina=<? echo $res_1['disciplina']; ?>&nota=<?php  echo $res_1['nota']; ?>&bimestre=<?php  echo $res_1_extra['bimestre']; ?>" rel="superbox[iframe][400x100]"><img border="0" src="../img/ico-editar.png" title="Alterar a nota deste trabalho" /></a></td>
   <?php  } ?>
  </tr>
</table>
</form>
<?php  }}} ?>

<?php  } ?>

<?php if(@$_GET['pg'] == 'excluir'){

$id_t = $_GET['id_t'];
$id = $_GET['id'];
$sql_2 = "DELETE FROM envio_de_trabalhos_bimestrais WHERE id = '$id'";
mysqli_query($conexao, $sql_2);

echo "<script language='javascript'>window.location='alunos_que_mostraram_este_trabalho.php?id=$id_t&pg=trabalhos_bimestrais';</script>";

}?>
</div><!-- box -->

<?php require "rodape.php"; ?>
</body>
</html>