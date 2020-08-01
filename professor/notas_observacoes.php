<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Notas Oberservações</title>
<link rel="stylesheet" type="text/css" href="css/trabalhos_extras.css"/>
</head>

<body>
<?php require "topo.php"; ?>

<div id="caixa_preta">
</div><!-- caixa_preta -->

<div id="box">
<br /><a class="a2" rel="superbox[iframe][850x350]" href="cadastrar_nota_observacao.php?code=<?php echo $code; ?>">Cadastrar Nota</a>
<p></p>
 <h1>Abaixo segue seu histórico de notas de observações bimestrais de suas turmas!</h1>

<?php
$sql_1 = "SELECT * FROM notas_de_observacoes WHERE professor = '$code' ORDER BY id DESC";
$result = mysqli_query($conexao, $sql_1);
if(mysqli_num_rows($result) == ''){
	 echo "<h2>No momento não existe nenhuma nota de observação lançada no sistema!</h2>";	 
}else{
	while($res_1 = mysqli_fetch_assoc($result)){
?>

<table width="955" border="0">
  <tr>
    <td width="60">Status</td>
    <td width="250">Curso</td>
    <td width="250">Disciplina</td>
    <td width="250">Bimestre</td>
    <td width="131">Lançamento</td>
  </tr>
  <tr>
    <td><h3><?php echo $res_1['status']; ?></h3></td>
    <td><h3><?php echo $res_1['curso']; ?></h3></td>
    <td><h3><?php echo $res_1['disciplina']; ?></h3></td>
    <td><h3><?php echo $res_1['bimestre']; ?>º Bimestre</h3></td>
    <td><h3><?php echo $res_1['date']; ?></h3></td>
  </tr>
  <tr>
    <td colspan="3"><a href="incluir_notas_de_observacao.php?id=<?php echo $res_1['id']; ?>&curso=<?php echo $res_1['curso']; ?>">Incluir notas</a></td>
    <td></td>
    <td><a href="notas_observacoes.php?pg_e=excluir&id=<?php echo $res_1['id']; ?>"><img src="../img/deleta.png" width= "22" border="0" /></a></td>
  </tr>  
  </table> 
<?php }} ?> 
</div><!-- box -->

<?php if(@$_GET['pg_e'] == 'excluir'){

$id = $_GET['id'];

$sql_2 = "DELETE FROM notas_de_observacoes WHERE id = '$id'";
mysqli_query($conexao, $sql_2);

echo "<script language='javascript'>window.location='notas_observacoes.php';</script>";

}?>


<?php require "rodape.php"; ?>
</body>
</html>