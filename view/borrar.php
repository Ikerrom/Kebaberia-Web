<?php 
    include "header.php";
    require_once '../controller/alumno-controller.php';
    $alumnoController = new AlumnoController();
    $alumnoController->deleteAlumno($_GET['id'],"administrazioa.php");
?>

<?php include "footer.php"?>