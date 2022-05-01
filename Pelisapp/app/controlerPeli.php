<?php
// ------------------------------------------------
// Controlador que realiza la gestión de usuarios
// ------------------------------------------------

include_once 'config.php';
include_once 'modeloPeliDB.php';
include_once 'Pelicula.php';

/**********
/*
 * Inicio Muestra o procesa el formulario (POST)
 */

function  ctlPeliInicio(){
    die(" No implementado.");
   }

/*
 *  Muestra y procesa el formulario de alta 
 */

function ctlPeliAlta (){
    if ($_SERVER['REQUEST_METHOD'] == "GET"){
        //Mostramos formulario
        include_once 'plantilla/fnuevo.php';

    }
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        //Procesamos formulario
        $peli = new Pelicula();
        $peli->nombre   = $_POST['nombre'];
        $peli->director = $_POST['director'];
        $peli->genero   = $_POST['genero'];
        if ( isset($_FILES['imagen']['name']) ) {            
            $peli->imagen = $_FILES['imagen']['name'];            
        } else {
            $peli->imagen = NULL;
        }
        ModeloUserDB::Nueva($peli);
        header('Location: index.php');

    }
}
/*
 *  Muestra y procesa el formulario de Modificación 
 */
function ctlPeliModificar (){
    die(" No implementado.");
}



/*
 *  Muestra detalles de la pelicula
 */

function ctlPeliDetalles(){
    $codigo_peli = $_GET['codigo'];
    $peli = ModeloUserDB::GetOne($codigo_peli); 
    include_once 'plantilla/detalle.php';
    //die(" No implementado.");
}
/*
 * Borrar Peliculas
 */

function ctlPeliBorrar(){
    $codigo_peli = $_GET['userid'];
  
    $peliculas = ModeloUserDB::Delete($codigo_peli);
    ctlPeliVerPelis ();
}

/*
 * Cierra la sesión y vuelca los datos
 */
function ctlPeliCerrar(){
    session_destroy();
    modeloUserDB::closeDB();
    header('Location:index.php');
}

/*
 * Muestro la tabla con los usuario 
 */ 
function ctlPeliVerPelis (){
    // Obtengo los datos del modelo
    $peliculas = ModeloUserDB::GetAll(); 
    // Invoco la vista 
    include_once 'plantilla/verpeliculas.php';
   
}

/*
 * Búsqueda por título
 */ 
function ctlBuscarPorTitulo (){
    $titulo = $_GET['busqueda'];
    $peliculas = ModeloUserDB::GetTitulo($titulo); 
    include_once 'plantilla/verpeliculas.php';
    
}

/*
 * Búsqueda por director
 */ 
function ctlBuscarPorDirector (){
    $director = $_GET['busqueda'];
    $peliculas = ModeloUserDB::GetDirector($director); 
    include_once 'plantilla/verpeliculas.php';
  
}

/*
 * Búsqueda por género
 */ 
function ctlBuscarPorGenero (){
    $genero = $_GET['busqueda'];
    $peliculas = ModeloUserDB::GetGenero($genero); 
    include_once 'plantilla/verpeliculas.php';
    
}