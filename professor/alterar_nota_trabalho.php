<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Editar Nota</title>
<?php require "../config.php"; ?>
</head>

<body>

<?php if($_GET['pg'] == 'trabalho_bimestral'){ ?>
<?php if(isset($_POST['send'])){

$nota = $_POST['nota'];
$aluno = $_GET['aluno'];
$id = $_GET['id'];
$dis = $_GET['disciplina'];
$bimestre = $_GET['bimestre'];

$sql_5 = "UPDATE envio_de_trabalhos_bimestrais SET nota = '$nota' WHERE id = '$id' AND aluno = '$aluno'";
$sql_6 = "UPDATE notas_trabalhos SET nota = '$nota' WHERE code = '$aluno' AND disciplina = '$dis' AND bimestre = '$bimestre'";
mysqli_query($conexao, $sql_5);
mysqli_query($conexao, $sql_6);


echo "A nota deste aluno foi alterada com sucesso!!!";

die;

}?>
<em>Digite abaixo qual vai ser a nova nota</em>
<form name="" method="post" action="" enctype="multipart/form-data">
 <input type="text" size="4" maxlength="7" name="nota" value="<?php echo $_GET['nota']; ?>" /><input type="submit" name="send" value="Alterar" />
</form>
<?php }?>



<?php if($_GET['pg'] == 'prova_bimestral'){ ?>

<?php if(isset($_POST['send'])){

$nota = $_POST['nota'];
$bimestre = $_GET['bimestre'];
$professor = $_GET['professor'];
$disciplina = $_GET['disciplina'];
$code_aluno = $_GET['aluno'];

$sql = "UPDATE notas_provas SET nota = '$nota' WHERE code = '$code_aluno' AND bimestre = '$bimestre' AND disciplina = '$disciplina'";

mysqli_query($conexao, $sql);

echo "A nota deste aluno foi alterada com sucesso!!!";
die;
	
}?>

<em>Digite abaixo qual vai ser a nova nota</em>
<form name="" method="post" action="" enctype="multipart/form-data">
 <input type="text" size="4" maxlength="7" name="nota" value="<?php echo $_GET['nota']; ?>" /><input type="submit" name="send" value="Alterar" />
</form>

<?php } ?>





<?php if($_GET['pg'] == 'trabalho_extra'){ ?>
 
<?php if(isset($_POST['send'])){

$nota = $_POST['nota'];
$id_envio = $_GET['id'];
$aluno = $_GET['aluno'];
$disciplina = $_GET['disciplina'];
$id_trabalho = $_GET['id_trabalho'];

$a_nota = $_GET['nota'];

$sql_2 = "UPDATE envio_de_trabalhos_extras SET nota = '$nota' WHERE id = '$id_envio' AND id_trabalho	 = '$id_trabalho' AND disciplina = '$disciplina' AND aluno = '$aluno'";

mysqli_query($conexao, $sql_2);

$sql_3 = "SELECT * FROM pontos_extras WHERE code = '$aluno' AND disciplina = '$disciplina'";
$result = mysqli_query($conexao, $sql_3);

	while($res_1 = mysqli_fetch_assoc($result)){
			$d_nota = $res_1['nota']-$a_nota;
			
			$nova_nota = $d_nota+$nota;
			
			$sql_4 = "UPDATE pontos_extras SET nota = '$nova_nota' WHERE code = '$aluno' AND disciplina = '$disciplina'";
			mysqli_query($conexao, $sql_4);
			echo "A nota deste aluno foi alterada com sucesso!!!";
			die;
	
		}

}?> 
 
<em>Digite abaixo qual vai ser a nova nota</em>
<form name="" method="post" action="" enctype="multipart/form-data">
 <input type="text" size="4" maxlength="7" name="nota" value="<?php echo $_GET['nota']; ?>" /><input type="submit" name="send" value="Alterar" />
</form> 
<?php } ?>

</body>
</html>