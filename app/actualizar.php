<?php
// Conexion pdo
include'../conexion/conexion_pdo.php';

//Recibo valores con el metodo POST
$id    	   = $_POST['id'];
$clave     = trim($_POST['clave']);
$nombre    = trim($_POST['nombre']);
$apPaterno = trim($_POST['apPaterno']);
$apMaterno = trim($_POST['apMaterno']);
$fNac      = trim($_POST['fNac']);
$edad      = trim($_POST['edad']);
$correo    = trim($_POST['correo']);
$curp      = trim($_POST['curp']);
$clave     = trim($_POST['clave']);
$domicilio = trim($_POST['domicilio']);
$sexo      = trim($_POST['sexo']);
$ecivil    = trim($_POST['ecivil']);
$activo    = 1;

$fecha=date("Y-m-d"); 
$hora=date ("H:i:s");

//Inserto registro en tabla pacientes 
$cadena = "UPDATE datos
			SET
				clave          = '$clave',
				nombre         = '$nombre',
				ap_paterno     = '$apPaterno', 
				ap_materno     = '$apMaterno', 
				edad           = '$edad', 
				curp           = '$curp', 
				clave          = '$clave', 
				domicilio      = '$domicilio', 
				sexo           = '$sexo', 
				id_ecivil      = '$ecivil', 
				fecha_nac      = '$fNac', 
				correo         = '$correo', 
				fecha_registro = '$fecha', 
				hora_registro  = '$hora'
			WHERE 
				id_datos= $id";

$actualizar = $conexion->query($cadena);

?>