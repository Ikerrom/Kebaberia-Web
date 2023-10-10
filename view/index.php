<?php 
    include "../template/header.php";
    require_once '../controller/curso-controller.php';
    $cursoController = new CursoController();
    
    $filternombre = "";

    if (isset($_POST['filter'])) {
        $filternombre = $_POST['nombre'];
    }
    $cursos = $cursoController->selectCursos('nombre',$filternombre,"index.php");
?>
<body>
    <div class="body">
        <p style="font-size:2vw;">CURSOS</p>
        <br>
        <table >
            <?php
                if (!empty($cursos)) {
                foreach ($cursos as $curso) {
            ?>
                <tr>
                    <td><?php echo "- " . $curso['nombre'] ;?></td>
            <?php
                    }
                }
            ?>
        </table>
        <br>
        <form method="post">
            <input type="text" name="nombre" id="nombre" value="<?= $filternombre ?>">
            <input type="submit" name="filter" value="Filtrar">
        </form>
    </div>
</body>
<?php 
    include "../template/footer.php";
?>