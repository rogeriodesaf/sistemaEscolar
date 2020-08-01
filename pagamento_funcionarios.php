<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<?php

$d = date("d");
$m = date("m");
$a = date("Y");
$date = date("d/m/Y H:i:s");
$d_m_y = date("d/m/Y");

if($d == 02){
$sql_1 = mysqli_query($conexao, "SELECT * FROM professores WHERE status = 'Ativo' AND code != ''");
if(mysqli_num_rows($sql_1) == ''){
}else{
	while($res_1 = mysqli_fetch_assoc($sql_1)){
			$code = $res_1['code'];	
			$nome = $res_1['nome'];
			$salario = $res_1['salario'];
			
	$sql_2 = mysqli_query($conexao, "SELECT * FROM fluxo_de_caixa WHERE date = '$d_m_y' AND codigo = '$code'");
	if(mysqli_num_rows($sql_2) >=1){
	}else{
		mysqli_query($conexao, "INSERT INTO fluxo_de_caixa (status, tipo, d, m, a, date_completo, date, codigo, descricao, valor, form_pag) VALUES ('Ativo', 'DÉBITO', '$d', '$m', '$a', '$date', '$d_m_y', '$code', 'Pagamento do professor (a) $nome', '$salario', 'Transferência Bancaria')");
				
   }
  }
 }
}
?>


<?php

$d = date("d");
$m = date("m");
$a = date("Y");
$date = date("d/m/Y H:i:s");
$d_m_y = date("d/m/Y");

if($d == 02){
$sql_1 = mysqli_query($conexao, "SELECT * FROM funcionarios WHERE status = 'Ativo' AND code != ''");
if(mysql_num_rows($sql_1) == ''){
}else{
	while($res_1 = mysqli_fetch_assoc($sql_1)){
			$code = $res_1['code'];	
			$nome = $res_1['nome'];
			$salario = $res_1['salario'];
			
	$sql_2 = mysqli_query($conexao, "SELECT * FROM fluxo_de_caixa WHERE date = '$d_m_y' AND codigo = '$code'");
	if(mysqli_num_rows($sql_2) >=1){
	}else{
		mysqli_query($conexao, "INSERT INTO fluxo_de_caixa (status, tipo, d, m, a, date_completo, date, codigo, descricao, valor, form_pag) VALUES ('Ativo', 'DÉBITO', '$d', '$m', '$a', '$date', '$d_m_y', '$code', 'Pagamento do funcionário (a) $nome', '$salario', 'Transferência Bancaria')");
				
   }
  }
 }
}
?>

</body>
</html>