<?php
require_once("connect.php");

// if (!isset($_SESSION["usu_id"]) || empty($_SESSION["usu_id"]) || 
// 	!isset($_SESSION['usu_nivel']) || empty($_SESSION["usu_nivel"]) || 
// 	$_SESSION["usu_id"] == "0")
// 	header('Location: ../login');

$temporada = $_SESSION["temporada_atual"];
$rodada = $_SESSION["rodada_site"];

try {
	$list_times = "[";

	$destaqueslist = $conn->query("SELECT * 
									 FROM vw_destaques_rodada 
									WHERE temporada = $temporada 
									  AND rodada <= $rodada") or trigger_error($conn->error);
	if($destaqueslist && $destaqueslist->num_rows > 0) {
		while($destaques = $destaqueslist->fetch_object()) {
            $escudo = "no-escudo.png";
            if(file_exists("../img/escudos/$destaques->escudo"))
            	$escudo = $destaques->escudo;

            $isMyTeam = "false";
            if($_SESSION["usu_time"] == $destaques->id_time)
            	$isMyTeam = "true";
		                
			$list_times .= '{"rodada": ' . $destaques->desc_rodada . ', "posicao": ' . $destaques->posicao . ', "escudo": "' . $escudo . '", "time": "' . $destaques->time . '", "pontuacao": ' . $destaques->pontuacao . ', "isMyTeam": ' . $isMyTeam . '}, ';
		}

		$list_times = substr($list_times, 0, -2);
	}
	$list_times .= "]";
	echo '{"succeed": true, "list": ' . $list_times . '}';
	exit();
} catch(Exception $e) {
	echo '{"succeed": false, "errno": 16001, "title": "Erro ao carregar os dados!", "erro": "Ocorreu um erro ao carregar os dados: ' . $e->getMessage() . '"}';
	exit();
}
?>