<?php include("../template/cabecera.php");?>

<?php  
    include("../config/db.php");

    $sentenciaSQL= $conexion->prepare("SELECT `materia`.*, `estatus`.*
    FROM `materia` 
        LEFT JOIN `estatus` ON `materia`.`estatus_materia` = `estatus`.`id_estatus`
    WHERE `estatus`.`nombre_estatus` = 'Activo';");
    $sentenciaSQL->execute();
    $listaMaterias=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<?php foreach($listaMaterias as $materias){ ?>
<div class="col-md-3">
<div class="card">

<div class="card-body">
    <h4 class="card-title"> <?php echo $materias['nombre_materia']; ?> </h4>
    <h4 class="card-title"> <?php echo $materias['nombre_estatus']; ?> </h4>
    <a class="btn btn-primary btn-lg" href="#" role="button">Ver Listado</a>
    
</div>
</div>
</div>
<?php } ?>







<?php include("../template/pie.php");?>