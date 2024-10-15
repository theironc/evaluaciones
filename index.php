<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Agregar el CSS de Semantic UI -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.css">
    <style>
        .login-form {
            max-width: 400px;
            min-width: 300px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="ui container" style="margin-top: 50px;">
        <div class="login-form">
            <h2 class="ui header center aligned">Iniciar sesión</h2>
            <form class="ui form" method="POST" action="login.php">
                <div class="field">
                    <label for="username">Usuario:</label>
                    <div class="ui left icon input">
                        <input type="text" name="username" id="username" placeholder="Usuario" required>
                        <i class="user icon"></i>
                    </div>
                </div>
                <div class="field">
                    <label for="password">Contraseña:</label>
                    <div class="ui left icon input">
                        <input type="password" name="password" id="password" placeholder="Contraseña" required>
                        <i class="lock icon"></i>
                    </div>
                </div>
                <button class="ui primary fluid button" type="submit" name="submit">Iniciar sesión</button>
            </form>
            
            <?php
            // Mensaje de error (si existe)
            if (isset($_GET['error'])) {
                echo "<div class='ui negative message'><p>".htmlspecialchars($_GET['error'])."</p></div>";
            }
            ?>
        </div>
    </div>

    <!-- Agregar el JavaScript de Semantic UI -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.js"></script>
</body>
</html>