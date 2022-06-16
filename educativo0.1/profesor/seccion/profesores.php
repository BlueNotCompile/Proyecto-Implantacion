<?php include("../template/cabecera.php");?>

<?php  
    include("../config/db.php");

    $sentenciaSQL= $conexion->prepare("SELECT `profesor`.*, `estatus`.*
    FROM `profesor` 
        LEFT JOIN `estatus` ON `profesor`.`estatus_profesor` = `estatus`.`id_estatus`
    ");
    $sentenciaSQL->execute();
    $listaprofesores=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<?php foreach($listaprofesores as $profesores){ ?>
<div class="col-md-4">
<div class="card">

<div class="card-body">
    <h4 class="card-title">Prof. <?php echo $profesores['nombre_profesor'], ' ', $profesores['apellido_profesor']; ?> </h4>
    <h4 class="card-title">Especialista en <?php echo $profesores['especialidad_profesor']; ?> </h4>
    <h4 class="card-title">Actualmente <?php echo $profesores['nombre_estatus']; ?> </h4>
    <h4 class="card-title">Correo: <?php echo $profesores['correo_profesor']; ?> </h4>
    
</div>
</div>
</div>
<?php } ?>







<?php include("../template/pie.php");?>