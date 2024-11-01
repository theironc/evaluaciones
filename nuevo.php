<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "";
$password = "";
$dbname = "";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Insertar nuevo registro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

    $sql = "INSERT INTO evaluaciones 
        (EMPRESA, SAT, Revisar, Pagado, Pagado_Parcial, Opinion_SAT, OBSERVACIONES, ISN, IMSS, Opinion_IMSS, INFONAVIT, Opinion_Infonavit, REPSE)
        VALUES ('$empresa', '$sat', '$revisar', '$pagado', '$pagadoParcial', '$opinionSAT', '$observaciones', '$isn', '$imss', '$opinionIMSS', '$infonavit', '$opinionInfonavit', '$repse')";

    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php"); // Redirigir a la lista después de la creación
        exit();
    } else {
        echo "Error creando registro: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Nuevo Registro de Evaluación</title>
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
    <h2 class="ui header">Agregar Nueva Evaluación</h2>

    <!-- Formulario de nueva evaluación -->
    <form class="ui form" method="post">
        <div class="ui two column grid">
            <!-- Primera columna -->
            <div class="column">
                <div class="field">
                    <label>EMPRESA</label>
                    <input type="text" name="EMPRESA" required>
                </div>

                <div class="field">
                    <label>SAT</label>
                    <div class="ui radio checkbox">
                        <input type="radio" name="SAT" value="Actualizado" checked>
                        <label>Actualizado</label>
                    </div>
                    <div class="ui radio checkbox">
                        <input type="radio" name="SAT" value="Vencido">
                        <label>Vencido</label>
                    </div>
                </div>

                <div class="field">
                    <label>Revisar</label>
                    <div class="ui radio checkbox">
                        <input type="radio" name="Revisar" value="Revisado" checked>
                        <label>Revisado</label>
                    </div>
                    <div class="ui radio checkbox">
                        <input type="radio" name="Revisar" value="Pendiente">
                        <label>Pendiente</label>
                    </div>
                </div>

                <div class="field">
                    <label>Pagado</label>
                    <div class="ui radio checkbox">
                        <input type="radio" name="Pagado" value="Si" checked>
                        <label>Sí</label>
                    </div>
                    <div class="ui radio checkbox">
                        <input type="radio" name="Pagado" value="No">
                        <label>No</label>
                    </div>
                </div>

                <div class="field">
                    <label>Opinión SAT</label>
                    <div class="ui radio checkbox">
                        <input type="radio" name="Opinion_SAT" value="Positiva" checked>
                        <label>Positiva</label>
                    </div>
                    <div class="ui radio checkbox">
                        <input type="radio" name="Opinion_SAT" value="Negativa">
                        <label>Negativa</label>
                    </div>
                </div>

                <div class="field">
                    <label>ISN</label>
                    <div class="ui radio checkbox">
                        <input type="radio" name="ISN" value="Pagado" checked>
                        <label>Pagado</label>
                    </div>
                    <div class="ui radio checkbox">
                        <input type="radio" name="ISN" value="No Pagado">
                        <label>No Pagado</label>
                    </div>
                </div>
            </div>

            <!-- Segunda columna -->
            <div class="column">
                <div class="field">
                    <label>IMSS</label>
                    <div class="ui radio checkbox">
                        <input type="radio" name="IMSS" value="Pagado" checked>
                        <label>Pagado</label>
                    </div>
                    <div class="ui radio checkbox">
                        <input type="radio" name="IMSS" value="No Pagado">
                        <label>No Pagado</label>
                    </div>
                </div>

                <div class="field">
                    <label>Opinión IMSS</label>
                    <div class="ui radio checkbox">
                        <input type="radio" name="Opinion_IMSS" value="Positiva" checked>
                        <label>Positiva</label>
                    </div>
                    <div class="ui radio checkbox">
                        <input type="radio" name="Opinion_IMSS" value="Negativa">
                        <label>Negativa</label>
                    </div>
                </div>

                <div class="field">
                    <label>INFONAVIT</label>
                    <div class="ui radio checkbox">
                        <input type="radio" name="INFONAVIT" value="Pagado" checked>
                        <label>Pagado</label>
                    </div>
                    <div class="ui radio checkbox">
                        <input type="radio" name="INFONAVIT" value="No Pagado">
                        <label>No Pagado</label>
                    </div>
                </div>

                <div class="field">
                    <label>Opinión INFONAVIT</label>
                    <div class="ui radio checkbox">
                        <input type="radio" name="Opinion_Infonavit" value="Positiva" checked>
                        <label>Positiva</label>
                    </div>
                    <div class="ui radio checkbox">
                        <input type="radio" name="Opinion_Infonavit" value="Negativa">
                        <label>Negativa</label>
                    </div>
                </div>

                <div class="field">
                    <label>REPSE</label>
                    <input type="text" name="REPSE">
                </div>

                <div class="field">
                    <label>Observaciones</label>
                    <textarea name="Observaciones" rows="4"></textarea>
                </div>
            </div>
        </div>

        <button class="ui blue button" type="submit">Guardar nueva evaluación</button>
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
