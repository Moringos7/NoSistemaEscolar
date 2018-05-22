<?php session_start();?>
<?php 
    include 'seguridad.php';
    checkSID();
    if(!isset($_SESSION['user'])){header("location:/sistemaescolar/iniciarSesion.html");}
?>
<!DOCTYPE html>
<html>
<head>
    <title>MateriaInsertado</title>
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
    
        <tr> <th> <p style="color: White" >Insertar Materia</p></th> </tr>
    </table>
</h1>
<div class="regresar">
        <a href="/sistemaescolar/index.php">Regresar</a>
        </div>
<?php 
    ReadMateria();
    include 'conexion.php';

    if(isset($_POST['nombre']))
    {
        $Nombrev =utf8_decode( $_POST['nombre']);

        $query="INSERT INTO materia(Nombre)values('{$Nombrev}');";


        if($Nombrev!="")
        {
            $insertando = mysqli_query($conexion, $query);
            insertLog($query);
            if($insertando)
            {
                echo"<script type='text/javascript'>alert('Inserción realizada correctamente'); window.location.href = '/sistemaescolar/lib/insertarMateria.php';</script>";
            } else 
            {
                  echo"<script type='text/javascript'>alert('Error al insertar '); window.location.href = '/sistemaescolar/lib/insertarMateria.php';</script>";
            }
        }
    }
    mysqli_close($conexion);
?>


<center>


    <div>
        <form action="insertarmateria.php" method="post">
    <h4>Materia(Nombre): <input type="text" name="nombre"></h4> 
        
          <input class="Botoninsertar" type = "submit">

         <br><br><br>

    </div>
</form>

 
    

 
</body>
</html>
