<?php 

    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $txtCedula=(isset($_POST['txtCedula']))?$_POST['txtCedula']:"";
    $txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
    $txtApellido=(isset($_POST['txtApellido']))?$_POST['txtApellido']:"";
    $txtEspecialidad=(isset($_POST['txtEspecialidad']))?$_POST['txtEspecialidad']:"";
    $txtCorreo=(isset($_POST['txtCorreo']))?$_POST['txtCorreo']:"";
    $txtGenero=(isset($_POST['txtGenero']))?$_POST['txtGenero']:"";
    $txtUsuario=(isset($_POST['txtUsuario']))?$_POST['txtUsuario']:"";
    $txtPass=(isset($_POST['txtPass']))?$_POST['txtPass']:"";
    $txtEstatus=(isset($_POST['txtEstatus']))?$_POST['txtEstatus']:"";
    $accion=(isset($_POST['accion']))?$_POST['accion']:"";

    include('config/db.php'); 

    switch($accion){
        case "Agregar";
        
            $sentenciaSQL= $conexion->prepare ("INSERT INTO profesor (cedula_profesor,nombre_profesor,apellido_profesor,especialidad_profesor,correo_profesor,genero_profesor,usuario_profesor,pass_profesor,estatus_profesor ) 
            VALUES (:cedula_profesor,:nombre_profesor,:apellido_profesor,:especialidad_profesor,:correo_profesor,:genero_profesor,:usuario_profesor,:pass_profesor,:estatus_profesor);");
            $sentenciaSQL->bindParam(':cedula_profesor',$txtCedula);
            $sentenciaSQL->bindParam(':nombre_profesor',$txtNombre);
            $sentenciaSQL->bindParam(':apellido_profesor',$txtApellido);
            $sentenciaSQL->bindParam(':especialidad_profesor',$txtEspecialidad);
            $sentenciaSQL->bindParam(':correo_profesor',$txtCorreo);
            $sentenciaSQL->bindParam(':genero_profesor',$txtGenero);
            $sentenciaSQL->bindParam(':usuario_profesor',$txtUsuario);
            $sentenciaSQL->bindParam(':pass_profesor',$txtPass);
            $sentenciaSQL->bindParam(':estatus_profesor',$txtEstatus);

            $sentenciaSQL->execute();
            header("Location:index.php");
            break;

            case "Cancelar";

                header("Location:index.php");
                break;
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
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
                <a class="nav-link" href="index.php">Ingresar </a>
             </li>

        </ul>
    </nav>

    <div class="col-md-9">
    <div class="card">

        <div class="card-header">
            Datos de profesor
        </div>

        <div class="card-body">
        <form method="POST" >

            <div class = "form-group">
            
            <input type="hidden" required readonly class="form-control" value="<?php echo $txtID;?>" name="txtID" id="txtID"  placeholder="ID">
            </div>

            <div class = "form-group">
            <label for="txtCedula">Cedula: </label>
            <input type="text" required class="form-control"  value="<?php echo $txtCedula;?>" name="txtCedula" id="txtCedula"  placeholder="Cedula del profesor">
            </div>

            <div class = "form-group">
            <label for="txtNombre">Nombre: </label>
            <input type="text" required class="form-control"  value="<?php echo $txtNombre;?>" name="txtNombre" id="txtNombre"  placeholder="Nombre del profesor">
            </div>

            <div class = "form-group">
            <label for="txtApellido">Apellido: </label>
            <input type="text" required class="form-control"  value="<?php echo $txtApellido;?>" name="txtApellido" id="txtApellido"  placeholder="Apellido del profesor">
            </div>

            <div class = "form-group">
            <label for="txtEspecialidad">Especialidad: </label>
            <input type="text" required class="form-control"  value="<?php echo $txtEspecialidad;?>" name="txtEspecialidad" id="$txtEspecialidad"  placeholder="Especialidad del profesor">
            </div>

            <div class = "form-group">
            <label for="txtCorreo">Correo: </label>
            <input type="email" required class="form-control"  value="<?php echo $txtCorreo;?>" name="txtCorreo" id="txtCorreo"  placeholder="Correo del profesor">
            </div>

            <div class = "form-group">
            <label for="txtGenero">Genero: </label>
            <select  required class="form-control"  name="txtGenero" id="txtGenero"  >
            <option value="Masculino">Masculino</option>
            <option value="Femenino">Femenino</option>
            <option value="Otros">Otros</option>
            </select>
            </div>

            <div class = "form-group">
            <label for="txtUsuario">Usuario: </label>
            <input type="text" required class="form-control"  value="<?php echo $txtUsuario;?>" name="txtUsuario" id="txtUsuario"  placeholder="Usuario del profesor">
            </div>

            <div class = "form-group">
            <label for="txtPass">Contraseña: </label>
            <input type="text" required class="form-control"  value="<?php echo $txtPass;?>" name="txtPass" id="txtPass"  placeholder="Contraseña del profesor">
            </div>

            <div class = "form-group">
            <label for="txtEstatus"> </label>
            
            <select hidden class="form-control" name="txtEstatus">
            
            <?php
                $query = $conexion->prepare("SELECT * FROM estatus");
                $query->execute();
                $data = $query->fetchAll();

                foreach ($data as $valores):
                echo '<option value="'.$valores["id_estatus"].'">'.$valores["nombre_estatus"].'</option>';
                endforeach;
            ?>
            </select>
            </div>

            

            <div class="btn-group" role="group" aria-label="">
                <button type="submit" name="accion" <?php echo ($accion=="Seleccionar")?"disabled":"" ?> Value="Agregar" class="btn btn-succes">Registrar</button>
                
                <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":"" ?> Value="Cancelar" class="btn btn-info">Cancelar</button>
            </div>

        </form>
     </div>

 </div>


  </body>
</html>