<?php
require_once("connect.php");
if (!isset($_SESSION["prov_id"]) || empty($_SESSION["prov_id"]) || 
	!isset($_SESSION['prov_login']) || empty($_SESSION["prov_login"]) || 
	$_SESSION["prov_id"] == "0")
	header('Location: ../login');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once("../lib/PHPMailer/src/Exception.php");
require_once("../lib/PHPMailer/src/PHPMailer.php");
require_once("../lib/PHPMailer/src/SMTP.php");

if(isset($_POST) && !empty($_POST) && $_POST["senha"]) {
	$isValid = true;
	$errMsg = "";
	
	if(!isset($_POST["senha_antiga"]) || empty($_POST["senha_antiga"])) {
		if(!$isValid)
			$errMsg .= ", ";	
		
		$errMsg .= "Senha Antiga";
		$isValid = false;
	}
	
	if(!isset($_POST["senha"]) || empty($_POST["senha"])) {
		if(!$isValid)
			$errMsg .= ", ";	
		
		$errMsg .= "Nova Senha";
		$isValid = false;
	}
	
	if(!isset($_POST["senha2"]) || empty($_POST["senha2"])) {
		if(!$isValid)
			$errMsg .= ", ";	
		
		$errMsg .= "Confirmação de Senha";
		$isValid = false;
	}

	if(!$isValid) {
		echo '{"succeed": false, "errno": 12101, "title": "Erro em um ou mais campos do formulário!", "erro": "Ocorreram erros nos seguintes campos do formulário: <b>' . $errMsg . '</b>"}';
	}
	else {
		try {
			$conn->autocommit(FALSE);

			$id = $_SESSION["prov_id"];
			$login = $_SESSION["prov_login"];
			$senha_antiga = $_POST["senha_antiga"];
			$senha = $_POST["senha"];
			$conf_senha = $_POST["senha2"];

			if($senha != $conf_senha) {
				echo '{"succeed": false, "errno": 12102, "title": "Senha e Confirmação de Senha divergem!", "erro": "A senha e a confirmação de senha devem ser iguais!"}';
				$conn->rollback();
				exit();
			}
			else {
				$usu_qry = $conn->query("SELECT id, times_id, usuario, senha, nivel, tentativas, senha_provisoria FROM tbl_usuarios WHERE usuario = '" . $login . "' LIMIT 1") or trigger_error("12103 - " . $conn->error);

				if ($usu_qry) { 
				    if($usu_qry->num_rows === 0) {
						echo '{"succeed": false, "errno": 12104, "title": "Usuário não encontrado!", "erro": "O usuário digitado não se encontra na base de dados!"}';
						$conn->rollback();
						exit();
				    } else {
				        while($usuario = $usu_qry->fetch_object()) {
				        	if($usuario->id != $id) {
								echo '{"succeed": false, "errno": 12108, "title": "Usuário divergente!", "erro": "Login do usuário informado diverge do usuário cadastrado no banco de dados! Favor contatar o administrador do site!"}';
								$conn->rollback();
								exit();
				        	}

				        	if(md5($senha_antiga) != $usuario->senha) {
								echo '{"succeed": false, "errno": 12109, "title": "Senha antiga divergente!", "erro": "Senha antiga informada diverge da senha cadastrada no banco de dados! Favor contatar o administrador do site!"}';
								$conn->rollback();
								exit();
				        	}
							$usu_time = $usuario->times_id;
							$usu_escudo = "";
							$usu_nome = $usuario->usuario;

							$upd_usuario = "UPDATE tbl_usuarios 
							  			       SET senha = '" . md5($senha) . "',
							  			           senha_provisoria = 0,
							  			           tentativas = 0
							  			     WHERE id = $id";

							if ($conn->query($upd_usuario) === TRUE) {
								$sqltime = $conn->query("SELECT nome_presidente, email, escudo_time FROM tbl_times WHERE id = " . $usuario->times_id) or trigger_error("12110 - " . $conn->error);

								$nome = "Sem Nome";
								$email = "sem@email";

								if ($sqltime && $sqltime->num_rows > 0) {
					    			while($time = $sqltime->fetch_object()) {
					    				$nome = $time->nome_presidente;
					    				$email = $time->email;

					    				$usu_nome = $time->nome_presidente;
					    				if(file_exists("../img/escudos/" . $time->escudo_time))
					    					$usu_escudo = $time->escudo_time;
					    				else 
					    					$usu_escudo = "no-escudo.png";
					    			}

					    			$mail = new PHPMailer(true); 

									$mail->isSMTP();
								    $mail->Host = 'email-ssl.com.br';
								    $mail->SMTPAuth = true;
								    $mail->Username = 'contato@cartoleirao.com.br';
								    $mail->Password = '34#Edc78*Bhu';
								    $mail->Port = 465;
									$mail->SMTPSecure = 'ssl';

								    $mail->setFrom('contato@cartoleirao.com.br', 'Contato | Cartoleirão - Trabalho Seguro TS');
								    $mail->addReplyTo('presidente@cartoleirao.com.br', 'Presidente |  Cartoleirão - Trabalho Seguro TS');
								    $mail->addAddress($email, $nome);
								    $mail->addBCC('presidente@cartoleirao.com.br', 'Presidente | Cartoleirão - Trabalho Seguro TS');
								    $mail->addBCC('contato@cartoleirao.com.br', 'Contato | Cartoleirão - Trabalho Seguro TS');

								    $mail->isHTML(true);

								    $mail->Subject = utf8_decode("[Liga Cartoleirão - Trabalho Seguro TS] Sua senha foi alterada, presidente!");
								    $mail->Body    = utf8_decode("<html><head></head><body><table width='600' border='0' align='center' cellpadding='0' cellspacing='0' style='background-color:#e9e9e9;'><tr><td style='background-color:#fc8f3e; width:600px; height:106px;'><h3 style='font-family:Verdana, Geneva, sans-serif; color:#fff; padding-top:15px;' align='center'>Alteração de senha</h3></td></tr><tr><td><p style='font-family:Verdana, Geneva, sans-serif; padding-left:20px; padding-top:20px;'>Olá cartoleiro " . $nome . "!</p><p style='font-family:Verdana, Geneva, sans-serif; padding-left:20px;'>Sua senha foi alterada com sucesso, parça!</p><p style='font-family:Verdana, Geneva, sans-serif; padding-left:20px;'>Caso você não tenha solicitado a alteração da sua senha, favor em contato urgentemente com a administração do site!</p><p style='font-family:Verdana, Geneva, sans-serif; padding-left:20px;'>Caso tenha alguma dúvida ou sugestão, entre em contato por:</p><p style='font-family:Verdana, Geneva, sans-serif; padding-left:20px;'> - (19) 99897-0090<br /> - <a href='mailto:contato@cartoleirao.com.br'>contato@cartoleirao.com.br</a></p><p style='font-family:Verdana, Geneva, sans-serif; padding-left:20px; padding-bottom:20px;'>Att,</p></td></tr><tr><td style='background-color:#fc8f3e; width:600px; height:106px;'><h3 style='font-family:Verdana, Geneva, sans-serif; color:#fff; padding-top:15px;' align='center'>Equipe Cartoleirão - Trabalho Seguro TS</h3></td></tr></table></body></html>");
								    $mail->AltBody = utf8_decode("Olá cartoleiro " . $nome . "! Sua senha foi alterada com sucesso, parça! Caso você não tenha solicitado a alteração da sua senha, favor em contato urgentemente com a administração do site! Caso tenha alguma dúvida ou sugestão, entre em contato por: (19) 99897-0090 ou contato@cartoleirao.com.br. Att., Equipe Cartoleirão - Trabalho Seguro TS.");

								    $mail->send();
					    		}

								$_SESSION["usu_id"] = $usuario->id;
								$_SESSION["usu_login"] = $usuario->usuario;
								$_SESSION["usu_nivel"] = $usuario->nivel;
								$_SESSION["usu_time"] = $usu_time;
								$_SESSION["usu_nome"] = $usu_nome;
								$_SESSION["usu_escudo"] = $usu_escudo;
								$_SESSION["prov_id"] = NULL;
								$_SESSION["prov_login"] = NULL;

								$conn->commit();
								echo '{"succeed": true}';
							}
						}
					}
				}
				else {
					echo '{"succeed": false, "errno": 12107, "title": "Erro desconhecido!", "erro": "Ocorreu um erro desconhecido ao tentar alterar a senha do usuário! Favor contatar o administrador do site!"}';
					$conn->rollback();
					exit();
				}
			}
		} catch(Exception $e) {
			$conn->rollback();

			echo '{"succeed": false, "errno": 12105, "title": "Erro ao salvar os dados!", "erro": "Ocorreu um erro ao salvar os dados: ' . $e->getMessage() . '"}';
		}
	}
}
else 
	echo '{"succeed": false, "errno": 12106, "title": "Erro ao fazer login!", "erro": "O formulário não foi preenchido, favor tentar novamente!"}';
?>