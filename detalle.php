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

// Obtener el ID de la evaluación (empresa) desde la URL
$evaluacion_id = $_GET['id'];

// Verificar si la tabla 'detalle_evaluaciones' ya tiene datos para esta empresa
$sql = "SELECT COUNT(*) as total FROM detalle_evaluaciones WHERE evaluacion_id = '$evaluacion_id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// Si la tabla está vacía para esta empresa, insertar los datos iniciales
if ($row['total'] == 0) {
    $sql_insert = "
        INSERT INTO detalle_evaluaciones (evaluacion_id, Presentacion, Periodo, IVA, ISR, Ret_ISR_Salarios, Ret_ISR, Ret_IVA, DIOT, Vencimiento, Estatus, Revisar) VALUES
        ('$evaluacion_id', '0000-00-00', 'ENERO', 'Próximo', 'Próximo', 'Próximo', 'Próximo', 'Próximo', 'Próximo', '0000-00-00', '', ''),
        ('$evaluacion_id', '0000-00-00', 'FEBRERO', 'Próximo', 'Próximo', 'Próximo', 'Próximo', 'Próximo', 'Próximo', '0000-00-00', '', ''),
        ('$evaluacion_id', '0000-00-00', 'MARZO', 'Próximo', 'Próximo', 'Próximo', 'Próximo', 'Próximo', 'Próximo', '0000-00-00', '', ''),
        ('$evaluacion_id', '0000-00-00', 'ABRIL', 'Próximo', 'Próximo', 'Próximo', 'Próximo', 'Próximo', 'Próximo', '0000-00-00', '', ''),
        ('$evaluacion_id', '0000-00-00', 'MAYO', 'Próximo', 'Próximo', 'Próximo', 'Próximo', 'Próximo', 'Próximo', '0000-00-00', '', ''),
        ('$evaluacion_id', '0000-00-00', 'JUNIO', 'Próximo', 'Próximo', 'Próximo', 'Próximo', 'Próximo', 'Próximo', '0000-00-00', '', ''),
        ('$evaluacion_id', '0000-00-00', 'JULIO', 'Próximo', 'Próximo', 'Próximo', 'Próximo', 'Próximo', 'Próximo', '0000-00-00', '', ''),
        ('$evaluacion_id', '0000-00-00', 'AGOSTO', 'Próximo', 'Próximo', 'Próximo', 'Próximo', 'Próximo', 'Próximo', '0000-00-00', '', ''),
        ('$evaluacion_id', '0000-00-00', 'SEPTIEMBRE', 'Próximo', 'Próximo', 'Próximo', 'Próximo', 'Próximo', 'Próximo', '0000-00-00', '', ''),
        ('$evaluacion_id', '0000-00-00', 'OCTUBRE', 'Próximo', 'Próximo', 'Próximo', 'Próximo', 'Próximo', 'Próximo', '0000-00-00', '', ''),
        ('$evaluacion_id', '0000-00-00', 'NOVIEMBRE', 'Próximo', 'Próximo', 'Próximo', 'Próximo', 'Próximo', 'Próximo', '0000-00-00', '', ''),
        ('$evaluacion_id', '0000-00-00', 'DICIEMBRE', 'Próximo', 'Próximo', 'Próximo', 'Próximo', 'Próximo', 'Próximo', '0000-00-00', '', '')
    ";
    if ($conn->query($sql_insert) === TRUE) {
        echo "Datos insertados exitosamente.";
    } else {
        echo "Error al insertar datos: " . $conn->error;
    }
}

// Obtener los registros de la tabla para esta empresa
$sql_select = "SELECT * FROM detalle_evaluaciones WHERE evaluacion_id = '$evaluacion_id'";
$result = $conn->query($sql_select);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detalle de Evaluaciones</title>
    <!-- Incluir Semantic UI desde CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
    <style>

    body {
            overflow-x: scroll; /* Habilita la barra de desplazamiento horizontal solo cuando sea necesario */
        }

    .ui.container {
            margin-top: 50px;
            text-align: left;
        }        
    </style>
</head>
<body>

<div class="ui container">
    <h2 class="ui header">Detalle de Evaluaciones</h2>
    
    <!-- Botón para volver a evaluaciones -->
    <a href="dashboard.php?id=<?php echo $evaluacion_id; ?>" class="ui primary button">Volver a Evaluaciones</a>
    
    <!-- Tabla de detalle de evaluaciones -->
    <table class="ui celled collapsing striped table"> 
        <thead>
            <tr>
                <th>Presentación</th>
                <th>Periodo</th>
                <th>IVA</th>
                <th>ISR</th>
                <th>RET. ISR Salarios</th>
                <th>RET. ISR</th>
                <th>RET. IVA</th>
                <th>DIOT</th>
                <th>Vencimiento</th>
                <th>Estatus</th>
                <th>Revisar</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['Presentacion']; ?></td>
                        <td><?php echo $row['Periodo']; ?></td>
                        <td><?php echo $row['IVA']; ?></td>
                        <td><?php echo $row['ISR']; ?></td>
                        <td><?php echo $row['Ret_ISR_Salarios']; ?></td>
                        <td><?php echo $row['Ret_ISR']; ?></td>
                        <td><?php echo $row['Ret_IVA']; ?></td>
                        <td><?php echo $row['DIOT']; ?></td>
                        <td><?php echo $row['Vencimiento']; ?></td>
                        <td><?php echo $row['Estatus']; ?></td>
                        <td><?php echo $row['Revisar']; ?></td>
                        <td>
                            <a href="editar_detalle.php?id=<?php echo $row['id']; ?>" class="mini ui blue button">Editar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="12" class="ui center aligned">No hay registros.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>

<?php
$conn->close();
?>
