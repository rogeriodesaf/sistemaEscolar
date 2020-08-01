<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Presenças</title>
<link rel="stylesheet" type="text/css" href="css/precesencas.css"/>
</head>

<body>
<?php require "topo.php"; ?>

<div id="caixa_preta">
</div><!-- caixa_preta -->

<div id="box">
 <h1><strong>Frequência Escolar</strong></h1>
<table width="900" border="0">
  <tr>
    <td align="center" colspan="5">Frequência geral nas disciplinas e nos bimestres</td>
  </tr>
  <tr>
    <td align="center" colspan="5"><hr></td>
  </tr>
  <tr>
    <td width="242"><strong>DISCIPLINA</strong></td>
    <td width="179"><strong>Total de presença</strong></td>
    <td width="152"><strong>Total de faltas</strong></td>
    <td width="192"><strong>Falta(s) Justificada</strong></td>
    <td width="119"><strong>Resultado</strong></td>
  </tr>
<?php
$sql_1 = "SELECT * FROM disciplinas WHERE curso = '$serie'";
$result_1 = mysqli_query($conexao, $sql_1);
	while($res_1 = mysqli_fetch_assoc($result_1)){

?>  
  <tr>
    <td><?php echo $disciplina = $res_1['disciplina']; ?></td>
    <td><?php 
	$sql_2 = "SELECT * FROM chamadas_em_sala WHERE curso = '$serie' AND disciplina = '$disciplina' AND code_aluno = '$code' AND presente = 'SIM'";
	$result_2 = mysqli_query($conexao, $sql_2);
	$ver_result_2 = mysqli_num_rows($result_2);
	echo $ver_result_2 / 3; ?></td>
    <td><?php $sql_3 = "SELECT * FROM chamadas_em_sala WHERE curso = '$serie' AND disciplina = '$disciplina' AND code_aluno = '$code' AND presente = 'NÃO'"; 
	$result_3 = mysqli_query($conexao, $sql_3);
	$ver_result_3 = mysqli_num_rows($result_3);
	echo $ver_result_3 / 3;
	?></td>
    <td><?php $sql_4 = "SELECT * FROM chamadas_em_sala WHERE curso = '$serie' AND disciplina = '$disciplina' AND code_aluno = '$code' AND presente = 'JUSTIFICADA'"; 
	$result_4 = mysqli_query($conexao, $sql_4);
	$ver_result_4 = mysqli_num_rows($result_4);
	echo $ver_result_4 / 3;
	?></td>
    <td>
    <?php
	$sql_5 = "SELECT * FROM chamadas_em_sala WHERE curso = '$serie' AND disciplina = '$disciplina'";
	$result_5 = mysqli_query($conexao, $sql_5);
	$conta_sql_5 = mysqli_num_rows($result_5);
	
	$total = ($conta_sql_5*25)/100;
	
	if($ver_result_3 > $total){
		echo "Reprovado";
	}else{
		echo "Aprovado";
		}
	
	?>    
    </td>
  </tr>
  <tr>
    <td colspan="5"><img src="img/menu_topo.png" width="900" height="1"></td>
  </tr>
<?php } ?>  
</table> 

</div><!-- box -->

</body>
</html>