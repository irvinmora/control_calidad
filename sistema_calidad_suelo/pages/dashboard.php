<?php
include '../includes/auth.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <div class="container">
        <h1 class="mt-4 mb-3">Bienvenido al Panel de Control De Suelo</h1>
        <div class="list-group">
            <a href="calcular.php" class="list-group-item list-group-item-action">Calcular Propiedades del Suelo</a>
            <a href="historial.php" class="list-group-item list-group-item-action">Historial de Análisis</a>
            <a href="logout.php" class="list-group-item list-group-item-action">Cerrar Sesión</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>