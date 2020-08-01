<?php $painel_atual = "admin"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/index.css"/>
<title>Painél da Administração</title>

</head>

<body>
<?php require "topo.php"; ?>

<div id="caixa_preta">
</div><!-- caixa_preta -->

<div id="box">
 <div id="relatorios">
 <?php
 
 $d = date("d");
 $m = date("m");
 $y = date("Y");
 
 ?>
   <ul>
    <h1><strong>Cursos e Disciplinas</strong></h1>
    <li><strong>Total de cursos cadastradas:</strong> <?php echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM cursos")); ?>  </li>
    <li><strong>Total de disciplinas cadastradas:</strong> <?php echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM disciplinas")); ?>  </li>
   </ul>
   
   <ul>
    <h1><strong>Professores</strong></h1>
    <li><strong>Professores Ativos:</strong> <?php echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM professores WHERE status = 'Ativo'")); ?></li>
    <li><strong>Professores Inativos:</strong> <?php echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM professores WHERE status = 'Inativo'")); ?></li>
   </ul> 
   
   <ul>
    <h1><strong>Estudantes</strong></h1>
    <li><strong>Estudantes Ativos:</strong> <?php echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM estudantes WHERE status = 'Ativo'")); ?></li>
    <li><strong>Estudantes Inativos:</strong> <?php echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM estudantes WHERE status = 'Inativo'")); ?></li>
   </ul> 
   
   <ul>
    <h1><strong>Setor Financeiro</strong></h1>
    <li><strong>Cobranças geradas este mês:</strong> <?php echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM mensalidades WHERE mes = '$m' AND ano = '$y'")); ?></li>
    <li><strong>Cobranças pagas:</strong>  <?php echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM mensalidades WHERE mes = '$m' AND ano = '$y' AND status = 'Pagamento Confirmado'")); ?></li>
    <li><strong>Cobranças não pagas:</strong> <?php echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM mensalidades WHERE mes = '$m' AND ano = '$y' AND status = 'Aguarda Pagamento'")); ?></li>
   </ul>  
   
   <ul>
    <h1><strong>Suporte Técnico</strong></h1>
    <li><strong>Contatos que aguarda resposta:</strong> <?php echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM central_mensagem WHERE status = 'Aguarda resposta'")); ?></li>
    <li><strong>Contatos respondidos:</strong><?php echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM central_mensagem WHERE status = 'Respondido'")); ?></li>
    <li><strong>Total de contatos:</strong> <?php echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM central_mensagem")); ?></li>
   </ul>        
 </div><!-- relatorios -->
 
 
 <div id="notificacoes">
  <h1>Notificações</h1>
  <div id="avisos_notificacoes">
   <ul>
   <?php
   $sql_1 = mysqli_query($conexao, "SELECT * FROM mural_coordenacao ORDER BY id DESC");
   if($sql_1 == ''){
	   echo "No momento não existe novidades";
   }else{
	   while($res_1 = mysqli_fetch_assoc($sql_1)){
   ?>
    <li><h1><?php echo $res_1['titulo']; ?></h1></li>
    <?php }} ?>
   </ul>
  </div><!-- avisos_notificacoes -->
 </div><!-- notificacoes -->
 
 
</div><!-- box -->


<?php require "rodape.php"; ?>
</body>
</html>