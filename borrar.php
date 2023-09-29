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

    try {
    $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
    $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
        
    $id = $_GET['id'];
    $consultaSQL = "DELETE FROM alumnos WHERE id =" . $id;

    $sentencia = $conexion->prepare($consultaSQL);
    $sentencia->execute();

    header('Location: /izaskun%20ariketak/CRUD//index.php');

    } catch(PDOException $error) {
    $resultado['error'] = true;
    $resultado['mensaje'] = $error->getMessage();
    }
?>
</head>
<body>

  <div class="container mt-2">
  <div class="row">
    <div class="col-md-12">
      <div class="alert alert-danger" role="alert">
        <?= $resultado['mensaje'] ?>
      </div>
    </div>
  </div>
</div>
</body>
</html>
