<?php
session_start(); // Asegúrate de iniciar la sesión

if (!isset($_SESSION['usuario_id'])) {
    header('Location: /sistema_calidad_suelo/pages/login.php'); // Redirigir al login si no está autenticado
    exit();
}
