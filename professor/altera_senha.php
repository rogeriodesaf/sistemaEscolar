<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<?php if(isset($_POST['button'])){
require "../conexao.php";


$senha = $_POST['senha'];
$senha2 = $_POST['senha2'];
$code = $_GET['code'];

if($senha != $senha2){
	echo "<script language='javascript'>window.alert('As senhas não confere!');</script>";
}else{

mysqli_query($conexao, "UPDATE login SET senha = '$senha' WHERE code = '$code'");

echo "Senha alterada com sucesso<br>Clique em F5 em seu teclado";
die;
}
}?>

<form name="" method="post" action="" enctype="multipart/form-data">
<em>Digite sua nova senha / Repita a senha</em><br />
<input name="senha" type="password" size="10" maxlength="20" />
<input name="senha2" type="password" size="10" maxlength="20" /><input type="submit" name="button" value="Alterar" />
</form>
</body>
</html>