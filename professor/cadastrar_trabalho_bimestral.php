<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cadastro de Trabalhos</title>
<link rel="stylesheet" type="text/css" href="css/cadastrar_trabalho_bimestral.css"/>
<?php require "../config.php"; ?>
</head>

<body>

<div id="box">
<?php if(isset($_POST['button'])){
	
$date = date("d/m/Y");

$bimenstre = $_POST['bimestre'];
$dis = $_POST['dis'];
$encerramento = $_POST['encerramento'];
$tema = $_POST['tema'];
$detalhes = $_POST['detalhes'];

$sql_3 = "SELECT * FROM disciplinas WHERE disciplina = '$dis'";
$result_3 = mysqli_query($conexao, $sql_3);
	while($res_3 = mysqli_fetch_assoc($result_3)){
		
		$curso = $res_3['curso'];
		
$sql_4 = "SELECT * FROM trabalhos_bimestrais WHERE curso = '$curso' AND disciplina = '$dis' AND bimestre = '$bimenstre'";
$result_4 = mysqli_query($conexao, $sql_4);
if(mysqli_num_rows($result_4) >= '1'){
	echo "<br><br><br>O trabalho para este bimestre para esta mesma disciplina e curso já foi lançada no sistema!";
die;
}else{
$sql_5 = "INSERT INTO trabalhos_bimestrais (date, status, professor, curso, disciplina, tema, detalhes, data_entrega, bimestre) VALUES ('$date', 'Ativo', '$code', '$curso', '$dis', '$tema', '$detalhes', '$encerramento', '$bimenstre')";
mysqli_query($conexao, $sql_5);
$sql_6 = "INSERT INTO mural_aluno (date, status, curso, titulo) VALUES ('$date', 'Ativo', '$curso', 'Trabalho bimestral de $dis com encerramento no dia $encerramento - Para ver mais detalhes vá em AVALIAÇÕES')";
mysqli_query($conexao, $sql_6);

echo "<script language='javascript'>window.alert('Trabalho cadastrado com sucesso! Clique OK para cadastrar um Novo!');window.location='cadastrar_trabalho_bimestral.php';</script>";


die;

}}}?>



 <form name="send" method="post" action="" enctype="multipart/form-data">		
<table border="0">
  <tr>
    <td width="198">Nº trabalho</td>
    <td width="216">Lançamento</td>
  </tr>
  <tr>
    <td><input disabled type="text" value="
	<?php
	
	$date = date("d/m/Y");
	
    $sql_1 = "SELECT * FROM trabalhos_bimestrais ORDER BY id DESC LIMIT 1";
	$result = mysqli_query($conexao, $sql_1);
	if(mysqli_num_rows($result) == ''){
		echo "1";
	}else{
		while($res_1 = mysqli_fetch_assoc($result)){
			echo $id = $res_1['id']+1;
			
							
	}}?>"></td>
    <td><input disabled type="text" value="<?php echo $date; ?>"></td>
  </tr>
  <tr>
    <td width="198">Selecione o bimestre</td>
    <td width="272">Disciplina</td>
  </tr>
  <tr>
    <td>
      <select name="bimestre" id="dis">
      <option value="1">1º Bimestre</option>
      <option value="2">2º Bimestre</option>
      <option value="3">3º Bimestre</option>
      <option value="4">4º Bimestre</option>
      </select></td>
    <td><label for="dis"></label>
      <select name="dis" id="dis">
      
      <?php
      $sql_2 = "SELECT * FROM disciplinas WHERE professor = '$code'";
	  $result_2 = mysqli_query($conexao, $sql_2);
	  if(mysqli_num_rows($result_2) == ''){
		 ?>
      <option value=""><?php echo "Nenhuma Disciplina"; ?></option>
      <?php
	  }else{
		  
		   ?>
      <option value="">Selecione uma Disciplina</option>
      <?php
		  
	  	while($res_2 = mysqli_fetch_assoc($result_2)){
	  ?>
      <option value="<?php echo $res_2['disciplina']; ?>"><?php echo $res_2['disciplina']; ?></option>
      <?php }} ?>
      </select></td>
  </tr>  
  <tr>
    <td width="216">Data de entrega</td>
    <td width="272">Tema</td>
  </tr>
  <tr>
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