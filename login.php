<?php
session_start();

$hardCodedUsername = '';
$hardCodedPassword = ''; // Cambia esto por la contraseña que desees

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === $hardCodedUsername && $password === $hardCodedPassword) {
        $_SESSION['user_id'] = 1; // Puedes usar cualquier ID que desees
        header("Location: dashboard.php");
        exit;
    }
    echo "Usuario o contraseña incorrectos.";
}
?>
