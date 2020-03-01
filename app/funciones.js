//Variables globales
var blanco   = "#ffffff";
var negro    = "#000000";
var obscuro  = "#343A40";
var azul     = "#1278F4";
var verde    = "#2AA44E";
var rojo     = "#D9304B";
var amarillo = "#FFC107";
var celeste  = "#17A2B8";

$("#frmGuardar").submit(function(e){

    var clave    = $("#clave").val();
    var nombre    = $("#nombre").val();
    var apPaterno = $("#apPaterno").val();
    var apMaterno = $("#apMaterno").val();
    var fNac      = $("#fNac").val();
    var edad      = $("#edad").val();
    var correo    = $("#correo").val();
    var curp      = $("#curp").val();
    var domicilio = $("#domicilio").val();
    var sexo      = $("#sexo").val();
    var ecivil    = $("#ecivil").val();

    //transition -> slide , zoom , flipx , flipy , fade , pulse
    alertify.confirm('alert').set({transition:'zoom',message: 'Transition effect: zoom'}).show();
    alertify.confirm(
        'Sistema', 
        '¿Deseas guardar la información?', 
        function(){ 

            $.ajax({
                url:"guardar.php",
                type:"POST",
                dateType:"json",
                data:{clave,nombre,apPaterno,apMaterno,edad,fNac,correo,curp,domicilio,sexo,ecivil},
                success:function(respuesta){
                    console.log(respuesta);
                    $("#guardar").hide();
                    llenar_lista1();
                    $("#frmGuardar")[0].reset();
                    selectTwo();
                    alertify.success("<i class='fa fa-save fa-lg'></i>", 2);
                    $('#nombre').focus();
                    log("Usuario inserto registro");
        
                },
                error:function(xhr,status){
                    alert("Error en metodo AJAX"); 
                },
            });

        }, 
        function(){ 
            alertify.error("<i class='fa fa-times fa-lg'></i>", 2);
                }
    ).set('labels',{ok:'Guardar',cancel:'Salir'});
    

    e.preventDefault();
    return false;
});

$("#frmActualizar").submit(function(e){

    var id        = $("#eId").val();
    var nombre    = $("#eNombre").val();
    var apPaterno = $("#eApPaterno").val();
    var apMaterno = $("#eApMaterno").val();
    var fNac      = $("#eFNac").val();
    var edad      = $("#eEdad").val();
    var correo    = $("#eCorreo").val();
    var curp      = $("#eCurp").val();
    var clave     = $("#eClave").val();
    var domicilio = $("#eDomicilio").val();
    var sexo      = $("#eSexo").val();
    var ecivil    = $("#eEcivil").val();

        //transition -> slide , zoom , flipx , flipy , fade , pulse
        alertify.confirm('alert').set({transition:'zoom',message: 'Transition effect: zoom'}).show();
        alertify.confirm(
            'Sistema', 
            '¿Deseas actualizar la Información?', 
            function(){ 
    
                $.ajax({
                    url:"actualizar.php",
                    type:"POST",
                    dateType:"json",
                    data:{clave,id,nombre,apPaterno,apMaterno,edad,fNac,correo,curp,clave,domicilio,sexo,ecivil},
                    success:function(respuesta){
                        llenar_lista1();
                            $("#frmGuardar")[0].reset();
                            $("#frmActualizar")[0].reset();
                            alertify.success("<i class='fa fa-bolt fa-lg'></i>", 2);
                        $("#btnCancelarG , #btnCancelarA").click();
                        log("Usuario modifico registro");
                        $('#nombre').focus();
                    },
                    error:function(xhr,status){
                        alert("Error en metodo AJAX"); 
                    },
                });
    
            }, 
            function(){ 
                alertify.error("<i class='fa fa-times fa-lg'></i>", 2);
                    }
        ).set('labels',{ok:'Actualizar',cancel:'Salir'});

    e.preventDefault();
    return false;
});

function llenar_lista1(){
    abrirModalCarga('Cargando Lista');
    $("#frmGuardar")[0].reset();
    $("#Listado1").hide();
    $.ajax({
        url:"lista1.php",
        type:"POST",
        dateType:"json",
        data:{},
        success:function(respuesta){
            $("#Listado1").html(respuesta);
            $("#Listado1").slideDown('slow');
            cerrarModalCarga();
            $("#nombre").focus();
        },
        error:function(xhr,status){
            alert("Error en metodo AJAX"); 
        },
    });
}

function abrirModalCarga(mensaje) {
    $("#modalCarga").modal("show");
    $("#msjCarga").text(mensaje);
}

function cerrarModalCarga(mensaje) {
    $("#modalCarga").modal("hide");
}

function edad(fecha){
    $.ajax({
        url:"calcularEdad.php",
        type:"POST",
        dateType:"json",
        data:{fecha},
        success:function(respuesta){

            $("#edad").val(respuesta);
            $("#eEdad").val(respuesta);

            xedad= parseInt(respuesta);
            if (xedad < 0) {
                cambioColor('.5s' , rojo , 'Fecha invalida')
                $("#edad, #eEdad , #fNac , #efNac").css("color", rojo);
            } else {
                cambioColor('.5s' , obscuro , 'Programa de Ejemplo')
                $("#edad, #eEdad , #fNac , #efNac").css("color", obscuro);
            }
        },
        error:function(xhr,status){
            alert("Error en metodo AJAX"); 
        },
    });
}

function llenar_formulario(id,nombre,apPaterno,apMaterno,fNac,edad,correo,curp,clave,domicilio,sexo,ecivil){

    $("#eId").val(id);
    $("#eClave").val(clave);
    $("#eNombre").val(nombre);
    $("#eApPaterno").val(apPaterno);
    $("#eApMaterno").val(apMaterno);
    $("#eFNac").val(fNac);
    $("#eEdad").val(edad);
    $("#eCorreo").val(correo);
    $("#eCurp").val(curp);
    $("#eClave").val(clave);
    $("#eDomicilio").val(domicilio);
    $("#eSexo").val(sexo);
    $("#eEcivil").val(ecivil);

    selectTwo();

    $("#titular").text("Actualizar Información");
    $("#guardar").hide();
    $("#Listado1").hide();
    $("#editar").show();
    $("#eNombre").focus();
}
//Verifica el tamaño de la pantalla
$(document).ready(function(){
    $(window).resize(function() {
      if ($(this).width() <= 700){
        $(".btn").addClass("btn-block");
      }else{
        $(".btn").removeClass("btn-block");
      }
    });
  });

function cambiar_estatus(id,consecutivo){

    var valor=$("#check"+consecutivo).val();
    var contravalor=(valor==1)?0:1;
    $("#check"+consecutivo).val(contravalor);

    $.ajax({
        url:"cEstatus.php",
        type:"POST",
        dateType:"json",
        data:{id,contravalor},
        success:function(respuesta){
            console.log(respuesta);
            if(contravalor==1){
                alertify.success("<i class='fa fa-check fa-lg'></i>", 2);
                $("#btnEditar"+consecutivo).removeAttr('disabled');
                $("#btnImprimir"+consecutivo).removeAttr('disabled');
                $("#btnModal"+consecutivo).removeAttr('disabled');
                log("Usuario activo registro");
            }else{
                alertify.error("<i class='fa fa-times fa-lg'></i>", 2);
                $("#btnEditar"+consecutivo).attr('disabled','disabled');
                $("#btnImprimir"+consecutivo).attr('disabled','disabled');
                $("#btnModal"+consecutivo).attr('disabled','disabled');
                log("Usuario desactivo registro");
            }
        },
        error:function(xhr,status){
            alert("Error en metodo AJAX"); 
        },
    });

}

function abrirModalDatos(id,nombre,apPaterno,apMaterno,fNac,edad,correo,curp,clave,domicilio,sexo,ecivil) {
    $("#modalTitle").text("Datos personales - "+nombre+' '+apPaterno);

    $("#mNombre").val(nombre);
    $("#mApPaterno").val(apPaterno);
    $("#mApMaterno").val(apMaterno);
    $("#mFNac").val(fNac);
    $("#mEdad").val(edad);
    $("#mCorreo").val(correo);
    $("#mCurp").val(curp);
    $("#mClave").val(clave);
    $("#mDomicilio").val(domicilio);
    $("#mSexo").val(sexo);
    $("#mEcivil").val(ecivil);

    selectTwo();

    $("#modalDatos").modal("show");
}

function cambioColor(duracion , colorF , mensaje , colorL=blanco){
    //color azul
    $(".jumbotron , .hTabla").css({
        transition : 'background-color'+ duracion +' ease-in-out',
        "background-color": colorF,
        color: colorL
    });

    $("#titular").html(mensaje);
}

//Manipulacion de eventos con jquery
$("#fNac").change(function(){
    var fecha = $(this).val();
    edad(fecha);
    ;
});

$("#efNac").change(function(){
    var fecha = $(this).val();
    edad(fecha);

});

$("#btnCancelarG , #btnCancelarA").click(function(){
    $("#editar").hide();
    $("#guardar").hide();
    $("#Listado1").fadeIn();
    cambioColor('.5s' , obscuro , "Programa de ejemplo", blanco)
});

$("#btnCancelarG").mouseover(function(){
    cambioColor('.5s' , rojo , 'Cancelar captura de Información')
});

$("#btnCancelarA").mouseover(function(){
    cambioColor('.5s' , rojo , 'Cancelar actualizacion de Información')
});

$("#btnActualizar").mouseout(function(){
    cambioColor('.5s' , obscuro , 'Programa de Ejemplo')
});

$("#btnGuardar").mouseout(function(){
    cambioColor('.5s' , obscuro , 'Programa de Ejemplo',blanco)
});

$("#btnCancelarG").mouseout(function(){
    cambioColor('.5s' , obscuro , 'Programa de Ejemplo')
});

$("#btnCancelarA ").mouseout(function(){
    cambioColor('.5s' , obscuro , 'Programa de Ejemplo')
});

function inputs(){

    $(".imprimir").mouseover(function(){
        if ($(this).is('[disabled]')) {
            cambioColor('.5s' , rojo , 'Imprimir datos personales','#fff')
        }else{
            cambioColor('.5s' , amarillo , 'Imprimir datos personales','#000')
        }
    });
    
    $(".editar").mouseover(function(){
        if ($(this).is('[disabled]')) {
            cambioColor('.5s' , rojo , 'Editar datos personales')
        }else{
            cambioColor('.5s' , verde , 'Editar datos personales')
        }
    });

    $(".ventana").mouseover(function(){
        if ($(this).is('[disabled]')) {
            cambioColor('.5s' , rojo , 'Mostrar ventana modal')
        }else{
            cambioColor('.5s' , celeste , 'Mostrar ventana modal')
        }
    });

    $("#btnGuardar").mouseover(function(){
        if ($(this).is('[disabled]')) {
            cambioColor('.5s' , rojo , 'Programa de ejemplo')
        }else{
            cambioColor('.5s' , azul , 'Captura de Información')
        }
    });

    $("#btnActualizar").mouseover(function(){
        if ($(this).is('[disabled]')) {
            cambioColor('.5s' , rojo , 'Programa de ejemplo')
        }else{
            cambioColor('.5s' , verde , 'Actualizar datos personales')
        }
    });
    
    $(".imprimir , .editar , .ventana").mouseout(function(){
        cambioColor('.5s' , obscuro , 'Programa de ejemplo')
    });

    $("#clave").keydown(function() {
        var valor=$(this).val();
        soloNumeros(valor);
        
    });

    $("#curp , #eCurp").keyup(function() {

        valor=$(this);
        // Convierte en mayuscula
        valor.val(valor.val().toUpperCase());
        
        //validar curp + expresion regular
        if (curpValida(valor.val())=="Si") {
            //$("#btnGuardar").removeAttr('disabled');
            $(valor).css("color", obscuro);
            alertify.success("Curp valida !",1);
            cambioColor('.5s' , azul , 'Programa de ejemplo')
        }else{
            //$("#btnGuardar").attr('disabled','disabled');
            $(valor).css("color", rojo);
            cambioColor('.5s' , rojo , 'Curp no valida')
        }

    });

    $("#clave").keyup(function(){
        var valor=$(this).val();
        revisar_clave(valor);
    });
}
//Manipulacion de eventos con jquery

function log(actividad){
    $.ajax({
        url:"log.php",
        type:"POST",
        dateType:"json",
        data:{actividad},
        success:function(respuesta){

        },
        error:function(xhr,status){
            alert("Error en metodo AJAX"); 
        },
    });
}

function abrirModalPDF(id) {

    $("#txtTitularPDF").text("Datos Personales")

    var link = "pdfDatos.php?id="+id ;
    PDFObject.embed(link, "#visualizador");

    $("#modalPDF").modal("show");

}

//solo numeros
function soloNumeros(e){
    if(event.shiftKey)
    {
         event.preventDefault();
    }
 
    if (event.keyCode == 46 || event.keyCode == 9 || event.keyCode == 8 )    {
    }
    else {
         if (event.keyCode < 95) {
           if (event.keyCode < 45 || event.keyCode > 57) {
                 event.preventDefault();
           }
         } 
         else {
               if (event.keyCode < 96 || event.keyCode > 105) {
                   event.preventDefault();
               }
         }
       }
}

//validar curp
function curpValida(valor) {

    var validador;
    var curp=valor;

    // Expresion regular para curp
    var re = /^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/,
        validado = curp.match(re);
    
    if (!validado){  //Coincide con el formato general?
        validador = "No";
    }else{
        validador = "Si";
    }
    return validador;
}

//Revisar clave repetida
function revisar_clave(valor){
    $.ajax({
        url:"rClave.php",
        type:"POST",
        dateType:"json",
        data:{valor},
        success:function(respuesta){
            res =parseInt(respuesta);
            if (res == 0) {
                $("#clave").css("color", obscuro);
                cambioColor('.5s' , obscuro , 'Programa de ejemplo');
            }else{
                $("#clave").css("color", rojo);
                cambioColor('.5s' , rojo , 'Clave repetida');
            }
        },
        error:function(xhr,status){
            alert("Error en metodo AJAX"); 
        },
    });
}
//llenar combo
function combo_ecivil()
{
    $.ajax({
        url : 'comboEcivil.php',
        data : {},
        type : 'POST',
        dataType : 'html',
        success : function(respuesta) {
            $("#ecivil , #eEcivil , #mEcivil").empty();
            $("#ecivil , #eEcivil , #mEcivil").html(respuesta);    
            selectTwo();
        },
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        },
    });
}

function selectTwo(){
    $( ".select2" ).select2({
        theme: "bootstrap4",
        placeholder: 'Seleccione...'
    });
}

function nuevo_registro(){
    $("#Listado1").hide();
    $("#guardar").fadeIn();
    $("#clave").focus();
}