<?php 
    ini_set ('display_errors', 1);
    ini_set ('display_startup_errors', 1);
    include "../template/header.php";
    require_once '../controller/alumno-controller.php';
    require_once '../controller/curso-controller.php';
    require_once '../controller/usuario-controller.php';
    $alumnoController = new AlumnoController();
    $cursoController = new CursoController();
    $usuarioController = new UsuarioController();
    $filtercolumn = "";
    $filtervalue = "";

    if(isset($_GET['id'])){
        $selected_alumno = $alumnoController->selectAlumno("id",$_GET['id']);
    }



    if (isset($_POST['filter'])) {
        $filtercolumn = strtolower($_POST['column']);
        $filtervalue = $_POST['value'];
    }
    $alumnos = $alumnoController->selectAlumnos($filtercolumn,$filtervalue);

    if (isset($_POST['insert'])) {
        $data = array(
            'id'   => $_POST['id'],
            'nombre'   => $_POST['nombre'],
            'apellido'    => $_POST['apellido'],
            'edad'   => $_POST['edad'],
            'email'   => $_POST['email'],
            'curso_id'    => $_POST['curso_id'],
            'usuario_id'   => $_POST['usuario_id'],
        );
        if($data['curso_id'] == ""){
            $data['curso_id'] = null; 
        }
        if($data['usuario_id'] == ""){
            $data['usuario_id'] = null; 
        }
        $alumnoController->insertAlumno($data);
    }

    $cursos = $cursoController->selectCursos("","");
    $usuarios = $usuarioController->selectUsuarios("","");

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
                <option value="id">Id</option>
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
            <button><a href="./administrazioa.php">Limpiar filtro</a></button>
        </form>
            
        <br>
    </div>
    <table>
        <thead>
            <tr>
                <th>Id</th>
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
                <td><?php echo $alumno['id'];?></td>
                <td><?php echo $alumno['nombre'];?></td>
                <td><?php echo $alumno['apellido'] ; ?></td>
                <td><?php echo $alumno['edad'] ; ?></td>
                <td><?php echo $alumno['email'] ; ?></td>
                <td><?php echo $alumno['curso_id'] != null ? $cursos[$alumno['curso_id']-1]['id'] . " ". $cursos[$alumno['curso_id']-1]['nombre'] : "No hay curso"; ?></td>
                <td><?php echo $alumno['usuario_id'] != null ? $usuarios[$alumno['usuario_id']-1]['id'] . " ". $usuarios[$alumno['usuario_id']-1]['nombre'] : "No hay usuario"; ?></td>
                <td><?php echo $alumno['created_at'] ; ?></td>
                <td><?php echo $alumno['updated_at'] ; ?></td>
                <td><a href="<?php echo "borrar.php?id=" . $alumno['id'];?>" >Borrar</a></td>
                <form method="post">
                    <td><a href="<?php echo "administrazioa.php?id=" . $alumno['id'];?>" >Editar</a></td>
                </from>
                <td>
                </td>
            </tr>
        <?php
                }
            }
        ?>
        <form method="post">
            <tr> 
                <td><input type="text" value="<?php echo isset($selected_alumno) ? $selected_alumno['id'] : "";?>" name="id" id="id" placeholder="Id" class="form-control"></td>
                <td><input type="text" value="<?php echo isset($selected_alumno) ? $selected_alumno['nombre'] : "";?>" name="nombre" id="nombre" placeholder="Nombre" class="form-control"></td>
                <td><input type="text" value="<?php echo isset($selected_alumno) ? $selected_alumno['apellido'] : "";?>" name="apellido" id="apellido" placeholder="Apellido" class="form-control"></td>
                <td><input type="text" value="<?php echo isset($selected_alumno) ? $selected_alumno['edad'] : "";?>" name="edad" id="edad" placeholder="Edad" class="form-control"></td>
                <td><input type="email" value="<?php echo isset($selected_alumno) ? $selected_alumno['email'] : "";?>"  name="email" id="email" placeholder="Email" class="form-control"></td>
                <td>
                    <select name="curso_id" id="curso_id">
                    <option value="<?php echo isset($selected_alumno) ? $selected_alumno['curso_id'] : "";?>" selected hidden><?php echo isset($selected_alumno['curso_id']) ? $cursos[$selected_alumno['curso_id']-1]['id'] . " ". $cursos[$selected_alumno['curso_id']-1]['nombre'] : "No hay curso"; ?></option>
                    <option value="">No hay curso</option>

                    <?php
                        if (!empty($cursos)) {
                            foreach ($cursos as $curso) {
                    ?>
                        <option value="<?php echo $curso['id'] ?>"><?php echo $curso['id'] . " " . $curso['nombre'] ?></option>
                    <?php
                            }
                        }
                    ?>
                    
                    </select>
                </td>
                <td>
                    <select name="usuario_id" id="usuario_id">
                    <option value="<?php echo isset($selected_alumno) ? $selected_alumno['usuario_id'] : "";?>" selected hidden><?php echo isset($selected_alumno['usuario_id']) ? $usuarios[$selected_alumno['usuario_id']-1]['id'] . " ". $usuarios[$selected_alumno['usuario_id']-1]['nombre'] : "No hay usuario"; ?></option>
                    <option value="">No hay curso</option>
                    <?php
                        if (!empty($usuarios)) {
                            foreach ($usuarios as $usuario) {
                    ?>
                        <option value="<?php echo $usuario['id'] ?>"><?php echo $usuario['id'] . " " . $usuario['nombre'] ?></option>
                    <?php
                            }
                        }
                    ?>
                    
                    </select>
                </td>
                <td><input type="submit" name="insert" value="✏️"></td>
            </tr>
        </form>

        <tbody>
    </table>
</body>

<?php include "../template/footer.php"?>
