<?php
// Conexion pdp
include'../conexion/conexion_pdo.php';

//Recibo valores con el metodo POST
$valor = $_POST['valor'];

$fecha = date("Y-m-d"); 
$hora  = date ("H: i: s");

//Inserto registro en tabla pacientes 
$cadena = "SELECT
				clave 
			FROM
				datos 
			WHERE
				clave = $valor";

$actualizar = $conexion->query($cadena);
$cantidad = $actualizar->rowCount(); //cuenta las filas
echo $cantidad;
?>