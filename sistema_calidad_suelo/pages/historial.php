<?php
include '../includes/auth.php';
include '../includes/db.php';

$stmt = $conn->prepare("SELECT * FROM suelo_analisis WHERE usuario_id = :usuario_id");
$stmt->execute(['usuario_id' => $_SESSION['usuario_id']]);
$analisis = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Historial de Análisis</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styles.css">

<body>
    <div class="container">
        <h1 class="mt-4 mb-3">Historial de Análisis</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Cultivo</th>
                    <th>Nitrógeno</th>
                    <th>Fósforo</th>
                    <th>Potasio</th>
                    <th>pH</th>
                    <th>Materia Orgánica</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($analisis as $analisis): ?>
                    <tr>
                        <td><?= $analisis['cultivo'] ?></td>
                        <td><?= $analisis['nitrogeno'] ?></td>
                        <td><?= $analisis['fosforo'] ?></td>
                        <td><?= $analisis['potasio'] ?></td>
                        <td><?= $analisis['ph'] ?></td>
                        <td><?= $analisis['materia_organica'] ?></td>
                        <td><?= $analisis['fecha_analisis'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="dashboard.php" class="btn btn-secondary">Volver al Dashboard</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>