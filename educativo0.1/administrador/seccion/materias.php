<?php include('../template/cabecera.php');    ?>

<?php 

    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
    $txtEstatus=(isset($_POST['txtEstatus']))?$_POST['txtEstatus']:"";
    $accion=(isset($_POST['accion']))?$_POST['accion']:"";

    include('../config/db.php'); 

    switch($accion){
        case "Agregar";
        
            $sentenciaSQL= $conexion->prepare ("INSERT INTO materia (nombre_materia,estatus_materia ) VALUES (:nombre_materia,:estatus_materia);");
            $sentenciaSQL->bindParam(':nombre_materia',$txtNombre);
            $sentenciaSQL->bindParam(':estatus_materia',$txtEstatus);

            $sentenciaSQL->execute();
            header("Location:materias.php");
            break;

        case "Modificar";

            $sentenciaSQL= $conexion->prepare("UPDATE materia SET nombre_materia = :nombre_materia WHERE id_materia=:id_materia");
            $sentenciaSQL->bindParam(':nombre_materia',$txtNombre);
            $sentenciaSQL->bindParam(':id_materia',$txtID);
            $sentenciaSQL->execute();

            $sentenciaSQL= $conexion->prepare("UPDATE materia SET estatus_materia = :estatus_materia WHERE id_materia=:id_materia");
            $sentenciaSQL->bindParam(':estatus_materia',$txtEstatus);
            $sentenciaSQL->bindParam(':id_materia',$txtID);
            $sentenciaSQL->execute();

            header("Location:materias.php");
            break;

        case "Cancelar";
            header("Location:materias.php");
            break;
        
        case "Seleccionar";
            $sentenciaSQL= $conexion->prepare("SELECT * FROM materia WHERE id_materia=:id_materia");
            $sentenciaSQL->bindParam(':id_materia',$txtID);
            $sentenciaSQL->execute();
            $materia=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

            $txtNombre=$materia['nombre_materia'];
            $txtEstatus=$materia['estatus_materia'];
            

            break;

         case "Borrar";

            $sentenciaSQL= $conexion->prepare("DELETE FROM materia WHERE id_materia=:id_materia");
            $sentenciaSQL->bindParam(':id_materia',$txtID);
            $sentenciaSQL->execute();
            header("Location:materias.php");
          
            break;

    }

    $sentenciaSQL= $conexion->prepare("SELECT `estudiante`.*, `estatus`.*
    FROM `estudiante` 
        LEFT JOIN `estatus` ON `estudiante`.`estatus_estudiante` = `estatus`.`id_estatus`;");
    $sentenciaSQL->execute();
    $listaMaterias=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);


    
?>

<div class="col-md-4">
    <div class="card">

        <div class="card-header">
            Datos de Materia
        </div>

        <div class="card-body">
        <form method="POST" >

            <div class = "form-group">
            <label for="txtID">ID:</label>
            <input type="text" required readonly class="form-control" value="<?php echo $txtID;?>" name="txtID" id="txtID"  placeholder="ID">
            </div>

            <div class = "form-group">
            <label for="txtNombre">Nombre: </label>
            <input type="text" required class="form-control"  value="<?php echo $txtNombre;?>" name="txtNombre" id="txtNombre"  placeholder="Nombre de la Materia">
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
                <th>Estatus</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listaMaterias as $materia){?>
            <tr>
                <td><?php echo $materia['id_materia'];?></td>
                <td><?php echo $materia['nombre_materia'];?></td>
                <td><?php echo $materia['nombre_estatus'];?></td>
               

                <td>
                    <form method="post">
                        <input type="hidden" name="txtID" id="txtID" value="<?php echo $materia['id_materia'];?>">
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