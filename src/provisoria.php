<?php
ob_start();
if (!isset($_SESSION)) session_start(); 
if (!isset($_SESSION["prov_id"]) || empty($_SESSION["prov_id"]) || 
	!isset($_SESSION['prov_login']) || empty($_SESSION["prov_login"]) || 
	$_SESSION["prov_id"] == "0") header('Location: login');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<meta name="description" content="Acompanhe seu time na liga Cartoleirão e seque bastante todos seus colegas" />
	<meta name="keywords" content="cartola, fc, globo, cartoleirao, futebol, brasileirão, serie, a" />
	<meta name="author" content="Pedro Pilz, Bruno Gomes"/>

	<meta name="robots" content="index, follow" />
	<meta name="googlebot" content="index, follow" />

	<title>Alteração de Senha | Cartoleirão</title>

	<link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<main>
		<div class="container-fluid">
			<div class="row justify-content-md-center">
				<div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 login-box">
					<div class="login-header">						
						<span class="head-login">Criação de senha definitiva</span>
					</div>
					<form id="form-provisoria" data-toggle="validator">
			  			<div class="form-group">		    			
							<label for="login">Usuário</label>
			    			<input type="text" class="form-control form-control-lg" id="login" name="login" aria-describedby="login" value="<?php echo $_SESSION['prov_login']; ?>" disabled>
			    			<div class="help-block with-errors"></div>
			    		</div>
						<div class="form-group">
							<label for="senha_antiga">Senha Enviada no E-Mail</label>
							<input type="password" class="form-control form-control-lg" id="senha_antiga" name="senha_antiga" placeholder="Digite sua senha antiga..." data-error="Por favor, informe a senha antiga." maxlength="120" required>
						</div>
						<div class="form-group">
							<label for="senha">Nova senha</label>
							<input type="password" class="form-control form-control-lg" id="senha" name="senha" placeholder="Digite sua nova senha..." data-error="Por favor, informe a nova senha." maxlength="120" required>
						</div>
						<div class="form-group">
							<label for="senha2">Confirmação de Senha</label>
							<input type="password" class="form-control form-control-lg" id="senha2" name="senha2" placeholder="Digite a confirmação da senha..." data-error="Por favor, informe a confirmação senha." maxlength="120" required>
						</div>
	  					<button id="btn-provisoria" type="submit" class="btn btn-success btn-lg form-control" name="submit">
	  						<i class='fa fa-save'></i> Alterar Senha
	  					</button>		
					</form>
				</div>
			</div><!-- row -->
		</div><!-- contatiner -->
	</main>
	<?php
	require_once('footer.php');
	?>