<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Detalhes do Trabalho</title>
<?php require "../config.php"; $id = $_GET['id']; ?>
<link rel="stylesheet" type="text/css" href="css/detalhes_do_trabalho.css"/>
</head>

<body>

<?php if($_GET['pg'] == 'trabalho_bimestral'){ ?>
<div id="box">
<?php
$sql_1 = "SELECT * FROM trabalhos_bimestrais WHERE id = '$id'";
$result_1 = mysqli_query($conexao, $sql_1);
	while($res = mysqli_fetch_assoc($result_1)){
?>
<table border="0">
  <tr>
    <td width="273">Nº trabalho:</td>
    <td width="269">Lançamento:</td>
  </tr>
  <tr>
    <td><h1><?php echo $res['id']; ?></h1></td>
    <td><h1><?php echo $res['date']; ?></h1></td>
  </tr>
  <tr>
    <td width="273">Bimestre:</td>
    <td width="269">Disciplina:</td>
  </tr>
  <tr>
    <td><h1><?php echo $res['bimestre']; ?>º Bimestre</h1></td>
    <td><h1><?php echo $res['disciplina']; ?></h1></td>
  </tr>  
  <tr>
    <td width="273">Data de entrega:</td>
    <td width="269">Tema:</td>
  </tr>
  <tr>
    <td><h1><?php echo $res['data_entrega']; ?></h1></td>
    <td><h1><?php echo $res['tema']; ?></h1></td>
  </tr>
  <tr>
    <td>Mais detalhes sobre o trabalho:</td>
  </tr>
  <tr>
    <td colspan="3"><h1><?php echo $res['detalhes']; ?></h1></td>
  </tr>
  </table>
<?php } ?>  
</div><!-- box -->
<?php } ?>



<?php if($_GET['pg'] == 'trabalho_extras'){ ?>
<div id="box">
<?php
$sql_1 = "SELECT * FROM trabalhos_extras WHERE id = '$id'";
$result_1 = mysqli_query($conexao, $sql_1);
	while($res = mysqli_fetch_assoc($result_1)){
?>
<table border="0">
  <tr>
    <td width="273">Nº trabalho:</td>
    <td width="269">Lançamento:</td>
  </tr>
  <tr>
    <td><h1><?php echo $res['id']; ?></h1></td>
    <td><h1><?php echo $res['date']; ?></h1></td>
  </tr>
  <tr>
    <td width="269">Disciplina:</td>
  </tr>
  <tr>
    <td><h1><?php echo $res['disciplina']; ?></h1></td>
  </tr>  
  <tr>
    <td width="273">Data de entrega:</td>
    <td width="269">Tema:</td>
  </tr>
  <tr>
    <td><h1><?php echo $res['data_entrega']; ?></h1></td>
    <td><h1><?php echo $res['tema']; ?></h1></td>
  </tr>
  <tr>
    <td>Mais detalhes sobre o trabalho:</td>
  </tr>
  <tr>
    <td colspan="3"><h1><?php echo $res['detalhes']; ?></h1></td>
  </tr>
  </table>
<?php } ?>  
</div><!-- box -->
<?php } ?>

</body>
</html>