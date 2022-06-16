

<?php
    session_start();
    include('config/db.php'); 
        

    
    $usuario=(isset($_POST['usuario']))?$_POST['usuario']:"";
    
    if($_POST){
        $sentenciaSQL= $conexion->prepare("SELECT * FROM estudiante WHERE usuario_estudiante = :usuario");
        $sentenciaSQL->bindParam(':usuario',$usuario);
        $sentenciaSQL->execute();
        $estudiante=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

            $txtID=$estudiante['id_estudiante'];
            $txtCedula=$estudiante['cedula_estudiante'];
            $txtNombre=$estudiante['nombre_estudiante'];
            $txtApellido=$estudiante['apellido_estudiante'];
            $txtSemestre=$estudiante['semestre_estudiante'];
            $txtCorreo=$estudiante['correo_estudiante'];
            $txtGenero=$estudiante['genero_estudiante'];
            $txtUsuario=$estudiante['usuario_estudiante'];
            $txtPass=$estudiante['pass_estudiante'];
            header("Location:index.php");
            

        if(($_POST['usuario']==$txtUsuario)&&($_POST['contrasenia']==$txtPass)
       ){
            
        
        $_SESSION['usuario']="ok";
        $_SESSION['id'] = $txtID;
        $_SESSION['nombreUsuario'] = $txtNombre;
        header("Location:seccion/inicio.php");
            
        } else {
            
            $mensaje="Error... datos incorrectos";
            header("Location:index.php");
    
        }

      
    }

    


?>

<!doctype html>
<html lang="en">
  <head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>


  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <ul class="nav navbar-nav">
            <li class="nav-item ">
                <a class="nav-link" href="../index.php">Volver al Menu Principal</a>
             </li>

             <li class="nav-item ">
                <a class="nav-link" href="singup.php">Registrarse </a>
             </li>

        </ul>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
            </div>

            <div class="col-md-4">
                <br><br><br>
                <div class="card">
                    <div class="card-header">
                        Login
                    </div>
                    <div class="card-body">

                        <?php if(isset($mensaje)){ ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $mensaje;?>
                        </div>
                        <?php } ?>

                        <form method="POST">

                        <div class = "form-group">
                        <label>Usuario</label>
                        <input type="text" class="form-control" name="usuario" placeholder="Escribe tu Usuario">
                        </div>

                        <div class="form-group">
                        <label>Contraseña: </label>
                        <input type="password" class="form-control" name="contrasenia" placeholder="Escribe tu Contraseña">
                        </div>

                        <button type="submit" class="btn btn-primary">Ingresar como Estudiante</button>
                        </form>
                        
                        
                        
                    </div>
                   
                </div>
                
            </div>
            
        </div>
    </div>

  </body>
</html>