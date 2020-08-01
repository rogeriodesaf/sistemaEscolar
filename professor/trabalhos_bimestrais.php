<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Trabalhos Bimestrais</title>
<link rel="stylesheet" type="text/css" href="css/trabalhos_bimestral.css"/>
</head>

<body>
<?php require "topo.php"; ?>

<div id="caixa_preta">
</div><!-- caixa_preta -->

<div id="box">
<br /><a class="a2" rel="superbox[iframe][680x400]" href="cadastrar_trabalho_bimestral.php?code=<?php echo $code; ?>">Postar trabalho</a>
<p></p>
 <h1>Abaixo segue seu histórico de trabalhos bimestrais!</h1>

<?php
$sql_1 = "SELECT * FROM trabalhos_bimestrais WHERE professor = '$code' ORDER BY id DESC";
$result = mysqli_query($conexao, $sql_1);
if(mysqli_num_rows($result) == ''){
 echo "<h2>No momento não existe nenhum trabalho lançado no sistema!</h2>";	 
}else{
	while($res_1 = mysqli_fetch_assoc($result)){	
?>
 
<table width="955" border="0">
  <tr>
    <td width="90">Nº trabalho</td>
    <td width="60">Status</td>
    <td width="131">Lançamento</td>
    <td width="187">Disciplina</td>
    <td width="323">Tema</td>
    <td width="129">Data de entrega</td>
  </tr>
  <tr>
    <td><h3><?php echo $res_1['id']; ?></h3></td>
    <td><h3><?php echo $res_1['status']; ?></h3></td>
    <td><h3><?php echo $res_1['date']; ?></h3></td>
    <td><h3><?php echo $res_1['disciplina']; ?></h3></td>
    <td><h3><?php echo $res_1['tema']; ?></h3></td>
    <td><h3><?php echo $res_1['data_entrega']; ?></h3></td>
  </tr>
  <tr>
    <td><a rel="superbox[iframe][680x400]" href="editar_trabalho_bimestral.php?id=<?php echo $res_1['id']; ?>&code=<?php echo $code; ?>">Editar</a></td>
    <td colspan="3"><a href="alunos_que_mostraram_este_trabalho.php?id=<?php echo $res_1['id']; ?>&pg=trabalhos_bimestrais">Alunos que entregaram este trabalho</a></td>
    <td></td>
    <td><a href="trabalhos_bimestrais.php?pg=excluir&code=<?php echo $code; ?>&id=<?php echo $res_1['id']; ?>"><img  border="0" src="../img/deleta.png" width="22" /></a></td>
  </tr>  
  </table>

<?php }} ?>
</div><!-- box -->


<?php if(@$_GET['pg'] == 'excluir'){

$id = $_GET['id'];
$code = $_GET['code'];

$sql_2 = "DELETE FROM trabalhos_bimestrais WHERE id = '$id' AND professor = '$code'";

mysqli_query($conexao, $sql_2);

echo "<script language='javascript'>window.location='trabalhos_bimestrais.php';</script>";

}?>


<?php require "rodape.php"; ?>
</body>
</html>