﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Editar Trabalho Bimestral</title>
<?php require "../conexao.php"; $id = $_GET['id']; $code = $_GET['code']; ?>

<link rel="stylesheet" type="text/css" href="css/editar_trabalho.css"/>
</head>

<body>

<div id="box">
<?php if(isset($_POST['button'])){

$dis = $_POST['dis'];
$encerramento = $_POST['encerramento'];
$tema = $_POST['tema'];
$detalhes = $_POST['detalhes'];
$curso = $_POST['curso'];


$sql_5 = "UPDATE trabalhos_bimestrais SET disciplina = '$dis', tema = '$tema', detalhes = '$detalhes', data_entrega = '$encerramento' WHERE id = '$id' ";
mysqli_query($conexao, $sql_5);
$date = date("d/m/Y H:i:s");

$sql_6 = "INSERT INTO mural_aluno (date, status, curso, titulo) VALUES ('$date', 'Ativo', '$curso', 'Foi alterado o trabalho bimestral de $dis com encerramento no dia $encerramento - Para ver mais detalhes vá em AVALIAÇÕES')";
mysqli_query($conexao, $sql_6);

echo "<br><br><br>Este trabalho foi atualizado no sistema com sucesso!<br>Aparte em F5 em seu teclado.";

die;

}?>




<?php

$sql_1 = "SELECT * FROM trabalhos_bimestrais WHERE id = '$id'";
$result = mysqli_query($conexao, $sql_1);
while($res_1 = mysqli_fetch_assoc($result)){
?>

 <form name="send" method="post" action="" enctype="multipart/form-data">		
<table width="700" border="0">
  <tr>
    <td width="198">Nº trabalho</td>
    <td width="216">Lançamento</td>
  </tr><input type="hidden" name="curso" value="<?php echo $res_1['curso']; ?>" />
  <tr>
    <td><input disabled type="text" value="<?php echo $res_1['id']; ?>"></td>
    <td><input disabled type="text" value="<?php echo $res_1['date']; ?>"></td>

  </tr>
  <tr>
    <td>Disciplina</td>
  </tr>
  <tr>
    <td><label for="dis"></label>
      <select name="dis" id="dis">
      <option value="<?php echo $res_1['disciplina']; ?>"><?php echo $res_1['disciplina']; ?></option>
      <option value=""></option>
      <?php
	  $dis = $res_1['disciplina'];
      $sql_2 = "SELECT * FROM disciplinas WHERE professor = '$code' AND disciplina != '$dis'";
	  $result_2 = mysqli_query($conexao, $sql_2);
	  	while($res_2 = mysqli_fetch_assoc($result_2)){
	  ?>
      <option value="<?php echo $res_2['disciplina']; ?>"><?php echo $res_2['disciplina']; ?></option>
      <?php } ?>      
      </select></td>
  </tr>
  <tr>
    <td width="216">Data de entrega</td>
    <td width="272">Tema</td>
  </tr>
  <tr>
    <td><input type="text" name="encerramento" value="<?php echo $res_1['data_entrega']; ?>"></td>
    <td><input type="text" name="tema" value="<?php echo $res_1['tema']; ?>"></td>
  </tr>  
  <tr>
    <td>Mais detalhes sobre o trabalho:</td>
  </tr>
  <tr>
    <td colspan="3"><textarea name="detalhes" cols="" rows=""><?php echo $res_1['detalhes']; ?></textarea></td>
  </tr>  
  <tr>
    <td><input class="input" type="submit" name="button" id="button" value="Editar"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  </table>
  </form>
<?php } ?>
</div><!-- box -->

</body>
</html>