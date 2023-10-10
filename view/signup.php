<?php 
    include "../template/header.php";
    require_once '../controller/usuario-controller.php';
    require_once '../controller/alumno-controller.php';
    $usuarioController = new UsuarioController();
    $alumnocontroller = new AlumnoController();

    if (isset($_POST['signup'])) {
        $data = array(
            'nombre'   => $_POST['nombre'],
            'email'   => $_POST['email'],
            'contrasena'    => $_POST['contrasena']
        );
        
        $selected_alumno = $alumnocontroller->selectAlumno("email",$_POST['email']);
        if($selected_alumno != null){
            $usuarioController->insertUsuario($data);
            $inserted_usuario = $usuarioController->selectUsuario("email",$_POST['email']);
            $data2 = array('usuario_id' => $inserted_usuario['id']);

            $alumnocontroller->updateAlumno($selected_alumno['id'],$data2);
            header('Location: kutsoak.php?id=' . $selected_alumno['id']);
        }else{
            $e = "El email no esta en uso";
            require_once("../template/error.php");
        }
         
    }


?>

<body>
    <form method="post" onsubmit="">
            <label for="nombre">Nombre de usuario</label>
            <input type="text" name="nombre" id="nombre">
            <label for="email">Correo electronico</label>
            <input type="email" name="email" id="email">
            <label for="contrasena">Contraseña</label>
            <input type="password" name="contrasena" id="contrasena">
            <label for="r_contrasena">Repetir contraseña</label>
            <input type="password" name="r_contrasena" id="r_contrasena">
            <input type="submit" name="signup" value="Entrar">
    </form>
</body>

<?php include "../template/footer.php"; ?>