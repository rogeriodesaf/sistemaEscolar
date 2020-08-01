<?php $painel_atual = "Aluno";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php require "../config.php";


$sql_aluno = "SELECT * FROM estudantes WHERE code = '$code'";
$result = mysqli_query($conexao, $sql_aluno);
	while($r_aluno = mysqli_fetch_assoc($result)){
		$nome = $r_aluno['nome'];
		$serie = $r_aluno['serie'];
		$turno = $r_aluno['turno'];
		$cpf = $r_aluno['cpf'];
	}
?>
<title>Bela School - Portal do aluno</title>
<link href="css/topo.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="../js/jquery-1.7.2.min.js"></script>
<script src="../js/lightbox.js"></script>
<link href="../css/lightbox.css" rel="stylesheet" />


<link rel="stylesheet" href="../jquery.superbox.css" type="text/css" media="all" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>

	<script type="text/javascript" src="../jquery.superbox-min.js"></script>
	<script type="text/javascript">

		$(function(){

			$.superbox.settings = {

				closeTxt: "Fechar",

				loadTxt: "Carregando...",

				nextTxt: "Next",

				prevTxt: "Previous"

			};

			$.superbox();

		});

	</script>
</head>

<body>
<div id="box_topo">
 
 <div id="logo">
  <img src="../img/logo.png" width="300" />
 </div><!-- logo -->
 
 <div id="dados_aluno">
	<h1><strong><?php echo @$code; ?></strong>
    <br />
    <?php echo $cpf; ?></h1>
 </div><!-- dados_aluno -->
 
 <div id="mostra_login">
  <h1><strong>Olá :</strong> <?php echo $nome; ?> <strong><a href="../config.php?pg=sair">Sair</a></strong></h1>
 </div><!-- mostra_login -->
</div><!-- box_topo -->

<div id="box_menu">
 
 <div id="menu_topo">
  <ul>
   <li><a href="index.php">HOME</a></li>
   <li><a href="minhas_notas.php?pg=bimestrais">MINHAS NOTAS</a>
    <ul>
     <li><a href="minhas_notas.php?pg=trabalhos">Notas de Trabalhos</a></li>
     <li><a href="minhas_notas.php?pg=provas">Notas das Provas</a></li>
     <li><a href="minhas_notas.php?pg=observacao">Notas de Observação</a></li>
     <li><a href="minhas_notas.php?pg=bimestrais">Notas Bimestrais</a></li>
    </ul>
   </li>
   <li><a href="">TRABALHOS</a>
    <ul>
     <li><a href="trabalhos.php?pg=trabalhos_bimestrais">Trabalhos bimestrais</a></li>
     <li><a href="trabalhos.php?pg=trabalhos_extras">Trabalhos extras</a></li>
    </ul>
   </li>    
   <li><a href="presencas.php">FREQUENCIA ESCOLAR</a></li>
   <li><a href="setor_financeiro.php">SETOR FINANCEIRO</a></li>
   <li><a href="suporte_tecnico.php">SUPORTE TECNICO</a></li>
  </ul>
 </div><!-- menu_topo -->

</div><!-- box_menu -->
</body>
</html>