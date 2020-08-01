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
$d_m_y = date("d/m/Y");
$date = date("d/m/Y H:i:s");

$sql_1 = mysqli_query($conexao, "SELECT * FROM estudantes WHERE nome != '' AND	status = 'Ativo'");
if(mysqli_num_rows($sql_1) == ''){
}else{
	while($res_1 = mysqli_fetch_assoc($sql_1)){
		$vencimento = $res_1['vencimento']-$d;
		$code_aluno = $res_1['code'];
		$mensalidade = $res_1['mensalidade'];
		$nome = $res_1['nome'];
		
		$d_vencimento = $res_1['vencimento'];
		
		if($vencimento >= 5){
		}else{
		$sql_2 = mysqli_query($conexao, "SELECT * FROM mensalidades WHERE d_cobranca = '$d_m_y' AND matricula = '$code_aluno'");		
		if(mysqli_num_rows($sql_2) >=1){
		}else{
			$sql_3 = mysqli_query($conexao, "SELECT * FROM mensalidades ORDER BY id DESC LIMIT 1");
				while($res_3 = mysqli_fetch_assoc($sql_3)){
					
					$codigo_cobranca = $res_3['code']+1;
					
					$v_cobranca = "$d_vencimento/$m/$a";
		 		
			$sql_4 = mysqli_query($conexao, "INSERT INTO mensalidades (code, matricula, d_cobranca, vencimento, valor, status, dia, mes, ano) VALUES ('$codigo_cobranca', '$code_aluno', '$d_m_y', '$v_cobranca', '$mensalidade', 'Aguarda Pagamento', '$d', '$m', '$a')");	
			$sql_5 = mysqli_query($conexao, "INSERT INTO mural_tesouraria (date, status, titulo) VALUES ('$date', 'Ativo', 'A cobrança do aluno $nome referente ao mês $m/$a foi gerada e aguarda pagamento')");	
		
					
	 }
	}
   }
  }
 }
?>
</body>
</html>