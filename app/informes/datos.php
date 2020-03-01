<?php 
// Conexion pdo
include'../conexion/conexion_pdo.php';

include'../funciones/calcularEdad.php';
include'../funciones/fechaEspanol.php';

$Id=$_REQUEST["id"];

$cadena = "SELECT
                id_datos,
                activo,
                nombre,
                ap_paterno,
                ap_materno,
                fecha_nac,
                edad,
                correo,
                curp,
                clave,
                domicilio,
                IF(sexo='M', 'Masculino', 'Femenino'),
                (SELECT descripcion FROM ecivil where ecivil.id_ecivil=datos.id_ecivil)
            FROM
                datos
            WHERE
                id_datos = $Id";
$datos = $conexion->query($cadena);

$n=1;
//Descargamos el arreglo que arroja la consulta
$row = $datos->fetch(PDO::FETCH_NUM);

// arreglo de variables
$nombre     = $row[2];
$paterno    = $row[3];
$materno    = $row[4];
$fNac       = $row[5];
$nacimiento = date("d-m-Y", strtotime($row[5]));
$edad       = $row[6];
$correo     = $row[7];
$curp       = $row[8];
$clave      = $row[9];
$domicilio  = $row[10];
$sexo       = $row[11];
$ecivil     = ($row[12]==null)?"Sin datos":$row[12];

$fecha=date("Y-m-d"); 

$fCastellano=fechaCastellano($fecha);

?>

<style type="text/css">

    td.col1{
        border: solid 0px red;
        text-align: right;
    }

    table{
        width:  90%;
        border: solid 0px #5544DD;
        margin:auto;
    }

    hr{
    border: solid 1px #34495e;
    }

    table.borde{
        width:  90%;
        border: solid 1px #D8D8D8;
        margin:auto;
    }

    th{
        text-align: center;
        border: solid 0px #113300;
        background: #EEFFEE;
    }

    th.borde{
        text-align: center;
        border: solid 1px #D8D8D8;
        background: #EEFFEE;
    }

    td.borde{
        text-align: left;
        border: solid 1px #D8D8D8;
        padding: 10px;
        text-align: center;
    }


    td.titular{
        text-align: center;
        border: solid 1px #34495e;
        background: #ecf0f1;
        color:#34495e;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 3px;
        padding: 10px;
    }

    td.titular2{
        text-align: center;
        border: solid 0px #34495e;
        background: #fff;
        color:#000;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 3px;
        padding: 15px;
        font-size:20px;
    }

    label.enfa{
        text-decoration: underline;
    }

    td.subtitular{
        text-align: center;
        border: solid 1px #34495e;
        background: #ffffff;
        color:#34495e;
        letter-spacing: 3px;
        padding: 15px;
    }

    td.fecha{
        text-align: right;
        border: solid 0px #34495e;
        background: #ffffff;
        color:#34495e;
        letter-spacing: 3px;
        padding: 18px;

    }

/*hojas de estilo propia*/
    img{
        width: 100%;
    }

/*letras*/
.chico{font-size: 11px;}  
.mediano{font-size: 15px;}  
.grande{font-size:18px;}
.subrayado{text-decoration: underline;} 
.firma {font-size: 13px;font-style: italic;}
.ancho{width:20px; }
.bajo{
    display: block;
    margin: 15px 0px 0px 0px;
    background: #ccc;
}

</style>

<table border="0">
    <col style="width: 100%" class="col1">

    <tr>
        <td>
            <img src="../images/encabezado.jpg" alt="">
        </td>
    </tr>

</table>


<table border="0">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <!-- defino el ancho de la tabla -->
    <tr border="0">
        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    </tr>

    <tr >
        <td  colspan="10" class="titular2">
            DATOS GENERALES DEL ALUMNO
        </td>
    </tr> 

    <tr >
        <td  colspan="10" class="titular">
            Información General
        </td>
    </tr>   

    <tr >
        <td  colspan="7" class="borde">
            <strong>Nombre  :</strong> <?php echo $nombre.' '.$paterno.' '.$materno; ?>
        </td>
        <td  colspan="3" class="borde">
            <strong>Edad :</strong> <?php echo $edad; ?>
        </td>
    </tr>   

    <tr >
        <td  colspan="7" class="borde">
            <strong>Correo electrónico :</strong> <?php echo $correo; ?>
        </td>
        <td  colspan="3" class="borde">
            <strong>Sexo :</strong> <?php echo "$sexo"; ?>
        </td>
    </tr> 

    <tr >
        <td  colspan="6" class="borde">
            <strong>Fecha de nacimiento :</strong> <?php echo $nacimiento; ?>
        </td>
        <td  colspan="4" class="borde">
            <strong>Estado civil :</strong> <?php echo $ecivil; ?>
        </td>
    </tr> 

    <tr >
        <td  colspan="10" class="borde">
            <strong>Clave única de registro de población (CURP):</strong> <?php echo $curp; ?>
        </td>
    </tr> 

    <tr >
        <td  colspan="10" class="borde">
            <strong>Domicilio :</strong> <?php echo $domicilio; ?>
        </td>
    </tr> 

    <tr >
        <td  colspan="10" class="fecha">
            <strong>Fecha de impresión:</strong> <?php echo $fCastellano; ?>
        </td>
    </tr> 

    <tr>
        <td  colspan="10" align="center">
            <hr>
        </td>
    </tr>

</table>
