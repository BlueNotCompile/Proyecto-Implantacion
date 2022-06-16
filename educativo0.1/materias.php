<?php include("template/cabecera.php");?>

<?php  
    include("administrador/config/db.php");

    $sentenciaSQL= $conexion->prepare("SELECT * FROM materias");
    $sentenciaSQL->execute();
    $listaMaterias=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<?php foreach($listaMaterias as $materias){ ?>
<div class="col-md-3">
<div class="card">

<div class="card-body">
    <h4 class="card-title"> <?php echo $materias['nombre_mat']; ?> </h4>
    <h4 class="card-title"> Codigo de Prelacion: <?php echo $materias['cod_pre']; ?> </h4>
    
</div>
</div>
</div>
<?php } ?>







<?php include("template/pie.php");?>