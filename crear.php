
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
            if (isset($_POST['submit'])) {
            
                $resultado = [
                    'error' => false,
                    'mensaje' => 'El alumno ' . escapar($_POST['nombre']) . ' ha sido agregado con éxito'
                ];
                
                $config = include 'config.php';

                try {
                    $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
                    $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

                    $alumno = [
                        "nombre"   => $_POST['nombre'],
                        "apellido" => $_POST['apellido'],
                        "email"    => $_POST['email'],
                        "edad"     => $_POST['edad'],
                    ];
                        $consultaSQL = "INSERT INTO alumnos (nombre, apellido, email, edad)";
                        $consultaSQL .= "values (:" . implode(", :", array_keys($alumno)) . ")";
                        $sentencia = $conexion->prepare($consultaSQL);
                        $sentencia->execute($alumno);

                } catch(PDOException $error) {
                    $resultado['error'] = true;
                    $resultado['mensaje'] = $error->getMessage();
                }
            }
        ?>

</head>
<body>
</div>
    <div class="container mt-3">
        <div class="row">
        <div class="col-md-12">
            <div class="alert alert-<?= $resultado['error'] ? 'danger' : 'success' ?>" role="alert">
            <?= $resultado['mensaje'] ?>
            </div>
        </div>
        </div>
    </div>
    <div class="container">
    <div class="row">
        <div class="col-md-12">
        <h2 class="mt-4">Crea un alumno</h2>
        <hr>
        <div class="container">

        <form method="post">
            <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" placeholder="Insertar nombre" class="form-control">
            </div>
            <br>
            <div class="form-group">
            <label for="apellido">Apellido</label>
            <input type="text" name="apellido" id="apellido" placeholder="Insertar apellido" class="form-control">
            </div>
            <br>
            <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Insertar email" class="form-control">
            </div>
            <br>
            <div class="form-group">
            <label for="edad">Edad</label>
            <input type="text" name="edad" id="edad" placeholder="Insertar edad" class="form-control">
            </div>
            <br>
            <div class="form-group">
            <input type="submit" name="submit" class="btn btn-primary" value="Enviar">
            <a class="btn btn-primary" href="index.php">Regresar al inicio</a>
            </div>
            <input name="csrf" type="hidden" value="<?php echo escapar($_SESSION['csrf']); ?>">

        </form>

        </div>
    </div>
    </div>
</body>
</html>