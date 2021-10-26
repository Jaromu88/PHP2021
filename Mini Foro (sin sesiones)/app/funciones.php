<?php
function usuarioOk($usuario, $contraseña) :bool {
   $usuario=eliminaCodigoHTML($usuario);
   $contraseña=eliminaCodigoHTML($contraseña);
   $respuesta=false;

   if (strlen($contraseña)>=8 && $contraseña==strrev($usuario)) {
      $respuesta=true;
   }  
      return $respuesta;    
}

function letraMasRepetida($texto){
   $caracterRepetido="";
   $texto=eliminaCodigoHTML($texto);
   $arrayTexto=str_split($texto);
   $valorCaracterRepe=array_count_values($arrayTexto);
   $caracterRepetido=asort($valorCaracterRepe);
   $caracterRepetido=array_key_last($valorCaracterRepe);
   
   while($caracterRepetido==" "){
      array_pop($valorCaracterRepe);
      $caracterRepetido=array_key_last($valorCaracterRepe);
   }
 return $caracterRepetido;
}

function palabraMasRepetida($texto) {
   $resultado=0;
   $texto=eliminaCodigoHTML($texto);
   if ($texto!="") {  
      $palabras=str_word_count($texto,1);
      $contador=array_count_values($palabras);  
      $maximo=0;
      
      foreach ($contador as $clave=> $value) {
         if ($value>$maximo) {
            $resultado=$clave;
            $maximo=$value;
         }
      }
   }    
   return $resultado;
}

function eliminaCodigoHTML($texto):string{
   $texto=trim($texto); // Elimina espacios antes y después de los datos
   $texto=stripslashes($texto); // Elimina backslashes \
   $texto=htmlspecialchars($texto); // Traduce caracteres especiales en entidades HTML
   return $texto;
}
