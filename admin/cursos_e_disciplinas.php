<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Adminstração</title>
<link href="css/cursos_e_disciplinas.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php require "topo.php"; ?>


<!CADASTRAR O CURSO>

<div id="caixa_preta">
</div><!-- caixa_preta -->

<?php if(@$_GET['pg'] == 'curso'){ ?>
<div id="box_curso">
<br /><br />
 <a class="a2" href="cursos_e_disciplinas.php?pg=curso&cadastra=sim">Cadastrar Curso</a>
<?php if(@$_GET['cadastra'] == 'sim'){?> 
 <br /><br />
 <h1>Cadastrar curso</h1>
<?php if(isset($_POST['cadastra'])){

$curso = $_POST['curso'];

$sql = "INSERT INTO cursos (curso) VALUES ('$curso')";	
	
	$cad = mysqli_query($conexao, $sql);

	if ($cad == ''){
		echo "<script language='javascript'> window.alert('Erro ao Cadastrar, Curso já Cadastrado!');</script>";
	}else{
		
	echo "<script language='javascript'> window.alert('Cadastro Realizado com sucesso!!');</script>";
	echo "<script language='javascript'>window.location='cursos_e_disciplinas.php?pg=curso';</script>";
	}

}?> 
<form name="form1" method="post" action="">
  <table width="900" border="0">
    <tr>
      <td width="134">Curso</td>
    </tr>
    <tr>
      <td><input type="text" name="curso" id="textfield"></td>
      <td><input class="input" type="submit" name="cadastra" id="button" value="Cadastrar"></td>
    </tr>
  </table>
</form> 
 <br />
<?php die;} ?> 



<!VISUALIZAR OS CURSOS CADASTRADOS>

<?php
$sql_1 = "SELECT * FROM cursos";
$result = mysqli_query($conexao, $sql_1);
 if(mysqli_num_rows($result) <= 0){
	 echo "<br><br>No momento não existe nenhum curso cadastrado!<br><br>";
 }else{
?>
<br /><br />
 <h1>Cursos</h1>
    <table width="900" border="0">
      <tr>
        <td><strong>Curso:</strong></td>
        <td><strong>Total de disciplinas deste curso:</strong></td>
        <td>&nbsp;</td>
      </tr>
      <?php while($res_1 = mysqli_fetch_assoc($result)){ ?>
      <tr>
        <td><h3><?php echo $curso = $res_1['curso']; ?></h3></td>
        <td><h3><?php $sql_2 = "SELECT * FROM disciplinas WHERE curso = '$curso'";
		$result2 = mysqli_query($conexao, $sql_2);
		echo mysqli_num_rows($result2); ?></h3>
        </td>
        <td><a class="a" href="cursos_e_disciplinas.php?pg=curso&deleta=cur&id=<?php echo @$res_1['id']; ?>"><img title="Excluir curso" src="img/deleta.jpg" width="18" height="18" border="0"></a></td>
      </tr>
      <?php } ?>
    </table>	 

<?php } ?> 
<br />


<!DELEÇÃO DOS CURSOS>

<?php if(@$_GET['deleta'] == 'cur'){

$id = $_GET['id'];

$sql_3 = "DELETE FROM cursos WHERE id = '$id'";
mysqli_query($conexao, $sql_3);

echo "<script language='javascript'>window.location='cursos_e_disciplinas.php?pg=curso';</script>";

}?>
</div><!-- box_curso -->
<?php  }?>





<!CADASTRAR DISCIPLINAS>

<?php if(@$_GET['pg'] == 'disciplina'){ ?>

<div id="box_disciplinas">
<a class="a2" href="cursos_e_disciplinas.php?pg=disciplina&cadastra=sim">
Cadastrar Disciplina</a>
<?php if(@$_GET['cadastra'] == 'sim'){ ?>
<h1>Cadastrar nova disciplina</h1>

<?php if(isset($_POST['cadastra'])){
	
$curso = $_POST['curso'];	
$disciplina = $_POST['disciplina'];	
$professor = $_POST['professor'];	
$sala = $_POST['sala'];	
$turno = $_POST['turno'];	

if($disciplina == ''){
	echo "<script language='javascript'>window.alert('Digite o nome da disciplina');</script>";
}else if($sala == ''){
	echo "<script language='javascript'>window.alert('Digite o nº da sala');</script>";
}else{
$sql_cad_disc = "INSERT INTO disciplinas (curso, disciplina, professor, sala, turno) VALUES ('$curso', '$disciplina', '$professor', '$sala', '$turno')";
$cad_disc = mysqli_query($conexao, $sql_cad_disc);
if($cad_disc == ''){
	echo "<script language='javascript'>window.alert('Ocorreu um erro!');</script>";
}else{
	echo "<script language='javascript'>window.alert('Disciplina cadastrada com sucesso!');window.location='cursos_e_disciplinas.php?pg=disciplina';</script>";
	echo "<script language='javascript'>window.location='cursos_e_disciplinas.php?pg=disciplina';</script>";
  }
 }
}?>

<form name="form1" method="post" action="">
  <table width="900" border="0">
    <tr>
      <td width="134">Curso:</td>
      <td width="213">Disciplina:</td>
      <td>Professor:</td>
      <td width="128">Sala: <em>Apenas o número</em></td>
      <td width="128">Turno:</td>
      <td width="126">&nbsp;</td>
      <td width="0" colspan="2"></td>
    </tr>
    <tr>
      <td>
      <select name="curso">
      <?php
      $sql_rec_curso = "SELECT * FROM cursos";
	  $result_rec_curso = mysqli_query($conexao, $sql_rec_curso);

	  	while($r2 = mysqli_fetch_assoc($result_rec_curso)){
	  ?>
      	<option value="<?php echo $r2['curso']; ?>"><?php echo $r2['curso']; ?></option>
      <?php } ?>
      </select>
      </td>
      <td>
      <input type="text" name="disciplina" id="textfield"></td>
      <td width="143">
      <select name="professor">
      <?php
      $sql_result_prof = "SELECT * FROM professores WHERE nome != ''";
	  $result_rec_prof = mysqli_query($conexao,  $sql_result_prof );
	  	while($r3 = mysqli_fetch_assoc($result_rec_prof)){
	  ?>
       <option value="<?php echo $r3['code']; ?>"><?php echo $r3['nome']; ?></option>
      <?php } ?>
      </select>
      </td>
      <td>
      <input type="text" name="sala" id="textfield"></td>
      <td>
        <select name="turno" size="1" id="turno">
          <option value="Manhã">Manhã</option>
          <option value="Tarde">Tarde</option>
          <option value="Noite">Noite</option>
      </select></td>
      <td width="126"><input class="input" type="submit" name="cadastra" id="button" value="Cadastrar"></td>
    </tr>    
  </table>
</form>

<?php die;  } ?>






<!MOSTRAR AS DISCIPLINAS NA TABELA>


<br /><br />




 <h1>Disciplinas</h1>
<?php
$sql_buscar_disc = "SELECT * FROM disciplinas";
$result_buscar_disc = mysqli_query($conexao,  $sql_buscar_disc );
if(mysqli_num_rows($result_buscar_disc) == ''){
	echo "<h2>No momento não existe nenhuma disciplina cadastrada!</h2><br><br>";
}else{
?> 
    <table width="900" border="0">
      <tr>
        <td><strong>Curso:</strong></td>
        <td><strong>Disciplina:</strong></td>
        <td><strong>Professor:</strong></td>
        <td><strong>Sala:</strong></td>
        <td><strong>Turno:</strong></td>
      </tr>
      <?php while($res_busca = mysqli_fetch_assoc($result_buscar_disc)){ ?>
      <tr>
        <td><h3><?php echo $res_busca['curso']; ?></h3></td>
        <td><h3><?php echo $res_busca['disciplina']; ?></h3></td>
        <td><h3>
		<?php
		$professor = $res_busca['professor'];
		
		$sql_busca_prof = "SELECT * FROM professores WHERE code = '$professor'";
			$result_buscar_prof = mysqli_query($conexao,  $sql_busca_prof);
			while($res_busca2 = mysqli_fetch_assoc($result_buscar_prof)){
				echo $res_busca2['nome']; echo " - "; echo $res_busca['professor'];
			}
				
		?>
        </h3></td>
        <td><h3><?php echo $res_busca['sala']; ?></h3></td>
        <td><h3><?php echo $res_busca['turno']; ?></h3></td>
        <td><a class="a" href="cursos_e_disciplinas.php?pg=disciplina&deleta=sim&id=<?php echo $res_busca['id']; ?>"><img title="Excluir Disciplina" src="img/deleta.jpg" width="18" height="18" border="0"></a></td>
      </tr>
      <?php } ?>
    </table>
<?php } ?>






<!EXCLUSÃO DAS DISCIPLINAS>

<?php if(@$_GET['deleta'] == 'sim'){

$id = $_GET['id'];

$sql_delete_disc = "DELETE FROM disciplinas WHERE id = '$id'";
mysqli_query($conexao,  $sql_delete_disc);

echo "<script language='javascript'>window.location='cursos_e_disciplinas.php?pg=disciplina';</script>";

}?> 
</div><!-- box_disciplinas -->
<?php } ?>






<!MOSTRAR OS CURSOS E AS DISCIPLINAS>


<?php if(@$_GET['pg'] == 'cursoedisciplinas'){ ?>
<div id="box_curso_e_disciplinas">
<h1>Cursos e Disciplinas</h1>

<?php
$sql_ced = "SELECT * FROM cursos";
$result_ced = mysqli_query($conexao,  $sql_ced);
if(mysqli_num_rows($result_ced) == ''){
	echo "Não existe nenhum curso cadastrado no momento!";
}else{
?>
<table width="620" border="0">
<?php while($rs_ced = mysqli_fetch_assoc($result_ced)){ ?>
  <tr>
    <td width="614">Curso: <?php echo $curso = $rs_ced['curso']; ?></td>
  </tr>
  <tr>
    <td>
    <textarea disabled="disabled" name="textarea" id="textarea" cols="100" rows="5">
    <?php
     $sql_ced_prof = "SELECT * FROM disciplinas WHERE curso = '$curso'";
	 $result_ced_prof = mysqli_query($conexao,  $sql_ced_prof);
	 	while($rs_ced2 = mysqli_fetch_assoc($result_ced_prof)){
		
			$professor = $rs_ced2['professor'];
						
			echo $rs_ced2['disciplina']; 
			echo " - ";
	$sql_ced_cod = "SELECT * FROM professores WHERE code = '$professor'";
	$result_ced_cod = mysqli_query($conexao,  $sql_ced_cod);
		while($rs_ced3 = mysqli_fetch_assoc($result_ced_cod)){
			echo $rs_ced3['nome'];
			echo " - ";
			echo $rs_ced3['code'];
			}  ?>
		
		<?php }
		
	?>
    </textarea>
    </td>
  </tr>
<?php } ?>
</table>
<br />	
<?php } ?>

</div><!-- box_curso_e_disciplinas -->
<?php } ?>



</div>
<?php require "rodape.php"; ?>
</body>
</html>