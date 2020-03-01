<?php
// Conexion pdo
include'../conexion/conexion_pdo.php';

//Recibo valores con el metodo POST
$actividad    = trim($_POST['actividad']);

$fecha=date("Y-m-d"); 
$hora=date ("H:i:s");

//Inserto registro en tabla pacientes 
$cadena = "INSERT INTO log
				(actividad,
				fecha_registro, 
				hora_registro)
			VALUES
				('$actividad',
				'$fecha', 
				'$hora')";				
$insertar = $conexion->query($cadena);
?>