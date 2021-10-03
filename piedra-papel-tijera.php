<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Piedra, papel, tijera
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
      div {
          font-size: 8rem;
      }
  </style>
</head>
<body>
  <h1>¡Piedra, papel, tijera!</h1>

  <p>Actualice la página para mostrar otra partida.</p>

  <h1>Jugador 1:   Jugador 2:</h1>

<?php
$jugador1 = rand(1, 3);
$jugador2 = rand(1, 3);

/*
PIEDRA1: "&#129308;";
PIEDRA2: "&#129307;";
PAPEL: "&#9995;";
TIJERA: "&#9996;";
*/

if ($jugador1 == 1 && $jugador2 == 3) { //Gana el jugador 1
    print "<div>&#129308;&#9996;<br></div>";
    print "<h1>Gana el jugador 1</h1>";
} elseif ($jugador1 == 2 && $jugador2 == 1) {
    print "<div>&#9995;&#129307;<br></div>";
    print "<h1>Gana el jugador 1</h1>";
} elseif ($jugador1 == 3 && $jugador2 == 2) {
    print "<div>&#9996;&#9995;<br></div>";
    print "<h1>Gana el jugador 1</h1>";
} else if ($jugador2 == 1 && $jugador1 == 3) { //Gana el jugador 2
    print "<div>&#9996;&#129307;<br></div>";
    print "<h1>Gana el jugador 2</h1>";
} elseif ($jugador2 == 2 && $jugador1 == 1) {
    print "<div>&#129308;&#9995;<br></div>";
    print "<h1>Gana el jugador 2</h1>";
} elseif ($jugador2 == 3 && $jugador1 == 2) {
    print "<div>&#9995;&#9996;<br></div>";
    print "<h1>Gana el jugador 2</h1>";
} elseif ($jugador1 == 1 && $jugador2 == 1) { //Empates
    print "<div>&#129308;&#129307;<br></div>";
    print "<h1>Empate</h1>";
} elseif ($jugador1 == 2 && $jugador2 == 2) {
    print "<div>&#9995;&#9995;<br></div>";
    print "<h1>Empate</h1>";
} elseif ($jugador1 == 3 && $jugador2 == 3) {
    print "<div>&#9996;&#9996;<br></div>";
    print "<h1>Empate</h1>";
}

?>
</body>
</html>