<?php

include_once 'config.php';
include_once 'Pelicula.php';

class ModeloUserDB {

     private static $dbh = null; 
     private static $consulta_peli = "Select * from peliculas where codigo_pelicula = ?";
     private static $nueva_peli   = "Insert into peliculas (nombre,director,genero,imagen)". "VALUES (?,?,?,?)";
     private static $borrar_peli   = "Delete from peliculas where codigo_pelicula = ?"; 
     private static $buscar_titulo = "Select * from peliculas where nombre like ?";
     private static $buscar_director = "Select * from peliculas where director like ?";
     private static $buscar_genero = "Select * from peliculas where genero like ?";
  /*
     private static $delete_peli   = "Delete from Usuarios where id = ?"; 
     private static $insert_user   = "Insert into Usuarios (id,clave,nombre,email,plan,estado)".
                                     " VALUES (?,?,?,?,?,?)";
     private static $update_user    = "UPDATE Usuarios set  clave=?, nombre =?, ".
                                     "email=?, plan=?, estado=? where id =?";
 */    
     
public static function init(){
   
    if (self::$dbh == null){
        try {
            // Cambiar  los valores de las constantes en config.php
            $dsn = "mysql:host=".DBSERVER.";dbname=".DBNAME.";charset=utf8";
            self::$dbh = new PDO($dsn,DBUSER,DBPASSWORD);
            // Si se produce un error se genera una excepción;
            self::$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }
        
    }
    
}

public static function nueva($peli):bool{
    $stmt = self::$dbh->prepare(self::$nueva_peli);
    $stmt->bindValue(1,$peli->nombre);
    $stmt->bindValue(2,$peli->director);
    $stmt->bindValue(3,$peli->genero);
    $stmt->bindValue(4,$peli->imagen );
    if ($stmt->execute()){
       return true;
    }
    return false; 
}

public static function Delete (String $codigo) {
    $stmt = self::$dbh->prepare(self::$borrar_peli);
    $stmt->bindValue(1,$codigo);
    $stmt->execute();
    return false;
}   


/***
// Borrar un usuario (boolean)
public static function UserDel($userid){
    $stmt = self::$dbh->prepare(self::$delete_user);
    $stmt->bindValue(1,$userid);
    $stmt->execute();
    if ($stmt->rowCount() > 0 ){
        return true;
    }
    return false;
}
// Añadir un nuevo usuario (boolean)
public static function UserAdd($userid, $userdat):bool{
    $stmt = self::$dbh->prepare(self::$insert_user);
    $stmt->bindValue(1,$userid);
    $clave = Cifrador::cifrar($userdat[0]);
    $stmt->bindValue(2,$clave);
    $stmt->bindValue(3,$userdat[1] );
    $stmt->bindValue(4,$userdat[2] );
    $stmt->bindValue(5,$userdat[3] );
    $stmt->bindValue(6,$userdat[4] );
    if ($stmt->execute()){
       return true;
    }
    return false; 
}

// Actualizar un nuevo usuario (boolean)
// GUARDAR LA CLAVE CIFRADA
public static function UserUpdate ($userid, $userdat){
    $clave = $userdat[0];
    // Si no tiene valor la cambio
    if ($clave == ""){ 
        $stmt = self::$dbh->prepare(self::$update_usernopw);
        $stmt->bindValue(1,$userdat[1] );
        $stmt->bindValue(2,$userdat[2] );
        $stmt->bindValue(3,$userdat[3] );
        $stmt->bindValue(4,$userdat[4] );
        $stmt->bindValue(5,$userid);
        if ($stmt->execute ()){
            return true;
        }
    } else {
        $clave = Cifrador::cifrar($clave);
        $stmt = self::$dbh->prepare(self::$update_user);
        $stmt->bindValue(1,$clave );
        $stmt->bindValue(2,$userdat[1] );
        $stmt->bindValue(3,$userdat[2] );
        $stmt->bindValue(4,$userdat[3] );
        $stmt->bindValue(5,$userdat[4] );
        $stmt->bindValue(6,$userid);
        if ($stmt->execute ()){
            return true;
        }
    }
    return false; 
}
****/

// Tabla de objetos con todas las peliculas
public static function GetAll ():array{
    // Genero los datos para la vista que no muestra la contraseña
    
    $stmt = self::$dbh->query("select * from peliculas");
    
    $tpelis = [];
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Pelicula');
    while ( $peli = $stmt->fetch()){
        $tpelis[] = $peli;       
    }
    return $tpelis;
}

//Añadido
public static function GetOne ($codigo){
    $stmt = self::$dbh->prepare(self::$consulta_peli);
    $stmt->bindValue(1,$codigo);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Pelicula');
    $peli = $stmt->fetch();
    return $peli;   
}

public static function GetTitulo ($titulo){
    $stmt = self::$dbh->prepare(self::$buscar_titulo);
    $stmt->bindValue(1,$titulo."%" );
    $stmt->execute();  
    $tpelis = [];
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Pelicula');
    while ( $peli = $stmt->fetch()){
        $tpelis[] = $peli;       
    }
    return $tpelis;    
}

public static function GetDirector ($director){ 
    $stmt = self::$dbh->prepare(self::$buscar_director);
    $stmt->bindValue(1,$director."%");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Pelicula');
    while ( $peli = $stmt->fetch()){
        $tpelis[] = $peli;       
    }
    return $tpelis;   
}

public static function GetGenero ($genero){
    $stmt = self::$dbh->prepare(self::$buscar_genero);
    $stmt->bindValue(1,$genero."%");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Pelicula');
    while ( $peli = $stmt->fetch()){
        $tpelis[] = $peli;       
    }
    return $tpelis;  
}


/***

// Datos de una película para visualizar
public static function UserGet ($codigo){
    $datosuser = [];
    $stmt = self::$dbh->prepare(self::$consulta_user);
    $stmt->bindValue(1,$userid);
    $stmt->execute();
    if ($stmt->rowCount() > 0 ){
        // Obtengo un objeto de tipo Usuario, pero devuelvo una tabla
        // Para no tener que modificar el controlador
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Usuario');
        $uobj = $stmt->fetch();
        $datosuser = [ 
                     $uobj->clave,
                     $uobj->nombre,
                     $uobj->email,
                     $uobj->plan,
                     $uobj->estado
                     ];
        return $datosuser;
    }
    return null;    
    
}
***/
public static function closeDB(){
    self::$dbh = null;
}

} // class
