<?php
require_once("connect.php");

if (!isset($_SESSION["usu_id"]) || empty($_SESSION["usu_id"]) || 
	!isset($_SESSION['usu_nivel']) || empty($_SESSION["usu_nivel"]) || 
	$_SESSION["usu_id"] == "0")
	header('Location: ../login');
						
if(isset($_POST) && !empty($_POST) && $_POST["nome"]) {
	$isValid = true;
	$errMsg = "";

	if(!isset($_POST["nome"]) || empty($_POST["nome"])) {
		$errMsg .= "Nome";
		$isValid = false;
	}
	
	if(!isset($_POST["email"]) || empty($_POST["email"])) {
		if(!$isValid)
			$errMsg .= ", ";	
		
		$errMsg .= "E-mail";
		$isValid = false;
	}
	
	if(!isset($_POST["telefone"]) || empty($_POST["telefone"])) {
		if(!$isValid)
			$errMsg .= ", ";	
		
		$errMsg .= "Telefone";
		$isValid = false;
	}

	if(!isset($_POST["senha"]) || empty($_POST["senha"])) {
		if(!$isValid)
			$errMsg .= ", ";	
		
		$errMsg .= "Senha";
		$isValid = false;
	}

	if(!isset($_POST["senha2"]) || empty($_POST["senha2"])) {
		if(!$isValid)
			$errMsg .= ", ";	
		
		$errMsg .= "Confirmação da Senha";
		$isValid = false;
	}

	if(!$isValid) {
		echo '{"succeed": false, "errno": 19003, "title": "Erro em um ou mais campos do formulário!", "erro": "Ocorreram erros nos seguintes campos do formulário: <b>' . $errMsg . '</b>"}';
	}
	else {
		try {
			$conn->autocommit(FALSE);

			$nome = $_POST["nome"];
			$email = $_POST["email"];
			$telefone = $_POST["telefone"];
			$senha = $_POST["senha"];
			$conf_senha = $_POST["senha2"];

			if($senha != $conf_senha) {
				echo '{"succeed": false, "errno": 19004, "title": "Senha e Confirmação de Senha divergem!", "erro": "A senha e a confirmação de senha devem ser iguais!"}';
				$conn->rollback();
				exit();
			}
			else {
				$usu_qry = $conn->query("SELECT id, times_id, senha
										   FROM tbl_usuarios 
										  WHERE id = " . $_SESSION["usu_id"]) or trigger_error("19005 - " . $conn->error);

				if ($usu_qry) { 
				    if($usu_qry->num_rows === 0) {
						echo '{"succeed": false, "errno": 19006, "title": "Usuário não encontrado!", "erro": "O usuário digitado não se encontra na base de dados!"}';
						exit();
				    } else {
				        while($usuario = $usu_qry->fetch_object()) {
				        	if(md5($senha) != $usuario->senha) {
								$senha = md5($senha);
				        	}

				        	$upd_usuario = "UPDATE tbl_usuarios 
							  			       SET usuario = '" . $email . "',
							  			           senha = '" . $senha . "',
							  			           senha_provisoria = 0,
							  			           tentativas = 0
							  			     WHERE id = " . $usuario->id;

							if ($conn->query($upd_usuario) === TRUE) {
								$upd_time = "UPDATE tbl_times 
							  			        SET nome_presidente = '" . $nome . "',
							  			            email = '" . $email . "',
							  			            telefone = '" . $telefone . "'
								  			  WHERE id = " . $usuario->times_id;

								if ($conn->query($upd_time) === TRUE) {
									$conn->commit();
									$_SESSION["usu_login"] = $email;
									$_SESSION["usu_nome"] = $nome;

									if(isset($_COOKIE['usu_login']) && !empty($_COOKIE['usu_login'])) {
										$_COOKIE['usu_login'] = $_SESSION["usu_login"];
									}

									if(isset($_COOKIE['usu_nome']) && !empty($_COOKIE['usu_nome'])) {
										$_COOKIE['usu_nome'] = $_SESSION["usu_nome"];
									}

									echo '{"succeed": true}';
								} else {
							        throw new Exception("Erro ao atualizar o time: " . $upd_time . "<br>" . $conn->error);
								}
							} else {
						        throw new Exception("Erro ao atualizar o usuário: " . $upd_usuario . "<br>" . $conn->error);
							}
						}
					}
				}

			}
		} catch(Exception $e) {
			$conn->rollback();

			echo '{"succeed": false, "errno": 19001, "title": "Erro ao salvar os dados!", "erro": "Ocorreu um erro ao salvar os dados: ' . $e->getMessage() . '"}';
		}
	}
}
else 
	echo '{"succeed": false, "errno": 19002, "title": "Erro ao enviar o formulário!", "erro": "Ocorreu um erro ao tentar enviar seu formulário, favor recarregar a página e tentar novamente!"}';
?>