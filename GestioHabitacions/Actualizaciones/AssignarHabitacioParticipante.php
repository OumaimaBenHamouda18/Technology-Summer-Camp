<!DOCTYPE html>
<html>
<head>
        <!--Nom fitxer: AssignarHabitacioParticipante.php
        Autora: Sujil Shrestha
        Data creació: 02/02/2024 -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title> AssignarHabitacioParticipante </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
<div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-7">
                <div class="card px-5" >
                <h2>Assignar Habitación Participante</h2>

                <form method="POST" action="AssignarHabitacioParticipante.php">
                    <div class="forms-inputs mb-4">
                        <label for="CODIGO_U">CODIGO_U: </label>
                        <input type="text" name="CODIGO_U" id="CODIGO_U" size=20 required> 
                    </div>
                    <div class="forms-inputs mb-4">
                        <label for="CODIGO_S">CODIGO_P: </label>
                        <input type="text" name="CODIGO_P" id="CODIGO_p" size=20 required> 
                    </div>
                    <div class="forms-inputs mb-4">
                        <label for="FECHA_ENTRADA">FECHA_ENTRADA: </label>
                        <input type="date" name="FECHA_ENTRADA" id="FECHA_ENTRADA" size=20 required>
                    </div>
                    <div class="forms-inputs mb-4">
                        <label for="FECHA_SALIDA">FECHA_SALIDA: </label>
                        <input type="date" name="FECHA_SALIDA" id="FECHA_SALIDA" size=20 required> 
                    </div>
                   <div class="forms-inputs mb-4">
                        <label for="SALA_HABITACION">SALA_HABITACION: </label>
                        <input type="text" name="SALA_HABITACION" id="SALA_HABITACION" size=20 required>
                   </div>
                
                    <input class="button" type="submit" name="Assignar" value="Assignar">
    </form>
                </div>
            </div>
        </div>
    </div>
<?php
            //comprobacion del boton
            if (isset($_POST["Assignar"])){
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

            $CODIGO_U=$_POST["CODIGO_U"] ;
            $CODIGO_P=$_POST["CODIGO_P"];

            $sentencia= "SELECT count(*) FROM alojarparticipantes Where CODIGO_U= '$CODIGO_U' and CODIGO_P ='$CODIGO_P'";

            $result=mysqli_query($enlace, $sentencia);

            $fila= mysqli_fetch_row($result);

            if ($fila[0]) {
                echo "<span class='warning'>Participante ya alojado</span>";
            }
            else {

          
                $FECHA_ENTRADA=$_POST["FECHA_ENTRADA"];
                $FECHA_SALIDA=$_POST["FECHA_SALIDA"];
                $SALA_HABITACION=$_POST["SALA_HABITACION"];

                $sentenciaComprobacionFK1="SELECT COUNT(*) FROM ubicaciones WHERE codigo='$CODIGO_U'";
                $sentenciaComprobacionFK2="SELECT COUNT(*) FROM participantes WHERE dni='$CODIGO_P'";

                if(mysqli_fetch_row(mysqli_query($enlace,$sentenciaComprobacionFK1))[0]){
                   
                    if(mysqli_fetch_row(mysqli_query($enlace,$sentenciaComprobacionFK2))[0]){

                        $sentencia ="INSERT INTO alojarparticipantes values
                        ('$CODIGO_U', '$CODIGO_P', '$FECHA_ENTRADA', '$FECHA_SALIDA', '$SALA_HABITACION')";
                        echo "<br>";
                        //se ejecuta la sentencia en el sistema gestor
                        mysqli_query($enlace, $sentencia);
                        echo "<span class='exito'>Se ha assignado el habitacion correctamente</span>";

                    }
                    else echo "<span class='warning'>El campo codigo_P debe tener un valor de la tabla Participantes</span>";
               
            }
            else echo "<span class='warning'>El campo codigo_U debe tener un valor de la tabla Ubicaciones</span>";

            }

            //cerrar conexión
            mysqli_close($enlace);
        }
?>
</body>
</html>