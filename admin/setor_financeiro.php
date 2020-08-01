<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Setor Financeiro</title>
<link rel="stylesheet" type="text/css" href="css/setor_financeiro.css"/>
</head>

<body>
<?php require "topo.php"; ?>

<div id="caixa_preta">
</div><!-- caixa_preta -->


<div id="box_aluno">
<h1>Setor financeiro</h1>
<?php

$d = date("d");
$m = date("m");
$a = date("Y");

?>
<table width="950" border="0">
  <tr>
    <td colspan="4"><h2><strong>Relatório de hoje</strong></h2></td>
  </tr>
  <tr>
    <td width="247"><strong>Mensalidades para hoje:</strong></td>
    <td width="262"><strong>Mensalidades pagas hoje:</strong></td>
    <td width="269"><strong>Mensalidades que aguarda pagamento:</strong></td>
    <td width="154"><strong>Valor em caixa:</strong></td>
  </tr>
  <tr>
    <td><?php echo $sql_1 = mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM mensalidades WHERE vencimento = '$d/$m/$a'")); ?></td>
    <td><?php echo $sql_2 = mysqli_num_rows(mysqli_query($conexao,"SELECT * FROM mensalidades WHERE dia_pagamento = '$d/$m/$a' AND status = 'Pagamento Confirmado'")); ?></td>
    <td><?php echo $sql_3 = mysqli_num_rows(mysqli_query($conexao,"SELECT * FROM mensalidades WHERE dia_pagamento = '$d/$m/$a' AND status = 'Aguarda Pagamento'")); ?></td>
    <td>
    <?php
    $sql_4 = mysqli_query($conexao, "SELECT SUM(valor) as soma FROM mensalidades WHERE dia_pagamento = '$d/$m/$a' AND status = 'Pagamento Confirmado'");
		while($res_4 = mysqli_fetch_assoc($sql_4)){
				echo number_format($res_4["soma"],2);
			}
	?>
    </td>
  </tr>
  <tr>
    <td><strong>Total pago em dinheiro:</strong></td>
    <td><strong>Total pago em cartão de débito:</strong></td>
    <td><strong>Total pago em cartão de crédito:</strong></td>
    <td><strong>Total pago em cheque:</strong></td>
  </tr>
  <tr>
    <td>
	<?php $sql_5 = mysqli_query($conexao, "SELECT SUM(valor) as soma FROM mensalidades WHERE dia_pagamento = '$d/$m/$a' AND status = 'Pagamento Confirmado' AND metodo_pagamento = 'Dinheiro'");
		
		echo mysqli_num_rows($sql_5);
		echo " - ";
		
			while($res_5 = mysqli_fetch_assoc($sql_5)){
					echo number_format($res_5["soma"],2);
				}
	?>  
    </td>
    <td>
	<?php $sql_6 = mysqli_query($conexao, "SELECT SUM(valor) as soma FROM mensalidades WHERE dia_pagamento = '$d/$m/$a' AND status = 'Pagamento Confirmado' AND metodo_pagamento = 'Cartão de débito'");
		
		echo mysqli_num_rows($sql_6);
		echo " - ";
		
			while($res_6 = mysqli_fetch_assoc($sql_6)){
					echo number_format($res_6["soma"],2);
				}
	?>      
    </td>
    <td>
	<?php $sql_7 = mysqli_query($conexao, "SELECT SUM(valor) as soma FROM mensalidades WHERE dia_pagamento = '$d/$m/$a' AND status = 'Pagamento Confirmado' AND metodo_pagamento = 'Cartão de crédito'");
		
		echo mysqli_num_rows($sql_7);
		echo " - ";
		
			while($res_7 = mysqli_fetch_assoc($sql_7)){
					echo number_format($res_7["soma"],2);
				}
	?>      
    </td>
    <td>
	<?php $sql_8 = mysqli_query($conexao, "SELECT SUM(valor) as soma FROM mensalidades WHERE dia_pagamento = '$d/$m/$a' AND status = 'Pagamento Confirmado' AND metodo_pagamento = 'Cheque'");
		
		echo mysqli_num_rows($sql_8);
		echo " - ";
		
			while($res_8 = mysqli_fetch_assoc($sql_8)){
					echo number_format($res_8["soma"],2);
				}
	?>      
    </td>
  </tr>
  <tr>
    <td colspan="4"><hr></td>
  </tr>
  <tr>
    <td colspan="4"><h2><strong>Relatório do mês</strong></h2></td>
  </tr>
  <tr>
    <td width="247"><strong>Mensalidades do mês:</strong></td>
    <td width="262"><strong>Mensalidades pagas no mês:</strong></td>
    <td width="269"><strong>Mensalidades que aguarda pagamento:</strong></td>
    <td width="154"><strong>Valor em caixa:</strong></td>
  </tr>
  <tr>
    <td><?php echo $sql_1 = mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM mensalidades WHERE mes = '$m' AND ano = '$a'")); ?></td>
    <td><?php echo $sql_2 = mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM mensalidades WHERE m_p = '$m' AND a_p = '$a' AND status = 'Pagamento Confirmado'")); ?></td>
    <td><?php echo $sql_3 = mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM mensalidades WHERE m_p = '$m' AND a_p = '$a' AND status = 'Aguarda Pagamento'")); ?></td>
    <td>
    <?php
    $sql_4 = mysqli_query($conexao, "SELECT SUM(valor) as soma FROM mensalidades WHERE m_p = '$m' AND a_p = '$a' AND status = 'Pagamento Confirmado'");
		while($res_4 = mysqli_fetch_assoc($sql_4)){
				echo number_format($res_4["soma"],2);
			}
	?>
    </td>
  </tr>
  <tr>
    <td><strong>Total pago em dinheiro:</strong></td>
    <td><strong>Total pago em cartão de débito:</strong></td>
    <td><strong>Total pago em cartão de crédito:</strong></td>
    <td><strong>Total pago em cheque:</strong></td>
  </tr>
  <tr>
    <td>
	<?php $sql_5 = mysqli_query($conexao, "SELECT SUM(valor) as soma FROM mensalidades WHERE m_p = '$m' AND a_p = '$a' AND status = 'Pagamento Confirmado' AND metodo_pagamento = 'Dinheiro'");
		
		echo mysqli_num_rows($sql_5);
		echo " - ";
		
			while($res_5 = mysqli_fetch_assoc($sql_5)){
					echo number_format($res_5["soma"],2);
				}
	?>  
    </td>
    <td>
	<?php $sql_6 = mysqli_query($conexao, "SELECT SUM(valor) as soma FROM mensalidades WHERE m_p = '$m' AND a_p = '$a' AND status = 'Pagamento Confirmado' AND metodo_pagamento = 'Cartão de débito'");
		
		echo mysqli_num_rows($sql_6);
		echo " - ";
		
			while($res_6 = mysqli_fetch_assoc($sql_6)){
					echo number_format($res_6["soma"],2);
				}
	?>      
    </td>
    <td>
	<?php $sql_7 = mysqli_query($conexao, "SELECT SUM(valor) as soma FROM mensalidades WHERE m_p = '$m' AND a_p = '$a' AND status = 'Pagamento Confirmado' AND metodo_pagamento = 'Cartão de crédito'");
		
		echo mysqli_num_rows($sql_7);
		echo " - ";
		
			while($res_7 = mysqli_fetch_assoc($sql_7)){
					echo number_format($res_7["soma"],2);
				}
	?>      
    </td>
    <td>
	<?php $sql_8 = mysqli_query($conexao, "SELECT SUM(valor) as soma FROM mensalidades WHERE m_p = '$m' AND a_p = '$a' AND status = 'Pagamento Confirmado' AND metodo_pagamento = 'Cheque'");
		
		echo mysqli_num_rows($sql_8);
		echo " - ";
		
			while($res_8 = mysqli_fetch_assoc($sql_8)){
					echo number_format($res_8["soma"],2);
				}
	?>      
    </td>
  </tr>
  <tr>
    <td colspan="4"><hr></td>
  </tr>
  <tr>
    <td colspan="4"><h2><strong>Relatório do ano</strong></h2></td>
  </tr>
  <tr>
    <td><strong>Mensalidades do ano:</strong></td>
    <td><strong>Mensalidades pagas no ano:</strong></td>
    <td><strong>Mensalidades que aguarda pagamento:</strong></td>
    <td><strong>Valor em caixa:</strong></td>
  </tr>
  <tr>
    <td><?php echo $sql_1 = mysqli_num_rows(mysqli_query($conexao,"SELECT * FROM mensalidades WHERE ano = '$a'")); ?></td>
    <td><?php echo $sql_2 = mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM mensalidades WHERE a_p = '$a' AND status = 'Pagamento Confirmado'")); ?></td>
    <td><?php echo $sql_3 = mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM mensalidades WHERE a_p = '$a' AND status = 'Aguarda Pagamento'")); ?></td>
    <td>
    <?php
    $sql_4 = mysqli_query($conexao, "SELECT SUM(valor) as soma FROM mensalidades WHERE a_p = '$a' AND status = 'Pagamento Confirmado'");
		while($res_4 = mysqli_fetch_assoc($sql_4)){
				echo number_format($res_4["soma"],2);
			}
	?>
    </td>
  </tr>
  <tr>
    <td><strong>Total pago em dinheiro:</strong></td>
    <td><strong>Total pago em cartão de débito:</strong></td>
    <td><strong>Total pago em cartão de crédito:</strong></td>
    <td><strong>Total pago em cheque:</strong></td>
  </tr>
  <tr>
    <td>
	<?php $sql_5 = mysqli_query($conexao, "SELECT SUM(valor) as soma FROM mensalidades WHERE a_p = '$a' AND status = 'Pagamento Confirmado' AND metodo_pagamento = 'Dinheiro'");
		
		echo mysqli_num_rows($sql_5);
		echo " - ";
		
			while($res_5 = mysqli_fetch_assoc($sql_5)){
					echo number_format($res_5["soma"],2);
				}
	?>  
    </td>
    <td>
	<?php $sql_6 = mysqli_query($conexao, "SELECT SUM(valor) as soma FROM mensalidades WHERE a_p = '$a' AND status = 'Pagamento Confirmado' AND metodo_pagamento = 'Cartão de débito'");
		
		echo mysqli_num_rows($sql_6);
		echo " - ";
		
			while($res_6 = mysqli_fetch_assoc($sql_6)){
					echo number_format($res_6["soma"],2);
				}
	?>      
    </td>
    <td>
	<?php $sql_7 = mysqli_query($conexao, "SELECT SUM(valor) as soma FROM mensalidades WHERE a_p = '$a' AND status = 'Pagamento Confirmado' AND metodo_pagamento = 'Cartão de crédito'");
		
		echo mysqli_num_rows($sql_7);
		echo " - ";
		
			while($res_7 = mysqli_fetch_assoc($sql_7)){
					echo number_format($res_7["soma"],2);
				}
	?>      
    </td>
    <td>
	<?php $sql_8 = mysqli_query($conexao, "SELECT SUM(valor) as soma FROM mensalidades WHERE a_p = '$a' AND status = 'Pagamento Confirmado' AND metodo_pagamento = 'Cheque'");
		
		echo mysqli_num_rows($sql_8);
		echo " - ";
		
			while($res_8 = mysqli_fetch_assoc($sql_8)){
					echo number_format($res_8["soma"],2);
				}
	?>      
    </td>
  </tr>
</table>
 
</div><!-- box_aluno -->

<?php require "rodape.php"; ?>
</body>
</html>