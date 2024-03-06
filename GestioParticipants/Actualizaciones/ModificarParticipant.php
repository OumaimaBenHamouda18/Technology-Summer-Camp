<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Participante</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../../style.css">
</head>
<body>

    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-7">
                <div class="card px-5 " >
                    <h2>Modificar Participante</h2>

                    <form method="POST" action="ModificarParticipant.php">

                    <div class="forms-inputs mb-4">
                        <label for="dni">dni</label>
                        <input type="text" name="dni" id="dni" required>
                    </div>

                    <div class="forms-inputs mb-4">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" required>
                    </div>
                    <div class="forms-inputs mb-4">
                        <label for="apellidos">Apellidos</label>
                        <input type="text" name="apellidos" id="apellidos" required>
                    </div>
                       
                    <div class="forms-inputs mb-4">
                        <label for="direccion">Direccion</label>
                        <input type="text" name="direccion" id="direccion" required>
                    </div>
                        
                    <div class="forms-inputs mb-4">
                        <label for="telefono">Telefono</label>
                        <input type="number" name="telefono" id="telefono" required>
                    </div>
                    
                    <div class="forms-inputs mb-4">
                        <label for="correo">correo</label>
                        <input type="email" name="correo" id="correo" required>
                    </div>
                        
                    <div class="forms-inputs mb-4">
                        <label for="fecha_nacimiento">fecha_nacimiento</label>
                        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" required>
                    </div>
                       
                    <div class="forms-inputs mb-4">
                        <label for="tarjeta_sanitaria">tarjeta_sanitaria</label>
                        <input type="text" name="tarjeta_sanitaria" id="tarjeta_sanitaria" required>
                    </div>
                       
                    <div class="forms-inputs mb-4">
                        <label for="codi_Ins">codi_Ins</label>
                        <input type="text" name="codi_Ins" id="codi_Ins" required>
                    </div> 


                    <input class="button"type="submit" value="modificar participant" name="modificar">

                    </form>     
                </div>
            </div>
        </div>
    </div>
</body>


<?php 

if(isset($_POST["modificar"])){

    //connexion a la base de datos 
    $servername="localhost";
    $username="root";
    $password="";
    $dbname="campamenteoVerano";
    $enlace=new mysqli($servername,$username,$password,$dbname);

    //Recoger datos del formulario
    $dni=$_POST["dni"];
    $nombre=$_POST["nombre"];
    $apellidos=$_POST["apellidos"];
    $direccion=$_POST["direccion"];
    $telefono=$_POST["telefono"];
    $correo=$_POST["correo"];
    $fecha_nacimiento=$_POST["fecha_nacimiento"];
    $tarjeta_sanitaria=$_POST["tarjeta_sanitaria"];
    $codi_Ins=$_POST["codi_Ins"];

    //sentencia insert
    $sentenciaComprobacion="SELECT count(*) from PARTICIPANTES where dni='$dni'";

    //ejecutar la sentencia
    $result=mysqli_query($enlace,$sentenciaComprobacion);

    $fila=mysqli_fetch_row($result);

    if($fila[0]) {

        //control de foreign keys
        $sentenciaComprobacionFK="SELECT COUNT(*) FROM INSCRPCIONES WHERE codi_Ins='$codi_Ins'";
        if(mysqli_fetch_row(mysqli_query($enlace,$sentenciaComprobacionFK))[0]){
            $sentencia="UPDATE PARTICIPANTES SET nombre='$nombre',apellidos='$apellidos',direccion='$direccion',telefono='$telefono',correo='$correo',fecha_nacimiento='$fecha_nacimiento',tarjeta_sanitaria='$tarjeta_sanitaria',codi_Ins='$codi_Ins'WHERE  dni='$dni' ";
            $result=mysqli_query($enlace,$sentencia);
            if($result) echo "<span class='exito'>Participante modificado con exito</span>";
        }
        else echo "<span class='warning'>El campo codi_Ins debe tener un valor de la tabla Inscripciones<span>";



     

    }
    else echo "<span class='error'>Participante no existe</span>";

    mysqli_close($enlace);
}


?>
</html>