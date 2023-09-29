<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Aplicación CRUD PHP</title>

    <link rel="stylesheet" href="./bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <?php
include 'funciones.php';
csrf();
    
if (isset($_POST['submit']) && !hash_equals($_SESSION['csrf'], $_POST['csrf'])) {
  die();
}
$error = false;
$config = include 'config.php';

try {
  $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
  $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

  if (isset($_POST['apellido'])) {
    $consultaSQL = "SELECT * FROM alumnos WHERE apellido LIKE '%" . $_POST['apellido'] . "%'";
  } else {
    $consultaSQL = "SELECT * FROM alumnos";
  }
  $sentencia = $conexion->prepare($consultaSQL);
  $sentencia->execute();

  $alumnos = $sentencia->fetchAll();

  $titulo = isset($_POST['apellido']) ? 'Lista de alumnos (' . $_POST['apellido'] . ')' : 'Lista de alumnos';

} catch(PDOException $error) {
  $error= $error->getMessage();
}
?>
  </head>
  <body>
<?php
if ($error) {
  ?>
  <div class="container mt-2">
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-danger" role="alert">
          <?= $error ?>
        </div>
      </div>
    </div>
  </div>
  <?php
}
?>
<div class="contenedor">
<div class="container">
<h1>Aplicación CRUD PHP</h1>
<div class="row">

            <div class="col-md-12">
            <a href="crear.php"  class="btn btn-primary mt-4">Crear alumno</a>
            <hr>
            <form method="post" class="form-inline">
                <div class="form-group mr-3">
                <input type="text" id="apellido" name="apellido" placeholder="Buscar por apellido" class="form-control">
                </div>
                <br>
                <button type="submit" name="submit" class="btn btn-primary">Ver resultados</button>
                <input name="csrf" type="hidden" value="<?php echo escapar($_SESSION['csrf']); ?>">
            </form>
            </div>
        </div>
</div>
<br>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2 class="mt-3"><?php echo escapar($titulo); ?></h2>
      <table class="table table-dark">
      <thead>
      <tr>
        
        <th>#</th>
        <th>Izena</th>
        <th>Abizena</th>
        <th>Emaila</th>
        <th>Telefonoa</th>
        <th>Kurtsoa</th>
        <th>Maila</th>
      </tr>
    </thead>
        <tbody>
          <?php
          if ($alumnos && $sentencia->rowCount() > 0) {
            foreach ($alumnos as $fila) {
              ?>
              <tr>
              
                <td><?php echo escapar($fila["id"]); ?></td>
                <td><?php echo escapar($fila["nombre"]); ?></td>
                <td><?php echo escapar($fila["apellido"]); ?></td>
                <td><?php echo escapar($fila["email"]); ?></td>
                <td><?php echo escapar($fila["edad"]); ?></td>
                <td><?php echo escapar($fila["curso"]); ?></td>
                <td><?php echo escapar($fila["nivel"]); ?></td>
                <td>
                <a href="<?= 'borrar.php?id=' . escapar($fila["id"]) ?>">🗑️Borrar</a>
                <a href="<?= 'editar.php?id=' . escapar($fila["id"]) ?>">✏️Editar</a>
               </td>
              </tr>
              <?php
            }
          }
          ?>
        <tbody>
      </table>
    </div>
  </div>
</div>
</div>
  </body>
</html>