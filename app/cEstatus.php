<?php
// Conexion pdo
include'../conexion/conexion_pdo.php';

//Recibo valores con el metodo POST
$id          = $_POST['id'];
$contravalor = $_POST['contravalor'];

$fecha=date("Y-m-d"); 
$hora=date ("H:i:s");

//Inserto registro en tabla pacientes 
$cadena = "UPDATE datos 
			SET
				activo=$contravalor,
				fecha_registro='$fecha',
				hora_registro='$hora'
			WHERE 
				id_datos= $id";

echo $contraValor;
$actualizar = $conexion->query($cadena);
?>