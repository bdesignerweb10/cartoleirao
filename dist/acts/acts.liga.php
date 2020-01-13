<?php
require_once("connect.php");

// if (!isset($_SESSION["usu_id"]) || empty($_SESSION["usu_id"]) || 
// 	!isset($_SESSION['usu_nivel']) || empty($_SESSION["usu_nivel"]) || 
// 	$_SESSION["usu_id"] == "0")
// 	header('Location: ../login');

$temporada = $_SESSION["temporada_atual"];
$rodada = $_SESSION["rodada_site"];

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
	echo '{"succeed": false, "errno": 15001, "title": "Erro ao carregar os dados!", "erro": "Ocorreu um erro ao carregar os dados: ' . $e->getMessage() . '"}';
	exit();
}
?>