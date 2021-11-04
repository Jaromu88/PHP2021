<?php

//Iniciamos sesión
session_start();
if (!isset($_COOKIE['sesiones'])) {
    setcookie("sesiones", 0, time() + 30*24*3600);    
    header("refresh: 0;"); 
}

//Función para definir si la opción seleccionada coincide con el resultado
function sacarResultado($opcion) {
    $resultado=false;
    $numero= rand(1,2);    
    if($numero%2==0 && $opcion=='par'){
        $resultado=true;
    }
    if($numero%2!=0 && $opcion=='impar'){
        $resultado=true;
    }   
    return $resultado;
}

?>

<html>
<head>
<meta charset="UTF-8">
<title>Mini Casino</title>
</head>
<body>
<form method="get">
<?php 

//Control de sesiones
if (isset($_REQUEST['salir'])) {
    echo "Muchas gracias por jugar con nosotros.<br>
            Su resultado final es de ".$_SESSION['cantidad']." € <br>";  
    $sesion=$_COOKIE["sesiones"];
    $sesion++;
    setcookie("sesiones", $sesion, time() + 30*24*3600); 
    session_destroy();
    exit();
}

if(isset($_REQUEST['entrar'])){
    $_SESSION['cantidad']=$_REQUEST['cantidad'];
}

//Selecciono la cantidad a apostar y la efectúo
if (isset($_SESSION['cantidad'])) {
    if (isset($_REQUEST['apostar'])) {
        //Compruebo si he seleccionado la opción PAR o IMPAR y la cantidad a apostar
        if (isset($_REQUEST['opcion']) && $_REQUEST['apuesta']>0) {
            //Compruebo si tengo dinero suficiente para realizar la apuesta
            if ( $_SESSION['cantidad']>=$_REQUEST['apuesta']  ) {
                //Obtengo el resultado de la apuesta
                if (sacarResultado($_REQUEST['opcion'])) {
                    $ganas=0;
                    $ganas+=$_REQUEST['apuesta']*2;
                    echo "RESULTADO DE LA APUESTA :".$_REQUEST['opcion']."<br>GANASTE<br>";
                    $_SESSION['cantidad']+=$ganas;
                    
                    echo "Dispones de ".$_SESSION['cantidad']." €  para jugar<br>";   
                } else {
                    echo "RESULTADO DE LA APUESTA : no es ".$_REQUEST['opcion']."<br>PERDISTE<br>";
                    $_SESSION['cantidad']-=$_REQUEST['apuesta'];
                    echo "Dispones de ".$_SESSION['cantidad']." € para jugar<br>";                    
                }
            } else{
                echo  "Error: No dispone de la cantidad apostada.<br>";
            }
        } else {
            echo "Debes indicar la cantidad y seleccionar la opcion a apostar.<br>";
        }
    } else{
        echo "Dispones de ".$_SESSION['cantidad']." € para jugar<br>";        
    }
    echo "Introduzca la cantidad para apostar  : <input name='apuesta' type='number' value='0' size='5' autofocus><br>";
    echo "Seleciona cual apostar:
				<input name='opcion' value='par' type=radio>PAR &nbsp;
				<input name='opcion' value='impar' type=radio>IMPAR <br>";

    echo" <button name='apostar' value='Apostar'>Apostar cantidad</button>
          <button name='salir' value='Salir'>Abandonar el Casino</button>";   
    exit();
}

//Muestra la pantalla de bienvenida con las veces que he visitado el casino
if (!isset($_SESSION['cantidad']) ) {
    echo "<h1>Bienvenido al casino</h1>";
    echo "Esta es su ". ($_COOKIE['sesiones']+1)."ª visita. <br>";
    echo "Introduzca el dinero con el que va a jugar:";
    echo "<input name='cantidad' type='number' value='0' autofocus> <br>
        <button name='entrar' value='entrar'>Entrar</button>";
    
}

?>

</form>
</body>
</html>
