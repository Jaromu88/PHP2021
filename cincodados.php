<?php

// Caracteres asociados a cada cara del dado
define ('UNO',    "&#9856;");
define ('DOS',    "&#9857;");
define ('TRES',   "&#9858;");
define ('CUATRO', "&#9859;");
define ('CINCO',  "&#9860;");
define ('SEIS',   "&#9861;");

$j1dado1 = rand(1, 6);
$j1dado2 = rand(1, 6);
$j1dado3 = rand(1, 6);
$j1dado4 = rand(1, 6);
$j1dado5 = rand(1, 6);

$j2dado1 = rand(1, 6);
$j2dado2 = rand(1, 6);
$j2dado3 = rand(1, 6);
$j2dado4 = rand(1, 6);
$j2dado5 = rand(1, 6);

$maxj1 = max($j1dado1, $j1dado2, $j1dado3, $j1dado4, $j1dado5);
$minj1 = min($j1dado1, $j1dado2, $j1dado3, $j1dado4, $j1dado5);
$maxj2 = max($j2dado1, $j2dado2, $j2dado3, $j2dado4, $j2dado5);
$minj2 = min($j2dado1, $j2dado2, $j2dado3, $j2dado4, $j2dado5);
$j1puntos = $j1dado1 + $j1dado2 + $j1dado3 + $j1dado4 + $j1dado5 - $maxj1 - $minj1;
$j2puntos = $j2dado1 + $j2dado2 + $j2dado3 + $j2dado4 + $j2dado5 - $maxj2 - $minj2;


// Tabla de mensajes en función del ganador
$msg = ["¡Empate !",
    " Ha ganado el jugador 1",
    " Ha ganado el jugador 2"];


//Calcula ganador

function calcularGanador ($j1puntos, $j2puntos){
    $ganador = 0;
    
    if ( $j1puntos > $j2puntos ) {
        $ganador = 1;
        return $ganador;
    } elseif ( $j2puntos > $j1puntos ){
        $ganador = 2;
        return $ganador;
    } else {
        return $ganador;
    }

}

$valores = [UNO,DOS,TRES,CUATRO,CINCO,SEIS];
$j1tirada = [$valores[$j1dado1-1],$valores[$j1dado2-1],$valores[$j1dado3-1],$valores[$j1dado4-1],$valores[$j1dado5-1]];
$j2tirada = [$valores[$j2dado1-1],$valores[$j2dado2-1],$valores[$j2dado3-1],$valores[$j2dado4-1],$valores[$j2dado5-1]];


?>

<html>
<head>
<title>Cinco Dados</title>
</head>
<body>
<h1>Cinco dados</h1>

    <p>Actualice la página para mostrar otra partida.</p>

    <h1>Jugador 1:
      <?php
      foreach ($j1tirada as $dado){
      echo $dado . "\n";
      }
      ?>
      Puntos: <?= $j1puntos; ?>
    </h1>

    <h1>Jugador 2:
      <?php
      foreach ($j2tirada as $dado){
      echo $dado . "\n";
      }
      ?>
      Puntos: <?= $j2puntos; ?>
    </h1>

    <p><?= $msg[calcularGanador($j1puntos,$j2puntos)] ?></p>
</body>
</html>