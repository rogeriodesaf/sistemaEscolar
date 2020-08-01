<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Imprimir</title>
<link rel="stylesheet" type="text/css" href="css/relatorios.css"/>
</head>


<body>
<script language="javascript">
window.print() 
</script>
<div id="box">
<?php
require "../config.php"; 

$s = base64_decode($_GET['s']);

$sql_1 = mysqli_query($conexao, $s);
if(mysqli_num_rows($sql_1) == ''){
	echo "Não existe resultado para Impressão!";
}else{
?>
<table width="950" border="0">
  <tr>
    <td width="200"><strong>Disciplina/Curso:</strong></td>
    <td width="70"><strong>Código:</strong></td>
    <td width="150"><strong>Nome</strong></td>
    <td width="180"><strong>Formação:</strong></td>
    <td width="105"><strong>Salário:</strong></td>
  </tr>
<?php while($res_1 = mysqli_fetch_assoc($sql_1)){ ?>  
  <tr>
    <td><?php
			echo $res_1['disciplina'];
			echo " - ";
			echo $res_1['curso'];
			
	?></td>
    <td><?php echo $res_1['professor']; ?></td>
    <td><?php
    $sql_1_extra = mysqli_query($conexao, "SELECT * FROM professores WHERE code = ".$res_1['professor']."");
		while($res_extra = mysqli_fetch_assoc($sql_1_extra)){
	
	?>
    <?php echo $res_extra['nome']; ?></td>
    <td><?php echo $res_extra['formacao']; ?>/<?php echo $res_extra['graduacao']; ?></td>
    <td>R$ <?php echo number_format($res_extra['salario'],2); ?></td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="6"><hr></td>
  </tr>
<?php } ?>  
  <tr>
   <td align="center" colspan="6"><a target="_blank" href="professores_pg_impressao.php?s=<?php echo $_GET['s']; ?>">Imprimir relação completa</a></td>
  </tr>
</table>
<?php } ?>

</div><!-- box -->
</body>
</html>