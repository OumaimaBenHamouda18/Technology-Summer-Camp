<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Participante por dni</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../../style.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500&display=swap" rel="stylesheet">
</head>
<body>
  

    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-7">
             <div class="card px-5 py-5" >
                <h2>Consultar Participante por dni</h2>
    
                <form method="POST" action="ConsultarParticipantesDni.php">
                
                    <div class="forms-inputs mb-4">
                        <label for="dni">dni</label>
                        <input type="text" name="dni" id="dni" required>
                    </div>
                    <input class="button" type="submit" name="consultar" value="Consultar participante"> 
        
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

    $dni=$_POST["dni"];

    //sentencia select

    if(mysqli_fetch_row(mysqli_query($enlace, "SELECT COUNT(*) from PARTICIPANTES where dni='$dni'"))[0]){
        $sentenciaSelect="SELECT * from PARTICIPANTES where dni='$dni'";
        $result=mysqli_query($enlace,$sentenciaSelect);
        $fila=mysqli_fetch_row($result);
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
        echo "<tr>";
        for($x=0;$x<$grado;$x++){
            echo "<td>";
            echo $fila[$x];
            echo "</td>";
            }
        echo "</tr>";
        echo "</table>";
    }

    else echo "<span class='error'>No hay ningun participante con dni: $dni</span>";
  
    mysqli_close($enlace);
    }



?>
</html>