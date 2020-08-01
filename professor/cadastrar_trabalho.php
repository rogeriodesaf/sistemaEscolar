<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cadastrar Trabalho</title>
<?php require "../config.php"; ?>
<link rel="stylesheet" type="text/css" href="css/cadastrar_trabalho.css"/>
</head>

<body>

<div id="box">

<?php if(isset($_POST['button'])){

$dis = $_POST['dis'];
$pontos = $_POST['pontos'];
$encerramento = $_POST['encerramento'];
$tema = $_POST['tema'];
$detalhes = $_POST['detalhes'];
$date = date("d/m/Y H:i:s");

$sql_3 = "SELECT * FROM disciplinas WHERE disciplina = '$dis'";
	$result_3 = mysqli_query($conexao, $sql_3);
	while($res_3 = mysqli_fetch_assoc($result_3)){
		$curso = $res_3['curso'];
$sql_4 = "INSERT INTO trabalhos_extras (date, status, professor, curso, disciplina, tema, detalhes, data_entrega, pontos) VALUES ('$date', 'Ativo', '$code', '$curso', '$dis', '$tema', '$detalhes', '$encerramento', '$pontos')";
mysqli_query($conexao, $sql_4);

$sql_5 = "INSERT INTO mural_aluno (date, status, curso, titulo) VALUES ('$date', 'Ativo', '$curso', 'Trabalho extra da disciplina $dis com encerramento no dia $encerramento - Para ver mais detalhes vá em AVALIAÇÕES')";
mysqli_query($conexao, $sql_5);

echo "Este trabalho foi lançado no sistema com sucesso!<br>Aparte em F5 em seu teclado.";

die;
	}
}?>

<form name="send" method="post" action="" enctype="multipart/form-data">		
<table border="0">
  <tr>
    <td width="198">Nº trabalho</td>
    <td width="216">Lançamento</td>
    <td width="272">Disciplina</td>
    <td width="100"></td>
  </tr>
  <tr>
    <td>
    <input disabled type="text" value="
    <?php
    $sql_1 = "SELECT * FROM trabalhos_extras ORDER BY id DESC LIMIT 1";
	$result = mysqli_query($conexao, $sql_1);
	if(mysqli_num_rows($result) == ''){
		echo "1";
	}else{
		while($res_1 = mysqli_fetch_assoc($result)){
			
			echo $res_1['id']+1;
			
	}}
	?>
    ">
    </td>
    <td><input disabled type="text" value="<?php echo date("d/m/Y H:i:s"); ?>"></td>
    <td>
      <select name="dis" id="dis">
      <?php
      $sql_2 = "SELECT * FROM disciplinas WHERE professor = '$code'";
	  $result_2 = mysqli_query($conexao, $sql_2);
	  	while($res_2 = mysqli_fetch_assoc($result_2)){
	  ?>
      <option value="<?php echo $res_2['disciplina']; ?>"><?php echo $res_2['disciplina']; ?></option>
      <?php } ?>
      </select>
   </td>
  </tr>
  <tr>
    <td>Total de pontos:</td>
    <td width="216">Data de entrega</td>
    <td width="272">Tema</td>
  </tr>
  <tr>
    <td><input type="text" name="pontos" value=""></td>
    <td><input type="text" name="encerramento" value=""></td>
    <td><input type="text" name="tema" value=""></td>
  </tr>
  <tr>
    <td>Mais detalhes sobre o trabalho:</td>
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