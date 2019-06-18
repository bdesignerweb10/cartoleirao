<?php 
require_once("acts/connect.php");

if($_SESSION["temporada"] == 2 && (basename($_SERVER['PHP_SELF']) != "inscricao.php" && basename($_SERVER['PHP_SELF']) != "regulamento.php"))
	header('Location: inscricao');
else {
	if ($_SESSION["user_ativado"] &&
		basename($_SERVER['PHP_SELF']) == "meus_dados.php" && 
		basename($_SERVER['PHP_SELF']) == "dados_clube.php" &&
		basename($_SERVER['PHP_SELF']) == "eventos.php" &&
		(!isset($_SESSION["usu_id"]) || empty($_SESSION["usu_id"]) || 
		!isset($_SESSION['usu_nivel']) || empty($_SESSION["usu_nivel"]) || 
		$_SESSION["usu_id"] == "0")) 
		header('Location: login?href=' . str_replace("_", "", str_replace(".php", "", basename($_SERVER['PHP_SELF']))));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<meta name="description" content="Liga Cartoleirão" />
	<meta name="keywords" content="Cartola FC, Cartoleirão, Fantasy, Game, Amigos" />
	<meta name="author" content="Bruno Gomes, Pedro Pilz"/>

	<meta name="robots" content="index, follow" />
	<meta name="googlebot" content="index, follow" />
	
	<title>Liga Cartoleirão</title>

	<link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png">
	<link rel="manifest" href="img/favicon/manifest.json">
	<link rel="mask-icon" href="img/favicon/safari-pinned-tab.svg" color="#5bbad5">
	<link rel="shortcut icon" href="img/favicon/favicon.ico">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="msapplication-config" content="img/favicon/browserconfig.xml">
	<meta name="theme-color" content="#ffffff">
	
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel='stylesheet' type="text/css" href='css/fullcalendar.min.css' />
	<link rel='stylesheet' type="text/css" href='css/fullcalendar.print.min.css' media='print' />	
	<link rel="stylesheet" type="text/css" href="css/bootstrap-toggle.min.css">
	<link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css">
	<link rel="stylesheet" type="text/css" href="css/textext.plugin.autocomplete.css">
	<link rel="stylesheet" type="text/css" href="css/lightbox.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	
</head>
<body>
	<div class="nav-header" id="nav-header">
		<nav class="navbar">
			<ul class="nav justify-content-end">
		      <li class="nav-item">
		        <a class="nav-link header-marketplace" href="#">
					<?php if ($_SESSION["mercado"] == 1) : ?>
		        		<i class="fas fa-lock-open"></i> Mercado Aberto
		        	<?php else: ?>
		        		<i class="fas fa-lock"></i> Mercado Fechado 
		        	<?php endif; ?>
		        		<span class="sr-only">(current)</span></a>
		      </li>
		      <?php 
				if($_SESSION["temporada"] == "0" || $_SESSION["temporada"] == "1" || $_SESSION["temporada"] == "1") :
					if(isset($_SESSION["usu_id"]) && !empty($_SESSION["usu_id"]) && $_SESSION["usu_id"] > 0) : ?>      
		      <li class="nav-item dropdown">
		        <a class="nav-link header-account dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		          <?php echo $_SESSION["usu_nome"] ?>
		        </a>
		        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
		          <a class="dropdown-item" href="meus-dados.php">Meus Dados</a>
		          <a class="dropdown-item" href="">Meus Torneios</a>
		          <a class="dropdown-item" href="#"><i class="fas fa-info"></i> Informações do Clube</a>
		          <div class="dropdown-divider"></div>
		          <a class="dropdown-item" id="logout" href="#"><i class="fas fa-sign-out-alt"></i> Sair</a>
		        </div>
		      </li>
		      <?php else: ?> 
		      	<a class="nav-link header-account" href="login.php"  role="button">
		          Entrar
		        </a> 
		        <?php endif;
				endif; ?>   
		    </ul>
		</nav>
	</div><!-- nav-header-->	
	<header class="header">	
		<div class="row">
			<div class="header-logo">
				<img class="img-fluid" src="img/Logo-Cartoleirao.png">
			</div>
		</div>

		<div class="header-menu" id="header">
			<nav class="navbar navbar-expand-lg navbar-light ">
			<a class="navbar-brand" href="#"></a>
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
			    <span class="navbar-toggler-icon"></span>
			  </button>			  
			  <div class="collapse navbar-collapse" id="navbarNavDropdown">
			    <ul class="navbar-nav">
			      <li class="nav-item">
			        <a class="nav-link" href="index.php">Inicio <span class="sr-only">(current)</span></a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="tabela-cts.php">Tabela Liga CTS</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="brasileirao.php">Tabela Brasileirão</a>
			      </li>			      
			      <li class="nav-item">
			        <a class="nav-link" href="clubes-liga.php">Clubes da liga</a>
			      </li>
			      <li class="nav-item dropdown">
			        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          Desempenho de clubes
			        </a>
			        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			          <a class="dropdown-item" href="destaques-rodada.php">Destaques da rodada</a>
			          <a class="dropdown-item" href="mensal.php">Pontuação mensal</a>
			          <a class="dropdown-item" href="desempenho-grafico.php">Gráfico de desempenho</a>
			        </div>
			      </li>	
			      <!--<li class="nav-item">
			        <a class="nav-link nav-subscription" href="#">Inscrição</a>
			      </li>-->		      
			      <li class="nav-item">
			        <a class="nav-link" href="regulamentos.php">Regulamentos</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="patrocinadores.php">Patrocinadores</a>
			      </li>

			      <!-- as opções abaixo, só deverá aparecer no menu, quando o mercado estiver FECHADO -->
			      <!--<li class="nav-item">
			        <a class="nav-link" href="tempo-real.php">Tempo Real</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="scouts.php">Scouts</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="#">Copa em Tempo Real</a>
			      </li>-->

			      <!-- Aqui deve exibir também a tabela do BR + o Regulamento -->
			    </ul>
			  </div>
			</nav>
		</div><!-- header-menu -->
		<div class="row">
			<div class="col-sm-6">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
				    <li class="breadcrumb-item"><a href="#">Desempenho de Clubes</a></li>
				    <li class="breadcrumb-item active" aria-current="page">Pontuação Mensal</li>
				  </ol>
				</nav>
			</div>			
			<div class="col-sm-4 current-round">
				<h6>Rodada Atual: <strong><?php echo $_SESSION["rod_atual"]; ?>º Rodada<strong></h6>
			</div>		
		</div>
		
		<!-- Exibir somente quando algum jogo não for valer para o Cartola FC -->	
		<div class="row">
			<div class="col-sm-10">
				<div class="alert alert-danger" role="alert">
				  <h4 class="alert-heading">Atenção</h4>
				  <p>O Jogo Corinthians x Santos não será válido para o Cartola FC</p>
				</div>
			</div>
		</div>		
	</header>

