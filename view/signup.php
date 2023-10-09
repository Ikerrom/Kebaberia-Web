<?php 
    include "../template/header.php";
    require_once '../controller/usuario-controller.php';
    $usuarioController = new UsuarioController();
    if (isset($_POST['signup'])) {
        $data = array(
            'nombre'   => $_POST['nombre'],
            'email'   => $_POST['email'],
            'password'    => password_hash($_POST['password'], PASSWORD_DEFAULT),
        );
        $usuarioController->insertUsuario($data);
    }
    

?>

<body>
    <form method="post" onsubmit="">
            <label for="nombre">Nombre de usuario</label>
            <input type="text" name="nombre" id="nombre">
            <label for="email">Correo electronico</label>
            <input type="email" name="email" id="email">
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password">
            <label for="r_password">Repetir contraseña</label>
            <input type="password" name="r_password" id="r_password">
            <input type="submit" name="signup" value="Entrar">
    </form>
</body>

<?php include "../template/footer.php"; ?>