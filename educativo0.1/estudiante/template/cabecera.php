<?php 
  session_start();
    if(!isset($_SESSION['usuario'])){
      header("Location:../index.php");
    } else {
      if($_SESSION['usuario']=="ok"){
       $id_usuario=$_SESSION['id'];
        $nombreUsuario=$_SESSION['nombreUsuario'];
      }

    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siistema Educativo</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
</head>
<body>

<?php $url= "http://".$_SERVER['HTTP_HOST']."/educativo0.1" ?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <ul class="nav navbar-nav">

        
            <a class="nav-item nav-link" href="<?php echo $url; ?> /estudiante/esccion/inicio.php">inicio</a>
            <a class="nav-item nav-link" href="<?php echo $url; ?> /estudiante/seccion/secciones.php">Secciones Activas</a>
            <a class="nav-item nav-link" href="<?php echo $url; ?> /estudiante/seccion/materias.php">Materias Activas</a>
            <a class="nav-item nav-link" href="<?php echo $url; ?> /estudiante/seccion/profesores.php">Profesores</a>
            <a class="nav-item nav-link" href="<?php echo $url; ?> /estudiante/seccion/cerrar.php">Cerrar Sesion</a>
            



            

            
       
        </ul>
    </nav>
    <div class="container">
        <br/>
        <dic class="row">