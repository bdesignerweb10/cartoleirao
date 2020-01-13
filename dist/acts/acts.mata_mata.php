<?php
require_once("connect.php");

// if (!isset($_SESSION["usu_id"]) || empty($_SESSION["usu_id"]) || 
// 	!isset($_SESSION['usu_nivel']) || empty($_SESSION["usu_nivel"]) || 
// 	$_SESSION["usu_id"] == "0")
// 	header('Location: ../login');

$temporada = $_SESSION["temporada_atual"];
$rodada = $_SESSION["rodada_site"];

if(isset($_GET['act']) && !empty($_GET['act'])) {
	switch ($_GET['act']) {
	    case 'mata-mata':
			try {
				$list_mata = "[";

				$matamatalist = $conn->query("SELECT mm.id AS id, mm.descricao AS descricao, mm.id_time_campeao as campeao
												FROM tbl_mata_mata mm
										  INNER JOIN tbl_mata_mata_confrontos mmc ON mm.id = mmc.id_mata_mata
										 	   WHERE mmc.id_anos <= $temporada 
										 	GROUP BY mm.id, mm.descricao
										    ORDER BY mm.id") or trigger_error($conn->error);
	        	if($matamatalist && $matamatalist->num_rows > 0) {
		        	while($matamata = $matamatalist->fetch_object()) {
						$confrontoslist = $conn->query("SELECT nivel, id_rodadas
														  FROM tbl_mata_mata_confrontos 
														 WHERE id_mata_mata = $matamata->id
													  ORDER BY id_rodadas DESC, nivel ASC, chave ASC LIMIT 1") or trigger_error($conn->error);
			        	if($confrontoslist && $confrontoslist->num_rows > 0) {
				        	while($confrontos = $confrontoslist->fetch_object()) {
				        		if($confrontos->id_rodadas > $_SESSION["rodada"]) {
				        			$confrontos->fase = "Aguardando início";
				        			$confrontos->cor_fase = "btn-default";
				        			//$confrontos->img = "aguardando.png";
				        			$ordem = "1";
				        		} else if($confrontos->id_rodadas == $_SESSION["rodada"] && (empty($matamata->campeao) || $matamata->campeao == "" || $matamata->campeao == 0)) {
				        			$confrontos->fase = "Copa em Andamento";
				        			$confrontos->cor_fase = "btn-success";
				        			//$confrontos->img = "mitou.png";
				        			$ordem = "0";
				        		} else {
				        			$confrontos->fase = "Copa Encerrada";
				        			$confrontos->cor_fase = "btn-danger";
				        			//$confrontos->img = "encerrada.png";
				        			$ordem = "2";
				        		}

				        		$id = $matamata->id * $_SESSION["fake_id"];
								$list_mata .= '{"ordem": ' . $ordem . ', "id": ' . $id . ', "nome": "' . $matamata->descricao . '", "fase": "' . $confrontos->fase . '", "cor_fase": "' . $confrontos->cor_fase . '", "imagem": "' . $confrontos->img . '"}, ';
				        	}
				        }
		        	}

					$list_mata = substr($list_mata, 0, -2);
		        }
				$list_mata .= "]";
				echo '{"succeed": true, "list": ' . $list_mata . '}';
				exit();
			} catch(Exception $e) {
				echo '{"succeed": false, "errno": 14003, "title": "Erro ao carregar os dados!", "erro": "Ocorreu um erro ao carregar os dados: ' . $e->getMessage() . '"}';
				exit();
			}
	        break;
	        
	    case 'confrontos':
			try {
				if(!isset($_GET['idmatamata']) || empty($_GET['idmatamata'])) {
					echo '{"succeed": false, "errno": 14005, "title": "Parâmetro não encontrado!", "erro": "Parâmetro do ID do mata-mata não enviado! Favor contatar o administrador mostrando o erro!"}';
					exit();
				}

				$id = $_GET['idmatamata'] / $_SESSION["fake_id"];

        		$mata_mata = "";
				$list_confrontos = "";

				$confrontoslist = $conn->query("SELECT *
												  FROM vw_mata_mata_confrontos 
												 WHERE id = $id
												 ORDER BY chave ASC") or trigger_error($conn->error);
	        	if($confrontoslist && $confrontoslist->num_rows > 0) {
	        		$nivel = "";
		        	while($confrontos = $confrontoslist->fetch_object()) {
		        		$mata_mata = $confrontos->mata_mata;

		        		if($nivel != $confrontos->nivel) {
		        			if(!empty($nivel)) {
								$list_confrontos = substr($list_confrontos, 0, -2);
		        				$list_confrontos .= "]}, ";
		        			}
		        			$list_confrontos .= '{"chave": ' . $confrontos->chave . ', "nivel": ' . $confrontos->nivel . ', "fase": "' . $confrontos->fase . '", "active": "' . ($confrontos->rodada == $_SESSION["rodada"] ? " active" : "") . '", "confrontos": [';
		        			$nivel = $confrontos->nivel;
		        		}

		                $escudo_time_1 = "no-escudo.png";
		                if(file_exists("../img/escudos/$confrontos->escudo_time_1"))
		                	$escudo_time_1 = $confrontos->escudo_time_1;

		                $escudo_time_2 = "no-escudo.png";
		                if(file_exists("../img/escudos/$confrontos->escudo_time_2"))
		                	$escudo_time_2 = $confrontos->escudo_time_2;

	        			$list_confrontos .= '{"chave": ' . $confrontos->chave . ', "time_1": "' . $confrontos->time_1 . '", "escudo_time_1": "' . $escudo_time_1 . '", "pontuacao_time_1": "' . $confrontos->pontuacao_time_1 . '", "time_2": "' . $confrontos->time_2 . '", "escudo_time_2": "' . $escudo_time_2 . '", "pontuacao_time_2": "' . $confrontos->pontuacao_time_2 . '"}, ';
		        	}
					$list_confrontos = substr($list_confrontos, 0, -2);
    				$list_confrontos .= "]}";
		        }
				echo '{"succeed": true, "mata_mata": "' . $mata_mata . '", "list": [' . $list_confrontos . ']}';
				exit();
			} catch(Exception $e) {
				echo '{"succeed": false, "errno": 14004, "title": "Erro ao carregar os dados!", "erro": "Ocorreu um erro ao carregar os dados: ' . $e->getMessage() . '"}';
				exit();
			}
	        break;

	    default:
	       echo '{"succeed": false, "errno": 14001, "title": "Ação não definida!", "erro": "Não foi definida a ação para a requisição. Favor contatar o administrador da página!"}';
	}
} else {
	echo '{"succeed": false, "errno": 14002, "title": "Ação não definida!", "erro": "Não foi definida a ação para a requisição. Favor contatar o administrador da página!"}';
}
?>