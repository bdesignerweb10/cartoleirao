<?php
function sendRequest($path, $options = array()){
  if($options['body']){
    $c = curl_init();
    curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($c, CURLOPT_URL, $options['base'] . $path);
    curl_setopt($c, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($c, CURLOPT_POST, true);
    curl_setopt($c, CURLOPT_POSTFIELDS, json_encode($options['body']));

    $result = curl_exec($c);

    /* Check for 404 (file not found). */
    $httpCode = curl_getinfo($c, CURLINFO_HTTP_CODE);
    // Check the HTTP Status code
    switch ($httpCode) {
        case 200:
            $error_status = "200: Success";
            return ($result);
            break;
        case 404:
            $error_status = "404: API Not found";
            break;
        case 500:
            $error_status = "500: servers replied with an error.";
            break;
        case 502:
            $error_status = "502: servers may be down or being upgraded. Hopefully they'll be OK soon!";
            break;
        case 503:
            $error_status = "503: service unavailable. Hopefully they'll be OK soon!";
            break;
        default:
            $error_status = "Undocumented error: " . $httpCode . " : " . curl_error($c);
            break;
    }
    curl_close($c);
    echo $error_status;
    die;
  } else if(isset($options['token'])){
    if (isset($options["api"]) && $options["api"] === "liga") {
      // $orderBy: campeonato, turno, mes, rodada, patrimonio
      $orderBy = "";
      if (isset($options["orderBy"]) && $options["orderBy"] != "") {
        $orderBy = "?orderBy=". $options["orderBy"];
      }
      // $page: 1, 2, 3...
      $page = "";
      if (isset($options["page"]) && $options["page"] != "") {
        if (!array_key_exists("orderBy", $options)) {
          $page = "?page=". $options["page"];
        } else {
          $page = "&page=". $options["page"];
        }
      }
      $url = "https://api.cartolafc.globo.com/auth/liga/". $options["liga_slug"] . $orderBy . $page;      
    }
    else if (isset($options["api"]) && $options["api"] === "atleta-pontuacao") {
      $url = "https://api.cartolafc.globo.com/auth/mercado/atleta/". $options["atleta_id"] ."/pontuacao";
    }
    else {
      $url = $options['base'] . $path;
    }

    $json = exec("curl -X GET ". $url ." -H 'x-glb-token: ". $options['token'] ."'");
    return ($json);
  } else {
    $json = exec("curl -X GET " . $options['base'] . $path);
    return ($json);
  }
}

function login($login, $password){
  $body = array('payload' => array(
    'email' => $login,
    'password' => $password,
    'serviceId' => 4728
  ));

  return json_decode(sendRequest('authentication', array(
    'base' => 'https://login.globo.com/api/',
    'body' => $body
  )));
}

function api($path, $options = array()){
  $opts = array(
    'body' => false,
    'base' => 'https://api.cartolafc.globo.com/'
  );

  if(count($options) > 0) {
    $opts = $opts + $options;
  }

  if(strpos($path, "auth") !== FALSE) {
    $auth = login($opts["login"], $opts["senha"]);
    unset($opts["login"]);
    unset($opts["senha"]);
    $opts += array('token' => $auth->{"glbId"});
  }

  $results = sendRequest($path, $opts);

  if(trim($results) == '404 page not found') {
    header('HTTP/1.0 404 Not Found');
  }

  return json_decode($results);
}

// require_once("../conn.php");
// $status_mercado = api("mercado/status");

// print "<b>Status Mercado:</b> " . cartola_dict("mercado_status", $status_mercado->{"status_mercado"});
// print '<br />';
// print ("<b>Partida rodada #". $status_mercado->{"rodada_atual"} . "</b>");
// print '<br />';
// print '<br />';
// $ligas = api("auth/ligas", array('login' => "phmpilz@hotmail.com", 'senha' => "23@Wsx89(Nji"));
  
// foreach($ligas->{"ligas"} as $l => $liga) {
//   if($liga->{"patrocinador"} == false && $liga->{"time_dono_id"} == 13908998) {
//     //var_dump($liga);
//     $cartola = api("auth", array('login' => "phmpilz@hotmail.com", 
//                      'senha' => "23@Wsx89(Nji", 
//                      'api' => "liga",
//                      'liga_slug' => $liga->{"slug"}));
//     foreach($cartola->{"times"} as $t => $time) {
      
//       print ("<b>" . $time->{"nome"} . ' - ' . $time->{"nome_cartola"} . "</b><br />");
//       print ("Slug: " . $time->{"slug"} . "<br /><br />");

//       var_dump($time);
//       print '<br />';
//       print '<br />';

//       //TODO: API PARA PEGAR A PONTUACAO
//       print ("<b>Patrimonio:</b> C$ " . number_format((float)$time->{"patrimonio"}, 2, ',', '.') . "<br />");
//       print ("<b>Posição rodada: </b> " . (!empty($time->{"ranking"}->{"rodada"}) ? $time->{"ranking"}->{"rodada"} : "0") . "º lugar<br />");
//       print ("<b>Posição mês: </b> " . (!empty($time->{"ranking"}->{"mes"}) ? $time->{"ranking"}->{"mes"} : "0") . "º lugar<br />");
//       print ("<b>Posição turno: </b> " . (!empty($time->{"ranking"}->{"turno"}) ? $time->{"ranking"}->{"turno"} : "0") . "º lugar<br />");
//       print ("<b>Posição campeonato: </b> " . (!empty($time->{"ranking"}->{"campeonato"}) ? $time->{"ranking"}->{"campeonato"} : "0") . "º lugar<br /><br />");
//       print ("<b>Pontuação rodada: </b> " . (!empty($time->{"pontos"}->{"rodada"}) ? $time->{"pontos"}->{"rodada"} : "0") . " pts.<br />");
//       print ("<b>Pontuação mês: </b> " . (!empty($time->{"pontos"}->{"mes"}) ? $time->{"pontos"}->{"mes"} : "0") . " pts.<br />");
//       print ("<b>Pontuação turno: </b> " . (!empty($time->{"pontos"}->{"turno"}) ? $time->{"pontos"}->{"turno"} : "0") . " pts.<br />");
//       print ("<b>Pontuação campeonato: </b> " . (!empty($time->{"pontos"}->{"campeonato"}) ? $time->{"pontos"}->{"campeonato"} : "0") . " pts.");
//       print '<br />';
//       print '<br />';
//       $atletas = api("time/slug/". $time->{"slug"});
//       if(!isset($atletas->{"mensagem"}) || empty($atletas->{"mensagem"})) {
//         if(count($atletas->{"atletas"}) > 0) {
//           foreach($atletas->{"atletas"} as $j => $jogador) {
//             // atleta tem info para exibir
//             if ($jogador->{"apelido"} != "") {
//               /*********************************************************/
//               // escudo clube
//               $athlete_clube_escudo = "";
//               $clube_escudo45x45 = "";
//               // se o clube_id for diferente de 1, que é 'outros' na API, exibe o escudo do time.
//               if ($jogador->{"clube_id"} != 1 && $jogador->{"clube_id"} !== null) {
//                 $clube_escudo45x45 = $atletas->{"clubes"}->{$jogador->{"clube_id"}}->{"escudos"}->{"45x45"};
//                 if (isset($clube_escudo45x45) && !empty($clube_escudo45x45)) {
//                   $athlete_clube_escudo = "<img src='" . $clube_escudo45x45 . "'>";
//                 }
//               }
//               // clube_id é igual a 1 (outros), exibe escudo fallback.
//               else {
//                 $athlete_clube_escudo = "<img src='images/emptystate_escudo.svg'>";
//               }
//               /*********************************************************/
//               /*********************************************************/
//               // atletas foto
//               $atleta_foto = $jogador->{"foto"};
//               $atleta_foto140x140 = "";
//               if (isset($atleta_foto) && !empty($atleta_foto)) {
//                 $atleta_foto140x140 = "<img src='" . str_replace("FORMATO", "140x140", $atleta_foto) . "'>";
//               } else {
//                 $atleta_foto140x140 = "<img src='images/foto-jogador.svg'>";
//               }
//               /*********************************************************/
//               /*********************************************************/
//               // atleta posicao
//               $athlete_posicao = $atletas->{"posicoes"}->{$jogador->{"posicao_id"}}->{"nome"};
//               /*********************************************************/
//               /*********************************************************/
//               // atleta apelido
//               $athlete_apelido = $jogador->{"apelido"};
//               /*********************************************************/
//               /*********************************************************/
//               // atletas pontuacao
//               $athlete_pontos = number_format((float)$jogador->{"pontuacao"}, 2, ',', '.');
//               /*********************************************************/
//               echo "<div id='" . $jogador->{"atleta_id"} . " class='row athlete_wrapper'>
//               <div class='athlete_clube'>" . $athlete_clube_escudo . "</div>
//               <div class='athlete_foto'>" . $atleta_foto140x140 . "</div>
//               <div class='athlete_apelido_label'>" . $athlete_apelido . "</div>
//               <div class='athlete_posicao_label'>" . $athlete_posicao . "</div>
//               <div class='statistics_wrapper'>
//               <div class='statistics'>
//               <span class='athlete_val'>" . $athlete_pontos . "</span>
//               <span class='athlete_label'>" . cartola_dict("athlete_score_current") . "</span>
//               </div>
//               </div>
//               </div>";
//             }
//           }
//         } else {
//           print "Mensagem: Não foram encontrados jogadores na escalação do time!";
//         }
//       }
//       else {
//         print "Mensagem: " . $atletas->{'mensagem'};
//       }
//       print '<br />';
//       print '<br />';
//       print '<br />';
//     }
//   }
// }
?>