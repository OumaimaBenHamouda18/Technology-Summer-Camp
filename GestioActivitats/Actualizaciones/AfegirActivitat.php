<!DOCTYPE html>
<html>
    <head>
        <!--Nom fitxer: AfegirActivitat.php
            Autora: Sujil Shrestha
            Data creació: 07/02/2024 -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>AfegirActivitat</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="../../style.css">
    </head>
    <body>
    
 
<div class="container mt-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
        <div class="card px-5" id="form1">
        <h2>Agregar Actividad</h2>

            <form method="POST" action="AfegirActivitat.php">
    
                <div class="forms-inputs mb-4">
                    <label for="CODIGO">CODIGO: </label>
                    <input type="text" name="CODIGO" id="CODIGO" size=20 required> 
                </div>

                <div class="forms-inputs mb-4">
                    <label for="DISCRIPCION">DISCRIPCION: </label>
                    <input type="text" name="DISCRIPCION" id="DISCRIPCION" size=20 required> 
                </div>

                <div class="forms-inputs mb-4">
                    <label for="NOMBRE">NOMBRE: </label>
                    <input type="text" name="NOMBRE" id="NOMBRE" size=20 required>
                </div>

          
                <div class="forms-inputs mb-4">
                    <label for="COSTOADDICIONAL">COSTOADDICIONAL: </label>
                    <input type="text" name="COSTOADDICIONAL" id="COSTOADDICIONAL" size=20 required> 
                </div>
                <div class="forms-inputs mb-4">
                    <label for="DURACION">DURACION: </label>
                    <input type="text" name="DURACION" id="DURACION" size=20 required> 
                </div>
               <div class="forms-inputs mb-4">
                    <label for="ESTADO">ESTADO: </label>
                    <input type="text" name="ESTADO" id="ESTADO" size=20 required>
               </div>
               <div class="forms-inputs mb-4">
                <label for="MATERIAL">MATERIAL: </label>
                <input type="text" name="MATERIAL" id="MATERIAL" size=20 required> 
               </div>
               <div class="forms-inputs mb-4">
                <label for="CODIGO_U">CODIGO_U: </label>
                <input type="text" name="CODIGO_U" id="CODIGO_U" size=20 required>
               </div>

                <input class="button" type="submit" name="Assignar" value="Assignar">
            </form>


            </div>
            </div>
        </div>
    </div>
</div>
<?php
            //comprobacion del boton
            if (isset($_POST["Assignar"])){
            //establecer conexion con mysql
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
            $sentencia= "SELECT count(*) FROM actividades Where CODIGO= '$CODIGO'";

            $result=mysqli_query($enlace, $sentencia);

            $fila= mysqli_fetch_row($result);

            if ($fila[0]==1) {
            echo "<span class='warning'>Actividad ya existe</span>";
            } else {

            $CODIGO=$_POST["CODIGO"];
            $DISCRIPCION=$_POST["DISCRIPCION"];
            $NOMBRE=$_POST["NOMBRE"];
            $COSTOADDICIONAL=$_POST["COSTOADDICIONAL"];
            $DURACION=$_POST["DURACION"];
            $ESTADO=$_POST["ESTADO"];
            $MATERIAL=$_POST["MATERIAL"];
            $CODIGO_U=$_POST["CODIGO_U"];

            //control de foreign keys
        $sentenciaComprobacionFK="SELECT COUNT(*) FROM ubicaciones WHERE codigo='$CODIGO_U'";
        if(mysqli_fetch_row(mysqli_query($enlace,$sentenciaComprobacionFK))[0]){
            $sentencia ="INSERT INTO actividades values
            ('$CODIGO', '$DISCRIPCION', '$NOMBRE', '$COSTOADDICIONAL', '$DURACION', '$ESTADO', '$MATERIAL', '$CODIGO_U')";
              echo "<br>";
              //se ejecuta la sentencia en el sistema gestor
              mysqli_query($enlace, $sentencia);
              echo "<span class='exito'>Se ha assignado el actividad correctamente</span>";
        }
        else echo "<span class='warning'>El campo codigo_U debe tener un valor de la tabla Ubicaciones</span>";
      
            }
          

            //cerrar conexión
            mysqli_close($enlace);
        }
?>
</body>
</html>