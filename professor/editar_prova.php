<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Editar Prova</title>
<?php require "../conexao.php"; $date = date("d/m/Y H:i:s"); $code = $_GET['code']; $id = $_GET['id']; ?>
<link rel="stylesheet" type="text/css" href="css/cadastrar_prova.css"/>
</head>

<body>

<div id="box">
<?php if(isset($_POST['button'])){

$dis = $_POST['dis'];
$bimestre = $_POST['bimestre'];
$aplicacao = $_POST['aplicacao'];
$detalhes = $_POST['detalhes'];


$sql_3 = "UPDATE provas_bimestrais SET disciplina = '$dis', detalhes = '$detalhes', bimestre = '$bimestre', data_aplicacao = '$aplicacao' WHERE id = '$id' ";
mysqli_query($conexao, $sql_3);
		
echo "Esta prova foi atualizada no sistema com sucesso!<br>Aparte em F5 em seu teclado.";

die;		

}?>

<?php

$sql_5 = "SELECT * FROM provas_bimestrais WHERE id = '$id'";
$result_5 = mysqli_query($conexao, $sql_5);
	while($res_5 = mysqli_fetch_assoc($result_5)){
?>
 <form name="send" method="post" action="" enctype="multipart/form-data">	
	
<table border="0">
  <tr>
    <td width="272">Disciplina</td>
    <td>Bimestre:</td>
    <td width="216">Data de aplicação da prova</td>
  </tr>
  <tr>
    <td>
      <select name="dis" id="dis">
      <option value="<?php echo $dis = $res_5['disciplina']; ?>"><?php echo $dis = $res_5['disciplina']; ?></option>
      <option value=""></option>
      <?php
      $sql_1 = "SELECT * FROM disciplinas WHERE professor = '$code' AND disciplina != '$dis'";
	  $result_1 = mysqli_query($conexao, $sql_1);
	  	while($res_1 = mysqli_fetch_assoc($result_1)){
	  ?>
      <option value="<?php echo $res_1['disciplina']; ?>"><?php echo $res_1['disciplina']; ?></option>
      <?php } ?>
      </select>
      </td>
    <td><select name="bimestre" size="1">
      <option value="<?php echo $res_5['bimestre']; ?>"><?php echo $res_5['bimestre']; ?> Bimestre</option>

      <option value=""></option>
      <option value="1">1&ordm; Bimestre</option>
      <option value="2">2&ordm; Bimestre</option>
      <option value="3">3&ordm; Bimestre</option>
      <option value="4">4&ordm; Bimestre</option>
    </select></td>
    <td><input type="text" name="aplicacao" value="<?php echo $res_5['data_aplicacao']; ?>"></td>
  </tr> 
  <tr>
    <td>Informações adicionais:</td>
  </tr>
  <tr>
    <td colspan="3"><textarea name="detalhes" cols="" rows=""><?php echo $res_5['detalhes']; ?></textarea></td>
  </tr>
  <tr>
    <td><input class="input" type="submit" name="button" id="button" value="Cadastrar"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  </table>
  </form>
<?php } ?>  
</div><!-- box -->

</body>
</html>