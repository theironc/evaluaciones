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

// Número de registros por página
$limit = 10;

// Obtener el número de página actual
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Consulta para obtener los registros
$sql = "SELECT * FROM evaluaciones LIMIT $start, $limit";
$result = $conn->query($sql);

// Contar el número total de registros
$countQuery = "SELECT COUNT(*) AS total FROM evaluaciones";
$countResult = $conn->query($countQuery);
$totalRows = $countResult->fetch_assoc()['total'];
$totalPages = ceil($totalRows / $limit);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Lista de Evaluaciones</title>
    <!-- Incluir Semantic UI desde CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
    <style>
        /* Aumentar el ancho de la columna de acciones */
        .acciones {
            width: 50px; /* Puedes ajustar el valor según lo necesites */
            white-space: nowrap; /* Evita que los botones se dividan en múltiples líneas */
        }

        body {
            overflow-x: scroll; /* Habilita la barra de desplazamiento horizontal solo cuando sea necesario */
        }

        /* Evitar que la tabla se ajuste al tamaño de la ventana, permitiendo el desplazamiento horizontal */
        table {
            min-width: 200px; /* Ajusta este valor según el tamaño necesario para forzar el desplazamiento */
        }

        /* Alinear contenido a la izquierda y agregar margen superior */
        .ui.container {
            margin-top: 50px;
            text-align: left;
        }
        /* Estilos para el formato condicional */
        .actualizado, .pagado, .positiva {
            background-color: #e6ffe6 !important;
            color: #006400 !important;
        }
        .vencido, .no-pagado, .negativa {
            background-color: #ffe6e6 !important;
            color: #8b0000 !important;
        }
        .revisado {
            background-color: #e6f3ff !important;
            color: #004080 !important;
        }
        .pendiente {
            background-color: #fff2e6 !important;
            color: #804000 !important;
        }

        /* Estilos para evitar saltos de línea en las celdas de la tabla */
        .ui.table td {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 150px; /* Ajusta este valor según tus necesidades */
        }

        /* Estilo para la columna de acciones */
        .ui.table td.acciones {
            white-space: nowrap;
            max-width: none;
            width: 200px; /* Ajusta este valor según sea necesario */
        }

        /* Estilos para los botones en la columna de acciones */
        .ui.table td.acciones .button {
            margin-right: 5px;
        }
    </style>    
</head>
<body>

<div class="ui container">
    <h2 class="ui header">Evaluaciones</h2>
    
    <!-- Botón para nuevo registro -->
    <a href="nuevo.php?id=1" class="ui primary button">Nuevo registro</a>
    
    <!-- Tabla de evaluaciones -->
    <table class="ui celled striped table">
        <thead>
            <tr>
                <th>Id</th>
                <th>EMPRESA</th>
                <th>SAT</th>
                <th>Revisar</th>
                <th>Pagado</th>
                <th>Opinion SAT</th>
                <th>ISN</th>
                <th>IMSS</th>
                <th>Opinion IMSS</th>
                <th>INFONAVIT</th>
                <th>Opinion Infonavit</th>
                <th>REPSE</th>
                <th class="acciones">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0) : ?>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['evaluacion_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['EMPRESA']); ?></td>
                        <td class="<?php echo strtolower($row['SAT']) === 'actualizado' ? 'actualizado' : 'vencido'; ?>">
                            <?php echo htmlspecialchars($row['SAT']); ?>
                        </td>
                        <td class="<?php echo strtolower($row['Revisar']) === 'revisado' ? 'revisado' : 'pendiente'; ?>">
                            <?php echo htmlspecialchars($row['Revisar']); ?>
                        </td>
                        <td class="<?php echo strtolower($row['Pagado']) === 'si' ? 'pagado' : 'no-pagado'; ?>">
                            <?php echo htmlspecialchars($row['Pagado']); ?>
                        </td>
                        <td class="<?php echo strtolower($row['Opinion_SAT']) === 'positiva' ? 'positiva' : 'negativa'; ?>">
                            <?php echo htmlspecialchars($row['Opinion_SAT']); ?>
                        </td>
                        <td class="<?php echo strtolower($row['ISN']) === 'pagado' ? 'pagado' : 'no-pagado'; ?>">
                            <?php echo htmlspecialchars($row['ISN']); ?>
                        </td>
                        <td class="<?php echo strtolower($row['IMSS']) === 'pagado' ? 'pagado' : 'no-pagado'; ?>">
                            <?php echo htmlspecialchars($row['IMSS']); ?>
                        </td>
                        <td class="<?php echo strtolower($row['Opinion_IMSS']) === 'positiva' ? 'positiva' : 'negativa'; ?>">
                            <?php echo htmlspecialchars($row['Opinion_IMSS']); ?>
                        </td>
                        <td class="<?php echo strtolower($row['INFONAVIT']) === 'pagado' ? 'pagado' : 'no-pagado'; ?>">
                            <?php echo htmlspecialchars($row['INFONAVIT']); ?>
                        </td>
                        <td class="<?php echo strtolower($row['Opinion_Infonavit']) === 'positiva' ? 'positiva' : 'negativa'; ?>">
                            <?php echo htmlspecialchars($row['Opinion_Infonavit']); ?>
                        </td>
                        <td><?php echo htmlspecialchars($row['REPSE']); ?></td>
                        <td class="acciones">
                            <a href="editar.php?id=<?php echo $row['evaluacion_id']; ?>" class="ui mini blue basic button">Editar</a>
                            <a href="borrar.php?id=<?php echo $row['evaluacion_id']; ?>" class="ui mini blue basic button" onclick="return confirm('¿Estás seguro de que deseas eliminar este registro?');">Borrar</a>
                            <a href="detalle.php?id=<?php echo $row['evaluacion_id']; ?>" class="ui mini blue basic button">Detalle</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else : ?>
                <tr>
                    <td colspan="13" class="ui center aligned">No hay registros disponibles</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Paginación -->
    <div class="ui pagination menu">
        <?php if ($totalPages > 1): ?>
            <?php if ($page > 1): ?>
                <a href="?page=<?php echo $page - 1; ?>" class="item">Anterior</a>
            <?php endif; ?>
    
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?php echo $i; ?>" class="item <?php echo ($i == $page) ? 'active' : ''; ?>"><?php echo $i; ?></a>
            <?php endfor; ?>
    
            <?php if ($page < $totalPages): ?>
                <a href="?page=<?php echo $page + 1; ?>" class="item">Siguiente</a>
            <?php endif; ?>
        <?php endif; ?>
    </div>

</div>

</body>
</html>

<?php
// Cerrar la conexión
$conn->close();
?>
