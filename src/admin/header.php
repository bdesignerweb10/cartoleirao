<?php
	require_once("../acts/connect.php");
if (!isset($_SESSION["usu_id"]) || empty($_SESSION["usu_id"]) || 
	!isset($_SESSION['usu_nivel']) || empty($_SESSION["usu_nivel"]) ||
	$_SESSION['usu_nivel'] == "3" || $_SESSION["usu_id"] == "0") header('Location: ./');
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
	
	<title>Painel Cartoleirão</title>

	<link rel="apple-touch-icon" sizes="180x180" href="../img/favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="../img/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="../img/favicon/favicon-16x16.png">
	<link rel="manifest" href="../img/favicon/manifest.json">
	<link rel="mask-icon" href="../img/favicon/safari-pinned-tab.svg" color="#5bbad5">
	<link rel="shortcut icon" href="../img/favicon/favicon.ico">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="msapplication-config" content="../img/favicon/browserconfig.xml">
	<meta name="theme-color" content="#ffffff">
	
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/style.css">		
	<link rel="stylesheet" type="text/css" href="css/bootstrap-toggle.min.css">
	<link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css">
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	
</head>
<body>
	<header class="header">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
		  <a class="navbar-brand" href="#"><img src="../img/Logo-Cartoleirao.png" width="40"></a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav mr-auto">
		      <li class="nav-item active">
		        <a class="nav-link" href="home.php">Inicio <span class="sr-only">(current)</span></a>
		      </li>      
		      <li class="nav-item dropdown">
		        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		          Competições
		        </a>
		        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
		          <a class="dropdown-item" href="ger-temporadas.php">Gerenciar Temporadas</a>
		          <a class="dropdown-item" href="ger-campeonatos.php">Gerenciar Campeonatos</a>          
		        </div>
		      </li>
		      <li class="nav-item dropdown">
		        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		          Usuários / Clubes
		        </a>
		        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
		          <a class="dropdown-item" href="ger-usuarios.php">Gerenciar Usuários</a>
		          <a class="dropdown-item" href="ger-clubes.php">Gerenciar Clubes</a>          
		        </div>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="recados.php">Recados</a>
		      </li>
		      <li class="nav-item dropdown">
		        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		          Inscrições
		        </a>
		        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
		          <a class="dropdown-item" href="ger-inscricao.php">Gerenciar Inscrições do Cartoleirão</a>
		          <a class="dropdown-item" href="#">Gerenciar Inscrições da Copa Kempes VI</a> 
		          <a class="dropdown-item" href="#">Gerenciar Inscrições da Copa Kempes VII</a> 
		          <a class="dropdown-item" href="#">Gerenciar Inscrições da Copa Segunda Pele II</a> 
		          <a class="dropdown-item" href="#">Gerenciar Inscrições da Copa Segunda Pele II</a>          
		        </div>
		      </li>      
		      <li class="nav-item">
		        <a class="nav-link" href="patrocinadores.php">Patrocinador</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Pontuação</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="configuracoes.php">Configurações</a>
		      </li>
		    </ul>
		    <ul class="navbar-nav mr-auto">
		    	<li class="nav-item">
		        	<a class="nav-link" href="#"><i class="far fa-bell"><span class="badge bd-not badge-secondary">4</span></i></a>
		      	</li>
		    	<li class="nav-item dropdown">
		        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		          <?php echo $_SESSION["usu_nome"] ?>
		        </a>
		        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
		          <a class="dropdown-item" href="#">Meus dados</a>
		          <a class="dropdown-item" id="logout" href="#">Sair</a>
		        </div>
		      </li>
		    </ul>
		  </div>
		</nav>
	</header>