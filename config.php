<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sem título</title>
</head>

<body>


<?php if(@$_GET['pg'] == 'sair'){
	
	@session_destroy();
$_SESSION['code'] = '';
$_SESSION['nome']= '';
$_SESSION['password']= '';
$_SESSION['painel']= '';



echo "<script language='javascript'>window.location='index.php';</script>";



}?>



<?php 
require "conexao.php";

@session_start();



$code = $_SESSION['code'];
$senha = $_SESSION['senha'];
$nome = $_SESSION['nome'];
$painel = $_SESSION['painel'];

if($code == ''){
	echo "<script language='javascript'>window.location='../index.php';</script>";
}else if($nome == ''){
	echo "<script language='javascript'>window.location='../index.php';</script>";
}else if($senha == ''){
	echo "<script language='javascript'>window.location='../index.php';</script>";
}else{

$sql_1 = "SELECT * FROM login WHERE code = '$code' AND senha = '$senha'";
$result = mysqli_query($conexao, $sql_1);
$conta_sql_1 = mysqli_num_rows($result);

if($conta_sql_1 == ''){
	echo "<script language='javascript'>window.location='../index.php';</script>";
}else{

 }
}
?>


<?php 
if(@$_GET['acao'] == 'quebra'){
	
	@session_destroy();
$_SESSION['code'] = '';
$_SESSION['nome']= '';
$_SESSION['password']= '';
$_SESSION['painel']= '';
	
	echo "<script language='javascript'>window.location='index.php';</script>";
}
	
	?>

</body>
</html>