<?php include("../template/cabecera.php");?>

<?php 

    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    
    $txtMateria=(isset($_POST['txtMateria']))?$_POST['txtMateria']:"";
    $txtSeccion=(isset($_POST['txtSeccion']))?$_POST['txtSeccion']:"";
    $txtProfesor=(isset($_POST['txtProfesor']))?$_POST['txtProfesor']:"";
    $txtPeriodo=(isset($_POST['txtPeriodo']))?$_POST['txtPeriodo']:"";
    $txtEstatus=(isset($_POST['txtEstatus']))?$_POST['txtEstatus']:"";
    $accion=(isset($_POST['accion']))?$_POST['accion']:"";

    include('../config/db.php'); 

    switch($accion){
        case "Agregar";
        
            $sentenciaSQL= $conexion->prepare ("INSERT INTO registro (id_estudiante, id_materia, id_seccion, id_periodo, id_estatus, id_profesor ) VALUES (:id_estudiante, :id_materia, :id_seccion, :id_periodo, :id_estatus, :id_profesor);");
            $sentenciaSQL->bindParam(':id_estudiante',$id_usuario);
            $sentenciaSQL->bindParam(':id_materia',$txtMateria);
            $sentenciaSQL->bindParam(':id_seccion',$txtSeccion);
            $sentenciaSQL->bindParam(':id_periodo',$txtPeriodo);
            $sentenciaSQL->bindParam(':id_profesor',$txtProfesor);
            $sentenciaSQL->bindParam(':id_estatus',$txtEstatus);

            $sentenciaSQL->execute();
            header("Location:mismaterias.php");
            break;

        case "Cancelar";
            header("Location:mismaterias.php");
            break;
          

    }

    
?>

<div class="col-md-4">
    <div class="card">

        <div class="card-header">
            Datos de la Inscripcion
        </div>

        <div class="card-body">
        <form method="POST" >

            <div class = "form-group">
            <input type="hidden" required readonly class="form-control" value="<?php echo $txtID;?>" name="txtID" id="txtID"  placeholder="ID">
            </div>

            <div class = "form-group">
            <input type="hidden" required class="form-control"  value="<?php echo $id_usuario;?>" name="id_usuario" id="txtEstudiante" >
            </div>

            <div class = "form-group">
            <label for="txtMateria">Materia: </label>
            <select class="form-control" name="txtMateria">
            
            <?php
                $query = $conexion->prepare("SELECT `materia`.*
                FROM `materia`
                WHERE `materia`.`estatus_materia` = '7';");
                $query->execute();
                $data = $query->fetchAll();

                foreach ($data as $valores):
                echo '<option value="'.$valores["id_materia"].'">'.$valores["nombre_materia"].'</option>';
                endforeach;
            ?>
            </select>
            </div>

            <div class = "form-group">
            <label for="txtSeccion">Seccion: </label>
            <select class="form-control" name="txtSeccion">
            
            <?php
                $query = $conexion->prepare("SELECT `seccion`.*
                FROM `seccion`
                WHERE `seccion`.`estatus_seccion` = '7';");
                $query->execute();
                $data = $query->fetchAll();

                foreach ($data as $valores):
                echo '<option value="'.$valores["id_seccion"].'">'.$valores["nombre_seccion"].' Capacidad: '.$valores["capacidad_seccion"].'</option>';
                endforeach;
            ?>
            </select>
            </div>

            <div class = "form-group">
            <label for="txtProfesor">Docente: </label>
            <select class="form-control" name="txtProfesor">
            
            <?php
                $query = $conexion->prepare("SELECT `profesor`.*
                FROM `profesor`
                WHERE `profesor`.`estatus_profesor` = '7';");
                $query->execute();
                $data = $query->fetchAll();

                foreach ($data as $valores):
                echo '<option value="'.$valores["id_profesor"].'">'.$valores["nombre_profesor"].' '.$valores["apellido_profesor"].'</option>';
                endforeach;
            ?>
            </select>
            </div>

            <div class = "form-group">
            <label for="txtPeriodo">Periodo: </label>
            <select class="form-control" name="txtPeriodo">
            
            <?php
                $query = $conexion->prepare("SELECT `periodo`.*
                FROM `periodo`
                WHERE `periodo`.`estatus_periodo` = '7';");
                $query->execute();
                $data = $query->fetchAll();

                foreach ($data as $valores):
                echo '<option value="'.$valores["id_periodo"].'">'.$valores["nombre_periodo"].'</option>';
                endforeach;
            ?>
            </select>
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
                <button type="submit" name="accion" <?php echo ($accion=="Seleccionar")?"disabled":"" ?> Value="Agregar" class="btn btn-succes">Agregar</button>
               
                <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":"" ?> Value="Cancelar" class="btn btn-info">Cancelar</button>
            </div>

        </form>
     </div>

 </div>


</div>

<?php include("../template/pie.php");?>