<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500&display=swap" rel="stylesheet">

   
    <title>Authentificar</title>
</head>
<style>
     body{
        background-image:url("bg.png");
        background-size:cover;
      
     }
</style>
<body >

<div class="container mt-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6">

            <div class="card px-5 py-5" id="form1">
            <h1>TechCat</h1>

                <form method="POST"action="authentificar.php">
                    <div class="forms-inputs mb-4" >
                        <input type="text" name="usuari" id="usuari" placeholder="Usuario">
                    </div>
                    <div class="forms-inputs mb-4" >
                        <input type="password" name="password" id="password" placeholder="Contraseña">
                    </div>
                
                    <input class="btn button btn-dark "type="submit" value="Acceder" name="acceder">
            
                </form>
            </div>
        </div>
    </div>
</div>


   
    
    <?php
    if(isset($_POST["acceder"])){


            //connexion a la base de datos 
            $servername="localhost";
            $username="root";
            $password="";
            $dbname="campamenteoVerano";

$enlace=new mysqli($servername,$username,$password,$dbname);

$nomUsuari=$_POST["usuari"];
$contrasenya=$_POST["password"];

$sentencia="SELECT COUNT(*) FROM USUARIS WHERE usuari='$nomUsuari' and contrasenya='$contrasenya'";

$result=mysqli_query($enlace,$sentencia);
$fila=mysqli_fetch_row($result);
if($fila[0]){
    echo "usuari exist";
    if($nomUsuari=='admin' ){
        header("Location:index.html");
    }
}
else {
    echo '<span class="error">Usuari no existeix<br></span>';
    
}


mysqli_close($enlace);



        

}


    ?>
    
</body>


</html>