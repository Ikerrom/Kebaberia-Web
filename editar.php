<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <title>Document</title>
    <?php
        include 'funciones.php';
        csrf();
    
        if (isset($_POST['submit']) && !hash_equals($_SESSION['csrf'], $_POST['csrf'])) {
          die();
        }
        $config = include 'config.php';

        $resultado = [
        'error' => false,
        'mensaje' => ''
        ];

        if (!isset($_GET['id'])) {
        $resultado['error'] = true;
        $resultado['mensaje'] = 'El alumno no existe';
        }
        if (isset($_POST['submit'])) {
            try {
              $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
              $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
              $alumno = [
                "id"        => $_GET['id'],
                "nombre"    => $_POST['nombre'],
                "apellido"  => $_POST['apellido'],
                "email"     => $_POST['email'],
                "edad"      => $_POST['edad'],
                "curso"      => $_POST['curso'],
                "nivel"      => $_POST['nivel']
              ];
              
                $consultaSQL = "UPDATE alumnos SET
                    nombre = :nombre,
                    apellido = :apellido,
                    email = :email,
                    edad = :edad,
                    curso = :curso,
                    nivel = :nivel,
                    updated_at = NOW()
                    WHERE id = :id";
                    
                $consulta = $conexion->prepare($consultaSQL);
                $consulta->execute($alumno);
            } catch(PDOException $error) {
              $resultado['error'] = true;
              $resultado['mensaje'] = $error->getMessage();
            }
        }
        try {
            $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
            $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
                
            $id = $_GET['id'];
            $consultaSQL = "SELECT * FROM alumnos WHERE id =" . $id;
            
            $sentencia = $conexion->prepare($consultaSQL);
            $sentencia->execute();

            $alumno = $sentencia->fetch(PDO::FETCH_ASSOC);

        if (!$alumno) {
            $resultado['error'] = true;
            $resultado['mensaje'] = 'No se ha encontrado el alumno';
        }

        } catch(PDOException $error) {
            $resultado['error'] = true;
            $resultado['mensaje'] = $error->getMessage();
        }
        ?>
</head>
<body>
<?php
if (isset($_POST['submit']) && !$resultado['error']) {
  ?>
  <div class="container mt-2">
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-success" role="alert">
          El alumno ha sido actualizado correctamente
        </div>
      </div>
    </div>
  </div>
  <?php
}
?>
<?php
if (isset($alumno) && $alumno) {
  ?>
  <div class="container">
    <div class="row">
      <div class="col-md-12" >
        <div class="centrado2">
        <h2 class="mt-5" >✏️Editando el alumno <?= escapar($alumno['nombre']) . ' ' . escapar($alumno['apellido'])  ?></h2>
        </div>
        <hr>
        <form method="post" class="centrado">
          <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="<?= escapar($alumno['nombre']) ?>" class="form-control">
          </div>
          <br>
          <div class="form-group">
            <label for="apellido">Apellido</label>
            <input type="text" name="apellido" id="apellido" value="<?= escapar($alumno['apellido']) ?>" class="form-control">
          </div>
          <br>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?= escapar($alumno['email']) ?>" class="form-control">
          </div>
          <br>
          <div class="form-group">
            <label for="edad">Edad</label>
            <input type="text" name="edad" id="edad" value="<?= escapar($alumno['edad']) ?>" class="form-control">
          </div>
          <br>
          <div class="form-group">
            <label for="curso">Curso</label>
            <input type="curso" name="curso" id="curso" value="<?= escapar($alumno['curso']) ?>" class="form-control">
          </div>
          <br>
          <div class="form-group">
            <label for="nivel">Nivel</label>
            <input type="text" name="nivel" id="nivel" value="<?= escapar($alumno['nivel']) ?>" class="form-control">
          </div>
          <br>
          <div class="form-group">
            <input type="submit" name="submit" class="btn btn-primary" value="Actualizar">
            <a class="btn btn-primary" href="index.php">Regresar al inicio</a>
          </div>
          <input name="csrf" type="hidden" value="<?php echo escapar($_SESSION['csrf']); ?>">
        </form>
      </div>
    </div>
  </div>
  <?php
}
?>
</body>
</html>
