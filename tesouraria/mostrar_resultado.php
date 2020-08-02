﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Detalhes da Busca</title>
<link rel="stylesheet" type="text/css" href="css/mostrar_resultado.css"/>
 <?php require "../conexao.php"; ?>
</head>

<body>

<div id="box">
<?php if(@$_GET['s'] == 'funcionario'){ ?>
  <?php 
  $q = $_GET['q'];
  $sql_1 = mysqli_query($conexao, "SELECT * FROM  funcionarios WHERE code = '$q'");
  while($res_1 = mysqli_fetch_assoc($sql_1)){
    ?>
  
  <table width="750" border="0">
  <tr>
    <td colspan="3"><h1>Informações sobre este funcionário</h1></td>
  </tr>
  <tr>
    <td><strong>Nome:</strong></td>
    <td><strong>CPF</strong></td>
    <td><strong>Data de nascimento:</strong></td>
  </tr>
  <tr>
    <td><?php echo $res_1['nome']; ?></td>
     <td><?php echo $res_1['cpf']; ?></td>
    <td><?php echo $res_1['nascimento'];?></td>
  </tr>
  
    <td>&nbsp;</td>
  
</table>
  
  
  <?php } ?>
<?php if(@$_GET['s'] == 'professor'){ ?>
<?php
$q = $_GET['q'];
$sql_1 = mysqli_query($conexao, "SELECT * FROM professores WHERE code = '$q' ");
	while($res_1 = mysqli_fetch_assoc($sql_1)){
?>
<table width="750" border="0">
  <tr>
    <td colspan="3"><h1>Informações sobre este professor</h1></td>
  </tr>
  <tr>
    <td><strong>Nome:</strong></td>
    <td><strong>Salário</strong></td>
    <td><strong>CPF:</strong></td>
  </tr>
  <tr>
    <td><?php echo $res_1['nome']; ?></td>
    <td>R$ <?php echo number_format($res_1['salario'],2); ?></td>
    <td><?php echo $res_1['cpf']; ?></td>
  </tr>
  <tr>
    <td><strong>Formação</strong>:</td>
    <td><strong>Graduação:</strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo $res_1['formacao']; ?></td>
    <td><?php echo $res_1['graduacao']; ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Pos-graduação:</strong></td>
    <td><strong>Mestrado:</strong></td>
    <td><strong>Doutorado:</strong></td>
  </tr>
  <tr>
    <td><?php echo $res_1['pos_graduacao']; ?></td>
    <td><?php echo $res_1['mestrado']; ?></td>
    <td><?php echo $res_1['doutorado']; ?></td>
  </tr>
</table>
<?php } ?>
<?php
$sql_2 = mysqli_query($conexao, "SELECT * FROM disciplinas WHERE professor = '$q'");
?>
<table width="750" border="0">
  <tr>
    <td colspan="2"><h1>Informações acadêmicas</h1></td>
  </tr>
  <tr>
    <td width="404"><strong>Status: </strong> <?php echo $_GET['status']; ?></td>
    <td width="330">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Disciplinas ministradas:</strong></td>
    <td><strong>Curso</strong></td>
  </tr>
  <?php while($res_2 = mysqli_fetch_assoc($sql_2)){ ?>
  <tr>
    <td><?php echo $res_2['disciplina']; ?></td>
    <td><?php echo $res_2['curso']; ?></td>
  </tr>
 <?php } ?> 
</table>

<?php

$sql_3 = mysqli_query($conexao, "SELECT * FROM fluxo_de_caixa WHERE codigo = '$q'");
if(mysqli_num_rows($sql_3) == ''){
	echo "<h3>Não foi encontrado nenhum pagamento.</h3>";
}else{
?>

<table width="750" border="0">
  <tr>
    <td colspan="3"><h1>Histórico de pagamento</h1></td>
  </tr>
  <tr>
    <td><strong>Data de pagamento:</strong></td>
    <td><strong>Descrição:</strong></td>
    <td><strong>Forma de pagamento:</strong></td>
  </tr>
  <?php while($res_3 = mysqli_fetch_assoc($sql_3)){ ?>
  <tr>
    <td><?php echo $res_3['date']; ?></td>
    <td><?php echo $res_3['descricao']; ?></td>
    <td><?php echo $res_3['form_pag']; ?></td>
  </tr>
  <?php } ?>
</table>
<?php } ?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php } ?>


<?php if($_GET['s'] == 'aluno'){ ?>
<?php
$q = $_GET['q'];
$sql_1 = mysqli_query($conexao, "SELECT * FROM estudantes WHERE code = '$q'");
	while($res_1 = mysqli_fetch_assoc($sql_1)){
?>
<table width="750" border="0">
  <tr>
    <td colspan="3"><h1>Informações Gerais</h1></td>
  </tr>
  <tr>
    <td><strong>Nome:</strong></td>
    <td><strong>CPF:</strong></td>
    <td><strong>RG:</strong></td>
  </tr>
  <tr>
    <td><?php echo $res_1['nome']; ?></td>
    <td><?php echo $res_1['cpf']; ?></td>
    <td><?php echo $res_1['rg']; ?></td>
  </tr>
  <tr>
    <td><strong>Nascimento:</strong></td>
    <td><strong>Mãe:</strong></td>
    <td><strong>Pai:</strong></td>
  </tr>
  <tr>
    <td><?php echo $res_1['nascimento']; ?></td>
    <td><?php echo $res_1['mae']; ?></td>
    <td><?php echo $res_1['pai']; ?></td>
  </tr>
  <tr>
    <td><strong>Estado:</strong></td>
    <td><strong>Cidade:</strong></td>
    <td><strong>Bairro:</strong></td>
  </tr>
  <tr>
    <td><?php echo $res_1['estado']; ?></td>
    <td><?php echo $res_1['cidade']; ?></td>
    <td><?php echo $res_1['bairro']; ?></td>
  </tr>
  <tr>
    <td><strong>Endereço:</strong></td>
    <td><strong>Complemento:</strong></td>
    <td><strong>Cep:</strong></td>
  </tr>
  <tr>
    <td><?php echo $res_1['endereco']; ?></td>
    <td><?php echo $res_1['complemento']; ?></td>
    <td><?php echo $res_1['cep']; ?></td>
  </tr>
  <tr>
    <td><strong>Telefone Residêncial:</strong></td>
    <td><strong>Celular:</strong></td>
    <td><strong>Telefone do amigo:</strong></td>
  </tr>
  <tr>
    <td><?php echo $res_1['tel_residencial']; ?></td>
    <td><?php echo $res_1['celular']; ?></td>
    <td><?php echo $res_1['tel_amigo']; ?></td>
  </tr>
  <tr>
    <td><strong>Série:</strong></td>
    <td><strong>Turno:</strong></td>
    <td><strong>Atendimento Especial:</strong></td>
  </tr>
  <tr>
    <td><?php echo $res_1['serie']; ?></td>
    <td><?php echo $res_1['turno']; ?></td>
    <td><?php echo $res_1['atendimento_especial']; ?></td>
  </tr>
  <tr>
    <td><strong>Mensalidade:</strong></td>
    <td><strong>Dia de vencimento:</strong></td>
    <td><strong>Telefone de cobrança:</strong></td>
  </tr>
  <tr>
    <td><?php echo $res_1['mensalidade']; ?></td>
    <td><?php echo $res_1['vencimento']; ?></td>
    <td><?php echo $res_1['tel_cobranca']; ?></td>
  </tr>
  <tr>
    <td><strong>OBS:</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><?php echo $res_1['obs']; ?></td>
  </tr>
</table>
<?php } ?>


<table width="750" border="0">
  <tr>
    <td colspan="5"><h1>Informações acadêmicas</h1></td>
  </tr>
  <tr>
    <td width="248"><strong>Presenças:</strong> <?php echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM chamadas_em_sala WHERE code_aluno = '$q' AND presente = 'SIM' ")); ?></td>
    <td colspan="2"><strong>Faltas:</strong>  <?php echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM chamadas_em_sala WHERE code_aluno = '$q' AND presente = 'NÃO' ")); ?></td>
    <td colspan="2"><strong>Faltas justificadas:</strong>  <?php echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM chamadas_em_sala WHERE code_aluno = '$q' AND presente = 'JUSTIFICADA' ")); ?></td>
  </tr>
  <tr>
    <td>
    <?php
    $sql_2 = mysqli_query($conexao, "SELECT * FROM chamadas_em_sala WHERE code_aluno = '$q' AND presente = 'SIM'");
		while($res_2 = mysqli_fetch_assoc($sql_2)){
				echo $res_2['date_day'];
				echo " - ";
				echo $res_2['disciplina'];		
				echo "<br>";		
					
			}
	?>
    </td>
    <td colspan="2">
    <?php
    $sql_3 = mysqli_query($conexao, "SELECT * FROM chamadas_em_sala WHERE code_aluno = '$q' AND presente = 'NÃO'");
		while($res_3 = mysqli_fetch_assoc($sql_3)){
				echo $res_3['date_day'];
				echo " - ";
				echo $res_3['disciplina'];	
				echo "<br>";		
			}
	?>    
    </td>
    <td colspan="2">
    <?php
    $sql_3 = mysqli_query($conexao, "SELECT * FROM chamadas_em_sala WHERE code_aluno = '$q' AND presente = 'JUSTIFICADA'");
		while($res_3 = mysqli_fetch_assoc($sql_3)){
				echo $res_3['date_day'];
				echo " - ";
				echo $res_3['disciplina'];	
				echo "<br>";		
			}
	?>      
    </td>
  </tr>
  <tr>
    <td colspan="5"><hr></td>
  </tr>
  <tr>
    <td colspan="5"><h2><strong>Notas dos trabalhos bimestrais</strong></h2></td>
  </tr>
  <tr>
    <td><strong>Disciplina:</strong></td>
    <td width="119"><strong>1º Bimestre</strong></td>
    <td width="119"><strong>2º Bimestre</strong></td>
    <td width="119"><strong>3º Bimestre</strong></td>
    <td width="119"><strong>4º Bimestre</strong></td>
  </tr>
 <?php
 $curso = $_GET['curso'];
 $sql_3 = mysqli_query($conexao, "SELECT * FROM disciplinas WHERE curso = '$curso'");
 	while($res_3 = mysqli_fetch_assoc($sql_3)){
		$disciplina = $res_3['disciplina'];
 ?> 
  <tr>
    <td><?php echo $res_3['disciplina']; ?></td>
    <td>
    <?php
     $sql_4 = mysqli_query($conexao, "SELECT * FROM notas_trabalhos WHERE bimestre = '1' AND disciplina = '$disciplina' AND code = '$q'");			
	 
	 	while($res_4 = mysqli_fetch_assoc($sql_4)){
				echo $res_4['nota'];
			}
	 
	?>
    </td>
    <td>
    <?php
     $sql_4 = mysqli_query($conexao, "SELECT * FROM notas_trabalhos WHERE bimestre = '2' AND disciplina = '$disciplina' AND code = '$q'");			
	 
	 	while($res_4 = mysqli_fetch_assoc($sql_4)){
				echo $res_4['nota'];
			}
	 
	?>    
    </td>
    <td>
    <?php
     $sql_4 = mysqli_query($conexao, "SELECT * FROM notas_trabalhos WHERE bimestre = '3' AND disciplina = '$disciplina' AND code = '$q'");			
	 
	 	while($res_4 = mysqli_fetch_assoc($sql_4)){
				echo $res_4['nota'];
			}
	 
	?>    
    </td>
    <td>
    <?php
     $sql_4 = mysqli_query($conexao, "SELECT * FROM notas_trabalhos WHERE bimestre = '4' AND disciplina = '$disciplina' AND code = '$q'");			
	 
	 	while($res_4 = mysqli_fetch_assoc($sql_4)){
				echo $res_4['nota'];
			}
	 
	?>    
    </td>
  </tr>
  <tr>
    <td colspan="5"><hr></td>
  </tr>`
  <?php } ?>
  <tr>
    <td colspan="5"><h2><strong>Notas de trabalhos extras</strong></h2></td>
  </tr>
 <?php
 $curso = $_GET['curso'];
 $sql_3 = mysqli_query($conexao, "SELECT * FROM disciplinas WHERE curso = '$curso'");

 ?>  
  <tr>
    <td><strong>Disciplina:</strong></td>
    <td colspan="4"><strong>Pontos</strong></td>
  </tr>
 <?php  	while($res_3 = mysqli_fetch_assoc($sql_3)){
		$disciplina = $res_3['disciplina'];
 ?> 
  <tr>
    <td><?php echo $res_3['disciplina']; ?></td>
    <td colspan="4">
    <?php
     $sql_4 = mysqli_query($conexao, "SELECT * FROM pontos_extras WHERE disciplina = '$disciplina' AND code = '$q'");			
	 
	 	while($res_4 = mysqli_fetch_assoc($sql_4)){
				echo $res_4['nota'];
			}
	 
	?>       
    </td>
  </tr>
  <tr>
    <td colspan="5"><hr></td>
  </tr>
<?php } ?>  
  <tr>
    <td colspan="5"><h2><strong>Notas das provas</strong></h2></td>
  </tr>
  <tr>
    <td><strong>Disciplina:</strong></td>
    <td><strong>1º Bimestre</strong></td>
    <td><strong>2º Bimestre</strong></td>
    <td><strong>3º Bimestre</strong></td>
    <td><strong>4º Bimestre</strong></td>
  </tr>
 <?php
 $curso = $_GET['curso'];
 $sql_3 = mysqli_query($conexao, "SELECT * FROM disciplinas WHERE curso = '$curso'");
 	while($res_3 = mysqli_fetch_assoc($sql_3)){
		$disciplina = $res_3['disciplina'];
 ?> 
  <tr>
    <td><?php echo $res_3['disciplina']; ?></td>
    <td>
    <?php
     $sql_4 = mysqli_query($conexao, "SELECT * FROM notas_provas WHERE bimestre = '1' AND disciplina = '$disciplina' AND code = '$q'");			
	 
	 	while($res_4 = mysqli_fetch_assoc($sql_4)){
				echo $res_4['nota'];
			}
	 
	?>
    </td>
    <td>
    <?php
     $sql_4 = mysqli_query($conexao, "SELECT * FROM notas_provas WHERE bimestre = '2' AND disciplina = '$disciplina' AND code = '$q'");			
	 
	 	while($res_4 = mysqli_fetch_assoc($sql_4)){
				echo $res_4['nota'];
			}
	 
	?>    
    </td>
    <td>
    <?php
     $sql_4 = mysqli_query($conexao, "SELECT * FROM notas_provas WHERE bimestre = '3' AND disciplina = '$disciplina' AND code = '$q'");			
	 
	 	while($res_4 = mysqli_fetch_assoc($sql_4)){
				echo $res_4['nota'];
			}
	 
	?>    
    </td>
    <td>
    <?php
     $sql_4 = mysqli_query($conexao, "SELECT * FROM notas_provas WHERE bimestre = '4' AND disciplina = '$disciplina' AND code = '$q'");			
	 
	 	while($res_4 = mysqli_fetch_assoc($sql_4)){
				echo $res_4['nota'];
			}
	 
	?>    
    </td>
  </tr>
  <tr>
    <td colspan="5"><hr></td>
  </tr>`
  <?php } ?>
  <tr>
    <td colspan="5"><h2><strong>Notas de observação</strong></h2></td>
  </tr>
  <tr>
    <td><strong>Disciplina:</strong></td>
    <td><strong>1º Bimestre</strong></td>
    <td><strong>2º Bimestre</strong></td>
    <td><strong>3º Bimestre</strong></td>
    <td><strong>4º Bimestre</strong></td>
  </tr>
 <?php
 $curso = $_GET['curso'];
 $sql_3 = mysqli_query($conexao, "SELECT * FROM disciplinas WHERE curso = '$curso'");
 	while($res_3 = mysqli_fetch_assoc($sql_3)){
		$disciplina = $res_3['disciplina'];
 ?> 
  <tr>
    <td><?php echo $res_3['disciplina']; ?></td>
    <td>
    <?php
     $sql_4 = mysqli_query($conexao, "SELECT * FROM notas_observacao WHERE bimestre = '1' AND disciplina = '$disciplina' AND code = '$q'");			
	 
	 	while($res_4 = mysqli_fetch_assoc($sql_4)){
				echo $res_4['nota'];
			}
	 
	?>
    </td>
    <td>
    <?php
     $sql_4 = mysqli_query($conexao, "SELECT * FROM notas_observacao WHERE bimestre = '2' AND disciplina = '$disciplina' AND code = '$q'");			
	 
	 	while($res_4 = mysqli_fetch_assoc($sql_4)){
				echo $res_4['nota'];
			}
	 
	?>    
    </td>
    <td>
    <?php
     $sql_4 = mysqli_query($conexao, "SELECT * FROM notas_observacao WHERE bimestre = '3' AND disciplina = '$disciplina' AND code = '$q'");			
	 
	 	while($res_4 = mysqli_fetch_assoc($sql_4)){
				echo $res_4['nota'];
			}
	 
	?>    
    </td>
    <td>
    <?php
     $sql_4 = mysqli_query($conexao, "SELECT * FROM notas_observacao WHERE bimestre = '4' AND disciplina = '$disciplina' AND code = '$q'");			
	 
	 	while($res_4 = mysqli_fetch_assoc($sql_4)){
				echo $res_4['nota'];
			}
	 
	?>    
    </td>
  </tr>
  <tr>
    <td colspan="5"><hr></td>
  </tr>`
  <?php } ?>
  <tr>
    <td colspan="5"><h2><strong>Notas bimestrais</strong></h2></td>
  </tr>
  <tr>
    <td><strong>Disciplina:</strong></td>
    <td><strong>1º Bimestre</strong></td>
    <td><strong>2º Bimestre</strong></td>
    <td><strong>3º Bimestre</strong></td>
    <td><strong>4º Bimestre</strong></td>
  </tr>
 <?php
 $curso = $_GET['curso'];
 $sql_3 = mysqli_query($conexao, "SELECT * FROM disciplinas WHERE curso = '$curso'");
 	while($res_3 = mysqli_fetch_assoc($sql_3)){
		$disciplina = $res_3['disciplina'];
 ?> 
  <tr>
    <td><?php echo $res_3['disciplina']; ?></td>
    <td>
    <?php
     $sql_4 = mysqli_query($conexao, "SELECT * FROM notas_bimestrais WHERE bimestre = '1' AND disciplina = '$disciplina' AND code = '$q'");			
	 
	 	while($res_4 = mysqli_fetch_assoc($sql_4)){
				echo $res_4['nota'];
			}
	 
	?>
    </td>
    <td>
    <?php
     $sql_4 = mysqli_query($conexao, "SELECT * FROM notas_bimestrais WHERE bimestre = '2' AND disciplina = '$disciplina' AND code = '$q'");			
	 
	 	while($res_4 = mysqli_fetch_assoc($sql_4)){
				echo $res_4['nota'];
			}
	 
	?>    
    </td>
    <td>
    <?php
     $sql_4 = mysqli_query($conexao, "SELECT * FROM notas_bimestrais WHERE bimestre = '3' AND disciplina = '$disciplina' AND code = '$q'");			
	 
	 	while($res_4 = mysqli_fetch_assoc($sql_4)){
				echo $res_4['nota'];
			}
	 
	?>    
    </td>
    <td>
    <?php
     $sql_4 = mysqli_query($conexao, "SELECT * FROM notas_bimestrais WHERE bimestre = '4' AND disciplina = '$disciplina' AND code = '$q'");			
	 
	 	while($res_4 = mysqli_fetch_assoc($sql_4)){
				echo $res_4['nota'];
			}
	 
	?>    
    </td>
  </tr>
  <tr>
    <td colspan="5"><hr></td>
  </tr>`
  <?php } ?>
  <tr>
    <td colspan="5">&nbsp;</td>
  </tr>
</table>

<table width="750" border="0">
  <tr>
    <td colspan="5"><h1>Informações financeiras</h1></td>
  </tr>
  <tr>
    <td width="141"><strong>Código da cobrança:</strong></td>
    <td width="133"><strong>Status:</strong></td>
    <td width="120"><strong>Valor:</strong></td>
    <td width="185"><strong>Data de pagamento</strong></td>
    <td width="137"><strong>Forma de pagamento</strong></td>
  </tr>
<?php
$sql_5 = mysqli_query($conexao, "SELECT * FROM mensalidades WHERE matricula = '$q'");
	while($res_5 = mysqli_fetch_assoc($sql_5)){
?>  
  <tr>
    <td><?php echo $res_5['code']; ?></td>
    <td><?php echo $res_5['status']; ?></td>
    <td>R$ <?php echo number_format($res_5['valor'],2); ?></td>
    <td><?php echo $res_5['data_pagamento']; ?></td>
    <td><?php echo $res_5['metodo_pagamento']; ?></td>
  </tr>
  <tr>
   <td colspan="5"><hr /></td>
  </tr>
<?php } ?>  
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>

<?php } ?>


<?php if($_GET['s'] == 'cobranca'){ ?>

<?php
$q = $_GET['q'];
$sql_1 = mysqli_query($conexao, "SELECT * FROM mensalidades WHERE code = '$q'");
	while($res_1 = mysqli_fetch_assoc($sql_1)){
	$matricula =  $res_1['matricula'];
$sql_2 = mysqli_query($conexao, "SELECT * FROM estudantes WHERE code = '$matricula'");	
	while($res_2 = mysqli_fetch_assoc($sql_2)){	

?>
 <table width="950" border="0">
  <tr>
    <td colspan="4"><hr /></td>
  </tr>
  <tr>
    <td><strong>Número de matricula:</strong></td>
    <td><strong>Nome do aluno:</strong></td>
    <td><strong>Vencimento:</strong></td>
  </tr>
  <tr>
    <td><?php echo $matricula; ?></td>
    <td><?php echo $res_2['nome']; ?></td>
    <td><?php echo $res_1['vencimento']; ?></td>
  </tr>
  <tr>
    <td><strong>Valor:</strong></td>
    <td><strong>Status:</strong></td>
    <td><strong>Data do pagamento:</strong></td>
  </tr>
  <tr>
    <td>R$ <?php echo number_format($res_1['valor'],2); ?></td>
    <td><?php echo $res_1['status']; ?></td>
    <td><?php echo $res_1['data_pagamento']; ?></td>
  </tr>
  <tr>
    <td><strong>CPF:</strong></td>
    <td><strong>Curso:</strong></td>
  </tr>
  <tr>
    <td><?php echo $res_2['cpf']; ?></td>
    <td><?php echo $res_2['serie']; ?></td>
  </tr>
  <tr>
    <td><strong>Forma de pagamento:</strong></td>
    <td><?php echo $res_1['metodo_pagamento']; ?></td>
  </tr>
  <tr>
    <td colspan="4"><hr /></td>
  </tr>
</table>
<?php }} ?>





  
</div><!--box  -->

</body>
</html>