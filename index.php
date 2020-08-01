<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sistema Escolar</title>

<link rel="stylesheet" type="text/css" href="css/estilo.css"/>

<link rel="shortcut icon" href="img/ico_escola.ico" />

<?php require "conexao.php"; require "operacional.php"; require "pagamento_funcionarios.php" ?>

</head>

<body>

<div id="logo">
<img src="img/logo1.jpg" />
</div>


<div id="caixa_login">

<?php
if(isset($_POST['button'])){
	$code = $_POST['code'];
	$password = $_POST['password'];
	
	if($code == ''){
		echo "<h2> Por favor, digite o número do cartão ou código de acesso! </h2>";
		}
		
		else if($password == ''){
			echo "<h2> Por favor, digite sua senha! </h2>";		
	} else{
		$sql = "SELECT * FROM login WHERE code = '$code' AND senha = '$password'";
		
		$result = mysqli_query($conexao, $sql);
		if(mysqli_num_rows($result) > 0){
			
			while($res_1 = mysqli_fetch_assoc($result)){
				$status = $res_1['status'];
				$code = $res_1['code'];
				$senha = $res_1['senha'];
				$nome = $res_1['nome'];
				$painel = $res_1['painel'];
				
				if($status == 'Inativo'){
					echo "<h2> Você está inativo, procure a administração!! </h2>";	
				}else{
				
					session_start();
					$_SESSION['code'] = $code;
					$_SESSION['nome'] = $nome;
					$_SESSION['senha'] = $senha;
					$_SESSION['painel'] = $painel;
					
					if($painel == 'admin'){
						echo "<script language='javascript'> window.location='admin';</script>";	
						
					} else if($painel == 'Aluno'){
						echo "<script language='javascript'> window.location='aluno';</script>";	
					}else if($painel == 'professor'){
						echo "<script language='javascript'> window.location='professor';</script>";	
					}else if($painel == 'portaria'){
						echo "<script language='javascript'> window.location='portaria';</script>";	
					}else if($painel == 'tesouraria'){
						echo "<script language='javascript'> window.location='tesouraria';</script>";	
					}
						
				}
				
			}
			
		} else{
			echo "<h2> Dados incorretos! </h2>";	
		}
		
	}
}
?>

<form name="form" method="post" action="" enctype="multipart/form-data">

<table>
  <tr>
   <td><h1>Nº Cartão ou Código de acesso:</h1></td>
  </tr>
  <tr>
   <td><input type="text" name="code" /></td>
  </tr>
   <tr>
   <td><h1>Senha:</h1></td>
  </tr>
  <tr>
   <td><input type="password" name="password" /></td>
  </tr>
  <tr>
   <td><input class="input" type="submit" name="button" value="Entrar" /></td>
  </tr>
 </table>

</form>
</div>


</body>
</html>