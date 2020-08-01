<?php $painel_atual = "professor"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Painél do Professor</title>
<link rel="stylesheet" type="text/css" href="css/index.css"/>
</head>

<body>

<?php require "topo.php"; ?>

<div id="caixa_preta">
</div><!-- caixa_preta -->

<div id="box">
 <div id="relatorios">
   <ul>
    <h1><strong>Turmas & Alunos</strong></h1>
    <li><strong>Disciplinas ministradas por você: </strong> <?php echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM disciplinas WHERE professor = '$code'")); ?></li>
    <li><strong>Você minista aula para
    
    <?php
    
  $sql_1 = mysqli_query($conexao, "SELECT * FROM disciplinas WHERE professor = '$code'");
  $total_alunos = 0;
		while($res_1 = mysqli_fetch_assoc($sql_1)){
			
      $curso = $res_1['curso'];
      
      //TRAZER DA FORMA CORRETA O TOTAL DE ALUNOS DE CADA PROFESSOR
   $result_tot_alunos = mysqli_query($conexao, "SELECT * FROM estudantes WHERE serie = '$curso'");
   $linhas_tot_alunos = mysqli_num_rows($result_tot_alunos);
   
   $total_alunos = $total_alunos + $linhas_tot_alunos;

			
    }
    
    echo $total_alunos;
	
	?>
    
    alunos. </strong></li>
   </ul>
   
   <ul>
    <h1><strong>Informações de acesso</strong> </h1>
    <li><strong>Seu código de acesso:</strong> <?php echo $code; ?></li>
    <li><strong>Senha:</strong>***** <a rel="superbox[iframe][285x100]" href="altera_senha.php?code=<?php echo $code; ?>">Alterar</a></li>
   </ul> 
   
   <ul>
    <h1><strong>Suporte Tecnico</strong></h1>
    <li><strong>Mensagens aguardando resposta:</strong> <?php echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM central_mensagem WHERE receptor = '$code' AND status = 'Aguarda resposta'")); ?></li>
    <li><strong>Mensagens respondidas:</strong>  <?php echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM central_mensagem WHERE receptor = '$code' AND status = 'Respondida'")); ?></li>
    <li><strong>Todas as mensagens:</strong>  <?php echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM central_mensagem WHERE receptor = '$code'")); ?></li>
   </ul> 
 </div><!-- relatorios -->
 
 <div id="notificacoes">
  <h1>Notificações</h1>
  <div id="avisos_notificacoes">
     <ul>
   <?php
   $sql_1 = mysqli_query($conexao, "SELECT * FROM central_mensagem WHERE receptor = '$code'");
   if(mysqli_num_rows($sql_1) == ''){
	   echo "No momento você não tem mensagens";
   }else{
   	while($res_1 = mysqli_fetch_assoc($sql_1)){
   ?>
    <li><h1>Nova Mensagem - <?php echo $res_1['mensagem']; ?></h1></li>
    <?php }} ?>
   </ul>
  </div><!-- avisos_notificacoes -->
 </div><!-- notificacoes -->
 
 
</div><!-- box -->

<?php require "rodape.php"; ?>
</body>
</html>