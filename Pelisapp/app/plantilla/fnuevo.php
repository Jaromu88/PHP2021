<?php

// Guardo la salida en un buffer(en memoria)
// No se envia al navegador
ob_start();
?>
<div id="aviso"><b><?= (isset($msg))?$msg:"" ?></b></div>
<h2> NUEVA PELÍCULA </h2>

<form name='ALTA' enctype="multipart/form-data" method="POST" action="index.php?orden=Alta">
<table>

<tr><td>Título:   </td><td><input name="nombre" type="text"></td></tr>
<tr><td>Director:  </td><td><input name="director" type="text"></td></tr>
<tr><td>Género:    </td><td><input name="genero" type="text"></td></tr>
<tr><td>Cartel:   </td><td><input name="imagen" type="file"></td></tr>

</table><br>
<input type="submit" value="Enviar"><br><br>
<input type="button" value=" Volver " size="10" onclick="javascript:window.location='index.php'" >
</form>
<?php 
// Vacio el bufer y lo copio a contenido
// Para que se muestre en div de contenido
$contenido = ob_get_clean();
include_once "principal.php";

?>