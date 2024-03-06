<!DOCTYPE html>
<html>
    <head>
        <!--Nom fitxer: ConsultarActivitatsData.php
            Autora: Sujil Shrestha
            Data creació: 05/02/2024 -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>ConsultarActivitatData</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="../../style.css">
        <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500&display=swap" rel="stylesheet">
    </head>
    <body>
    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-7">
            <h2>Consultar Actividad por fecha</h2>
                <div class="card px-5" >
                   
                    <form method="POST" action="ConsultarActivitatsData.php">
                    <div class="forms-inputs">
                        <label for="fecha"> fecha: </label>
                        <input type="Date" name="fecha" id="fecha" size=20 required> 
                    </div> 

                <input class="button"type="submit" name="Consultar" value="Consultar">
            </form>

                </div>
            </div>
        </div>
    </div>
        
        <?php
        if (isset($_POST["Consultar"])){
        //establecer conexion con mysql
            $servidor = "localhost";
            $usuario = "root";
            $password = "";
            $bd = "campamenteoverano";

            //crear conexión
            $enlace = mysqli_connect($servidor, $usuario, $password, $bd);

            //se crea la sentencia de la sentencia
            $fecha=$_POST["fecha"];
            if(mysqli_fetch_row(mysqli_query($enlace, "SELECT COUNT(*) from asistir WHERE fecha = '$fecha'"))[0]){



                $sentencia= "SELECT * FROM actividades where codigo IN (select codigo_A FROM asistir WHERE fecha = '$fecha')";

                //se ejecuta la sentencia en el sistema gestor
                $result=mysqli_query($enlace, $sentencia);
        
                //se visualiza la cabecera de la tabla con el nombre de los atributos
                $grado = mysqli_num_fields($result);
            //se visualizan los registros en forma de tabla
            $cardinalidad = mysqli_num_rows($result);
            echo  "<table border=2  class='resultado table table-striped'>";
            echo "<thead>
            <tr>
              <th scope='col'>CODIGO</th>
              <th scope='col'>DISCRIPCION </th>
              <th scope='col'>NOMBRE</th>
              <th scope='col'>COSTOADDICIONAL</th>
              <th scope='col'>DURACION </th>
              <th scope='col'>ESTADO</th>
              <th scope='col'>MATERIAL</th>
              <th scope='col'>CODIGO_U</th>
            </tr>
          </thead>";
        
        
            while ($cardinalidad!=0) {
                $fila = mysqli_fetch_row($result);
                echo "<tr>";
                for ($x = 0; $x < $grado; $x++) {
                    echo "<td>";
                    echo "$fila[$x]"." ";
                    echo "</td>";
                }
                echo "</tr>";
                $cardinalidad--;
            }
            echo "</table>";

            }
            else echo "<span class='error'>Actividad no existe</span>";


            //cerrar conexión
            mysqli_close($enlace);
 
        }
        ?> 
    </body>
</html>