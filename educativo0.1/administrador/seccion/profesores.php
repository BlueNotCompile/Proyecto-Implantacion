<?php include('../template/cabecera.php');    ?>

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

    include('../config/db.php'); 

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
            header("Location:profesores.php");
            break;

        case "Modificar";

            $sentenciaSQL= $conexion->prepare("UPDATE profesor SET cedula_profesor = :cedula_profesor, nombre_profesor = :nombre_profesor, apellido_profesor=:apellido_profesor, especialidad_profesor = :especialidad_profesor, correo_profesor = :correo_profesor, genero_profesor = :genero_profesor, usuario_profesor = :usuario_profesor , pass_profesor =:pass_profesor, estatus_profesor = :estatus_profesor  
             WHERE id_profesor=:id_profesor");
            $sentenciaSQL->bindParam(':cedula_profesor',$txtCedula);
            $sentenciaSQL->bindParam(':nombre_profesor',$txtNombre);
            $sentenciaSQL->bindParam(':apellido_profesor',$txtApellido);
            $sentenciaSQL->bindParam(':especialidad_profesor',$txtEspecialidad);
            $sentenciaSQL->bindParam(':correo_profesor',$txtCorreo);
            $sentenciaSQL->bindParam(':genero_profesor',$txtGenero);
            $sentenciaSQL->bindParam(':usuario_profesor',$txtUsuario);
            $sentenciaSQL->bindParam(':pass_profesor',$txtPass);
            $sentenciaSQL->bindParam(':estatus_profesor',$txtEstatus);
            $sentenciaSQL->bindParam(':id_profesor',$txtID);
            $sentenciaSQL->execute();

            header("Location:profesores.php");
            break;

        case "Cancelar";
            header("Location:profesores.php");
            break;
        
        case "Seleccionar";
            $sentenciaSQL= $conexion->prepare("SELECT * FROM profesor WHERE id_profesor=:id_profesor");
            $sentenciaSQL->bindParam(':id_profesor',$txtID);
            $sentenciaSQL->execute();
            $profesor=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

            $txtCedula=$profesor['cedula_profesor'];
            $txtNombre=$profesor['nombre_profesor'];
            $txtApellido=$profesor['apellido_profesor'];
            $txtEspecialidad=$profesor['especialidad_profesor'];
            $txtCorreo=$profesor['correo_profesor'];
            $txtGenero=$profesor['genero_profesor'];
            $txtUsuario=$profesor['usuario_profesor'];
            $txtPass=$profesor['pass_profesor'];
            $txtEstatus=$profesor['estatus_profesor'];


            break;

         case "Borrar";

            $sentenciaSQL= $conexion->prepare("DELETE FROM profesor WHERE id_profesor=:id_profesor");
            $sentenciaSQL->bindParam(':id_profesor',$txtID);
            $sentenciaSQL->execute();
            header("Location:profesores.php");
          
            break;

    }

    $sentenciaSQL= $conexion->prepare("SELECT `profesor`.*, `estatus`.*
    FROM `profesor` 
        LEFT JOIN `estatus` ON `profesor`.`estatus_profesor` = `estatus`.`id_estatus`;");
    $sentenciaSQL->execute();
    $listaprofesores=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);


    
?>

<div class="col-md-3">
    <div class="card">

        <div class="card-header">
            Datos de profesor
        </div>

        <div class="card-body">
        <form method="POST" >

            <div class = "form-group">
            <label for="txtID">ID:</label>
            <input type="text" required readonly class="form-control" value="<?php echo $txtID;?>" name="txtID" id="txtID"  placeholder="ID">
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
            <input type="text" required class="form-control"  value="<?php echo $txtEspecialidad;?>" name="txtEspecialidad" id="txtEspecialidad"  placeholder="especialidad del profesor">
            </div>

            <div class = "form-group">
            <label for="txtCorreo">Correo: </label>
            <input type="text" required class="form-control"  value="<?php echo $txtCorreo;?>" name="txtCorreo" id="txtCorreo"  placeholder="Correo del profesor">
            </div>

            <div class = "form-group">
            <label for="txtGenero">Genero: </label>
            <input type="text" required class="form-control"  value="<?php echo $txtGenero;?>" name="txtGenero" id="txtGenero"  placeholder="Genero del profesor">
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
                <th>Especialidad</th>
                <th>Correo</th>
                <th>Genero</th>
                <th>Usuario</th>
                <th>Contraseña</th>
                <th>Estatus</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listaprofesores as $profesor){?>
            <tr>
                <td><?php echo $profesor['id_profesor'];?></td>
                <td><?php echo $profesor['cedula_profesor'];?></td>
                <td><?php echo $profesor['nombre_profesor'];?></td>
                <td><?php echo $profesor['apellido_profesor'];?></td>
                <td><?php echo $profesor['especialidad_profesor'];?></td>
                <td><?php echo $profesor['correo_profesor'];?></td>
                <td><?php echo $profesor['genero_profesor'];?></td>
                <td><?php echo $profesor['usuario_profesor'];?></td>
                <td><?php echo $profesor['pass_profesor'];?></td>
                <td><?php echo $profesor['nombre_estatus'];?></td>
               

                <td>
                    <form method="post">
                        <input type="hidden" name="txtID" id="txtID" value="<?php echo $profesor['id_profesor'];?>">
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