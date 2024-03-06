<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../../style.css">
    <title> Modificar Habitación Prticipante </title>
</head>
<body>
    




        <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-7">
                <div class="card px-5" >
                <h2>Modificar Habitación Participante</h2>

                <form method="POST" action="ModificarHabitacioParticipants.php">
                <div class="forms-inputs mb-4">
                    <label for="CODIGO">CODIGO: </label>
                    <input type="text" name="CODIGO" id="CODIGO" size=20 required> 
                </div>
               <div class="forms-inputs mb-4">
                    <label for="CALLE">CALLE: </label>
                    <input type="text" name="CALLE" id="CALLE" size=20 required> 
               </div>

                <div class="forms-inputs mb-4">
                    <label for="CODIGO_POSTAL">CODIGO_POSTAL: </label>
                    <input type="text" name="CODIGO_POSTAL" id="CODIGO_POSTAL" size=20 required> 
                </div>

                <div class="forms-inputs mb-4">
                    <label for="PUERTA">PUERTA: </label>
                    <input type="text" name="PUERTA" id="PUERTA" size=20 required>
                </div>
               
                <div class="forms-inputs mb-4">
                    <label for="PROVINCIA">PROVINCIA:</label>
                    <input type="text" name="PROVINCIA" id="PROVINCIA" size=20 required> 
                </div>
            

                <input class="button"type="submit" name="Modificar" value="Modificar">
            </form>
                </div>
            </div>
        </div>
    </div>
<body>
<?php
            //comprobacion del boton
            if (isset($_POST["Modificar"])){
            //establecer conexion con base de datos
            $servidor = "localhost";
            $usuario = "root";
            $password = "";
            $bd = "campamenteoVerano";
            //crear conexión
            $enlace =mysqli_connect($servidor, $usuario, $password, $bd);
            //comprobar conexión
            if (!$enlace) {
            echo "No he podido establecer conexión con la base de datos";
            }

            $CODIGO=$_POST["CODIGO"] ;
            $sentencia= "SELECT count(*) FROM ubicaciones Where CODIGO= '$CODIGO'";

            $result=mysqli_query($enlace, $sentencia);

            $fila= mysqli_fetch_row($result);

            if ($fila[0]==1) {
                $CODIGO=$_POST["CODIGO"];
                $CALLE=$_POST["CALLE"];
                $CODIGO_POSTAL=$_POST["CODIGO_POSTAL"];
                $PUERTA= $_POST["PUERTA"];
                $PROVINCIA= $_POST["PROVINCIA"];
                $sentencia = "UPDATE ubicaciones
                SET CALLE='$CALLE', CODIGO_POSTAL='$CODIGO_POSTAL', PUERTA='$PUERTA', PROVINCIA='$PROVINCIA' WHERE CODIGO='$CODIGO'";

                echo "<br>";
                //se ejecuta la sentencia en el sistema gestor

                mysqli_query($enlace, $sentencia);
                echo "<span class='exito'>El registro se ha modificado correctamente</span>";

            } else {
        
                echo "<span class='error'>El registro no existe</span>";
           
            }
           
            //cerrar conexión
            mysqli_close($enlace);
        }
?>
</body>
</html>