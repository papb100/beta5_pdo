<?php
// Conexion pdo
include'../conexion/conexion_pdo.php';

$nhcP=$_POST['nhc'];

$cadena = "SELECT
                id_ecivil,
                descripcion,
                activo
            FROM
                ecivil 
            WHERE 
                activo=1 
            ORDER BY 
                id_ecivil";
$datos = $conexion->query($cadena);

while($row = $datos->fetch(PDO::FETCH_NUM)){  
	if ($rowl[0]!=$row[0]) {
    ?>
    <option value="<?php echo $row[0];?>"><?php echo $row[1];?></option>
    <?php
	}
}
?>
