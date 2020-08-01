<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cadastrar Nota Obs</title>
<link rel="stylesheet" type="text/css" href="css/cadastrar_prova.css"/>
<?php require "../conexao.php"; $code = $_GET['code'];?>
</head>

<body>

<div id="box">

<?php if(isset($_POST['button'])){

$dis = $_POST['dis'];
$bimestre = $_POST['bimestre'];
$detalhes = $_POST['detalhes'];
$date = date("d/m/Y H:i:s");	

$sql_2 = "SELECT * FROM disciplinas WHERE disciplina = '$dis'";
$result_2 = mysqli_query($conexao, $sql_2);
	while($res_2 = mysqli_fetch_assoc($result_2)){
		
		$curso = $res_2['curso'];
		
	$sql_3 = "INSERT INTO notas_de_observacoes (date, status, professor, curso, disciplina, detalhes, bimestre) VALUES ('$date', 'Ativo', '$code', '$curso', '$dis', '$detalhes', '$bimestre')";		
$result_3 = mysqli_query($conexao, $sql_3);

$sql_4 = "INSERT INTO mural_aluno (date, status, curso, titulo) VALUES ('$date', 'Ativo', '$curso', 'As notas bimestrais foram lançadas no sistema')";
$result_3 = mysqli_query($conexao, $sql_4);

echo "Esta informação foi lançado no sistema com sucesso!<br>Aparte em F5 em seu teclado.";

die;
		
		}


}?>

<form name="send" method="post" action="" enctype="multipart/form-data">		
<table border="0">
  <tr>
    <td width="272">Disciplina</td>
    <td>Bimestre:</td>
  </tr>
  <tr>
    <td>
      <select name="dis" id="dis">
      <?php
	  $sql_1 = "SELECT * FROM disciplinas WHERE professor = '$code'";
	  $result_1 = mysqli_query($conexao, $sql_1);
	  while($res_1 = mysqli_fetch_assoc($result_1)){
	  
	  ?>
      <option value="<?php echo $res_1['disciplina']; ?>"><?php echo $res_1['disciplina']; ?></option>
      <?php } ?>
      </select></td>
    <td><select name="bimestre" size="1">
      <option value="1">1&ordm; Bimestre</option>
      <option value="2">2&ordm; Bimestre</option>
      <option value="3">3&ordm; Bimestre</option>
      <option value="4">4&ordm; Bimestre</option>
    </select></td>
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
  
</div><!-- box --> 

</body>
</html>