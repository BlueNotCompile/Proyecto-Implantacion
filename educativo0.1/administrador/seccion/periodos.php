<?php include('../template/cabecera.php');    ?>

<?php 

    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
    $txtEstatus=(isset($_POST['txtEstatus']))?$_POST['txtEstatus']:"";
    $accion=(isset($_POST['accion']))?$_POST['accion']:"";

    include('../config/db.php'); 

    switch($accion){
        case "Agregar";
        
            $sentenciaSQL= $conexion->prepare ("INSERT INTO periodo (nombre_periodo,estatus_periodo ) VALUES (:nombre_periodo,:estatus_periodo);");
            $sentenciaSQL->bindParam(':nombre_periodo',$txtNombre);
            $sentenciaSQL->bindParam(':estatus_periodo',$txtEstatus);

            $sentenciaSQL->execute();
            header("Location:periodos.php");
            break;

        case "Modificar";

            $sentenciaSQL= $conexion->prepare("UPDATE periodo SET nombre_periodo = :nombre_periodo WHERE id_periodo=:id_periodo");
            $sentenciaSQL->bindParam(':nombre_periodo',$txtNombre);
            $sentenciaSQL->bindParam(':id_periodo',$txtID);
            $sentenciaSQL->execute();

            $sentenciaSQL= $conexion->prepare("UPDATE periodo SET estatus_periodo = :estatus_periodo WHERE id_periodo=:id_periodo");
            $sentenciaSQL->bindParam(':estatus_periodo',$txtEstatus);
            $sentenciaSQL->bindParam(':id_periodo',$txtID);
            $sentenciaSQL->execute();

            header("Location:periodos.php");
            break;

        case "Cancelar";
            header("Location:periodos.php");
            break;
        
        case "Seleccionar";
            $sentenciaSQL= $conexion->prepare("SELECT * FROM periodo WHERE id_periodo=:id_periodo");
            $sentenciaSQL->bindParam(':id_periodo',$txtID);
            $sentenciaSQL->execute();
            $periodo=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

            $txtNombre=$periodo['nombre_periodo'];
            $txtEstatus=$periodo['estatus_periodo'];
            

            break;

         case "Borrar";

            $sentenciaSQL= $conexion->prepare("DELETE FROM periodo WHERE id_periodo=:id_periodo");
            $sentenciaSQL->bindParam(':id_periodo',$txtID);
            $sentenciaSQL->execute();
            header("Location:periodos.php");
          
            break;

    }

    $sentenciaSQL= $conexion->prepare("SELECT `periodo`.*, `estatus`.*
    FROM `periodo` 
        LEFT JOIN `estatus` ON `periodo`.`estatus_periodo` = `estatus`.`id_estatus`;");
    $sentenciaSQL->execute();
    $listaperiodos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);


    
?>

<div class="col-md-4">
    <div class="card">

        <div class="card-header">
            Datos de periodo
        </div>

        <div class="card-body">
        <form method="POST" >

            <div class = "form-group">
            <label for="txtID">ID:</label>
            <input type="text" required readonly class="form-control" value="<?php echo $txtID;?>" name="txtID" id="txtID"  placeholder="ID">
            </div>

            <div class = "form-group">
            <label for="txtNombre">Nombre: </label>
            <input type="text" required class="form-control"  value="<?php echo $txtNombre;?>" name="txtNombre" id="txtNombre"  placeholder="Nombre de la periodo">
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
            <?php foreach ($listaperiodos as $periodo){?>
            <tr>
                <td><?php echo $periodo['id_periodo'];?></td>
                <td><?php echo $periodo['nombre_periodo'];?></td>
                <td><?php echo $periodo['nombre_estatus'];?></td>
               

                <td>
                    <form method="post">
                        <input type="hidden" name="txtID" id="txtID" value="<?php echo $periodo['id_periodo'];?>">
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