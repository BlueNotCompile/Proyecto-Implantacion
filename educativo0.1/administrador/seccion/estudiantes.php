<?php include('../template/cabecera.php');    ?>

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

    include('../config/db.php'); 

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
            header("Location:estudiantes.php");
            break;

        case "Modificar";

            $sentenciaSQL= $conexion->prepare("UPDATE estudiante SET cedula_estudiante = :cedula_estudiante, nombre_estudiante = :nombre_estudiante, apellido_estudiante=:apellido_estudiante, semestre_estudiante = :semestre_estudiante, correo_estudiante = :correo_estudiante, genero_estudiante = :genero_estudiante, usuario_estudiante = :usuario_estudiante , pass_estudiante =:pass_estudiante, estatus_estudiante = :estatus_estudiante  
             WHERE id_estudiante=:id_estudiante");
            $sentenciaSQL->bindParam(':cedula_estudiante',$txtCedula);
            $sentenciaSQL->bindParam(':nombre_estudiante',$txtNombre);
            $sentenciaSQL->bindParam(':apellido_estudiante',$txtApellido);
            $sentenciaSQL->bindParam(':semestre_estudiante',$txtSemestre);
            $sentenciaSQL->bindParam(':correo_estudiante',$txtCorreo);
            $sentenciaSQL->bindParam(':genero_estudiante',$txtGenero);
            $sentenciaSQL->bindParam(':usuario_estudiante',$txtUsuario);
            $sentenciaSQL->bindParam(':pass_estudiante',$txtPass);
            $sentenciaSQL->bindParam(':estatus_estudiante',$txtEstatus);
            $sentenciaSQL->bindParam(':id_estudiante',$txtID);
            $sentenciaSQL->execute();

            header("Location:estudiantes.php");
            break;

        case "Cancelar";
            header("Location:estudiantes.php");
            break;
        
        case "Seleccionar";
            $sentenciaSQL= $conexion->prepare("SELECT * FROM estudiante WHERE id_estudiante=:id_estudiante");
            $sentenciaSQL->bindParam(':id_estudiante',$txtID);
            $sentenciaSQL->execute();
            $estudiante=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

            $txtCedula=$estudiante['cedula_estudiante'];
            $txtNombre=$estudiante['nombre_estudiante'];
            $txtApellido=$estudiante['apellido_estudiante'];
            $txtSemestre=$estudiante['semestre_estudiante'];
            $txtCorreo=$estudiante['correo_estudiante'];
            $txtGenero=$estudiante['genero_estudiante'];
            $txtUsuario=$estudiante['usuario_estudiante'];
            $txtPass=$estudiante['pass_estudiante'];
            $txtEstatus=$estudiante['estatus_estudiante'];


            break;

         case "Borrar";

            $sentenciaSQL= $conexion->prepare("DELETE FROM estudiante WHERE id_estudiante=:id_estudiante");
            $sentenciaSQL->bindParam(':id_estudiante',$txtID);
            $sentenciaSQL->execute();
            header("Location:estudiantes.php");
          
            break;

    }

    $sentenciaSQL= $conexion->prepare("SELECT `estudiante`.*, `estatus`.*
    FROM `estudiante` 
        LEFT JOIN `estatus` ON `estudiante`.`estatus_estudiante` = `estatus`.`id_estatus`;");
    $sentenciaSQL->execute();
    $listaestudiantes=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);


    
?>

<div class="col-md-3">
    <div class="card">

        <div class="card-header">
            Datos de estudiante
        </div>

        <div class="card-body">
        <form method="POST" >

            <div class = "form-group">
            <label for="txtID">ID:</label>
            <input type="text" required readonly class="form-control" value="<?php echo $txtID;?>" name="txtID" id="txtID"  placeholder="ID">
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
            <input type="text" required class="form-control"  value="<?php echo $txtSemestre;?>" name="txtSemestre" id="txtSemestre"  placeholder="Semestre del estudiante">
            </div>

            <div class = "form-group">
            <label for="txtCorreo">Correo: </label>
            <input type="text" required class="form-control"  value="<?php echo $txtCorreo;?>" name="txtCorreo" id="txtCorreo"  placeholder="Correo del estudiante">
            </div>

            <div class = "form-group">
            <label for="txtGenero">Genero: </label>
            <input type="text" required class="form-control"  value="<?php echo $txtGenero;?>" name="txtGenero" id="txtGenero"  placeholder="Genero del estudiante">
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
            <label for="txtEstatus">Estatus: </label>
            <select class="form-control" name="txtEstatus">
            
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
                <button type="submit" name="accion" <?php echo ($accion=="Seleccionar")?"disabled":"" ?> Value="Agregar" class="btn btn-succes">Agregar</button>
                <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":"" ?> Value="Modificar" class="btn btn-warning">Modificar</button>
                <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":"" ?> Value="Cancelar" class="btn btn-info">Cancelar</button>
            </div>

        </form>
     </div>

 </div>


</div>

<div class="col-md-9">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cedula</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Semestre</th>
                <th>Correo</th>
                <th>Genero</th>
                <th>Usuario</th>
                <th>Contraseña</th>
                <th>Estatus</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listaestudiantes as $estudiante){?>
            <tr>
                <td><?php echo $estudiante['id_estudiante'];?></td>
                <td><?php echo $estudiante['cedula_estudiante'];?></td>
                <td><?php echo $estudiante['nombre_estudiante'];?></td>
                <td><?php echo $estudiante['apellido_estudiante'];?></td>
                <td><?php echo $estudiante['semestre_estudiante'];?></td>
                <td><?php echo $estudiante['correo_estudiante'];?></td>
                <td><?php echo $estudiante['genero_estudiante'];?></td>
                <td><?php echo $estudiante['usuario_estudiante'];?></td>
                <td><?php echo $estudiante['pass_estudiante'];?></td>
                <td><?php echo $estudiante['nombre_estatus'];?></td>
               

                <td>
                    <form method="post">
                        <input type="hidden" name="txtID" id="txtID" value="<?php echo $estudiante['id_estudiante'];?>">
                        <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary">
                        <input type="submit" name="accion" value="Borrar" class="btn btn-danger">

                    </form>


                </td>   


            </tr>
           <?php } ?>
        </tbody>
    </table>
</div>



<?php include('../template/pie.php');   