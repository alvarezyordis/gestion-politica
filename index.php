<?php 
  $alert='';
session_start();

/*  if(!empty($_SESSION['active'])){
   header('location: principal.php');
}else{  */

  if(!empty($_POST)){
    if (empty($_POST['usuario']) || empty($_POST['clave'])){
      $alert='Ingrese datos';
    }else{
      require_once "conexionBD.php";

      $user=mysqli_real_escape_string($conection, $_POST['usuario']);
      $pass=mysqli_real_escape_string($conection, $_POST['clave']);

      $query=mysqli_query($conection,"SELECT * FROM usuario WHERE usuario='$user' AND clave='$pass'");
      $result=mysqli_num_rows($query);

        if ($result>0) {
          $data=mysqli_fetch_array($query);

          $_SESSION['active']=true;
          $_SESSION['idUser']=$data['idusuario'];
          $_SESSION['nombre']=$data['nombre'];
          $_SESSION['email']=$data['email'];
          $_SESSION['user']=$data['usuario'];
          $_SESSION['rol']=$data['rol'];

          if ($data['rol']==1) {
              header('location: principal.php');
          }if ($data['rol']==2) {
              header('location: usuario/principal.php');
         
          }

        }else{
                $alert='Datos incorrectos';
                session_destroy();
    }

  }
}
?>


<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Inicio de sesión</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>


  <body class="jumbotron" style="background-image: url(imagenes/chavez1.jpg); background-size: 100%;">
 <a class="nav-link" href="#">
         <!-- <span><center><h1>RAAS-PLAZA<center></h1></span>-->
   
         <span><center><h2>BIENVENIDO A LA SALA SITUACIONAL<center></h2></span>
   </a>
          <div class="alert"><h3><?php echo isset($alert)? $alert:''; ?></h3>
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header"><h4>Inicio de sesión.</h4></div>
      <div class="card-body">

    <form action="" method="POST"> 
          <label for="usuario">Correo electrónico</label>
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" name="usuario" class="form-control"></div>
          </div>
          <label for="clave">Contraseña</label>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" name="clave" class="form-control">
              
            </div>
          </div>
          
        <div class="form-group"> <!-- Submit Button -->
          
        <button type="submit" class="btn btn-primary" value="Ingresar">Aceptar</button>
        </div> 
      </form>
              <!--<div class="text-center">
                <a class="d-block small" href="forgot-password.html">olvidó contraseña?</a>
              </div>-->
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
