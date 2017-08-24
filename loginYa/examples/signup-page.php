<?php
  session_start();
  //require_once("sesion.class.php");
  //$sesion = new sesion();
  $estado = "";

  if( isset($_POST["iniciar"]) )
  {
    $usuario = $_POST["correo_admin"];
    $password = $_POST["contrasenia"];
    
    if(validarUsuario($usuario,$password) == true)
    {
    	$_SESSION["usuario"]=$usuario;
    	$_SESSION["tipo"]="Admin";
    	

    	$conexion = new mysqli("localhost","root","","tuvei");
	    $consulta = "select nombre from admin where correo = '$usuario';";
	    $result = $conexion->query($consulta);
	    
	    if($result->num_rows > 0)
	    {
	      $fila = $result->fetch_assoc();
	      $_SESSION["user"] = $fila["nombre"];
	    }

      //$sesion->set("usuario",$usuario);
      header("location: ../../indexAdmin.php");
    }
    else 
    {
      $estado = "Verifica tu nombre de usuario y contraseña";
    }
  }
  
  function validarUsuario($usuario, $password)
  {
    $conexion = new mysqli("localhost","root","","tuvei");
    $consulta = "select contrasenia from admin where correo = '$usuario';";
    
    $result = $conexion->query($consulta);
    
    if($result->num_rows > 0)
    {
      $fila = $result->fetch_assoc();
      if( strcmp($password,$fila["contrasenia"]) == 0 )
        return true;            
      else          
        return false;
    }
    else
        return false;
  }

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	
	<link rel="icon" type="image/png" href="../assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Iniciar Sesion</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

	<!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/material-kit.css" rel="stylesheet"/>

</head>

<body class="signup-page">
	<nav class="navbar navbar-transparent navbar-absolute">
    	<div class="container">
        	<!-- Brand and toggle get grouped for better mobile display -->
        	<div class="navbar-header">
        		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example">
            		<span class="sr-only">Toggle navigation</span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
        		</button>
        		<a class="navbar-brand" href="http://www.creative-tim.com">Inicio sesión</a>
        	</div>

        	<div class="collapse navbar-collapse" id="navigation-example">
        		<ul class="nav navbar-nav navbar-right">
				
        		</ul>
        	</div>
    	</div>
    </nav>

    <div class="wrapper">
		<div class="header header-filter" style="background-image: url('../assets/img/w.jpg'); background-size: cover; background-position: top center;">
			<div class="container">
				<div class="row">
					<div class="col-md-5 col-md-offset-4 col-sm-6 col-sm-offset-3">
						<div class="card card-signup">
							<form class="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
								<div class="header header-primary text-center">
									<h3>¡HOLA!</h3>
									
								</div>
								<p class="text-divider">Por favor introduzca sus datos</p>
								<div class="content">

									<div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">email</i>
										</span>
										<input type="text" placeholder="Correo..." class="form-control" name="correo_admin" />
									</div>

									<div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">face</i>
										</span>
										<input type="text" class="form-control" placeholder="Su clave túvei..." name="clave_tuvei">
									</div>

									<div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">lock_outline</i>
										</span>
										<input type="password" placeholder="Su contraseña..." class="form-control" name="contrasenia"/>
									</div>

								</div>
								<div>
									
								<p style="text-align: center; color: red;">
									<?php echo $estado; ?>
								</p>
								</div>
								<div class="footer text-center">
									<input type="submit" name ="iniciar" class="btn btn-primary btn-lg" style="color:black" value="INGRESAR">
								</div>
							</form>
							<div class="column">
								<div class="col-md-6 text-left"> <a href="#" style="color: black">¿Olvidaste tu contraseña?</a> </div>
								<div class="col-md-6 text-right"><a href="../../inicio.html" style="color: black">Registrarse</a> </div>
							</div><hr>
						</div>
					</div>
				</div>
			</div>

			<footer class="footer">
		        <div class="container">
		           
		          
		        </div>
		    </footer>

		</div>

    </div>


</body>
	<!--   Core JS Files   -->
	<script src="../assets/js/jquery.min.js" type="text/javascript"></script>
	<script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="../assets/js/material.min.js"></script>

	<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
	<script src="../assets/js/nouislider.min.js" type="text/javascript"></script>

	<!--  Plugin for the Datepicker, full documentation here: http://www.eyecon.ro/bootstrap-datepicker/ -->
	<script src="../assets/js/bootstrap-datepicker.js" type="text/javascript"></script>

	<!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc -->
	<script src="../assets/js/material-kit.js" type="text/javascript"></script>

</html>
