<?php 
    include "../template/header.php";
    require_once '../controller/alumno-controller.php';

    $alumnoController = new AlumnoController();
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
            'email'    => $_POST['email'],
            'edad'   => $_POST['edad'],
            'curso'    => $_POST['curso'],
            'nivel'   => $_POST['nivel']
        );
        $alumnoController->insertAlumno($data);
    }

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
                <option value="email">Email</option>
                <option value="edad">Edad</option>
                <option value="curso">Curso</option>
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
                <th>Email</th>
                <th>Edad</th>
                <th>Curso</th>
            </tr>
        </thead>
        <tbody>
        <?php
            if (!empty($alumnos)) {
                foreach ($alumnos as $alumno) {
        ?>
            <tr>
                <td><?php echo $alumno['nombre'] ;?></td>
                <td><?php echo $alumno['apellido'] ; ?></td>
                <td><?php echo $alumno['email'] ; ?></td>
                <td><?php echo $alumno['edad'] ; ?></td>
                <td><?php echo $alumno['curso'] ; ?></td>
                <td>
                <a href="<?= 'borrar.php?id=' .  $alumno['id']; ?>">🗑️Borrar</a>
                <a href="<?= 'editar.php?id=' .  $alumno['id']; ?>">✏️Editar</a>
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
                <td><input type="email" name="email" id="email" placeholder="Email" class="form-control"></td>
                <td><input type="text" name="edad" id="edad" placeholder="Edad" class="form-control"></td>
                <td><input type="text" name="curso" id="curso" placeholder="Kurtsoa" class="form-control"></td>
                <td><input type="submit" name="insert" value="➕Crear"></td>
            </tr>
        </form>

        <tbody>
    </table>
</body>

<?php include "../template/footer.php"?>
