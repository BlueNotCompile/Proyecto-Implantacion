<?php include("../template/cabecera.php");?>
<?php include('../config/db.php'); 

    $sentenciaSQL= $conexion->prepare("SELECT `registro`.`id_registro`, `materia`.`nombre_materia`, `seccion`.`nombre_seccion`, `profesor`.`nombre_profesor`, `profesor`.`apellido_profesor`, `periodo`.`nombre_periodo`, `registro`.`id_estatus`, `estatus`.`nombre_estatus`
    FROM `registro` 
        LEFT JOIN `materia` ON `registro`.`id_materia` = `materia`.`id_materia` 
        LEFT JOIN `seccion` ON `registro`.`id_seccion` = `seccion`.`id_seccion` 
        LEFT JOIN `profesor` ON `registro`.`id_profesor` = `profesor`.`id_profesor` 
        LEFT JOIN `periodo` ON `registro`.`id_periodo` = `periodo`.`id_periodo` 
        LEFT JOIN `estatus` ON `materia`.`estatus_materia` = `estatus`.`id_estatus`
    WHERE `registro`.`id_estudiante` = $id_usuario;");
    $sentenciaSQL->execute();
    $listaMaterias=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);






?>

<div class="col-md-12">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Seccion</th>
                <th>Nombre del Profesor</th>
                <th>Apellido del Profesor</th>
                <th>Periodo</th>
                <th>Estatus</th>
                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listaMaterias as $materia){?>
            <tr>
                <td><?php echo $materia['nombre_materia'];?></td>
                <td><?php echo $materia['nombre_seccion'];?></td>
                <td><?php echo $materia['nombre_profesor'];?></td>
                <td><?php echo $materia['apellido_profesor'];?></td>
                <td><?php echo $materia['nombre_periodo'];?></td>
                <td><?php echo $materia['nombre_estatus'];?></td>
               

                 


            </tr>
           <?php } ?>
        </tbody>
    </table>
    <a class="btn btn-primary btn-lg" href="inscribir_materia.php" role="button">Inscribir nueva Materia</a>
</div>




<?php include("../template/pie.php");?>