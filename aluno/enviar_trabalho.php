<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Enviar Trabalho</title>
<?php require "../config.php"; ?>

<link rel="stylesheet" type="text/css" href="css/enviar_trabalho.css"/>
</head>

<body>

<div id="box">
<?php  if($_GET['pg'] == 'trabalho_bimestral'){ ?>
<?php  if(isset($_POST['button'])){

$trabalho = $_FILES['trabalho']['name'];

if(file_exists("../trabalhos_alunos/$trabalho")){
		$a = 1;
		while(file_exists("../trabalhos_alunos/[$a]$trabalho")){
			$a++;
			}
		$trabalho = "[".$a."]".$trabalho;
}

$date = date("d/m/Y H:i:s");
$id = $_GET['id'];
$dis = $_GET['dis'];
$code  =$_GET['aluno'];

$sql_1 = "INSERT INTO envio_de_trabalhos_bimestrais (date, status, id_trabalho, disciplina, trabalho, aluno) VALUES ('$date', 'Aguarda', '$id', '$dis', '$trabalho', '$code')";
mysqli_query($conexao, $sql_1);

(move_uploaded_file($_FILES['trabalho']['tmp_name'], "../trabalhos_alunos/".$trabalho));

	echo "<h1>Trabalho enviado com sucesso!<br>Aperte F5 em seu teclado para atualizar a página.</h1>";
	die;

}?>


<strong>Atenção:</strong> Você tem até o dia <?php  echo $_GET['entrega']; ?>
<form name="" method="post" action="" enctype="multipart/form-data">
  <table width="379" border="0">
  <tr>
    <td>Clique na caixa abaixo para selecionar o trabalho</td>
  </tr>
  <tr>
    <td><label for="fileField"></label>
    <input type="file" name="trabalho" id="fileField"></td>
  </tr>
  <tr>
    <td><input class="input" type="submit" name="button" id="button" value="Enviar"></td>
  </tr>
</table>
</form>
</div><!-- box -->
<?php  } ?>







<?php  if($_GET['pg'] == 'trabalho_extras'){ ?>
<div id="box">

<?php  if(isset($_POST['button'])){
	
@$trabalho = $_FILES['trabalho']['name'];
if($trabalho == ''){
	echo "<script language='javascript'>window.alert('Selecione o trabalho para enviar!');</script>";
}else{

if(file_exists("../trabalhos_alunos/$trabalho")){
			$a = 1;
			while(file_exists("../trabalhos_alunos/[$a]$trabalho")){
				$a++;
			}
			
			$trabalho = "[".$a."]".$trabalho;
			
		}	  
$date = date("d/m/Y H:i:s");
$id = $_GET['id'];
$aluno = $_GET['aluno'];
$dis = $_GET['dis'];

$sql_2 = "INSERT INTO envio_de_trabalhos_extras (date, status, id_trabalho, disciplina, trabalho, aluno) VALUES ('$date', 'Aguarda', '$id', '$dis', '$trabalho', '$aluno')";
mysqli_query($conexao, $sql_2);

	(move_uploaded_file($_FILES['trabalho']['tmp_name'], "../trabalhos_alunos/".$trabalho));

	
	echo "<h1>Trabalho enviado com sucesso!<br>Aperte F5 em seu teclado para atualizar a página.</h1>";
	die;
 }
}?>


<?php 
$id = $_GET['id'];
$sql_1 = "SELECT * FROM trabalhos_extras WHERE id = '$id'";
$result_1 = mysqli_query($conexao, $sql_1);
	while($res_1 = mysqli_fetch_assoc($result_1)){
?>
<strong>Atenção:</strong> Você tem até o dia <?php  echo $res_1['data_entrega']; ?>
<form name="" method="post" action="" enctype="multipart/form-data">
<table width="379" border="0">
  <tr>
    <td>Clique na caixa abaixo para selecionar o trabalho</td>
  </tr>
  <tr>
    <td><label for="fileField"></label>
    <input type="file" name="trabalho" id="fileField"></td>
  </tr>
  <tr>
    <td><input class="input" type="submit" name="button" id="button" value="Enviar"></td>
  </tr>
</table>
</form>
</div><!-- box -->
<?php }} ?>

</body>
</html>