<?php session_start();?>
<?php 
    include 'seguridad.php';
    checkSID();
    if(!isset($_SESSION['user'])){header("location:/sistemaescolar/iniciarSesion.html");}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>AlumnoInsertado</title>
        <style type="text/css">
      .Botoninsertar{
        text-decoration: none;
        padding: 10px;
        font-weight: 600;
        font-size: 20px;
        color: #ffffff;
        background-color: #1883ba;
        border-radius: 6px;
        border: 2px solid #0016b0;
      }
      .regresar{
    margin-left: 5%;
    padding-top: 20px;
    padding-bottom: 20px;
        }

        .regresar a{
            text-decoration: none;
            background-color: #DA4403;
            color: #FFFFFF;
            padding: 5px 10px 5px 10px;
            font-size: 1.2em;
            border-radius: 3px;
        }

        .regresar a:hover{
            background-color: #D58927;
        }
    </style>
    </head>
    <body >

        <h1>
        <table bgcolor="13AB91" width="1350"> 
            
                <tr> <th> <p style="color: White" >Insertar Alumno </p></th> </tr>
            </table>
        </h1>
        <div class="regresar">
        <a href="/sistemaescolar/index.php">Regresar</a>
        </div>
     <?php
    ReadCursa();
    include 'conexion.php';
    include_once 'nusoap/nusoap.php';
    if(isset($_POST['idAlumno']))
    {
        $idAlumnov = utf8_decode( $_POST['idAlumno']);
        $idMateriav = utf8_decode( $_POST['IdMateria']);
        $idCalificacionv = utf8_decode( $_POST['Calificacion']);

        $client = new nusoap_client($servidorWebInsertar,true);
        $err = $client->getError();
        if ($err) { 
            echo "<script type='text/javascript'>alert('Error envio Datos'); window.location.href = '/sistemaescolar/iniciarSesion.html';</script>";
        }

        $parametros = array('IdAlumno'=>$idAlumnov,'IdMateria'=>$idMateriav,'Calificacion'=>$idCalificacionv);
        $result = array();
        $result = $client->call('InsertarCursa', $parametros);

        if ($client->fault) {
            echo "<script type='text/javascript'>alert('Error conexion servidor '); window.location.href = '/sistemaescolar/iniciarSesion.html';</script>";
        }else{
            if($result['ValidadorRango'])
            {
                if($result['Validador'])
                {
                   insertLog($result['Sentencia']);
                   echo "<script type='text/javascript'>alert('Calificacion insertada');window.location.href = '/sistemaescolar/lib/insertarCalificacion.php';</script>";
                }else 
                {
                    echo "<script type='text/javascript'>alert('Calificación no insertada');window.location.href = '/sistemaescolar/lib/insertarCalificacion.php';</script>";
                }
            }else{
                echo "<script type='text/javascript'>alert('Campo calificacion fuera de rango');window.location.href = '/sistemaescolar/lib/insertarCalificacion.php';</script>";
            }
        }
    }
    ?>
     
   
    <center>
        <div>
            <form action="insertarcalificacion.php" method="post">
        <h4>Id Alumno: <input type="" name="idAlumno"></h4> 
            <table>
                    <tr><th>IdMateria: <input type="" name="IdMateria"></th><th>Calificacion: <input type="" name="Calificacion" pattern="[0-9]+" title="El campo sólo puede contener números."></th></tr>           
            </table>
              
              <input class="Botoninsertar" type = "submit">

             <br><br><br>

        </div>
    </form>

    
    </body>
</html>
