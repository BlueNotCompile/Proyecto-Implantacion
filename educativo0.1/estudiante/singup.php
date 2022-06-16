<?php 

    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $txtCedula=(isset($_POST['txtCedula']))?$_POST['txtCedula']:"";
    $txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
    $txtApellido=(isset($_POST['txtApellido']))?$_POST['txtApellido']:"";
    $txtSemestre=(isset($_POST['txtSemestre']))?$_POST['txtSemestre']:"";
    $txtCorreo=(isset($_POST['txtCorreo']))?$_POST['txtCorreo']:"";
    $txtGenero=(isset($_POST['txtGenero']))?$_POST['txtGenero']:"";
    $txtUsuario=(isset($_POST['txtUsuario']))?$_POST['txtUsuario']:"";
    $txtPass=(isset($_POST['txtPass']))?$_POST['txtPass']:"";
    $txtEstatus=(isset($_POST['txtEstatus']))?$_POST['txtEstatus']:"";
    $accion=(isset($_POST['accion']))?$_POST['accion']:"";

    include('config/db.php'); 

    switch($accion){
        case "Agregar";
        
            $sentenciaSQL= $conexion->prepare ("INSERT INTO estudiante (cedula_estudiante,nombre_estudiante,apellido_estudiante,semestre_estudiante,correo_estudiante,genero_estudiante,usuario_estudiante,pass_estudiante,estatus_estudiante ) 
            VALUES (:cedula_estudiante,:nombre_estudiante,:apellido_estudiante,:semestre_estudiante,:correo_estudiante,:genero_estudiante,:usuario_estudiante,:pass_estudiante,:estatus_estudiante);");
            $sentenciaSQL->bindParam(':cedula_estudiante',$txtCedula);
            $sentenciaSQL->bindParam(':nombre_estudiante',$txtNombre);
            $sentenciaSQL->bindParam(':apellido_estudiante',$txtApellido);
            $sentenciaSQL->bindParam(':semestre_estudiante',$txtSemestre);
            $sentenciaSQL->bindParam(':correo_estudiante',$txtCorreo);
            $sentenciaSQL->bindParam(':genero_estudiante',$txtGenero);
            $sentenciaSQL->bindParam(':usuario_estudiante',$txtUsuario);
            $sentenciaSQL->bindParam(':pass_estudiante',$txtPass);
            $sentenciaSQL->bindParam(':estatus_estudiante',$txtEstatus);

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
            Datos de estudiante
        </div>

        <div class="card-body">
        <form method="POST" >

            <div class = "form-group">
            
            <input type="hidden" required readonly class="form-control" value="<?php echo $txtID;?>" name="txtID" id="txtID"  placeholder="ID">
            </div>

            <div class = "form-group">
            <label for="txtCedula">Cedula: </label>
            <input type="text" required class="form-control"  value="<?php echo $txtCedula;?>" name="txtCedula" id="txtCedula"  placeholder="Cedula del estudiante">
            </div>

            <div class = "form-group">
            <label for="txtNombre">Nombre: </label>
            <input type="text" required class="form-control"  value="<?php echo $txtNombre;?>" name="txtNombre" id="txtNombre"  placeholder="Nombre del estudiante">
            </div>

            <div class = "form-group">
            <label for="txtApellido">Apellido: </label>
            <input type="text" required class="form-control"  value="<?php echo $txtApellido;?>" name="txtApellido" id="txtApellido"  placeholder="Apellido del estudiante">
            </div>

            <div class = "form-group">
            <label for="txtSemestre">Semestre: </label>
            <select required class="form-control" name="txtSemestre" id="txtSemestre" >
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            </select>
            </div>

            <div class = "form-group">
            <label for="txtCorreo">Correo: </label>
            <input type="email" required class="form-control"  value="<?php echo $txtCorreo;?>" name="txtCorreo" id="txtCorreo"  placeholder="Correo del estudiante">
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
            <input type="text" required class="form-control"  value="<?php echo $txtUsuario;?>" name="txtUsuario" id="txtUsuario"  placeholder="Usuario del estudiante">
            </div>

            <div class = "form-group">
            <label for="txtPass">Contraseña: </label>
            <input type="text" required class="form-control"  value="<?php echo $txtPass;?>" name="txtPass" id="txtPass"  placeholder="Contraseña del estudiante">
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