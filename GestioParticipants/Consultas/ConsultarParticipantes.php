<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Participante</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="../../style.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500&display=swap" rel="stylesheet">
</head>
<body>
    
    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-7">
             <div class="card px-5 py-5" >
                <h2>Consultar Participante</h2> 
                <form method="POST" action="ConsultarParticipantes.php">
                    <input class="button" type="submit" name="consultar" value="Consultar participantes"> 
                </form>
                </div>
            </div>
        </div>
    </div>

</body>

<?php 
 
if(isset($_POST["consultar"])){

    //connexion a la base de datos 
    $servername="localhost";
    $username="root";
    $password="";
    $dbname="campamenteoVerano";
    $enlace=new mysqli($servername,$username,$password,$dbname);


    //sentencia select

        $sentenciaSelect="SELECT * from PARTICIPANTES";
        $result=mysqli_query($enlace,$sentenciaSelect);
        $carnalidad=mysqli_num_rows($result);
        $grado=mysqli_num_fields($result);
        echo  "<table border=2  class='resultado table table-striped'>";
        echo "<thead>
        <tr>
          <th scope='col'>dni</th>
          <th scope='col'>Nombre</th>
          <th scope='col'>Apellidos</th>
          <th scope='col'>Dirección</th>
          <th scope='col'>Telefono</th>
          <th scope='col'>Correo</th>
          <th scope='col'>Fecha_Nacimiento</th>
          <th scope='col'>Tarjeta_sanitaria</th>
          <th scope='col'>Codi_Ins</th>
        </tr>
      </thead>";
        while($carnalidad!=0){
            echo "<tr>";
            $fila=mysqli_fetch_row($result);
            for($x=0;$x<$grado;$x++){
                echo "<td>";
                echo $fila[$x];
                echo "</td>";
            }
            echo "</tr>";
            $carnalidad--;
        }
        echo "</table>";
  
        mysqli_close($enlace);
    }



?>
</html>