<?php include("../template/cabecera.php");?>

<?php  
    include("../config/db.php");

    $sentenciaSQL= $conexion->prepare("SELECT `seccion`.*, `estatus`.*
    FROM `seccion` 
        LEFT JOIN `estatus` ON `seccion`.`estatus_seccion` = `estatus`.`id_estatus`
    WHERE `estatus`.`nombre_estatus` = 'Activo';");
    $sentenciaSQL->execute();
    $listaseccions=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<?php foreach($listaseccions as $seccions){ ?>
<div class="col-md-3">
<div class="card">

<div class="card-body">
    <h4 class="card-title">Seccion <?php echo $seccions['nombre_seccion']; ?> </h4>
    <h4 class="card-title">Maximo <?php echo $seccions['capacidad_seccion']; ?> profesores</h4>
    <h4 class="card-title"> <?php echo $seccions['nombre_estatus']; ?> </h4>
    <a class="btn btn-primary btn-lg" href="#" role="button">Ver Listado</a>
    
</div>
</div>
</div>
<?php } ?>







<?php include("../template/pie.php");?>