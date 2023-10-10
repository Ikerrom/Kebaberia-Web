<?php 
    include "../template/header.php";
    require_once '../controller/usuario-controller.php';
    require_once '../controller/alumno-controller.php';
    require_once '../controller/curso-controller.php';
    $usuarioController = new UsuarioController();
    $alumnoController = new AlumnoController();
    $cursoController = new CursoController();

    if(isset($_GET['id'])){
        $selected_alumno = $alumnoController->selectAlumno("id",$_GET['id'],"kurtsoak.php");
        $selected_usuario = $usuarioController->selectUsuario("id",$selected_alumno['usuario_id'],"kurtsoak.php");
    }

    if (isset($_POST['cursochange'])) {
        $data = array('curso_id'   => $_POST['curso_id']);
        $alumnoController->updateAlumno($selected_alumno['id'],$data,"kurtsoak.php?id=" . $_GET['id']);
    }

    $cursos = $cursoController->selectCursos("","","kurtsoak.php");
?>

<body>
    <h1>Bienvenido <?php echo isset($selected_alumno) ? $selected_usuario['nombre'] : "" ?></h1>
    <form method="post" onsubmit="">
            <select name="curso_id" id="curso_id">
            <option value="<?php echo isset($selected_alumno) ? $selected_alumno['curso_id'] : "";?>" selected hidden><?php echo isset($selected_alumno['curso_id']) ?  $cursoController->selectCurso("id",$selected_alumno['curso_id'],"kurtsoak.php")['id'] . " ". $cursoController->selectCurso("id",$selected_alumno['curso_id'],"kurtsoak.php")['nombre']  : "No hay curso"; ?></option>
                    <option value="">No hay curso</option>

                    <?php
                        if (!empty($cursos)) {
                            foreach ($cursos as $curso) {
                    ?>
                        <option value="<?php echo $curso['id'] ?>"><?php echo $curso['id'] . " " . $curso['nombre'] ?></option>
                    <?php
                            }
                        }
                    ?>
            </select>
            <input type="submit" name="cursochange" value="Entrar">
    </form>
</body>

<?php include "../template/footer.php"; ?>