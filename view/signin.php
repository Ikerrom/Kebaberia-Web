<?php 
    include "../template/header.php";
    require_once '../controller/usuario-controller.php';
    require_once '../controller/alumno-controller.php';
    $usuarioController = new UsuarioController();
    $alumnoController = new AlumnoController();

    if (isset($_POST['signin'])) {
        $selected_usuario = $usuarioController->selectUsuario("nombre",$_POST['nombre'],"signin.php");

        if($selected_usuario != null){
            if(openssl_encrypt($_POST['contrasena'],"AES-128-ECB","salchichonmelocotondelimon") == $selected_usuario['contrasena']){
                if($selected_usuario['is_admin']){
                    header('Location: administrazioa.php'); 
                }else{
                    header('Location: kurtsoak.php?id=' .  $alumnoController->selectAlumno("usuario_id",$selected_usuario['id'],"signin.php")['id']); 
                    
                }
            }
        }
        $e = "Contraseña incorrecta";
        require_once("../template/error.php");
    }
?>

<body>
    <form method="post" onsubmit="">
            <label for="nombre">Nombre de usuario</label>
            <input type="text" name="nombre" id="nombre">
            <label for="contrasena">Contraseña</label>
            <input type="password" name="contrasena" id="contrasena">
            <input type="submit" name="signin" value="Entrar">
    </form>
</body>

<?php include "../template/footer.php"; ?>