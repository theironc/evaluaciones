<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "afcconta_evaluaciones";
$password = "z7M3QUjMVtkKEtX";
$dbname = "afcconta_evaluaciones";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el ID del registro
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Obtener los datos del registro
if ($_SERVER['REQUEST_METHOD'] === 'GET' && $id) {
    $sql = "SELECT * FROM evaluaciones WHERE `evaluacion_id` = $id";
    $result = $conn->query($sql);
    $registro = $result->fetch_assoc();
}

// Actualizar los datos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['evaluacion_id'];
    $empresa = $_POST['EMPRESA'];
    $sat = $_POST['SAT'];
    $revisar = $_POST['Revisar'];
    $pagado = $_POST['Pagado'];
    $opinionSAT = $_POST['Opinion_SAT'];
    $observaciones = $_POST['OBSERVACIONES'];
    $isn = $_POST['ISN'];
    $imss = $_POST['IMSS'];
    $opinionIMSS = $_POST['Opinion_IMSS'];
    $infonavit = $_POST['INFONAVIT'];
    $opinionInfonavit = $_POST['Opinion_Infonavit'];
    $repse = $_POST['REPSE'];

    // Actualizar el registro en la base de datos
    $sql = "UPDATE evaluaciones SET 
        evaluacion_id = '$id', EMPRESA = '$empresa', SAT = '$sat', Revisar = '$revisar', 
        Pagado = '$pagado', `Opinion_SAT` = '$opinionSAT',
        OBSERVACIONES = '$observaciones', ISN = '$isn', IMSS = '$imss', 
        `Opinion_IMSS` = '$opinionIMSS', INFONAVIT = '$infonavit', 
        `Opinion_Infonavit` = '$opinionInfonavit', REPSE = '$repse' 
        WHERE `evaluacion_id` = $id";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php"); // Redirigir de nuevo a la lista
        exit();
    } else {
        echo "Error actualizando registro: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Evaluación</title>
    <!-- Incluir Semantic UI desde CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
    <style>
        .ui.container {
            margin-top: 50px;
            text-align: left;
        }
    </style>
</head>
<body>

<div class="ui container">
    <h2 class="ui header">Editar Evaluación</h2>

    <!-- Formulario de edición -->
    <form class="ui form" method="post">
        <div class="ui grid">
            <!-- Primera columna -->
            <div class="eight wide column">
                <div class="field">
                    <label>EMPRESA</label>
                    <input type="text" name="EMPRESA" value="<?php echo $registro['EMPRESA']; ?>" required>
                </div>

                <div class="field">
                    <label>SAT</label>
                    <div class="ui radio checkbox">
                        <input type="radio" name="SAT" value="Actualizado" <?php echo ($registro['SAT'] == 'Actualizado') ? 'checked' : ''; ?>>
                        <label>Actualizado</label>
                    </div>
                    <div class="ui radio checkbox">
                        <input type="radio" name="SAT" value="Vencido" <?php echo ($registro['SAT'] == 'Vencido') ? 'checked' : ''; ?>>
                        <label>Vencido</label>
                    </div>
                </div>

                <div class="field">
                    <label>Revisar</label>
                    <div class="ui radio checkbox">
                        <input type="radio" name="Revisar" value="Revisado" <?php echo ($registro['Revisar'] == 'Revisado') ? 'checked' : ''; ?>>
                        <label>Revisado</label>
                    </div>
                    <div class="ui radio checkbox">
                        <input type="radio" name="Revisar" value="Pendiente" <?php echo ($registro['Revisar'] == 'Pendiente') ? 'checked' : ''; ?>>
                        <label>Pendiente</label>
                    </div>
                </div>

                <div class="field">
                    <label>Pagado</label>
                    <div class="ui radio checkbox">
                        <input type="radio" name="Pagado" value="Si" <?php echo ($registro['Pagado'] == 'Si') ? 'checked' : ''; ?>>
                        <label>Sí</label>
                    </div>
                    <div class="ui radio checkbox">
                        <input type="radio" name="Pagado" value="No" <?php echo ($registro['Pagado'] == 'No') ? 'checked' : ''; ?>>
                        <label>No</label>
                    </div>
                    <div class="ui radio checkbox">
                        <input type="radio" name="Pagado" value="Parcial" <?php echo ($registro['Pagado'] == 'Parcial') ? 'checked' : ''; ?>>
                        <label>Parcial</label>
                    </div>
                </div>

                <div class="field">
                    <label>Opinión SAT</label>
                    <div class="ui radio checkbox">
                        <input type="radio" name="Opinion_SAT" value="Positiva" <?php echo ($registro['Opinion_SAT'] == 'Positiva') ? 'checked' : ''; ?>>
                        <label>Positiva</label>
                    </div>
                    <div class="ui radio checkbox">
                        <input type="radio" name="Opinion_SAT" value="Negativa" <?php echo ($registro['Opinion_SAT'] == 'Negativa') ? 'checked' : ''; ?>>
                        <label>Negativa</label>
                    </div>
                </div>
                <div class="field">
                    <label>Observaciones</label>
                    <textarea name="OBSERVACIONES"><?php echo $registro['OBSERVACIONES']; ?></textarea>
                </div>

                <div class="field">
                    <label>ISN</label>
                    <div class="ui radio checkbox">
                        <input type="radio" name="ISN" value="Pagado" <?php echo ($registro['ISN'] == 'Pagado') ? 'checked' : ''; ?>>
                        <label>Pagado</label>
                    </div>
                    <div class="ui radio checkbox">
                        <input type="radio" name="ISN" value="No Pagado" <?php echo ($registro['ISN'] == 'No Pagado') ? 'checked' : ''; ?>>
                        <label>No Pagado</label>
                    </div>
                </div>

                <div class="field">
                    <label>IMSS</label>
                    <div class="ui radio checkbox">
                        <input type="radio" name="IMSS" value="Pagado" <?php echo ($registro['IMSS'] == 'Pagado') ? 'checked' : ''; ?>>
                        <label>Pagado</label>
                    </div>
                    <div class="ui radio checkbox">
                        <input type="radio" name="IMSS" value="No Pagado" <?php echo ($registro['IMSS'] == 'No Pagado') ? 'checked' : ''; ?>>
                        <label>No Pagado</label>
                    </div>
                </div>
            </div>

            <!-- Segunda columna -->
            <div class="eight wide column">
                <div class="field">
                    <label>Opinión IMSS</label>
                    <div class="ui radio checkbox">
                        <input type="radio" name="Opinion_IMSS" value="Positiva" <?php echo ($registro['Opinion_IMSS'] == 'Positiva') ? 'checked' : ''; ?>>
                        <label>Positiva</label>
                    </div>
                    <div class="ui radio checkbox">
                        <input type="radio" name="Opinion_IMSS" value="Negativa" <?php echo ($registro['Opinion_IMSS'] == 'Negativa') ? 'checked' : ''; ?>>
                        <label>Negativa</label>
                    </div>
                </div>

                <div class="field">
                    <label>INFONAVIT</label>
                    <div class="ui radio checkbox">
                        <input type="radio" name="INFONAVIT" value="Pagado" <?php echo ($registro['INFONAVIT'] == 'Pagado') ? 'checked' : ''; ?>>
                        <label>Pagado</label>
                    </div>
                    <div class="ui radio checkbox">
                        <input type="radio" name="INFONAVIT" value="No Pagado" <?php echo ($registro['INFONAVIT'] == 'No Pagado') ? 'checked' : ''; ?>>
                        <label>No Pagado</label>
                    </div>
                </div>

                <div class="field">
                    <label>Opinión INFONAVIT</label>
                    <div class="ui radio checkbox">
                        <input type="radio" name="Opinion_Infonavit" value="Positiva" <?php echo ($registro['Opinion_Infonavit'] == 'Positiva') ? 'checked' : ''; ?>>
                        <label>Positiva</label>
                    </div>
                    <div class="ui radio checkbox">
                        <input type="radio" name="Opinion_Infonavit" value="Negativa" <?php echo ($registro['Opinion_Infonavit'] == 'Negativa') ? 'checked' : ''; ?>>
                        <label>Negativa</label>
                    </div>
                </div>

                <div class="field">
                    <label>REPSE</label>
                    <input type="text" name="REPSE" value="<?php echo $registro['REPSE']; ?>">
                </div>
            </div>
        </div>

        <input type="hidden" name="evaluacion_id" value="<?php echo $registro['evaluacion_id']; ?>">
        <br>
        <button class="ui blue button" type="submit">Guardar cambios</button>
        <a href="dashboard.php?id=<?php echo $evaluacion_id; ?>" class="ui button">Volver a Evaluaciones</a>
    </form>
</div>

<script>
$(document).ready(function() {
    $('.ui.radio.checkbox').checkbox();
});
</script>

</body>
</html>
<?php
$conn->close();
?>