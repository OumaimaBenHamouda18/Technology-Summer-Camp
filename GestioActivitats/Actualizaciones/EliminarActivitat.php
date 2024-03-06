<!DOCTYPE html>
<html>
<head>
        <!--Nom fitxer: EliminarActivitat.php
        Autora: Sujil Shrestha
        Data creació: 07/02/2024 -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>EliminarActivitat</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../../style.css">
</head>
<body>


<div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-7">
           
                <div class="card px-5" >
                <h2>Eliminar Actividad</h2>
                <form method="POST" action="EliminarActivitat.php">
                    <div class="forms-inputs mb-4">
                        <label for="NOMBRE">NOMBRE: </label>
                        <input type="text" name="NOMBRE" id="NOMBRE" size=20 required>
                    </div>
        
           

        <input class="button"type="submit" name="Eliminar" value="Eliminar"></form>    
                </div>
            </div>
        </div>
    </div>
    
<body>

<?php
            //comprobacion del boton
            if (isset($_POST["Eliminar"])){
            //establecer conexion con base de datos
            $servidor = "localhost";
            $usuario = "root";
            $password = "";
            $bd = "campamenteoverano";
            //crear conexión
            $enlace =mysqli_connect($servidor, $usuario, $password, $bd);
            //comprobar conexión
            if (!$enlace) {
            echo "No he podido establecer conexión con la base de datos";
            }

            $NOMBRE=$_POST["NOMBRE"];
            $sentencia= "SELECT count(*) FROM actividades Where NOMBRE='$NOMBRE'";

            $result=mysqli_query($enlace, $sentencia);
            $fila= mysqli_fetch_row($result);

            if ($fila[0]==1) {

                $NOMBRE=$_POST["NOMBRE"];

                //ELIMNAR todos los registros de las tablas que hacen referencia a esta actividad


                $sentencia1 = "DELETE FROM asistir Where codigo_A=(select codigo from Actividades Where NOMBRE='$NOMBRE')";
                mysqli_query($enlace, $sentencia1);

                $sentencia2 = "DELETE FROM dirigir Where codigo_A=(select codigo from Actividades Where NOMBRE='$NOMBRE')";
                mysqli_query($enlace, $sentencia2);
               
                echo "<br>";
                //se ejecuta la sentencia en el sistema gestor
                
                $sentencia = "DELETE FROM actividades Where NOMBRE='$NOMBRE'";
                mysqli_query($enlace, $sentencia);
                echo "<span class='exito'>El registro se ha eliminado correctamente</span>";

            } else {
        
                echo "<span class='error'>Actividad no existe</span>";
           
            }
            //cerrar conexión
            mysqli_close($enlace);
        }
?>
</body>
</html>