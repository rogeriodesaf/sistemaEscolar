<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Correçao de Prova</title>
<link rel="stylesheet" type="text/css" href="css/correcao_prova.css"/>
</head>

<?php require "topo.php"; ?>

<div id="caixa_preta">
</div><!-- caixa_preta -->

<div id="box">
 <h1>Abaixo segue a lista dos alunos desta disciplina!</h1>

<?php if(isset($_POST['button'])){

$code_aluno = $_POST['code_aluno'];
$nota = $_POST['nota'];
$bimestre = $_POST['bimestre'];
$disciplina = $_POST['disciplina'];
$prova = $_FILES['prova']['name'];

if(file_exists("../trabalhos_alunos/$prova")){
	$a = 1;
	while(file_exists("../trabalhos_alunos/[$a]$prova")){
	$a++;
  }
  	$prova = "[".$a."]".$prova;
 }

 $sql_3 = "INSERT INTO notas_provas (code, bimestre, disciplina, nota, prova) VALUES ('$code_aluno', '$bimestre', '$disciplina', '$nota', '$prova')";
 mysqli_query($conexao, $sql_3);
 
 (move_uploaded_file($_FILES['prova']['tmp_name'], "../trabalhos_alunos/".$prova));
 
 echo "<script language='javascript'>window.location='';</script>";

}?> 
 
 
 
<?php

$id = $_GET['id'];
$sql_1 = "SELECT * FROM provas_bimestrais WHERE id = '$id'";
$result = mysqli_query($conexao, $sql_1);
	while($res_1 = mysqli_fetch_assoc($result)){
		$curso = $res_1['curso'];
		$professor = $res_1['professor'];
		$bimestre = $res_1['bimestre'];
		
$sql_2 = "SELECT * FROM estudantes WHERE serie = '$curso'";
$result_2 = mysqli_query($conexao, $sql_2);
if(mysqli_num_rows($result_2) == ''){
	echo "<h2>Nem um aluno cadastrado neste curso</h2>";
}else{
		while($res_2 = mysqli_fetch_assoc($result_2)){
?> 
 
<form name="" method="post" action="" enctype="multipart/form-data">
<input type="hidden" name="bimestre" value="<?php echo $res_1['bimestre']; ?>" />
<input type="hidden" name="disciplina" value="<?php echo $res_1['disciplina']; ?>" />
<input type="hidden" name="code_aluno" value="<?php echo $res_2['code']; ?>" />
<table width="955" border="0">
  <tr>
    <td width="107">Código:</td>
    <td width="302">Nome do aluno:</td>
    <td width="200">D. aplicação:</td>
    <td width="144">Bimestre:</td>
    <td width="200">Prova Scaneada:</td>
    <td width="156">Nota:</td>
  </tr>
  <tr>
    <td><h3><?php echo $code_aluno = $res_2['code']; ?></h3></td>
    <td><h3><?php echo $res_2['nome']; ?></h3></td>
    <td><h3><?php echo $res_1['data_aplicacao']; ?></h3></td>
    <td><h3><?php echo $bimestre = $res_1['bimestre']; ?>º</h3></td>
    <?php
    $sql_4 = "SELECT * FROM notas_provas WHERE code = '$code_aluno' AND bimestre = '$bimestre'";
	$result_4 = mysqli_query($conexao, $sql_4);
	if(mysqli_num_rows($result_4) == ''){
	?>
    <td><input type="file" name="prova" size="5" /></td>
    <td><input name="nota" type="text" id="textfield" size="6"></td>
    <td><input type="submit" name="button" id="button" value="Concretizar"></td>
    <?php }else{ while($res_4 = mysqli_fetch_assoc($result_4 )){ ?>
    <td><a target="_blank" href="../trabalhos_alunos/<?php echo $res_4['prova']; ?>">Ver prova</a></td>
    <td><h3><?php echo $res_4['nota']; ?></h3></td>
   <td><a href="alterar_nota_trabalho.php?pg=prova_bimestral&id=<?php echo $res_4['id']; ?>&aluno=<?php echo $res_2['code']; ?>&disciplina=<?php echo $res_1['disciplina']; ?>&bimestre=<?php echo $res_1['bimestre'];  ?>&professor=<?php echo $res_1['professor'];  ?>&nota=<?php echo $res_4['nota']; ?>" rel="superbox[iframe][400x100]"><img src="../img/ico-editar.png" border="0" title="Alterar a nota" /></a></td>
    <?php }} ?>
  </tr>
</table>
</form>
<?php }}} ?>
</div><!-- box -->


<?php require "rodape.php"; ?>

<body>
</body>
</html>