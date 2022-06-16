<?php include('../template/cabecera.php');    ?>

<?php 

    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
    $accion=(isset($_POST['accion']))?$_POST['accion']:"";

    include('../config/db.php'); 

    switch($accion){
        case "Agregar";
        
            $sentenciaSQL= $conexion->prepare ("INSERT INTO estatus (nombre_estatus) VALUES (:nombre_estatus)");
            $sentenciaSQL->bindParam(':nombre_estatus',$txtNombre);


            $sentenciaSQL->execute();
            header("Location:estatus.php");
            break;

        case "Modificar";

            $sentenciaSQL= $conexion->prepare("UPDATE estatus SET nombre_estatus = :nombre_estatus WHERE id_estatus=:id_estatus");
            $sentenciaSQL->bindParam(':nombre_estatus',$txtNombre);
            $sentenciaSQL->bindParam(':id_estatus',$txtID);
            $sentenciaSQL->execute();

            header("Location:estatus.php");
            break;

        case "Cancelar";
            header("Location:estatus.php");
            break;
        
        case "Seleccionar";
            $sentenciaSQL= $conexion->prepare("SELECT * FROM estatus WHERE id_estatus=:id_estatus");
            $sentenciaSQL->bindParam(':id_estatus',$txtID);
            $sentenciaSQL->execute();
            $estatus=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

            $txtNombre=$estatus['nombre_estatus'];

            break;

         case "Borrar";

            $sentenciaSQL= $conexion->prepare("DELETE FROM estatus WHERE id_estatus=:id_estatus");
            $sentenciaSQL->bindParam(':id_estatus',$txtID);
            $sentenciaSQL->execute();
            header("Location:estatus.php");
          
            break;

    }

    $sentenciaSQL= $conexion->prepare("SELECT `estatus`.* FROM `estatus`;");
    $sentenciaSQL->execute();
    $listaestatuss=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);


    
?>

<div class="col-md-4">
    <div class="card">

        <div class="card-header">
            Datos de estatus
        </div>

        <div class="card-body">
        <form method="POST" >

            <div class = "form-group">
            <label for="txtID">ID:</label>
            <input type="text" required readonly class="form-control" value="<?php echo $txtID;?>" name="txtID" id="txtID"  placeholder="ID">
            </div>

            <div class = "form-group">
            <label for="txtNombre">Nombre: </label>
            <input type="text" required class="form-control"  value="<?php echo $txtNombre;?>" name="txtNombre" id="txtNombre"  placeholder="Nombre de la estatus">
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
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listaestatuss as $estatus){?>
            <tr>
                <td><?php echo $estatus['id_estatus'];?></td>
                <td><?php echo $estatus['nombre_estatus'];?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="txtID" id="txtID" value="<?php echo $estatus['id_estatus'];?>">
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