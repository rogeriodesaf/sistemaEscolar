<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cadastro de Provas</title>
<link rel="stylesheet" type="text/css" href="css/cadastrar_prova.css"/>
<?php require "../config.php"; $code; ?>
</head>

<body>

<div id="box">
<?php if($_GET['tipo'] == 'bimestral'){ ?>

<?php if(isset($_POST['button'])){

$dis = $_POST['dis'];
$bimestre = $_POST['bimestre'];
$aplicacao = $_POST['aplicacao'];
$detalhes = $_POST['detalhes'];
$date = date("d/m/Y");

$sql_2 = "SELECT * FROM disciplinas WHERE disciplina = '$dis'";
$result_2 = mysqli_query($conexao, $sql_2);
	while($res_2 = mysqli_fetch_assoc($result_2)){
		$curso = $res_2['curso'];
		
$sql_3 = "INSERT INTO provas_bimestrais (date, status, professor, curso, disciplina, detalhes, bimestre, data_aplicacao) VALUES ('$date', 'Ativo', '$code', '$curso', '$dis', '$detalhes', '$bimestre', '$aplicacao')";
mysqli_query($conexao, $sql_3);
		
$sql_4 = "INSERT INTO mural_aluno (date, status, curso, titulo) VALUES ('$date', 'Ativo', '$curso', 'As notas das provas bimestrais estão sendo divulgadas')";
mysqli_query($conexao, $sql_4);

echo "<script language='javascript'>window.alert('Prova cadastrada com sucesso! Click em OK para cadastrar outras!');window.location='cadastrar_prova.php?tipo=bimestral';</script>";

die;		

}}?>

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
      <?php
      $sql_1 = "SELECT * FROM disciplinas WHERE professor = '$code'";
	  $result = mysqli_query($conexao, $sql_1);
	  	while($res_1 = mysqli_fetch_assoc($result)){
	  ?>
      <option value="<?php echo $res_1['disciplina']; ?>"><?php echo $res_1['disciplina']; ?></option>
      <?php } ?>
      </select>
      </td>
    <td><select name="bimestre" size="1">
      <option value="1">1&ordm; Bimestre</option>
      <option value="2">2&ordm; Bimestre</option>
      <option value="3">3&ordm; Bimestre</option>
      <option value="4">4&ordm; Bimestre</option>
    </select></td>
    <td><input type="text" name="aplicacao" value="<?php echo date("d/m/Y"); ?>"></td>
  </tr> 
  <tr>
    <td>Informações adicionais:</td>
  </tr>
  <tr>
    <td colspan="3"><textarea name="detalhes" cols="" rows=""></textarea></td>
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