<?php
require_once("connect.php");

// if (!isset($_SESSION["usu_id"]) || empty($_SESSION["usu_id"]) || 
// 	!isset($_SESSION['usu_nivel']) || empty($_SESSION["usu_nivel"]) || 
// 	$_SESSION["usu_id"] == "0")
// 	header('Location: ../login');

$temporada = $_SESSION["temporada_atual"];

if(isset($_GET['act']) && !empty($_GET['act'])) {
	switch ($_GET['act']) {
	    case 'escudos':
	    	$id_clube_default = $_SESSION["usu_time"];

	    	$list_times = "";
			$timeslist = $conn->query("SELECT *
										 FROM vw_escudos_temporada
										WHERE temporada = $temporada
								     ORDER BY time ASC") or trigger_error($conn->error);
        	if($timeslist && $timeslist->num_rows > 0) {
	        	while($time = $timeslist->fetch_object()) {
	        		if(!isset($id_clube_default) && empty($id_clube_default)) {
	        			$id_clube_default = $time->id;
	        		}

	                $escudo = "no-escudo.png";
	                if(file_exists("../img/escudos/$time->escudo"))
	                	$escudo = $time->escudo;
					$list_times .= '{"id": ' . $time->id * $_SESSION["fake_id"] . ', "time": "' . $time->time . '", "escudo": "' . $escudo . '"}, ';
	        	}

				$list_times = substr($list_times, 0, -2);
	        }
			echo '{"succeed": true, "id_clube_default": ' . $id_clube_default * $_SESSION["fake_id"] . ', "list": [' . $list_times . ']}';
	        break;

        case 'historia':
			if(!isset($_GET['idclube']) || empty($_GET['idclube'])) {
				echo '{"succeed": false, "errno": 19203, "title": "Parâmetro não encontrado!", "erro": "Parâmetro do ID do clube não enviado! Favor contatar o administrador mostrando o erro!"}';
				exit();
			}

			$id = $_GET['idclube'] / $_SESSION["fake_id"];

			$sqltime = $conn->query("SELECT t.nome_time AS time, t.nome_presidente AS presidente, t.escudo_time AS escudo, 
											t.historia AS historia, t.ano_fundacao AS ano_fundacao, MIN(a.descricao) AS primeira_part
								       FROM tbl_times t
								 INNER JOIN tbl_inscricao i ON i.id_times = t.id
								 INNER JOIN tbl_anos a ON a.id = i.id_anos
								      WHERE t.id = $id
								   GROUP BY t.nome_time, t.nome_presidente, t.escudo_time, t.historia") or trigger_error("19204 - " . $conn->error);

			if ($sqltime && $sqltime->num_rows > 0) {
				while($time = $sqltime->fetch_object()) {
					$nome_time = $time->time;
					$presidente = $time->presidente;
					$historia = $time->historia;
					if(isset($time->ano_fundacao) && !empty($time->ano_fundacao) && $time->ano_fundacao != null) {
						$ano_fundacao = $time->ano_fundacao;
					}
					else {
						$ano_fundacao = $time->primeira_part;
					}
					if(file_exists("../img/escudos/" . $time->escudo))
						$escudo = $time->escudo;
					else 
						$escudo = "no-escudo.png";
					if(!isset($historia) || empty($historia))
						$historia = "Esse clube é muito pequeno, e por isso não tem história. Tá na hora de ganhar alguma coisa né, parça?";
					else {
						$historia = nl2p(str_replace('"', '”', str_replace("'", "`", $historia)));
					}

					$list_temps = "";
					$temporadaslist = $conn->query("SELECT a.id AS id, a.descricao AS descricao
													 FROM tbl_inscricao i
								 			   INNER JOIN tbl_anos a ON a.id = i.id_anos
													WHERE i.id_times = $id
											     ORDER BY a.descricao ASC") or trigger_error($conn->error);
					if($temporadaslist && $temporadaslist->num_rows > 0) {
						while($temps = $temporadaslist->fetch_object()) {
							if($temps->id == $temporada)
								$is_atual = "true";
							else
								$is_atual = "false";
							$list_temps .= '{"id": ' . $temps->id * $_SESSION["fake_id"] . ', "temporada": "' . $temps->descricao . '", "is_actual": ' . $is_atual . '}, ';
						}

						$list_temps = substr($list_temps, 0, -2);
					}

					$list_camps = "";
					$ligaslist = $conn->query("SELECT a.id AS id_temporada, a.descricao AS temporada, tt.posicao_liga AS posicao
												 FROM tbl_times_temporadas tt
										   INNER JOIN tbl_anos a ON a.id = tt.id_anos
												WHERE tt.id_times = $id
												  AND tt.id_anos <> $temporada
												  AND tt.id_rodadas = (SELECT MAX(id_rodadas) 
													   					 FROM tbl_temporadas 
													   				    WHERE id_anos = tt.id_anos)
											 ORDER BY a.descricao DESC") or trigger_error($conn->error);
					if($ligaslist && $ligaslist->num_rows > 0) {
						while($liga = $ligaslist->fetch_object()) {
							$list_camps .= '{"tipo": "liga", "temporada": "' . $liga->temporada . '", "posicao": ' . $liga->posicao . '}, ';
						}
					}

					$mmlist = $conn->query("SELECT a.id AS id_temporada, a.descricao AS temporada, mm.id_time_campeao AS time_campeao, 
												   mm.descricao AS mata_mata
											  FROM tbl_mata_mata mm
										INNER JOIN tbl_mata_mata_confrontos mmc ON mmc.id_mata_mata = mm.id
									    INNER JOIN tbl_anos a ON a.id = mmc.id_anos
										     WHERE mm.id_time_campeao IS NOT NULL
										       AND EXISTS(SELECT mmt.id_time 
										       				FROM tbl_mata_mata_times mmt 
										                   WHERE mmt.id_mata_mata = mm.id
										                     AND mmt.id_time = $id)
										  GROUP BY mm.id_time_campeao
										  ORDER BY a.descricao DESC, mm.descricao ASC") or trigger_error($conn->error);

					if($mmlist && $mmlist->num_rows > 0) {
						while($mm = $mmlist->fetch_object()) {
							$campeao = "false";
							if($id == $mm->time_campeao)
								$campeao = "true";
							$list_camps .= '{"tipo": "mata_mata", "temporada": "' . $mm->temporada . '", "mata_mata": "' . $mm->mata_mata . '", "campeao": ' . $campeao . '}, ';
						} 
					}

					if(strlen($list_camps) > 2) {
						$list_camps = substr($list_camps, 0, -2);
					}
				}
				echo '{"succeed": true, "escudo": "' . $escudo . '", "nome_time": "' . $nome_time . '", "ano_fundacao": "' . $ano_fundacao . '", "nome_presidente": "' . $presidente . '", "historia": "' . $historia . '", "list_temp" : [' . $list_temps . '], "list_camps" : [ ' . $list_camps . ']}';
			}
			else {
	       		echo '{"succeed": false, "errno": 19205, "title": "Clube não encontrado!", "erro": "O clube informado não foi encontrado no banco de dados! Favor contatar o administrador do site!"}';
			}

        	break;

        case 'paineis':
			if(!isset($_GET['idano']) || empty($_GET['idano'])) {
				echo '{"succeed": false, "errno": 19206, "title": "Parâmetro não encontrado!", "erro": "Parâmetro do ID da temporada não enviado! Favor contatar o administrador mostrando o erro!"}';
				exit();
			}
			if(!isset($_GET['idtime']) || empty($_GET['idtime'])) {
				echo '{"succeed": false, "errno": 19207, "title": "Parâmetro não encontrado!", "erro": "Parâmetro do ID do clube não enviado! Favor contatar o administrador mostrando o erro!"}';
				exit();
			}

			$idano = $_GET['idano'] / $_SESSION["fake_id"];
			$idtime = $_GET['idtime'] / $_SESSION["fake_id"];

			$qrytemporada = $conn->query("SELECT a.descricao AS descricao, MAX(pontuacao) AS max_pontos, MIN(pontuacao) AS min_pontos, 
												 ROUND(AVG(pontuacao), 2) AS media
      									    FROM tbl_times_temporadas tt
									  INNER JOIN tbl_anos a ON a.id = tt.id_anos
	 									   WHERE tt.id_times = $idtime
	   						  				 AND tt.id_anos  = $idano
  						 				GROUP BY a.descricao") or trigger_error($conn->error);
			if($qrytemporada && $qrytemporada->num_rows > 0) {
				while($temp = $qrytemporada->fetch_object()) {
					$list_camps = "";
					$ligaslist = $conn->query("SELECT a.id AS id_temporada, a.descricao AS temporada, tt.posicao_liga AS posicao
												 FROM tbl_times_temporadas tt
										   INNER JOIN tbl_anos a ON a.id = tt.id_anos
												WHERE tt.id_times = $idtime
												  AND tt.id_anos  = $idano
												  AND tt.id_rodadas = (SELECT MAX(id_rodadas) 
													   					 FROM tbl_temporadas 
													   				    WHERE id_anos = tt.id_anos)
											 ORDER BY a.descricao DESC") or trigger_error($conn->error);
					if($ligaslist && $ligaslist->num_rows > 0) {
						while($liga = $ligaslist->fetch_object()) {
							$list_camps .= '{"tipo": "liga", "temporada": "' . $liga->temporada . '", "posicao": ' . $liga->posicao . '}, ';

							$mmlist = $conn->query("SELECT a.id AS id_temporada, a.descricao AS temporada, mm.id_time_campeao AS time_campeao, 
														   mm.descricao AS mata_mata
													  FROM tbl_mata_mata mm
												INNER JOIN tbl_mata_mata_confrontos mmc ON mmc.id_mata_mata = mm.id
											    INNER JOIN tbl_anos a ON a.id = mmc.id_anos
												     WHERE a.id = $idano
												       AND EXISTS(SELECT mmt.id_time 
												       				FROM tbl_mata_mata_times mmt 
												                   WHERE mmt.id_mata_mata = mm.id
												                     AND mmt.id_time = $idtime)
												  GROUP BY mm.id_time_campeao
												  ORDER BY a.descricao DESC, mm.descricao ASC") or trigger_error($conn->error);

							if($mmlist && $mmlist->num_rows > 0) {
								while($mm = $mmlist->fetch_object()) {
									$campeao = "false";
									if($idtime == $mm->time_campeao)
										$campeao = "true";
									$list_camps .= '{"tipo": "mata_mata", "temporada": "' . $mm->temporada . '", "mata_mata": "' . $mm->mata_mata . '", "campeao": ' . $campeao . '}, ';
								} 
							}
						}

						$list_camps = substr($list_camps, 0, -2);
					}

					echo '{"succeed": true, "temporada": "' . $temp->descricao . '", "max_pontos": ' . $temp->max_pontos . ', "min_pontos": ' . $temp->min_pontos . ', "media": ' . $temp->media . ', "list_camps" : [ ' . $list_camps . ']}';
				}
			}

        	break;

	    default:
	       echo '{"succeed": false, "errno": 19201, "title": "Ação não definida!", "erro": "Não foi definida a ação para a requisição. Favor contatar o administrador da página!"}';
	}
} else {
	echo '{"succeed": false, "errno": 19202, "title": "Ação não definida!", "erro": "Não foi definida a ação para a requisição. Favor contatar o administrador da página!"}';
}
?>