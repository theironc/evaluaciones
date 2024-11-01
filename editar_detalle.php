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

// Verificar si se recibió el ID del registro
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Si no se recibió un ID válido, redirigir a la página principal
if ($id == 0) {
    header('Location: detalle.php');
    exit();
}

// Obtener los datos del registro a editar
$sql = "SELECT * FROM detalle_evaluaciones WHERE id = $id";
$result = $conn->query($sql);

// Verificar si se encontró el registro
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $evaluacion_id = $row['evaluacion_id']; // Obtener el ID de la empresa
} else {
    echo "No se encontró el registro.";
    exit();
}

// Procesar el formulario cuando se envía
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $presentacion = $_POST['Presentacion'];
    $periodo = $_POST['Periodo'];
    $iva = $_POST['IVA'];
    $isr = $_POST['ISR'];
    $ret_isr_salarios = $_POST['Ret_ISR_Salarios'];
    $ret_isr = $_POST['Ret_ISR'];
    $ret_iva = $_POST['Ret_IVA'];
    $diot = $_POST['DIOT'];
    $vencimiento = $_POST['Vencimiento'];
    $estatus = $_POST['Estatus'];
    $revisar = $_POST['Revisar'];

    // Actualizar los datos en la base de datos
    $sql_update = "UPDATE detalle_evaluaciones SET 
                    Presentacion = '$presentacion', 
                    Periodo = '$periodo',
                    IVA = '$iva',
                    ISR = '$isr',
                    Ret_ISR_Salarios = '$ret_isr_salarios',
                    Ret_ISR = '$ret_isr',
                    Ret_IVA = '$ret_iva',
                    DIOT = '$diot',
                    Vencimiento = '$vencimiento',
                    Estatus = '$estatus',
                    Revisar = '$revisar'
                  WHERE id = $id";

    if ($conn->query($sql_update) === TRUE) {
        // Redirigir a la página de detalles de la empresa correspondiente después de la actualización
        header("Location: detalle.php?id=$evaluacion_id");
        exit();
    } else {
        echo "Error al actualizar el registro: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Detalle de Evaluación</title>
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
    <h2 class="ui header">Editar Detalle de Evaluación</h2>

    <!-- Formulario de edición -->
    <form class="ui form" method="post" action="">
        <div class="two fields">
            <div class="field">
                <label>Presentación</label>
                <input type="text" name="Presentacion" value="<?php echo $row['Presentacion']; ?>">
            </div>
            <div class="field">
                <label>Periodo</label>
                <input type="text" name="Periodo" value="<?php echo $row['Periodo']; ?>">
            </div>
        </div>

        <div class="two fields">
            <div class="field">
                <label>IVA</label>
                <div class="ui radio checkbox">
                    <input type="radio" name="IVA" value="Próximo" <?php echo ($row['IVA'] == 'Próximo') ? 'checked' : ''; ?>>
                    <label>Próximo</label>
                </div>
                <div class="ui radio checkbox">
                    <input type="radio" name="IVA" value="Vencido" <?php echo ($row['IVA'] == 'Vencido') ? 'checked' : ''; ?>>
                    <label>Vencido</label>
                </div>
            </div>
            
            <div class="field">
                <label>ISR</label>
                <div class="ui radio checkbox">
                    <input type="radio" name="ISR" value="Próximo" <?php echo ($row['ISR'] == 'Próximo') ? 'checked' : ''; ?>>
                    <label>Próximo</label>
                </div>
                <div class="ui radio checkbox">
                    <input type="radio" name="ISR" value="Vencido" <?php echo ($row['ISR'] == 'Vencido') ? 'checked' : ''; ?>>
                    <label>Vencido</label>
                </div>
            </div>
        </div>

        <div class="two fields">
            <div class="field">
                <label>Ret. ISR Salarios</label>
                <div class="ui radio checkbox">
                    <input type="radio" name="Ret_ISR_Salarios" value="Próximo" <?php echo ($row['Ret_ISR_Salarios'] == 'Próximo') ? 'checked' : ''; ?>>
                    <label>Próximo</label>
                </div>
                <div class="ui radio checkbox">
                    <input type="radio" name="Ret_ISR_Salarios" value="Vencido" <?php echo ($row['Ret_ISR_Salarios'] == 'Vencido') ? 'checked' : ''; ?>>
                    <label>Vencido</label>
                </div>
            </div>

            <div class="field">
                <label>Ret. ISR</label>
                <div class="ui radio checkbox">
                    <input type="radio" name="Ret_ISR" value="Próximo" <?php echo ($row['Ret_ISR'] == 'Próximo') ? 'checked' : ''; ?>>
                    <label>Próximo</label>
                </div>
                <div class="ui radio checkbox">
                    <input type="radio" name="Ret_ISR" value="Vencido" <?php echo ($row['Ret_ISR'] == 'Vencido') ? 'checked' : ''; ?>>
                    <label>Vencido</label>
                </div>
            </div>
        </div>

        <div class="two fields">
            <div class="field">
                <label>Ret. IVA</label>
                <div class="ui radio checkbox">
                    <input type="radio" name="Ret_IVA" value="Próximo" <?php echo ($row['Ret_IVA'] == 'Próximo') ? 'checked' : ''; ?>>
                    <label>Próximo</label>
                </div>
                <div class="ui radio checkbox">
                    <input type="radio" name="Ret_IVA" value="Vencido" <?php echo ($row['Ret_IVA'] == 'Vencido') ? 'checked' : ''; ?>>
                    <label>Vencido</label>
                </div>
            </div>

            <div class="field">
                <label>DIOT</label>
                <div class="ui radio checkbox">
                    <input type="radio" name="DIOT" value="Próximo" <?php echo ($row['DIOT'] == 'Próximo') ? 'checked' : ''; ?>>
                    <label>Próximo</label>
                </div>
                <div class="ui radio checkbox">
                    <input type="radio" name="DIOT" value="Vencido" <?php echo ($row['DIOT'] == 'Vencido') ? 'checked' : ''; ?>>
                    <label>Vencido</label>
                </div>
            </div>
        </div>

        <div class="two fields">
            <div class="field">
                <label>Vencimiento</label>
                <input type="date" name="Vencimiento" value="<?php echo $row['Vencimiento']; ?>">
            </div>

            <div class="field">
                <label>Estatus</label>
                <input type="text" name="Estatus" value="<?php echo $row['Estatus']; ?>">
            </div>
        </div>

        <div class="field">
            <label>Revisar</label>
            <input type="text" name="Revisar" value="<?php echo $row['Revisar']; ?>">
        </div>

        <!-- Botón de envío -->
        <button class="ui primary button" type="submit">Actualizar</button>
        <a href="detalle.php?id=<?php echo $evaluacion_id; ?>" class="ui button">Volver a Detalle de Evaluaciones</a>
    </form>
</div>

<!-- Activar los radio buttons -->
<script>
    $('.ui.radio.checkbox').checkbox();
</script>

</body>
</html>
