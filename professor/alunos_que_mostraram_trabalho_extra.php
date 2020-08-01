<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Entrega Trabalho Extras</title>
<link rel="stylesheet" type="text/css" href="css/alunos_que_mostraram_este_trabalho.css"/>
</head>

<body>

<?php require "topo.php"; ?>


<div id="caixa_preta">
</div><!-- caixa_preta -->

<div id="box">
 <h1>Abaixo segue a lista dos alunos que enviaram o trabalho! </h1>

<?php if(isset($_POST['button'])){

$code_aluno = $_POST['code_aluno'];
$nota = $_POST['nota'];
$id_trabalho = $_POST['id_trabalho'];
$disciplina = $_POST['disciplina'];

$sql_3 = "UPDATE envio_de_trabalhos_extras SET status = 'Aceito', nota = '$nota' WHERE aluno = '$code_aluno' AND id_trabalho = '$id_trabalho' AND disciplina = '$disciplina'";
mysqli_query($conexao, $sql_3);

$sql_4  = "INSERT INTO notas_trabalhos (code, bimestre, disciplina, nota) VALUES ('$code_aluno', 'Trabalho extra', '$disciplina', '$nota')";
mysqli_query($conexao, $sql_4);

$sql_5 = "SELECT * FROM pontos_extras WHERE code = '$code_aluno' AND disciplina = '$disciplina'";
$result_5 = mysqli_query($conexao, $sql_5);

if(mysqli_num_rows($result_5) == ''){
	$sql_6 = "INSERT INTO pontos_extras (code, disciplina, nota) VALUES ('$code_aluno', '$disciplina', '$nota')";
	mysqli_query($conexao, $sql_6);


	echo "<script language='javascript'>window.location='';</script>";		

}else{
	
	while($res_5 = mysqli_fetch_assoc($result_5)){
			$nova_nota = $res_5['nota']+$nota;
			
	$sql_7 = "UPDATE pontos_extras SET nota = '$nova_nota' WHERE code = '$code_aluno' AND disciplina = '$disciplina'";
	mysqli_query($conexao, $sql_7);
			
	echo "Inserido com sucesso !<script language='javascript'>window.location='';</script>";		
			
		}
	
	}

}?>


<?php

$id = $_GET['id'];

$sql_1 = "SELECT * FROM envio_de_trabalhos_extras WHERE id_trabalho = '$id'";
$result = mysqli_query($conexao, $sql_1);
if(mysqli_num_rows($result) == ''){
	 echo "<h2>No momento não existe nenhum trabalho enviado para ser corrigido!</h2>";	 
}else{
	while($res_1 = mysqli_fetch_assoc($result)){
		
$sql_extra = "SELECT * FROM trabalhos_extras WHERE id = '$id'";
	$result_extra = mysqli_query($conexao, $sql_extra);
	while($res_extra = mysqli_fetch_assoc($result_extra)){
?>
<form name="" method="post" action="" enctype="multipart/form-data">
<table width="955" border="0">
  <tr>
    <td width="107">Código:</td>
    <td width="302">Nome do aluno:</td>
    <td width="100">Trabalho:</td>
    <td width="144">Data de envio:</td>
    <td width="156">Nota máxima( <strong><em><?php echo $res_extra['pontos']; ?></em></strong> ):</td>
    <td width="170">&nbsp;</td>
  </tr>
  <tr>
  <input type="hidden" name="code_aluno" value="<?php echo $res_1['aluno']; ?>" />
  <input type="hidden" name="disciplina" value="<?php echo $res_1['disciplina']; ?>" />
  <input type="hidden" name="id_trabalho" value="<?php echo $res_1['id_trabalho']; ?>" />
  <input type="hidden" name="bimestre" value="<?php echo $res_1['aluno']; ?>" />
    <td><?php echo $code_aluno = $res_1['aluno']; ?></td>
    <td>
    
    <?php
	$sql_2 = "SELECT * FROM estudantes WHERE code = '$code_aluno'";
	$result_2 = mysqli_query($conexao, $sql_2);
		while($res_2 = mysqli_fetch_assoc($result_2)){
				echo $res_2['nome'];
			}
	?>
    
    </td>
    <td><a href="../trabalhos_alunos/<?php echo $res_1['trabalho']; ?>" target="_blank">Ver</a></td>
    <td><h3><?php echo $res_1['date']; ?></h3></td>
    
    <?php if($res_1['nota'] == ''){ ?>
    
    <td><input name="nota" type="text" id="textfield" size="2"></td>
    <td><input type="submit" name="button" id="button" value="Concretizar"></td>
    <td> <a href="alunos_que_mostraram_trabalho_extra.php?pg=excluir&id=<?php echo $res_1['id']; ?>&id_t=<?php echo $_GET['id']; ?>"><img src="../img/deleta.png" width="22" border="0" title="Excluir trabalho" /></a></td>
   <?php }else{ $nota = $res_1['nota']; echo "<td>Corrigido - <strong>$nota</strong></td>"; ?>
   <td><a href="alterar_nota_trabalho.php?pg=trabalho_extra&id=<?php echo $res_1['id']; ?>&id_trabalho=<?php echo $_GET['id']; ?>&aluno=<?php echo $res_1['aluno']; ?>&disciplina=<?php echo $res_1['disciplina']; ?>&nota=<?php echo $res_1['nota']; ?>" rel="superbox[iframe][400x100]"><img border="0" src="../img/ico-editar.png" title="Alterar a nota deste trabalho" /></a></td>
   <?php } ?>
  </tr>
</table>
</form>
<?php }}} ?>



<?php if(@$_GET['pg'] == 'excluir'){
	
$id = $_GET['id'];
$id_t = $_GET['id_t'];

$sql_excluir = "DELETE FROM envio_de_trabalhos_extras WHERE id = '$id' AND id_trabalho = '$id_t'";
mysqli_query($conexao, $sql_excluir);
echo "<script language='javascript'>window.location='alunos_que_mostraram_trabalho_extra.php?id=$id_t';</script>";


}?>


</div><!-- box -->

<?php require "rodape.php"; ?>

</body>
</html>