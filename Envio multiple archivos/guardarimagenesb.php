<?php
// DETALLES DE CONFIGURACIÓN Y CONSTANTES
define('DIR', 'C:\Users\darke\Downloads\imgusers');
define('TAMAÑOMAXTOTAL', 300000);
define('TAMAÑOMAXFICHERO', 200000);

define('ERROR_NO_JPG_PNG',     5000);
define('ERROR_MAX_TAMAÑOIMG',  5001);
define('ERROR_MAX_TAMAÑOTOTAL', 5002);

$codigosErrorSubida = [
    UPLOAD_ERR_OK         => 'Subida correcta',
    UPLOAD_ERR_INI_SIZE   => 'El tamaño del archivo excede el admitido por el servidor',  // directiva upload_max_filesize en php.ini
    UPLOAD_ERR_FORM_SIZE  => 'El tamaño del archivo excede el admitido por el cliente',  // directiva MAX_FILE_SIZE en el formulario HTML
    UPLOAD_ERR_PARTIAL    => 'El archivo no se pudo subir completamente',
    UPLOAD_ERR_NO_FILE    => 'No se seleccionó ningún archivo para ser subido',
    UPLOAD_ERR_NO_TMP_DIR => 'No existe un directorio temporal donde subir el archivo',
    UPLOAD_ERR_CANT_WRITE => 'No se pudo guardar el archivo en disco',  // permisos
    UPLOAD_ERR_EXTENSION  => 'Una extensión PHP evito la subida del archivo',  // extensión PHP
    // Mis errores adicionales
    ERROR_NO_JPG_PNG         => 'Formato de Imagen no admitido',
    ERROR_MAX_TAMAÑOIMG      => 'El archivo supera el tamaño máximo permitido',
    ERROR_MAX_TAMAÑOTOTAL    => 'El total de los archivos supera el máximo permitido ' . (TAMAÑOMAXTOTAL / 1000) . ' KB'
];

foreach($_FILES["archivos"]['tmp_name'] as $key => $tmp_name) {
	//Condicional si el fichero existe
	if($_FILES["archivos"]["name"][$key]) {
		// Nombres de archivos de temporales
		$archivonombre = $_FILES["archivos"]["name"][$key]; 
		$fuente = $_FILES["archivos"]["tmp_name"][$key]; 
		$archivo= $_FILES["archivos"];
        $mensaje=($archivo["error"][$key]==0)?"No hay errores en el archivo $archivonombre":"error ".$archivo["error"][$key]." ( ".$codigosErrorSubida[$archivo["error"][$key]] .")";

		$carpeta = 'C:\Users\darke\Downloads\imgusers'; //Declaramos el nombre de la carpeta que guardara los archivos
		
        if(!file_exists($carpeta)){
			mkdir($carpeta, 0777) or die("Se ha producido un error al crear el directorio de almacenamiento");	
		}
        
		$dir=opendir($carpeta);
		$destino = $carpeta.'/'.$archivonombre; //Indicamos la ruta de destino de los archivos
	
        echo("Intentando subir archivo: ".$archivo["name"][$key])." <br>";
        echo("Tipo de archivo: ".$archivo["type"][$key]." <br>");
        if($_FILES["archivos"]["type"][$key] === "image/jpeg" || $_FILES["archivos"]["type"][$key] === "image/png"){
            echo("Tamaño de fichero: ".$archivo["size"][$key]." kilobytes <br>" );
            echo("Fichero temporal: ".$archivo["tmp_name"][$key]."<br>");

            if(move_uploaded_file($fuente, $destino)) {
                echo("$mensaje <br>");
                echo("El archivo $archivonombre se ha subido de forma correcta.<br>" );
                echo("<br> <br> <br>" );
            } else {	
                echo("$mensaje <br>");
                echo("Error al subir el archivo $archivonombre");
            }
        } else {
            echo("TIPO DE ARCHIVO NO PERMITIDO<br> <br> <br>");
        }
        closedir($dir); //Cerramos la conexion con la carpeta destino
	}
}
?>
<?php

var_dump($_POST);
var_dump($_FILES);

?>
<body>
<br />
	<a href="selectmultiple.html">Volver a la página de subida</a>
</body>
