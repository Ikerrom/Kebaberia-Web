<?php 
    ini_set ('display_errors', 1);
    ini_set ('display_startup_errors', 1);
    error_reporting (E_ALL);
    include "../template/header.php";
    require_once '../controller/curso-controller.php';

    $cursoController = new CursoController();
    $filternombre = "";

    if (isset($_POST['filter'])) {
        $filternombre = $_POST['nombre'];
    }
    $cursos = $cursoController->selectCursos('nombre',$filternombre);
?>
<body>
    <form method="post">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="<?= $filternombre ?>">
            <input type="submit" name="filter" value="Filtrar">
            <button><a href="./index.php">Limpiar filtro</a></button>
    </form>
    <br>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
        <?php
            if (!empty($cursos)) {
                foreach ($cursos as $curso) {
        ?>
            <tr>
                <td><?php echo $curso['nombre'] ;?></td>
        <?php
                }
            }
        ?>
        <tbody>
    </table>
    <br>
    <button><a href="./singin.php">Iniciar sesion</a></button>
    <button><a href="./singup.php">Registrarse</a></button>
</body>
<?php 
    include "../template/footer.php";
?>