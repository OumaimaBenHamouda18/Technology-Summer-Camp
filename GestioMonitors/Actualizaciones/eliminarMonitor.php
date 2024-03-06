<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Monitor</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
  
<div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-7">
                <div class="card px-5" >
                    <h2>Eliminar Monitor</h2>

                    <form method="POST" action="eliminarMonitor.php">

                        <div class="forms-inputs mb-4">
                            <label for="dni">dni</label>
                            <input type="text" name="dni" id="dni" required>
                        </div>
                        <input class="button"type="submit" value="Eliminar Monitor" name="eliminar">

                    </form>        
                </div>
            </div>
        </div>
    </div>
</body>

<?php 
 
if(isset($_POST["eliminar"])){

    //connexion a la base de datos 
    $servername="localhost";
    $username="root";
    $password="";
    $dbname="campamenteoVerano";
    $enlace=new mysqli($servername,$username,$password,$dbname);

    //Recoger datos del formulario
    $dni=$_POST["dni"];

    //sentencia insert
    $sentenciaComprobacion="SELECT count(*) from supervisores where dni='$dni'";

    //ejecutar la sentencia
    $result=mysqli_query($enlace,$sentenciaComprobacion);

    $fila=mysqli_fetch_row($result);

    if($fila[0]) {

        //eliminar los registros del participante en las tablas donde se manifesta como clave externa

        $sentenciaEliminar="DELETE FROM  supervisar WHERE  dni_S='$dni';"; 
        $sentenciaEliminar .="DELETE FROM  dirigir WHERE  dni_S='$dni';";
        $sentenciaEliminar.="DELETE FROM  ALOJARSUPERVISORES WHERE CODIGO_S='$dni'";

        mysqli_multi_query($enlace,$sentenciaEliminar);
        while (mysqli_next_result($enlace)) 
            if (!mysqli_more_results($enlace)) 
                break;

        //eliminar participante
        $sentencia="DELETE FROM  supervisores WHERE  dni='$dni' ";
        $result=mysqli_query($enlace,$sentencia);
        if($result) echo "<span class='exito'>Supervisor eliminado con exito</span>";

    }

    else echo "<span class='error'>Supervisor no existe</span>";

    mysqli_close($enlace);
}


?>
</html>