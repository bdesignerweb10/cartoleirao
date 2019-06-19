<?php
require_once("connect.php");
require_once("acts.cartola.php");

// if (!isset($_SESSION["usu_id"]) || empty($_SESSION["usu_id"]) || 
// 	!isset($_SESSION['usu_nivel']) || empty($_SESSION["usu_nivel"]) || 
// 	$_SESSION["usu_id"] == "0")
// 	header('Location: ../login');

$temporada = $_SESSION["temporada_atual"];
$rodada = $_SESSION["rodada_site"];

if(isset($_GET['act']) && !empty($_GET['act'])) {
	switch ($_GET['act']) {
	    case 'listagem':
			try {
				$destaqueslist = $conn->query("SELECT * 
												 FROM vw_desempenho_geral 
												WHERE temporada = $temporada 
											 ORDER BY total_pontos DESC") or trigger_error($conn->error);
				if($destaqueslist && $destaqueslist->num_rows > 0) {
					$list_times = "";
					$pontuados = api("atletas/pontuados");

					while($destaques = $destaqueslist->fetch_object()) {
						$parcial = "";
						$posicao = "";

						$qryselposicao = $conn->query("SELECT COALESCE(posicao_liga, 0) AS posicao_liga
														 FROM tbl_times_temporadas 
														WHERE id_times = $destaques->id_time
														  AND id_anos = $temporada
														  AND id_rodadas = $rodada LIMIT 1") or trigger_error($conn->error);
				    	if($qryselposicao && $qryselposicao->num_rows > 0) {
				        	while($pos = $qryselposicao->fetch_object()) {
				        		$posicao = $pos->posicao_liga;
				        	}
				        }

						$atletas = api("time/slug/". $destaques->slug_cartola);

						if(!isset($atletas->{"mensagem"}) || empty($atletas->{"mensagem"})) {
				 			if(count($atletas->{"atletas"}) > 0) {
								$pont_total = (float)0.0;
								foreach($atletas->{"atletas"} as $j => $jogador) {
									if ($jogador->{"apelido"} != "") {
										$athlete_pontos = (float)$pontuados->{"atletas"}->{$jogador->{"atleta_id"}}->{"pontuacao"};

										if($jogador->{"atleta_id"} == $atletas->{"capitao_id"}) {
											$athlete_pontos = $athlete_pontos * 2;
										}

										$pont_total = $pont_total + $athlete_pontos;
									} else {
										$parcial = 0;
						 			}
								}

								$parcial = $pont_total;
				 			} else {
								$parcial = 0;
				 			}
				 		}
				 		else {
							$parcial = 0;
			 			}

			 			$parcial_total = (float)$destaques->total_pontos + $parcial;

			            $isMyTeam = "false";
			            if($_SESSION["usu_time"] == $destaques->id_time)
			            	$isMyTeam = "true";

						$list_times .= '{"id": ' . $destaques->id_time * $_SESSION["fake_id"] . ', "posicao": ' . $posicao . ', "escudo": "' . $destaques->escudo . '", "time": "' . $destaques->time . '", "pontuacao": ' . $destaques->total_pontos . ', "parcial": ' . number_format($parcial, 2, '.', ',') . ', "parcial_total": ' . str_replace(',', '', number_format($parcial_total, 2, '.', ',')) . ', "isMyTeam": ' . $isMyTeam . '}, ';
					}

					$list_times = substr($list_times, 0, -2);
				}
				echo '{"succeed": true, "list": [' . $list_times . ']}';
				exit();
			} catch(Exception $e) {
				echo '{"succeed": false, "errno": 15001, "title": "Erro ao carregar os dados!", "erro": "Ocorreu um erro ao carregar os dados: ' . $e->getMessage() . '"}';
				exit();
			}
	        break;
	        
	    case 'scouts':
			$status_mercado = api("mercado/status");

			if ($status_mercado->{"status_mercado"} == 2) {

				if(!isset($_GET['idtime']) || empty($_GET['idtime'])) {
					echo '{"succeed": false, "errno": 15004, "title": "Parâmetro não encontrado!", "erro": "Parâmetro do ID do time não enviado! Favor contatar o administrador mostrando o erro!"}';
				}

				$id = $_GET['idtime'] / $_SESSION["fake_id"];

				$qrytime = $conn->query("SELECT t.nome_time AS time, t.slug_cartola AS slug, t.escudo_time AS escudo, t.patrimonio AS patrimonio
							               FROM tbl_times t
									  LEFT JOIN tbl_inscricao i ON i.id_times = t.id
											AND i.id_anos = $temporada
										  WHERE t.id = $id") or 
											trigger_error("15005 - " . $conn->error);

				if ($qrytime && $qrytime->num_rows > 0) {
					while($t = $qrytime->fetch_object()) {
						if(!isset($t->slug) || empty($t->slug) || $t->slug == null) {
							echo '{"succeed": false, "errno": 15006, "title": "Slug do Cartola FC não cadastrado!", "erro": "O time que você deseja consultar as parciais no Cartola FC não possui SLUG cadastrado. Favor contatar o administrador do sistema informando o erro!"}';
							break;
						} else {
			                $escudo = "no-escudo.png";
			                if(file_exists("../img/escudos/$t->escudo"))
			                	$escudo = $t->escudo;

			                $patrimonio = number_format((float)"0", 2, ',', '.');
			                if(isset($t->patrimonio) && !empty($t->patrimonio) && $t->patrimonio != null) {
			                	$patrimonio = number_format((float)$t->patrimonio, 2, ',', '.');
			                }

							$atletas = api("time/slug/". $t->slug);
							$pontuados = api("atletas/pontuados");

					 		if(!isset($atletas->{"mensagem"}) || empty($atletas->{"mensagem"})) {
					 			if(count($atletas->{"atletas"}) > 0) {
									$list_atletas = "";
									$pont_total = (float)0.0;

									foreach($atletas->{"atletas"} as $j => $jogador) {
										if ($jogador->{"apelido"} != "") {
											$atleta_foto = $jogador->{"foto"};
											$atleta_foto140x140 = "";
											if (isset($atleta_foto) && !empty($atleta_foto)) {
												$atleta_foto140x140 = str_replace("FORMATO", "140x140", $atleta_foto);
											} else {
												$atleta_foto140x140 = "img/no-foto.png";
											}

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

											$athlete_posicao = strtoupper(substr(formataNomeEscudo($atletas->{"posicoes"}->{$jogador->{"posicao_id"}}->{"nome"}),0,3));
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

											$list_atletas .= '{"index" : "'.$athlete_idx.'", "escudo" : "'.$athlete_clube_escudo.'", "foto" : "'.$atleta_foto140x140.'", "posicao": "'. $athlete_posicao .'", "nome": "'.$athlete_apelido.'", "pontuacao": "'.number_format($athlete_pontos, 2, ',', '.').'", "capitao": '.$isCapitao.', "css_pont": "'.$estilo_pontos.'"}, ';
										} else {
											echo '{"succeed": false, "errno": 15007, "title": "Houveu um erro ao consultar as parcias do clube!", "erro": "Atleta do clube não possui informações para serem exibidas!"}';
											break;
							 			}
									}
									$list_atletas = substr($list_atletas, 0, -2);

									echo '{"succeed": true, "time": "'.$t->time.'", "escudo": "'.$escudo.'", "patrimonio": "'.$patrimonio.'", "pont_total": "'.number_format($pont_total, 2, ',', '.').'", "atletas": [' . $list_atletas . ']}';	
					 			} else {
									echo '{"succeed": false, "errno": 15008, "title": "Houveu um erro ao consultar as parcias do clube!", "erro": "Não foram encontrados jogadores na escalação do time!"}';
									break;
					 			}
					 		}
					 		else {
								echo '{"succeed": false, "errno": 15009, "title": "Houveu um erro ao consultar as parcias do clube!", "erro": "'.$atletas->{'mensagem'}.'"}';
								break;
				 			}
						}
			 		}
			 	} else {
					echo '{"succeed": false, "errno": 15010, "title": "Time não encontrado!", "erro": "O time que você deseja consultar as parcias não foi encontrado no sistema!"}';
					break;
				}
			} else {
				echo '{"succeed": false, "errno": 15011, "title": "Não é possível consultar as parcias do time!", "erro": "O mercado do Cartola FC precisa estar fechado para consultar as parciais do time! Status atual do mercado: <b>'.cartola_dict("mercado_status", $status_mercado->{"status_mercado"}).'</b>"}';
				break;
			}
	        break;

	    default:
	       echo '{"succeed": false, "errno": 15002, "title": "Ação não definida!", "erro": "Não foi definida a ação para a requisição. Favor contatar o administrador da página!"}';
	}
} else {
	echo '{"succeed": false, "errno": 15003, "title": "Ação não definida!", "erro": "Não foi definida a ação para a requisição. Favor contatar o administrador da página!"}';
}
?>