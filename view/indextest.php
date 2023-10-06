<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
    require_once '../controller/alumno-controller.php';
    require_once '../util/funciones.php';

    csrf();
    if (isset($_POST['submit']) && !hash_equals($_SESSION['csrf'], $_POST['csrf'])) {
      die();
    }

    $alumnoController = new AlumnoController();
    $alumnosel;
    $alumnos;
    
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

    if (isset($_POST['delete'])) {
        $data = $_POST['id'];
        $alumnoController->deleteAlumno($data);
    }

    if (isset($_POST['select'])) {
        $alumnosel = $alumnoController->selectAlumno("id",$_POST['id']);
    }

    if (isset($_POST['update'])) {
        $data = array(
            'nombre'   => $_POST['nombre'],
            'apellido'    => $_POST['apellido'],
            'email'    => $_POST['email'],
            'edad'   => $_POST['edad'],
            'curso'    => $_POST['curso'],
            'nivel'   => $_POST['nivel']
        );
        $alumnoController->updateAlumno($_POST['id'],$data);
    }

    ?>
</head>
<body>

<form method="post">
    <label for="column">Column</label>
    <input type="text" name="column" id="column" placeholder="Columna" class="form-control">
    <br>
    <label for="value">Value</label>
    <input type="text" name="value" id="value" placeholder="Valor" class="form-control">
    <br>
    <input type="submit" name="filter" class="btn btn-primary" value="Enviar">
    <input name="csrf" type="hidden" value="<?php echo escapar($_SESSION['csrf']); ?>">
</form>

<?php
    if (!empty($alumnos)) {
		foreach ($alumnos as $alumno) { ?>
			<p><?=$alumno['id'] . " " . $alumno['nombre']. " " . $alumno['apellido']. " " . $alumno['email']. " " . $alumno['edad']. " " . $alumno['curso']. " " . $alumno['nivel'];?></p>
<?php } } ?>
    
<form method="post">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre" placeholder="Insertar nombre" class="form-control">
    <br>
    <label for="apellido">Apellido</label>
    <input type="text" name="apellido" id="apellido" placeholder="Insertar apellido" class="form-control">
    <br>
    <label for="email">Email</label>
    <input type="email" name="email" id="email" placeholder="Insertar email" class="form-control">
    <br>
    <label for="edad">Edad</label>
    <input type="text" name="edad" id="edad" placeholder="Insertar edad" class="form-control">
    <br>
    <label for="curso">Kurtsoa</label>
    <input type="text" name="curso" id="curso" placeholder="Sartu kurtsoa" class="form-control">
    <br>
    <input type="submit" name="insert" class="btn btn-primary" value="Enviar">
    <input name="csrf" type="hidden" value="<?php echo escapar($_SESSION['csrf']); ?>">
</form>
<br>
<br>
<form method="post">
    <label for="id">ID</label>
    <input type="text" name="id" id="id" placeholder="delete id" class="form-control">
    <br>
    <input type="submit" name="delete" class="btn btn-primary" value="Enviar">
    <input name="csrf" type="hidden" value="<?php echo escapar($_SESSION['csrf']); ?>">
</form>
<br>
<br>
<form method="post">
    <label for="id">ID</label>
    <input type="text" name="id" id="id" placeholder="Edit id" class="form-control">
    <br>
    <input type="submit" name="select" class="btn btn-primary" value="Enviar">
    <input name="csrf" type="hidden" value="<?php echo escapar($_SESSION['csrf']); ?>">
</form>
<br>
<br>
<form method="post">
    <input type="text" name="id" id="id" hidden="true" class="form-control" value="<?php echo isset($alumnosel) ? $alumnosel['id'] : "";?>">
    <br>
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo isset($alumnosel) ? $alumnosel['nombre'] : "";?>">
    <br>
    <label for="apellido">Apellido</label>
    <input type="text" name="apellido" id="apellido" class="form-control" value="<?php echo isset($alumnosel) ? $alumnosel['apellido'] : "";?>">
    <br>
    <label for="email">Email</label>
    <input type="email" name="email" id="email" class="form-control" value="<?php echo isset($alumnosel) ? $alumnosel['email'] : "";?>">
    <br>
    <label for="edad">Edad</label>
    <input type="text" name="edad" id="edad"  class="form-control" value="<?php echo isset($alumnosel) ? $alumnosel['edad'] : "";?>">
    <br>
    <label for="curso">Kurtsoa</label>
    <input type="text" name="curso" id="curso"  class="form-control" value="<?php echo isset($alumnosel) ? $alumnosel['curso'] : "";?>">
    <br>
    <label for="nivel">Maila</label>
    <input type="text" name="nivel" id="nivel"  class="form-control" value="<?php echo isset($alumnosel) ? $alumnosel['nivel'] : "";?>">
    <br>
    <input type="submit" name="update" class="btn btn-primary" value="Enviar">
    <input name="csrf" type="hidden" value="<?php echo escapar($_SESSION['csrf']); ?>">
</form>
</body>
</html>