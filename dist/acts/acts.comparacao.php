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

        case 'dados_time':
			$time = str_replace('"', '', $_POST["nome_time"]);

			$qrytime = $conn->query("SELECT t.id AS id_time, t.slug_cartola AS slug, t.escudo_time AS escudo, t.patrimonio AS patrimonio
						               FROM tbl_times t
								  LEFT JOIN tbl_inscricao i ON i.id_times = t.id
										AND i.id_anos = $temporada
									  WHERE UPPER(t.nome_time) LIKE '%" . strtoupper($time) . "%'") or 
										trigger_error("33008 - " . $conn->error);

			if ($qrytime && $qrytime->num_rows > 0) {
				while($t = $qrytime->fetch_object()) {
					if(!isset($t->slug) || empty($t->slug) || $t->slug == null) {
						echo '{"succeed": false, "errno": 32006, "title": "Slug do Cartola FC não cadastrado!", "erro": "O time que você deseja consultar as parciais no Cartola FC não possui SLUG cadastrado. Favor contatar o administrador do sistema informando o erro!"}';
						break;
					} else {
		                $escudo = "no-escudo.png";
		                $idtime = $t->id_time;

		                $max_pontos = 0;
		                $min_pontos = 0;
		                $media = 0;
		                $tot_pontos = 0;
		                $posicao = 0;
		                $ult_pontos = 0;

		                if(file_exists("../img/escudos/$t->escudo"))
		                	$escudo = $t->escudo;

		                $patrimonio = number_format(0, 2, ',', '.');
		                if(isset($t->patrimonio) && !empty($t->patrimonio) && $t->patrimonio != null) {
		                	$patrimonio = number_format($t->patrimonio, 2, ',', '.');
		                }

						$qrytemporada = $conn->query("SELECT MAX(pontuacao) AS max_pontos, MIN(pontuacao) AS min_pontos, 
															 SUM(pontuacao) AS tot_pontos, ROUND(AVG(pontuacao), 2) AS media
			      									    FROM tbl_times_temporadas tt
												  INNER JOIN tbl_anos a ON a.id = tt.id_anos
				 									   WHERE tt.id_times = $idtime
				   						  				 AND tt.id_anos  = $temporada
													     AND tt.id_rodadas <= " . $_SESSION["rodada_site"] . "
			  						 				GROUP BY a.descricao") or trigger_error($conn->error);
						if($qrytemporada && $qrytemporada->num_rows > 0) {
							while($temp = $qrytemporada->fetch_object()) {
				                $max_pontos = $temp->max_pontos;
				                $min_pontos = $temp->min_pontos;
				                $media = $temp->media;
				                $tot_pontos = $temp->tot_pontos;
							}
						}

						$qryselposicao = $conn->query("SELECT COALESCE(posicao_liga, 0) AS posicao_liga, pontuacao
														 FROM tbl_times_temporadas 
														WHERE id_times = $idtime
														  AND id_anos = $temporada
														  AND id_rodadas = " . $_SESSION["rodada_site"] . " LIMIT 1") or trigger_error($conn->error);
			        	if($qryselposicao && $qryselposicao->num_rows > 0) {
				        	while($pos = $qryselposicao->fetch_object()) {
	        					$posicao = $pos->posicao_liga;
				        		$ult_pontos = $pos->pontuacao;
				        	}
				        }

						$media_g = (float)0.0;
						$media_l = (float)0.0;
						$media_z = (float)0.0;
						$media_m = (float)0.0;
						$media_a = (float)0.0;
						$media_t = (float)0.0;

						$count_g = 0;
						$count_l = 0;
						$count_z = 0;
						$count_m = 0;
						$count_a = 0;
						$count_t = 0;

		                $qryselrodadaant = $conn->query("SELECT r.descricao AS rodada 
														   FROM tbl_temporadas t
												     INNER JOIN tbl_rodadas r ON r.id = t.id_rodadas
														  WHERE t.id_anos = " . $temporada . "
														    AND t.id_rodadas <= " . $_SESSION["rodada_site"] . "
													   ORDER BY t.id_rodadas ASC") or trigger_error($conn->error);

						if ($qryselrodadaant && $qryselrodadaant->num_rows > 0) {
					        while($rodadaant = $qryselrodadaant->fetch_object()) {
								$atletas = api("time/slug/". $t->slug . "/" . $rodadaant->rodada);

								foreach($atletas->{"atletas"} as $j => $jogador) {
									if ($jogador->{"apelido"} != "") {
										$athlete_posicao = $atletas->{"posicoes"}->{$jogador->{"posicao_id"}}->{"abreviacao"};
										$athlete_pontos = (float)$jogador->{"pontos_num"};

										if($jogador->{"atleta_id"} == $atletas->{"capitao_id"}) {
											$athlete_pontos = $athlete_pontos * 2;
										}

										if($athlete_posicao == "gol") {
											$media_g = $media_g + $athlete_pontos;				
											$count_g++;
										}
										if($athlete_posicao == "lat") {
											$media_l = $media_l + $athlete_pontos;
											$count_l++;
										}
										if($athlete_posicao == "zag") {
											$media_z = $media_z + $athlete_pontos;
											$count_z++;
										}
										if($athlete_posicao == "mei") {
											$media_m = $media_m + $athlete_pontos;
											$count_m++;
										}
										if($athlete_posicao == "ata") {
											$media_a = $media_a + $athlete_pontos;
											$count_a++;
										}
										if($athlete_posicao == "tec") {
											$media_t = $media_t + $athlete_pontos;
											$count_t++;
										}
									}
								}
					        }
					    }

						$media_g = number_format($media_g / $count_g, 2, '.', '');
						$media_l = number_format($media_l / $count_l, 2, '.', '');
						$media_z = number_format($media_z / $count_z, 2, '.', '');
						$media_m = number_format($media_m / $count_m, 2, '.', '');
						$media_a = number_format($media_a / $count_a, 2, '.', '');
						$media_t = number_format($media_t / $count_t, 2, '.', '');

						echo '{"succeed": true, "time": "'.$time.'", "escudo": "'.$escudo.'", "patrimonio": "'.$patrimonio.'", "max_pontos": ' . $max_pontos . ', "min_pontos": ' . $min_pontos . ', "media": ' . $media . ', "tot_pontos": ' . $tot_pontos . ', "ult_pontos": ' . $ult_pontos . ', "posicao": ' . $posicao . ', "media_g": ' . $media_g . ', "media_l": ' . $media_l . ', "media_z": ' . $media_z . ', "media_m": ' . $media_m . ', "media_a": ' . $media_a . ', "media_t": ' . $media_t . '}';	
					}
		 		}
		 	} else {
				echo '{"succeed": false, "errno": 33002, "title": "Time não encontrado!", "erro": "O time que você deseja consultar as parcias não foi encontrado no sistema!"}';
				break;
			}

        	break;

	    default:
	       echo '{"succeed": false, "errno": 33004, "title": "Ação não definida!", "erro": "Não foi definida a ação para a requisição. Favor contatar o administrador da página!"}';
	}
} else {
	echo '{"succeed": false, "errno": 33005, "title": "Ação não definida!", "erro": "Não foi definida a ação para a requisição. Favor contatar o administrador da página!"}';
}
?>