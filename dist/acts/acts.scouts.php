<?php
require_once("connect.php");
require_once("acts.cartola.php");

// if (!isset($_SESSION["usu_id"]) || empty($_SESSION["usu_id"]) || 
// 	!isset($_SESSION['usu_nivel']) || empty($_SESSION["usu_nivel"]) || 
// 	$_SESSION["usu_id"] == "0")
// 	header('Location: ../login');

$temporada = $_SESSION["temporada_atual"];

if(isset($_GET['act']) && !empty($_GET['act'])) {
	switch ($_GET['act']) {

        case 'times':
        	$where_and = "";
        	if(isset($_GET['q']) && !empty(isset($_GET['q']))) {
        		$where_and = " WHERE LOWER(nome_time) LIKE '%" . strtolower($_GET['q']) .  "%'";
        	}
	    	$list_times = "";
			$timeslist = $conn->query("SELECT nome_time AS time
										 FROM tbl_times" . 
										 $where_and) or trigger_error($conn->error);
        	if($timeslist && $timeslist->num_rows > 0) {
	        	while($time = $timeslist->fetch_object()) {
					$list_times .= '"' . $time->time . '", ';
	        	}

				$list_times = substr($list_times, 0, -2);
	        }
			echo '[' . $list_times . ']';
        	break;

        case 'pontuacao':
			$status_mercado = api("mercado/status");

			if ($status_mercado->{"status_mercado"} == 2) {
				$time = str_replace('"', '', $_POST["nome_time"]);

				$qrytime = $conn->query("SELECT t.slug_cartola AS slug, t.escudo_time AS escudo, t.patrimonio AS patrimonio
							               FROM tbl_times t
									  LEFT JOIN tbl_inscricao i ON i.id_times = t.id
											AND i.id_anos = $temporada
										  WHERE UPPER(t.nome_time) LIKE '%" . strtoupper($time) . "%'") or 
											trigger_error("32008 - " . $conn->error);

				if ($qrytime && $qrytime->num_rows > 0) {
					while($t = $qrytime->fetch_object()) {
						if(!isset($t->slug) || empty($t->slug) || $t->slug == null) {
							echo '{"succeed": false, "errno": 32006, "title": "Slug do Cartola FC não cadastrado!", "erro": "O time que você deseja consultar as parciais no Cartola FC não possui SLUG cadastrado. Favor contatar o administrador do sistema informando o erro!"}';
							break;
						} else {
			                $escudo = "no-escudo.png";
			                if(file_exists("../img/escudos/$t->escudo"))
			                	$escudo = $t->escudo;

			                $patrimonio = number_format(0, 2, ',', '.');
			                if(isset($t->patrimonio) && !empty($t->patrimonio) && $t->patrimonio != null) {
			                	$patrimonio = number_format($t->patrimonio, 2, ',', '.');
			                }

							$atletas = api("time/slug/". $t->slug);
							$pontuados = api("atletas/pontuados");

					 		if(!isset($atletas->{"mensagem"}) || empty($atletas->{"mensagem"})) {
					 			if(count($atletas->{"atletas"}) > 0) {
									$list_atletas = "";
									$pont_total = (float)0.0;

									foreach($atletas->{"atletas"} as $j => $jogador) {
										if ($jogador->{"apelido"} != "") {
											$athlete_clube_escudo = "";
											$clube_escudo45x45 = "";
											if ($jogador->{"clube_id"} != 1 && $jogador->{"clube_id"} !== null) {
												$clube_escudo45x45 = $atletas->{"clubes"}->{$jogador->{"clube_id"}}->{"escudos"}->{"45x45"};

												if (isset($clube_escudo45x45) && !empty($clube_escudo45x45)) {
													$athlete_clube_escudo = $clube_escudo45x45;
												}
											} else {
												$athlete_clube_escudo = "img/escudos/no-escudo.png";
											}

											$athlete_posicao = $atletas->{"posicoes"}->{$jogador->{"posicao_id"}}->{"nome"};
											$athlete_idx = idx_pos(substr($athlete_posicao,0,1));
											$athlete_apelido = $jogador->{"apelido"};
											$athlete_pontos = (float)$pontuados->{"atletas"}->{$jogador->{"atleta_id"}}->{"pontuacao"};

											$isCapitao = "false";
											if($jogador->{"atleta_id"} == $atletas->{"capitao_id"}) {
												$athlete_pontos = $athlete_pontos * 2;
												$isCapitao = "true";
											}

											$pont_total = $pont_total + $athlete_pontos;

											$estilo_pontos = "";
											if($athlete_pontos == 0) {
												$estilo_pontos = "pont_zerado";
											} else if($athlete_pontos > 0) {
												$estilo_pontos = "pont_pos";
											} else if($athlete_pontos < 0) {
												$estilo_pontos = "pont_neg";
											}

											$list_atletas .= '{"index" : "'.$athlete_idx.'", "escudo" : "'.$athlete_clube_escudo.'", "posicao": "'. substr($athlete_posicao,0,1).'", "nome": "'.$athlete_apelido.'", "pontuacao": "'.number_format($athlete_pontos, 2, ',', '.').'", "capitao": '.$isCapitao.', "css_pont": "'.$estilo_pontos.'"}, ';
										} else {
											echo '{"succeed": false, "errno": 32008, "title": "Houveu um erro ao consultar as parcias do clube!", "erro": "Atleta do clube não possui informações para serem exibidas!"}';
											break;
							 			}
									}
									$list_atletas = substr($list_atletas, 0, -2);

									echo '{"succeed": true, "time": "'.$time.'", "escudo": "'.$escudo.'", "patrimonio": "'.$patrimonio.'", "pont_total": "'.number_format($pont_total, 2, ',', '.').'", "atletas": [' . $list_atletas . ']}';	
					 			} else {
									echo '{"succeed": false, "errno": 32007, "title": "Houveu um erro ao consultar as parcias do clube!", "erro": "Não foram encontrados jogadores na escalação do time!"}';
									break;
					 			}
					 		}
					 		else {
								echo '{"succeed": false, "errno": 32001, "title": "Houveu um erro ao consultar as parcias do clube!", "erro": "'.$atletas->{'mensagem'}.'"}';
								break;
				 			}
						}
			 		}
			 	} else {
					echo '{"succeed": false, "errno": 32002, "title": "Time não encontrado!", "erro": "O time que você deseja consultar as parcias não foi encontrado no sistema!"}';
					break;
				}
			} else {
				echo '{"succeed": false, "errno": 32003, "title": "Não é possível consultar as parcias do time!", "erro": "O mercado do Cartola FC precisa estar fechado para consultar as parciais do time! <br />Status atual do mercado: <b>'.cartola_dict("mercado_status", $status_mercado->{"status_mercado"}).'</b>"}';
				break;
			}

        	break;

	    default:
	       echo '{"succeed": false, "errno": 32004, "title": "Ação não definida!", "erro": "Não foi definida a ação para a requisição. Favor contatar o administrador da página!"}';
	}
} else {
	echo '{"succeed": false, "errno": 32005, "title": "Ação não definida!", "erro": "Não foi definida a ação para a requisição. Favor contatar o administrador da página!"}';
}
?>