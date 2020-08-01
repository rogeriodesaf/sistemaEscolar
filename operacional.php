<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<?php // aqui faz o encerramento dos trabalhos bimestrais


$date = date("d/m/Y");
$sql_1 = mysqli_query($conexao, "SELECT * FROM trabalhos_bimestrais WHERE data_entrega < '$date'");
if(mysqli_num_rows($sql_1) == ''){
}else{
	while($res_1 = mysqli_fetch_assoc($sql_1)){	
		
		mysqli_query($conexao, "UPDATE trabalhos_bimestrais SET status = 'Encerrado' WHERE id = ".$res_1['id']."");
 }
}
// aqui fecha o trabalho bimestral
?>


<?php // aqui faz o encerramento dos trabalhos extras
$date = date("d/m/Y");
$sql_2 = mysqli_query($conexao, "SELECT * FROM trabalhos_extras WHERE data_entrega < '$date'");
if(mysqli_num_rows($sql_2) == ''){
}else{
	while($res_2 = mysqli_fetch_assoc($sql_2)){	
		
		mysqli_query($conexao, "UPDATE trabalhos_extras SET status = 'Encerrado' WHERE id = ".$res_2['id']."");
 }
}
// aqui fecha o trabalho bimestral
?>
</body>
</html>