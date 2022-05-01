<?php
ob_start();

?>
<h2> Detalles de la película:</h2>
<table>
<tr><td>Cartel   </td><td><img src="<?='app/img/'.$peli->imagen ?>" height="380" width="240"></img></td></tr>
<tr><td>Código   </td><td> <?= $peli->codigo_pelicula ?></td></tr>
<tr><td>Nombre   </td><td>   <?= $peli->nombre ?></td></tr>
<tr><td>Director  </td><td>     <?= $peli->director ?></td></tr>
<tr><td>Género    </td><td>    <?= $peli->genero  ?></td></tr>
</table>

<!--
    <label>Trailer: </label><iframe src="<? $peli->trailer ?>" frameborder="0"></iframe><br><br>
-->
<br>
<input type="button" value=" Volver " size="10" onclick="javascript:window.location='index.php'" >
<?php 
// Vacio el bufer y lo copio a contenido
// Para que se muestre en div de contenido

$contenido = ob_get_clean();
include_once "principal.php";


?>