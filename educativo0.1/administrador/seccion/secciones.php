<?php include('../template/cabecera.php');    ?>

<?php 

    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
    $txtEstatus=(isset($_POST['txtEstatus']))?$_POST['txtEstatus']:"";
    $txtCapacidad=(isset($_POST['txtCapacidad']))?$_POST['txtCapacidad']:"";
    $accion=(isset($_POST['accion']))?$_POST['accion']:"";

    include('../config/db.php'); 

    switch($accion){
        case "Agregar";
        
            $sentenciaSQL= $conexion->prepare ("INSERT INTO seccion (nombre_seccion,capacidad_seccion,estatus_seccion ) VALUES (:nombre_seccion,:capacidad_seccion,:estatus_seccion);");
            $sentenciaSQL->bindParam(':nombre_seccion',$txtNombre);
            $sentenciaSQL->bindParam(':capacidad_seccion',$txtCapacidad);
            $sentenciaSQL->bindParam(':estatus_seccion',$txtEstatus);
            $sentenciaSQL->execute();
            
            header("Location:secciones.php");
            break;

        case "Modificar";

            $sentenciaSQL= $conexion->prepare("UPDATE seccion SET nombre_seccion = :nombre_seccion WHERE id_seccion=:id_seccion");
            $sentenciaSQL->bindParam(':nombre_seccion',$txtNombre);
            $sentenciaSQL->bindParam(':id_seccion',$txtID);
            $sentenciaSQL->execute();

            $sentenciaSQL= $conexion->prepare("UPDATE seccion SET capacidad_seccion = :capacidad_seccion WHERE id_seccion=:id_seccion");
            $sentenciaSQL->bindParam(':capacidad_seccion',$txtCapacidad);
            $sentenciaSQL->bindParam(':id_seccion',$txtID);
            $sentenciaSQL->execute();

            $sentenciaSQL= $conexion->prepare("UPDATE seccion SET estatus_seccion = :estatus_seccion WHERE id_seccion=:id_seccion");
            $sentenciaSQL->bindParam(':estatus_seccion',$txtEstatus);
            $sentenciaSQL->bindParam(':id_seccion',$txtID);
            $sentenciaSQL->execute();

            header("Location:secciones.php");
            break;

        case "Cancelar";
            header("Location:secciones.php");
            break;
        
        case "Seleccionar";
            $sentenciaSQL= $conexion->prepare("SELECT * FROM seccion WHERE id_seccion=:id_seccion");
            $sentenciaSQL->bindParam(':id_seccion',$txtID);
            $sentenciaSQL->execute();
            $seccion=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

            $txtNombre=$seccion['nombre_seccion'];
            $txtCapacidad=$seccion['capacidad_seccion'];
            $txtEstatus=$seccion['estatus_seccion'];
            

            break;

         case "Borrar";

            $sentenciaSQL= $conexion->prepare("DELETE FROM seccion WHERE id_seccion=:id_seccion");
            $sentenciaSQL->bindParam(':id_seccion',$txtID);
            $sentenciaSQL->execute();
            header("Location:secciones.php");
          
            break;

    }

    $sentenciaSQL= $conexion->prepare("SELECT `seccion`.*, `estatus`.*
    FROM `seccion` 
        LEFT JOIN `estatus` ON `seccion`.`estatus_seccion` = `estatus`.`id_estatus`;");
    $sentenciaSQL->execute();
    $listaSeccion=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);


    
?>

<div class="col-md-4">
    <div class="card">

        <div class="card-header">
            Datos de Seccion
        </div>

        <div class="card-body">
        <form method="POST" >

            <div class = "form-group">
            <label for="txtID">ID:</label>
            <input type="text" required readonly class="form-control" value="<?php echo $txtID;?>" name="txtID" id="txtID"  placeholder="ID">
            </div>

            <div class = "form-group">
            <label for="txtNombre">Nombre: </label>
            <input type="text" required class="form-control"  value="<?php echo $txtNombre;?>" name="txtNombre" id="txtNombre"  placeholder="Nombre de la Seccion">
            </div>

            <div class = "form-group">
            <label for="txtCapacidad">Capacidad: </label>
            <input type="text" required class="form-control"  value="<?php echo $txtCapacidad;?>" name="txtCapacidad" id="txtCapacidad"  placeholder="Capacidad Maxima">
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

<div class="col-md-8">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Capacidad</th>
                <th>Estatus</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listaSeccion as $seccion){?>
            <tr>
                <td><?php echo $seccion['id_seccion'];?></td>
                <td><?php echo $seccion['nombre_seccion'];?></td>
                <td><?php echo $seccion['capacidad_seccion'];?></td>
                <td><?php echo $seccion['nombre_estatus'];?></td>
               

                <td>
                    <form method="post">
                        <input type="hidden" name="txtID" id="txtID" value="<?php echo $seccion['id_seccion'];?>">
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