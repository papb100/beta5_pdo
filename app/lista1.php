<?php
// Conexion pdo
include'../conexion/conexion_pdo.php';

$nhcP=$_POST['nhc'];

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
                sexo,
                id_ecivil
            FROM
                datos ORDER BY id_datos DESC";
$datos = $conexion->query($cadena);

?>

<div class="table-responsive">
<table id="example1" class="table table-striped table-bordered" style="width:100%">

        <thead>
            <tr class='hTabla'>
                <th scope="col">#</th>
                <th scope="col">Editar</th>
                <th scope="col">Imprimir</th>
                <th scope="col">Datos</th>
                <th scope="col">Clave</th>
                <th scope="col">Nombre</th>
                <th scope="col">Ap. Paterno</th>
                <th scope="col">Ap. Materno</th>
                <th scope="col">Nacimiento</th>
                <th scope="col">Status</th>
            </tr>
        </thead>

        <tbody>
        <?php
        // Recorro el arreglo y le asigno variables a cada valor del item
        $n=1;
        //PDO::FETCH_ASSOC //asociativo
        while($row = $datos->fetch(PDO::FETCH_NUM)){ 

            $id          = $row[0];

            if ($row[1] == 1) {
                $chkChecado    = "checked";
                $dtnDesabilita = "";
                $chkValor      = "1";
            }else{
                $chkChecado    = "";
                $dtnDesabilita = "disabled";
                $chkValor      = "0";
            }

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
            $ecivil     = $row[12];

            ?>
            <tr class="centrar">
                <th scope="row" class="textoBase">
                    <?php echo $n?>
                </th>
                <td>
                    <button <?php echo $dtnDesabilita?> type="button" class="editar btn btn-outline-success fa-1x activo" id="btnEditar<?php echo $n?>" onclick="llenar_formulario('<?php echo $id?>','<?php echo $nombre?>','<?php echo $paterno?>','<?php echo $materno?>','<?php echo $fNac?>','<?php echo $edad?>','<?php echo $correo?>','<?php echo $curp?>','<?php echo $clave?>','<?php echo $domicilio?>','<?php echo $sexo?>','<?php echo $ecivil?>')">
                                <i class="far fa-edit fa-lg"></i>
                    </button>
                <td>
                    <button <?php echo $dtnDesabilita?> type="button" class="imprimir btn btn-outline-warning fa-1x activo" id="btnImprimir<?php echo $n?>" onclick="abrirModalPDF('<?php echo $id?>')">
                                <i class="fas fa-print fa-lg"></i>
                    </button>
                </td>
                <td>
                    <button <?php echo $dtnDesabilita?> type="button" class="ventana btn btn-outline-info fa-1x activo"  id="btnModal<?php echo $n?>" onclick="abrirModalDatos('<?php echo $id?>','<?php echo $nombre?>','<?php echo $paterno?>','<?php echo $materno?>','<?php echo $fNac?>','<?php echo $edad?>','<?php echo $correo?>','<?php echo $curp?>','<?php echo $clave?>','<?php echo $domicilio?>','<?php echo $sexo?>','<?php echo $ecivil?>')">
                        <i class="far fa-window-maximize fa-lg"></i>
                    </button>
                </td>
                <td>
                    <label class="textoBase">
                        <?php echo $clave?>
                    </label>
                </td>
                <td>
                    <label class="textoBase">
                        <?php echo $nombre?>
                    </label>
                </td>
                <td>
                    <label class="textoBase">
                        <?php echo $paterno?>
                    </label>
                </td>
                <td>
                    <label class="textoBase">
                        <?php echo $materno?>
                    </label>
                </td>
                <td>
                    <label class="textoBase">
                        <?php echo $nacimiento?>
                    </label>
                </td>
                <td>
                    <input value="<?php echo $chkValor?>" onchange="cambiar_estatus(<?php echo $id?>,<?php echo $n?>)" class="toggle-two" type="checkbox" <?php echo $chkChecado?> data-toggle="toggle" data-onstyle="outline-success" data-width="101" data-offstyle="outline-danger" data-on="<i class='fa fa-check'></i> Si" data-off="<i class='fa fa-times'></i> No" id="check<?php echo $n?>">
                </td>
            </tr>
        <?php
        $n++;
        }
        
        ?>

        </tbody>
        <tfoot>
            <tr class='hTabla'>
                <th scope="col">#</th>
                <th scope="col">Editar</th>
                <th scope="col">Imprimir</th>
                <th scope="col">Datos</th>
                <th scope="col">Clave</th>
                <th scope="col">Nombre</th>
                <th scope="col">Ap. Paterno</th>
                <th scope="col">Ap. Materno</th>
                <th scope="col">Nacimiento</th>
                <th scope="col">Status</th>
            </tr>
        </tfoot>
    </table>
<div>

<?php
//En caso de error imprime
//Cierro la conexionLi
?>

<script type="text/javascript">
  $(document).ready(function() {
        $('#example1').DataTable( {
            "language": {
                    // "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                    "url": "../plugins/dataTablesB4/langauge/Spanish.json"
                },
            "order": [[ 0, "asc" ]],
            "paging":   true,
            "ordering": true,
            "info":     true,
            "responsive": true,
            "searching": true,
            stateSave: true,
            dom: 'Bfrtip',
            lengthMenu: [
                [ 10, 25, 50, -1 ],
                [ '10 Registros', '25 Registros', '50 Registros', 'Todos' ],
            ],
            columnDefs: [ {
                // targets: 0,
                // visible: false
            }],
            buttons: [
                      {
                          text: "<i class='fas fa-plus fa-lg' aria-hidden='true'></i> &nbsp;Nuevo Registro",
                          className: 'btn btn-outline-primary',
                          id: 'btnNuevo',
                          action : function(){
                            nuevo_registro();
                          }
                      },
                      {
                          extend: 'excel',
                          text: "<i class='far fa-file-excel fa-lg' aria-hidden='true'></i> &nbsp;Exportar a Excel",
                          className: 'btn btn-outline-secondary',
                          title:'Lista_datos',
                          id: 'btnExportar',
                          exportOptions: {
                              columns: ':visible'
                          }
                      }

            ]
        } );
    } );

</script>

<script>
    $('.toggle-two').bootstrapToggle();
    inputs();
</script>