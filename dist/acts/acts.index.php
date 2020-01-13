<?php
require_once("connect.php");
require_once("acts.cartola.php");

$temporada = $_SESSION["temporada_atual"];
$desc_temp = $_SESSION["temp_atual"];
$rodada = $_SESSION["rodada_site"];
$id_time = $_SESSION["usu_time"];

if(isset($_GET['act']) && !empty($_GET['act'])) {
	switch ($_GET['act']) {
	    case 'destaques-rodada':
		    try {
				$list_times = "[";

				$destaqueslist = $conn->query("SELECT * 
												 FROM vw_destaques_rodada 
												WHERE temporada = $temporada 
												  AND rodada = $rodada LIMIT 4") or trigger_error($conn->error);
	        	if($destaqueslist && $destaqueslist->num_rows > 0) {
		        	while($destaques = $destaqueslist->fetch_object()) {
		                $escudo = "no-escudo.png";
		                if(file_exists("../img/escudos/$destaques->escudo"))
		                	$escudo = $destaques->escudo;

		                $isMyTeam = "false";
		                if($_SESSION["usu_time"] == $destaques->id_time)
		                	$isMyTeam = "true";

						$list_times .= '{"posicao": ' . $destaques->posicao . ', "escudo": "' . $escudo . '", "time": "' . $destaques->time . '", "pontuacao": ' . $destaques->pontuacao . ', "isMyTeam": ' . $isMyTeam . '}, ';
		        	}

					$list_times = substr($list_times, 0, -2);
		        }
				$list_times .= "]";
				echo '{"succeed": true, "list": ' . $list_times . '}';
				exit();
			} catch(Exception $e) {
				echo '{"succeed": false, "errno": 13003, "title": "Erro ao carregar os dados!", "erro": "Ocorreu um erro ao carregar os dados: ' . $e->getMessage() . '"}';
				exit();
			}
	        break;

	    case 'desempenho-geral':
			try {
		    	$limit = "";
				if(isset($_GET['limit']) && $_GET['limit']) {
					$limit = "LIMIT " . $_GET['limit'];
				}
				$list_times = "[";

				$destaqueslist = $conn->query("SELECT * 
												 FROM vw_desempenho_geral 
												WHERE temporada = $temporada 
											 ORDER BY total_pontos DESC " . $limit) or trigger_error($conn->error);
	        	if($destaqueslist && $destaqueslist->num_rows > 0) {
		        	while($destaques = $destaqueslist->fetch_object()) {
		        		$posicao = "";
		        		$pontuacao = "";
		        		$posantiga = "";
		        		$variacao = "";

						$qryselposicao = $conn->query("SELECT COALESCE(posicao_liga, 0) AS posicao_liga, pontuacao
														 FROM tbl_times_temporadas 
														WHERE id_times = $destaques->id_time
														  AND id_anos = $temporada
														  AND id_rodadas = $rodada LIMIT 1") or trigger_error($conn->error);
			        	if($qryselposicao && $qryselposicao->num_rows > 0) {
				        	while($pos = $qryselposicao->fetch_object()) {
				        		$posicao = $pos->posicao_liga;
				        		$pontuacao = $pos->pontuacao;
				        	}
				        }

				        $hasmaxpont = "false";
				        $qryselmaxpont = $conn->query("SELECT id_times, MAX(pontuacao)
														 FROM tbl_times_temporadas 
														WHERE id_anos = $temporada 
													 GROUP BY id_times
													 ORDER BY MAX(pontuacao) DESC LIMIT 1") or trigger_error($conn->error);
				    	if($qryselmaxpont && $qryselmaxpont->num_rows > 0) {
				        	while($maxpont = $qryselmaxpont->fetch_object()) {
				        		if ($maxpont->id_times == $destaques->id_time)
				        			$hasmaxpont = "true";
				        	}
				        }

						$qryposanterior = $conn->query("SELECT COALESCE(posicao_liga, 0) AS posicao_liga
														  FROM tbl_times_temporadas 
														 WHERE id_times = $destaques->id_time
														   AND id_anos = $temporada
														   AND id_rodadas < $rodada 
													  ORDER BY id_rodadas DESC LIMIT 1") or trigger_error($conn->error);
			        	if($qryposanterior && $qryposanterior->num_rows > 0) {
				        	while($posant = $qryposanterior->fetch_object()) {
				        		$posantiga = $posant->posicao_liga;
				        	}
				        }

				        if((intval($posantiga) - intval($posicao)) > 0) {
				        	$variacao = "+" . (intval($posantiga) - intval($posicao));
				        }
				        else if((intval($posantiga) - intval($posicao)) < 0) {
				        	$variacao = (intval($posantiga) - intval($posicao));
				        }
				        else {
				        	$variacao = "-";
				        }
				        
		                $escudo = "no-escudo.png";
		                if(file_exists("../img/escudos/$destaques->escudo"))
		                	$escudo = $destaques->escudo;

		                $isMyTeam = "false";
		                if($_SESSION["usu_time"] == $destaques->id_time)
		                	$isMyTeam = "true";

						$list_times .= '{"posicao": ' . $posicao . ', "escudo": "' . $escudo . '", "time": "' . $destaques->time . '", "pontuacao": ' . $destaques->total_pontos . ', "pont_ult_rodada": ' . $pontuacao . ', "variacao": "' . $variacao . '", "isMyTeam": ' . $isMyTeam . ', "hasMaxPont": ' . $hasmaxpont . '}, ';
		        	}

					$list_times = substr($list_times, 0, -2);
		        }
				$list_times .= "]";
				echo '{"succeed": true, "list": ' . $list_times . '}';
				exit();
			} catch(Exception $e) {
				echo '{"succeed": false, "errno": 13004, "title": "Erro ao carregar os dados!", "erro": "Ocorreu um erro ao carregar os dados: ' . $e->getMessage() . '"}';
				exit();
			}
	        break;

        case 'mata-mata-andamento':
	        try {
				$list_mata = "[";

				$matamatalist = $conn->query("SELECT * 
												 FROM vw_mata_mata_andamento 
												WHERE temporada = $temporada 
												  AND rodada >= $rodada") or trigger_error($conn->error);
	        	if($matamatalist && $matamatalist->num_rows > 0) {
		        	while($matamata = $matamatalist->fetch_object()) {
		        		if($matamata->rodada > $_SESSION["rodada"]) {
		        			$matamata->fase = "Aguardando início";
		        			$matamata->cor_fase = "bg-info";
		        		}
						$list_mata .= '{"nome": "' . $matamata->mata_mata . '", "fase": "' . $matamata->fase . '", "cor_fase": "' . $matamata->cor_fase . '"}, ';
		        	}

					$list_mata = substr($list_mata, 0, -2);
		        }
				$list_mata .= "]";
				echo '{"succeed": true, "list": ' . $list_mata . '}';
				exit();
			} catch(Exception $e) {
				echo '{"succeed": false, "errno": 13005, "title": "Erro ao carregar os dados!", "erro": "Ocorreu um erro ao carregar os dados: ' . $e->getMessage() . '"}';
				exit();
			}
	        break;

        case 'desempenho-rodada':
	        try {

	    		$labelslist = "[";

				$rodadaslist = $conn->query("SELECT descricao FROM tbl_rodadas WHERE id <= $rodada") or trigger_error($conn->error);
	        	if($rodadaslist && $rodadaslist->num_rows > 0) {
		        	while($rodadas = $rodadaslist->fetch_object()) {
						$labelslist  .= '"' . $rodadas->descricao . '", ';
		        	}
					$labelslist = substr($labelslist, 0, -2);
		        }
				$labelslist .= "]";

				$serieslist = "";
				
	        	$where_time = "";
	        	if(isset($_SESSION["usu_time"]) && !empty($_SESSION["usu_time"]) && intval($_SESSION["usu_time"]) > 0) {
	        		$where_time = "AND t.id = " . $_SESSION["usu_time"];
	        	}

	    		$timeslist = $conn->query("SELECT t.id AS id, t.nome_time AS nome_time
										     FROM tbl_times t
									   INNER JOIN tbl_inscricao i ON i.id_times = t.id
										    WHERE t.ativo = 1
										      AND i.ativo = 1
										      AND i.id_anos = $temporada $where_time") or trigger_error($conn->error);
	        	if($timeslist && $timeslist->num_rows > 0) {
		        	while($times = $timeslist->fetch_object()) {
		        		if((!isset($_SESSION["usu_time"]) && empty($_SESSION["usu_time"])) || $times->id == $_SESSION["usu_time"]) {
		        			$border = '"borderWidth": 3, ';
		        		}
		        		else {
		        			$border_dash = '"borderWidth": 1, "borderDash": [2,4], ';
		        		}
						$posicoeslist = '{"label": "' . $times->nome_time . '", "fill": false, ' . $border . '"data": [';

			    		$posicoesqry = $conn->query("SELECT COALESCE(posicao_liga, 0) AS posicao_liga 
			    									   FROM tbl_times_temporadas 
												  	  WHERE id_times = $times->id 
													    AND id_anos = $temporada 
												  		AND id_rodadas <= $rodada") or trigger_error($conn->error);
			        	if($posicoesqry && $posicoesqry->num_rows > 0) {
				        	while($posicoes = $posicoesqry->fetch_object()) {
								$posicoeslist  .= '"' . $posicoes->posicao_liga . '", ';
				        	}
							$posicoeslist = substr($posicoeslist, 0, -2);
				        }
						$posicoeslist .= "]}, ";
						$serieslist .= $posicoeslist;
		        	}
					$serieslist = substr($serieslist, 0, -2);
		        }
				echo '{"succeed": true, "labels": ' . $labelslist . ', "series": [' . $serieslist . ']}';
				exit();
			} catch(Exception $e) {
				echo '{"succeed": false, "errno": 13006, "title": "Erro ao carregar os dados!", "erro": "Ocorreu um erro ao carregar os dados: ' . $e->getMessage() . '"}';
				exit();
			}
        	break;

        case 'eventos':
	        try {
	    		//$eventoslist = '{"id": 0, "title": "Campeonato Brasileiro '.$_SESSION["temp_atual"].'", "description": "Duração do maior e mais disputado campeonato do mundo! O nosso Brasileirão!", "start": "2018-04-14", "end": "2018-12-12" }, ';
	    		$eventoslist = '';

				$eventosqry = $conn->query("SELECT id, titulo, local, descricao, data
					 						  FROM tbl_eventos 
					  						 WHERE data >= NOW() 
					  						   AND ativo = 1") or trigger_error($conn->error);
	        	if($eventosqry && $eventosqry->num_rows > 0) {
		        	while($eventos = $eventosqry->fetch_object()) {
	    				$eventoslist .= '{"id": '.$eventos->id.', "title": "'.$eventos->titulo.'", "description": "Local: '.$eventos->local.' - Descrição: '.$eventos->descricao.'", "start": "'.date('Y-m-d', strtotime($eventos->data)).'T'.date('H:i:s', strtotime($eventos->data)).'", "color": "#5893d6"}, ';
		        	}
		        }

		        $jsonUOL = json_decode(exec("curl -X GET http://jsuol.com.br/c/monaco/utils/gestor/commons.js?file=commons.uol.com.br/sistemas/esporte/modalidades/futebol/campeonatos/dados/".$desc_temp."/30/dados.json"));

			    if(isset($jsonUOL->{"fases"}) && isset($jsonUOL->{"agrupamento"}) && isset($jsonUOL->{"equipes"})) {
			    	$agrupamento = $jsonUOL->{"agrupamento"}[0]->{"fases"}[0]->{"id"};
			    	$jogos = $jsonUOL->{"fases"}->{$agrupamento}->{"jogos"};
			    	$equipes = $jsonUOL->{"equipes"};
			    	
			    	$datas = $jogos->{"data"};

					if(count($datas) > 0) {
						foreach($datas as $d => $partidas_data) {
							if($d != "0000-00-00") {
				    			foreach($partidas_data AS $ij => $id_jogo) {
				    				$partida = $jogos->{"id"}->{$id_jogo};

									$clube_m = $equipes->{$partida->{"time1"}};
									$clube_v = $equipes->{$partida->{"time2"}};

									$m_escudo = str_replace("40x40", "20x20", $clube_m->{"brasao"});
									$m_time = $clube_m->{"sigla"};
									$mc_time = $clube_m->{"nome-comum"};
									
									$v_escudo = str_replace("40x40", "20x20", $clube_v->{"brasao"});
									$v_time = $clube_v->{"sigla"};
									$vc_time = $clube_v->{"nome-comum"};
									
									$confronto = $m_time . " x " . $v_time;
									$confrontoc = '<img src=\''.$m_escudo.'\' /> ' . $mc_time . " x " . $vc_time . ' <img src=\''.$v_escudo.'\' />';

									$local = $partida->{"estadio"};
									$cidade = $partida->{"local"};
									$data = $partida->{"data"} . "T" . str_replace("h", ":", $partida->{"horario"}) . ":00";

			    					$eventoslist .= '{"id": '.$id_jogo.', "title": "'.$confronto.'", "description": "<b>Rodada #'.$partida->{"rodada"}.'</b><br/><br/>'.$confrontoc.'<br /><b>Estádio:</b> '.$local.'<br/><b>Cidade:</b> '.$cidade.'<br /><b>Data:</b> '.date('d/m/Y H:i', strtotime($data)).'hrs", "start": "'.$data.'", "color": "#326410"}, ';
				    			}
							}
						}
					} 
			    }

				$eventoslist = substr($eventoslist, 0, -2);

				echo '{"succeed": true, "eventos": [' . $eventoslist . ']}';
				exit();
			} catch(Exception $e) {
				echo '{"succeed": false, "errno": 13006, "title": "Erro ao carregar os dados!", "erro": "Ocorreu um erro ao carregar os dados: ' . $e->getMessage() . '"}';
				exit();
			}
        	break;

        case 'resumo':
        	try {
				$list_times = "[";

				$destaqueslist = $conn->query("SELECT * 
												 FROM vw_desempenho_geral 
												WHERE temporada = $temporada 
											 ORDER BY total_pontos DESC LIMIT 6") or trigger_error($conn->error);
	        	if($destaqueslist && $destaqueslist->num_rows > 0) {
		        	while($destaques = $destaqueslist->fetch_object()) {
		                $escudo = "no-escudo.png";
		                if(file_exists("../img/escudos/$destaques->escudo"))
		                	$escudo = $destaques->escudo;

		                $hasmaxpont = "false";
		                $maxpontz = "0";

				        $qryselmaxpont = $conn->query("SELECT id_times, MAX(pontuacao) as max_pont
														 FROM tbl_times_temporadas 
														WHERE id_anos = $temporada 
													 GROUP BY id_times
													 ORDER BY MAX(pontuacao) DESC LIMIT 1") or trigger_error($conn->error);
				    	if($qryselmaxpont && $qryselmaxpont->num_rows > 0) {
				        	while($maxpont = $qryselmaxpont->fetch_object()) {
				        		if ($maxpont->id_times == $destaques->id_time)
				        			$hasmaxpont = "true";
		                			$maxpontz = $maxpont->max_pont;
				        	}
				        }

						$list_times .= '{"escudo": "' . $escudo . '", "time": "' . $destaques->time . '", "pontuacao": ' . $destaques->total_pontos . ', "hasMaxPont": ' . $hasmaxpont . ', "max_pont": ' . $maxpontz . '}, ';
		        	}

					$list_times = substr($list_times, 0, -2);
		        }
				$list_times .= "]";
				echo '{"succeed": true, "list": ' . $list_times . '}';
				exit();
			} catch(Exception $e) {
				echo '{"succeed": false, "errno": 13007, "title": "Erro ao carregar os dados!", "erro": "Ocorreu um erro ao carregar os dados: ' . $e->getMessage() . '"}';
				exit();
			}
        	break;

        case 'res-mata':
        	try {
				$list_times = "[";

				$destaqueslist = $conn->query("SELECT mm.descricao AS mata_mata, t.nome_time AS time, t.escudo_time AS escudo
      											 FROM tbl_mata_mata_confrontos mmc
										   INNER JOIN tbl_mata_mata mm ON mm.id = mmc.id_mata_mata
										   INNER JOIN tbl_times t ON t.id = mm.id_time_campeao
										   WHERE mmc.id_anos = $temporada
     									GROUP BY mmc.id_anos, mm.descricao
  										ORDER BY mmc.id_rodadas ASC") or trigger_error($conn->error);
	        	if($destaqueslist && $destaqueslist->num_rows > 0) {
		        	while($destaques = $destaqueslist->fetch_object()) {
		                $escudo = "no-escudo.png";
		                if(file_exists("../img/escudos/$destaques->escudo"))
		                	$escudo = $destaques->escudo;

						$list_times .= '{"mata_mata": "' . $destaques->mata_mata . '", "escudo": "' . $escudo . '", "time": "' . $destaques->time . '"}, ';
		        	}

					$list_times = substr($list_times, 0, -2);
		        }
				$list_times .= "]";
				echo '{"succeed": true, "list": ' . $list_times . '}';
				exit();
			} catch(Exception $e) {
				echo '{"succeed": false, "errno": 13008, "title": "Erro ao carregar os dados!", "erro": "Ocorreu um erro ao carregar os dados: ' . $e->getMessage() . '"}';
				exit();
			}
        	break;

        case 'dados-time':

    		$sqltime = $conn->query("SELECT t.escudo_time AS escudo, t.nome_time as time, t.slug_cartola AS slug, t.patrimonio as patrimonio, 
    										ROUND(SUM(tt.pontuacao), 2) AS total_pontos, 
    										ROUND(SUM(tt.pontuacao), 2) / COUNT(tt.pontuacao) AS media, 
    										MAX(tt.pontuacao) AS max_pontos, 
    										MIN(tt.pontuacao) AS min_pontos
								       FROM tbl_times t
								 INNER JOIN tbl_times_temporadas tt ON tt.id_times = t.id
								      WHERE t.id = $id_time
										AND tt.id_anos = $temporada
										AND tt.id_rodadas <= $rodada
								   GROUP BY t.escudo_time, t.nome_time") or trigger_error("13010 - " . $conn->error);

			if ($sqltime && $sqltime->num_rows > 0) {
				while($time = $sqltime->fetch_object()) {
					if(file_exists("../img/escudos/" . $time->escudo))
						$escudo = $time->escudo;
					else 
						$escudo = "no-escudo.png";

					$qryrodmaxpont = $conn->query("SELECT id_rodadas
													 FROM tbl_times_temporadas 
													WHERE id_times = $id_time
													  AND id_anos = $temporada
													  AND pontuacao = $time->max_pontos LIMIT 1") or trigger_error($conn->error);
		        	if($qryrodmaxpont && $qryrodmaxpont->num_rows > 0) {
			        	while($rodmaxpont = $qryrodmaxpont->fetch_object()) {
			        		$max_rodada = $rodmaxpont->id_rodadas;
			        	}
			        }

					$qryrodminpont = $conn->query("SELECT id_rodadas
													 FROM tbl_times_temporadas 
													WHERE id_times = $id_time
													  AND id_anos = $temporada
													  AND pontuacao = $time->min_pontos LIMIT 1") or trigger_error($conn->error);
		        	if($qryrodminpont && $qryrodminpont->num_rows > 0) {
			        	while($rodminpont = $qryrodminpont->fetch_object()) {
			        		$min_rodada = $rodminpont->id_rodadas;
			        	}
			        }

			        $total_g = (float)0.0;
					$total_l = (float)0.0;
					$total_z = (float)0.0;
					$total_m = (float)0.0;
					$total_a = (float)0.0;
					$total_t = (float)0.0;

					$maior_j = (float)0.0;
					$menor_j = (float)0.0;

					$maior_c = (float)0.0;
					$menor_c = (float)0.0;

					$isFirstJ = true;
					$isFirstC = true;

	                $qryselrodadaant = $conn->query("SELECT r.descricao AS rodada 
													   FROM tbl_temporadas t
											     INNER JOIN tbl_rodadas r ON r.id = t.id_rodadas
													  WHERE t.id_anos = $temporada
													    AND t.id_rodadas <= $rodada
												   ORDER BY t.id_rodadas ASC") or trigger_error($conn->error);

					if ($qryselrodadaant && $qryselrodadaant->num_rows > 0) {
				        while($rodadaant = $qryselrodadaant->fetch_object()) {
							$atletas = api("time/slug/". $time->slug . "/" . $rodadaant->rodada);

							foreach($atletas->{"atletas"} as $j => $jogador) {
								if ($jogador->{"apelido"} != "") {

									$athlete_posicao = $atletas->{"posicoes"}->{$jogador->{"posicao_id"}}->{"abreviacao"};
									$athlete_pontos = (float)$jogador->{"pontos_num"};

									if($jogador->{"atleta_id"} == $atletas->{"capitao_id"}) {
										$athlete_pontos = $athlete_pontos * 2;

										if($isFirstC) {
											$menor_c = $athlete_pontos;
											$isFirstC = false;
										}
										
										if($athlete_pontos > $maior_c) {
											$maior_c = $athlete_pontos;
										}
										
										if($athlete_pontos < $menor_c) {
											$menor_c = $athlete_pontos;
										}
									}
									else {
										if($isFirstJ) {
											$menor_j = $athlete_pontos;
											$isFirstJ = false;
										}
										
										if($athlete_pontos > $maior_j) {
											$maior_j = $athlete_pontos;
										}
										
										if($athlete_pontos < $menor_j) {
											$menor_j = $athlete_pontos;
										}
									}

									if($athlete_posicao == "gol") {
										$total_g = $total_g + $athlete_pontos;				
									}
									if($athlete_posicao == "lat") {
										$total_l = $total_l + $athlete_pontos;
									}
									if($athlete_posicao == "zag") {
										$total_z = $total_z + $athlete_pontos;
									}
									if($athlete_posicao == "mei") {
										$total_m = $total_m + $athlete_pontos;
									}
									if($athlete_posicao == "ata") {
										$total_a = $total_a + $athlete_pontos;
									}
									if($athlete_posicao == "tec") {
										$total_t = $total_t + $athlete_pontos;
									}
								}
							}
				        }
				    }

					// $conn->autocommit(FALSE);
				 //    $qryatualizapont = $conn->query("SELECT t.id AS id_time, t.slug_cartola AS slug_cartola,r.id as id_rodada,
				 //    									   r.descricao AS rodada
					// 						   		  FROM tbl_times_temporadas tt
	    //                                         INNER JOIN tbl_times t ON t.id = tt.id_times
					// 						    INNER JOIN tbl_rodadas r ON r.id = tt.id_rodadas
					// 						   		 WHERE tt.id_anos = $temporada") or trigger_error("26020 - " . $conn->error);
			        
			  //       if ($qryatualizapont && $qryatualizapont->num_rows > 0) {
				 //        while($timesz = $qryatualizapont->fetch_object()) {
					// 		$atletas = api("time/slug/". $timesz->slug_cartola . "/" . $timesz->rodada);

					// 		// $pontuacao = (float)0.0;
					// 		// foreach($atletas->{"atletas"} as $j => $jogador) {
					// 		// 	if ($jogador->{"apelido"} != "") {
					// 		// 		$athlete_pontos = (float)$jogador->{"pontos_num"};

					// 		// 		if($jogador->{"atleta_id"} == $atletas->{"capitao_id"}) {
					// 		// 			$athlete_pontos = $athlete_pontos * 2;
					// 		// 		}

					// 		// 		$pontuacao = $pontuacao + $athlete_pontos;
					// 		// 	}
					// 		// }

					// 		// $pontuacao = number_format($pontuacao, 2, '.', '');

					// 		$pontuacao = number_format((!empty($atletas->{"pontos"}) ? str_replace(',', '.', $atletas->{"pontos"}) : "0"), 2, '.', '');

				 //    		$qryupdpontandpo = "UPDATE tbl_times_temporadas 
					// 				  		   	   SET pontuacao = " . $pontuacao . ",
					// 						 		   usuario_id = " . $_SESSION["usu_id"] . ",
					// 						 		   alterado_em = NOW()
					// 					    	 WHERE id_anos = $temporada
					// 					       	   AND id_rodadas = $timesz->id_rodada 
					// 					       	   AND id_times = $timesz->id_time";

					// 		if ($conn->query($qryupdpontandpo) !== TRUE) {
					// 			$conn->rollback();
					// 			echo '{"succeed": false, "errno": 99999, "title": "Erro ao salvar os dados!", "erro": "Erro ao atualizar pontuacoes: ' . $qryupdpontandpo . '<br />' . $conn->error . '"}';
					// 		}

					// 		$conn->commit();
					// 	}
					// }

					$total_g = number_format($total_g, 2, '.', '');
					$total_l = number_format($total_l, 2, '.', '');
					$total_z = number_format($total_z, 2, '.', '');
					$total_m = number_format($total_m, 2, '.', '');
					$total_a = number_format($total_a, 2, '.', '');
					$total_t = number_format($total_t, 2, '.', '');

					$maior_j = number_format($maior_j, 2, '.', '');
					$menor_j = number_format($menor_j, 2, '.', '');

					$maior_c = number_format($maior_c, 2, '.', '');
					$menor_c = number_format($menor_c, 2, '.', '');

					echo '{"succeed": true, "escudo": "' . $escudo . '", "nome_time": "' . $time->time . '", "patrimonio": ' . $time->patrimonio . ', "total_pontos": ' . $time->total_pontos . ', "media": ' . $time->media . ', "max_pontos": ' . $time->max_pontos . ', "max_rodada": ' . $max_rodada . ', "min_pontos": ' . $time->min_pontos . ', "min_rodada": ' . $min_rodada . ', "total_g": ' . $total_g . ', "total_l": ' . $total_l . ', "total_z": ' . $total_z . ', "total_m": ' . $total_m . ', "total_a": ' . $total_a . ', "total_t": ' . $total_t . ', "maior_j": ' . $maior_j . ', "menor_j": ' . $menor_j . ', "maior_c": ' . $maior_c . ', "menor_c": ' . $menor_c . '}';
				}
			}
			else {
	       		echo '{"succeed": false, "errno": 13009, "title": "Clube não encontrado!", "erro": "O clube informado não foi encontrado no banco de dados! Favor contatar o administrador do site!"}';
			}

        	break;

	    default:
	       echo '{"succeed": false, "errno": 13001, "title": "Ação não definida!", "erro": "Não foi definida a ação para a requisição. Favor contatar o administrador da página!"}';
	}
} else {
	echo '{"succeed": false, "errno": 13002, "title": "Ação não definida!", "erro": "Não foi definida a ação para a requisição. Favor contatar o administrador da página!"}';
}
?>