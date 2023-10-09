<?php 
    ini_set ('display_errors', 1);
    ini_set ('display_startup_errors', 1);
    include "../template/header.php";
    require_once '../controller/alumno-controller.php';
    require_once '../controller/curso-controller.php';
    $alumnoController = new AlumnoController();
    $cursoController = new CursoController();
    $filtercolumn = "";
    $filtervalue = "";

    if (isset($_POST['filter'])) {
        $filtercolumn = strtolower($_POST['column']);
        $filtervalue = $_POST['value'];
    }
    $alumnos = $alumnoController->selectAlumnos($filtercolumn,$filtervalue);

    if (isset($_POST['insert'])) {
        $data = array(
            'nombre'   => $_POST['nombre'],
            'apellido'    => $_POST['apellido'],
            'edad'   => $_POST['edad'],
            'email'   => $_POST['email'],
            'curso_id'    => $_POST['curso_id'],
            'usuario_id'   => $_POST['usuario_id'],
        );
        $alumnoController->insertAlumno($data);
    }

    $cursos = $cursoController->selectCursos("","");


?>
<body>
<h1>Aplicación CRUD PHP</h1>
    <div>
        <hr>
        <h3>Filtro</h3>
        <form method="post">
            <label for="column">Columna</label>
            <select name="column" id="column">
                <option value="<?=$filtercolumn?>" selected hidden><?= ucfirst($filtercolumn) ?></option>
                <option value="nombre">Nombre</option>
                <option value="apellido">Apellido</option>
                <option value="edad">Edad</option>
                <option value="email">Email</option>
                <option value="curso_id">Curso_id</option>
                <option value="usuario_id">Usuario_id</option>
            </select>
            <label for="value">Valor</label>
            <input type="text" name="value" id="value" value="<?= $filtervalue ?>">
            <input type="submit" name="filter" value="Filtrar">
            <button><a href="./index.php">Limpiar filtro</a></button>
        </form>
            
        <br>
    </div>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Edad</th>
                <th>Email</th>
                <th>Curso</th>
                <th>Usuario</th>
                <th>Created</th>
                <th>Updated</th>
            </tr>
        </thead>
        <tbody>
        <?php
            if (!empty($alumnos)) {
                foreach ($alumnos as $alumno) {
        ?>
            <tr>
                <td><?php echo $alumno['nombre'];?></td>
                <td><?php echo $alumno['apellido'] ; ?></td>
                <td><?php echo $alumno['edad'] ; ?></td>
                <td><?php echo $alumno['email'] ; ?></td>
                <td><?php echo $cursos[$alumno['curso_id']-1]['id'] . " ". $cursos[$alumno['curso_id']-1]['nombre']; ?></td>
                <td><?php echo $alumno['usuario_id'] ; ?></td>
                <td><?php echo $alumno['created_at'] ; ?></td>
                <td><?php echo $alumno['updated_at'] ; ?></td>

                <td>
                </td>
            </tr>
        <?php
                }
            }
        ?>
        <form method="post">
            <tr> 
                <td><input type="text" name="nombre" id="nombre" placeholder="Nombre" class="form-control"></td>
                <td><input type="text" name="apellido" id="apellido" placeholder="Apellido" class="form-control"></td>
                <td><input type="text" name="edad" id="edad" placeholder="Edad" class="form-control"></td>
                <td><input type="email" name="email" id="email" placeholder="Email" class="form-control"></td>
                <td><input type="text" name="curso_id" id="curso_id" placeholder="Curso" class="form-control"></td>
                <td><input type="text" name="usuario_id" id="usuario_id" placeholder="Usuario" class="form-control"></td>
                <td><input type="submit" name="insert" value="➕Crear"></td>
            </tr>
        </form>

        <tbody>
    </table>
</body>

<?php include "../template/footer.php"?>
