<?php
session_start();

$hardCodedUsername = 'Jorge';
$hardCodedPassword = 'afccontadores24'; // Cambia esto por la contraseña que desees

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? 'Jorge';
    $password = $_POST['password'] ?? 'afccontadores24';

    if ($username === $hardCodedUsername && $password === $hardCodedPassword) {
        $_SESSION['user_id'] = 1; // Puedes usar cualquier ID que desees
        header("Location: dashboard.php");
        exit;
    }
    echo "Usuario o contraseña incorrectos.";
}
?>