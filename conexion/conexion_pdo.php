<?php
$servidor        = 'localhost';
$bd_name         = 'beta';
$usuario         = 'root';
$password        = 'xoops8305';
$cadena_conexion = 'mysql:dbname='.$bd_name.';host='.$servidor.'';

global $conexion;

try {

    $conexion = new PDO($cadena_conexion, $usuario, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Establece la zona horaria predeterminada usada
    date_default_timezone_set("America/Monterrey");

    //llamo la consulta para especificar UTF-8
    $conexion->query("SET NAMES utf8");
    
} 
catch (PDOException $error) {
    //muestro el error de la conexión
    echo 'Falló la conexión: ' . $error->getMessage();
}
?>