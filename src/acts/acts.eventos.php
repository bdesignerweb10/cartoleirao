<?php
require_once("connect.php");

if (!isset($_SESSION["usu_id"]) || empty($_SESSION["usu_id"]) || 
	!isset($_SESSION['usu_nivel']) || empty($_SESSION["usu_nivel"]) || 
	$_SESSION["usu_id"] == "0")
	header('Location: ../login');

$temporada = $_SESSION["temp_atual"];
$id_time = (isset($_SESSION["usu_time"]) && !empty($_SESSION["usu_time"]) ? intval($_SESSION["usu_time"]) : 0);

if(isset($_GET['act']) && !empty($_GET['act'])) {
	switch ($_GET['act']) {
	    case 'listagem-eventos':
			try {
				$list_eventos = "";
				$eventoslist = $conn->query("SELECT * 
											  FROM vw_eventos 
											 WHERE ano = '$temporada'") or trigger_error($conn->error);
				if($eventoslist && $eventoslist->num_rows > 0) {
					while($eventos = $eventoslist->fetch_object()) {
						$confirmado = 'false';
						$confirmpresenca = $conn->query("SELECT id_times 
													       FROM tbl_eventos_presenca 
													      WHERE id_eventos = $eventos->id
													      	AND id_times = $id_time") or trigger_error($conn->error);

						if($confirmpresenca && $confirmpresenca->num_rows > 0)
							$confirmado = 'true';

						$list_eventos .= '{"id": ' . $eventos->id * $_SESSION["fake_id"] . ', "titulo": "' . $eventos->titulo . '", "local": "' . $eventos->local . '", "data": ' . $eventos->data . ', "descricao": "' . $eventos->descricao . '", "participantes": ' . $eventos->participantes . ', "confirmado": ' . $confirmado . '}, ';
					}

					$list_eventos = substr($list_eventos, 0, -2);
				}

				echo '{"succeed": true, "eventos": [' . $list_eventos . ']}';
				exit();
			} catch(Exception $e) {
				echo '{"succeed": false, "errno": 18003, "title": "Erro ao carregar os dados!", "erro": "Ocorreu um erro ao carregar os dados: ' . $e->getMessage() . '"}';
				exit();
			}
        	break;

	    case 'confirmar-presenca':
			try {
				$conn->autocommit(FALSE);

				if(!isset($_GET['idevento']) || empty($_GET['idevento'])) {
					echo '{"succeed": false, "errno": `8006, "title": "Parâmetro não encontrado!", "erro": "Parâmetro do ID do evento não enviado! Favor contatar o administrador mostrando o erro!"}';
					exit();
				}

				$id_evento = $_GET['idevento'] / $_SESSION["fake_id"];

				$qryinspresencaevento = "INSERT INTO tbl_eventos_presenca (id_eventos, id_times) VALUES ($id_evento, $id_time)";
				if ($conn->query($qryinspresencaevento) === TRUE) {
					$conn->commit();
					echo '{"succeed": true}';
				} else {
			        throw new Exception("Erro ao confirmar presença no evento: " . $qryinspresencaevento . "<br>" . $conn->error);
				}
			} catch(Exception $e) {
				$conn->rollback();

				echo '{"succeed": false, "errno": 18005, "title": "Erro ao salvar os dados!", "erro": "Ocorreu um erro ao salvar os dados: ' . $e->getMessage() . '"}';
			}
        	break;

	    case 'remover-presenca':
			try {
				$conn->autocommit(FALSE);

				if(!isset($_GET['idevento']) || empty($_GET['idevento'])) {
					echo '{"succeed": false, "errno": 18004, "title": "Parâmetro não encontrado!", "erro": "Parâmetro do ID do evento não enviado! Favor contatar o administrador mostrando o erro!"}';
					exit();
				}

				$id_evento = $_GET['idevento'] / $_SESSION["fake_id"];

				$qrydelpresencaevento = "DELETE FROM tbl_eventos_presenca WHERE id_eventos = $id_evento AND id_times = " . $_SESSION["usu_time"];
				if ($conn->query($qrydelpresencaevento) === TRUE) {
					$conn->commit();
					echo '{"succeed": true}';
				} else {
			        throw new Exception("Erro ao desconfirmar presença do evento: " . $qrydelpresencaevento . "<br>" . $conn->error);
				}
			} catch(Exception $e) {
				$conn->rollback();

				echo '{"succeed": false, "errno": 18005, "title": "Erro ao salvar os dados!", "erro": "Ocorreu um erro ao salvar os dados: ' . $e->getMessage() . '"}';
			}
        	break;

	    default:
	       echo '{"succeed": false, "errno": 18001, "title": "Ação não definida!", "erro": "Não foi definida a ação para a requisição. Favor contatar o administrador da página!"}';
	}
} else {
	echo '{"succeed": false, "errno": 18002, "title": "Ação não definida!", "erro": "Não foi definida a ação para a requisição. Favor contatar o administrador da página!"}';
}
?>