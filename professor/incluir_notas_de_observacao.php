<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Notas de Observação</title>
<link rel="stylesheet" type="text/css" href="css/correcao_prova.css"/>
</head>

<body>
<?php require "topo.php"; ?>

<div id="caixa_preta">
</div><!-- caixa_preta -->

<div id="box">
 <h1>Abaixo segue a lista dos alunos desta disciplina!</h1>

<?php if(isset($_POST['button'])){

echo $code_aluno = $_POST['code_aluno'];
$nota = $_POST['nota'];
$disciplina = $_POST['disciplina'];
$date = date("d/m/Y H:i:s");
$bimestre = $_POST['bimestre'];

$sql_3 = "SELECT * FROM notas_provas WHERE code = '$code_aluno' AND disciplina = '$disciplina' AND bimestre = '$bimestre'";
$result_3 = mysqli_query($conexao, $sql_3);
if(mysqli_num_rows($result_3) == ''){
	echo "<script language='javascript'>window.alert('A nota da prova bimestral deste aluno ainda não foi lançada no sistema, necessitamos dela para calcular média do aluno');</script>";
}else{
	while($res_3 = mysqli_fetch_assoc($result_3)){
		
$sql_4 = "SELECT * FROM notas_trabalhos WHERE code = '$code_aluno' AND disciplina = '$disciplina' AND bimestre = '$bimestre'";
$result_4 = mysqli_query($conexao, $sql_4);
if(mysqli_num_rows($result_4) == ''){
	echo "<script language='javascript'>window.alert('A nota do trabalho bimestral deste aluno ainda não foi lançada no sistema, necessitamos dela para calcular média do aluno');</script>";
}else{
	while($res_4 = mysqli_fetch_assoc($result_4)){
		
$sql_5 = "SELECT * FROM pontos_extras WHERE code = '$code_aluno' AND disciplina = '$disciplina'";
$result_5 = mysqli_query($conexao, $sql_5);
if(mysqli_num_rows($result_5) == ''){


		$media = ($res_3['nota']+$res_4['nota']+$nota)/3;
		
		if($media >10){
			$media = 10;
		}else{
			$media = $media;
		}

 $sql_6 = "INSERT INTO notas_observacao (code, bimestre, disciplina, nota) VALUES ('$code_aluno', '$bimestre', '$disciplina', '$nota')"; mysqli_query($conexao, $sql_6);
 
 $sql_7 = "INSERT INTO notas_bimestrais (code, bimestre, disciplina, nota) VALUES ('$code_aluno', '$bimestre', '$disciplina', '$media')";
 mysqli_query($conexao, $sql_7);
 
 $sql_8 = "DELETE FROM pontos_extras WHERE code = '$code_aluno' AND disciplina = '$disciplina'";
 mysqli_query($conexao, $sql_8);

echo "<script language='javascript'>window.location='';</script>";


}else{
	while($res_5 = mysqli_fetch_assoc($result_5)){
		
		$pontos_extras = $res_5['nota'];

		
		$media = ($res_3['nota']+$res_4['nota']+$pontos_extras+$nota)/3;
		
		if($media >10){
			$media = 10;
		}else{
			$media = $media;
		}

 $sql_6 = "INSERT INTO notas_observacao (code, bimestre, disciplina, nota) VALUES ('$code_aluno', '$bimestre', '$disciplina', '$nota')"; 
  mysqli_query($conexao, $sql_6);
 
 $sql_7 = "INSERT INTO notas_bimestrais (code, bimestre, disciplina, nota) VALUES ('$code_aluno', '$bimestre', '$disciplina', '$media')";
  mysqli_query($conexao, $sql_7);
 
 $sql_8 = "DELETE FROM pontos_extras WHERE code = '$code_aluno' AND disciplina = '$disciplina'";
  mysqli_query($conexao, $sql_8);

echo "<script language='javascript'>window.location='';</script>";
						
}}}}}}}?> 
 
 
 
 
 <?php
$id = $_GET['id'];
$sql_1 = "SELECT * FROM notas_de_observacoes WHERE id = ".$_GET['id']."";
 	$result_1 = mysqli_query($conexao, $sql_1);
	while($res_1 = mysqli_fetch_assoc($result_1)){
	$curso = $res_1['curso'];

 $sql_2 = "SELECT * FROM estudantes WHERE status = 'Ativo' AND serie = '$curso'";
 	$result_2 = mysqli_query($conexao, $sql_2);
	while($res_2 = mysqli_fetch_assoc($result_2)){
 ?>

<form name="" method="post" action="" enctype="multipart/form-data">
<input type="hidden" name="code_aluno" value="<?php echo $res_2['code']; ?>" />
<input type="hidden" name="bimestre" value="<?php echo $res_1['bimestre']; ?>" />
<input type="hidden" name="disciplina" value="<?php echo $res_1['disciplina']; ?>" />
<table width="955" border="0">
  <tr>
    <td width="107"><strong>Código:</strong></td>
    <td width="302"><strong>Nome do aluno:</strong></td>
    <td width="302"><strong>Disciplina:</strong></td>
    <td width="156"><strong>Nota:</strong></td>
    <td width="170">&nbsp;</td>
  </tr>
  <tr>
    <td><h3><?php echo $res_2['code']; ?></h3></td>
    <td><h3><?php echo $res_2['nome']; ?></h3></td>
    <td><h3><?php echo $res_1['disciplina']; ?></h3></td>
    
    <?php
	
	$code_aluno = $res_2['code'];
	$disciplina = $res_1['disciplina'];
	$bimestre = $res_1['bimestre'];
	$sql_9 = "SELECT * FROM notas_observacao WHERE code = '$code_aluno' AND disciplina = '$disciplina' AND bimestre = '$bimestre'";
	$result_9 = mysqli_query($conexao, $sql_9);
	if(mysqli_num_rows($result_9) == ''){
	?>
    <td><input name="nota" type="text" id="textfield" size="6"></td>
    <td><input type="submit" name="button" id="button" value="Concretizar"></td>
    <?php
	}else{  
	
	while($res_9 = mysqli_fetch_assoc($result_9)){
	
	echo "<td><h3>Indisponível - Nota: ".$res_9['nota']."</h3></td>";
	}} ?>
    
  </tr>
</table>
</form>
<?php }} ?>
</div><!-- box -->



<?php require "rodape.php"; ?>
</body>
</html>