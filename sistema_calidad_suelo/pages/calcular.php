<?php
include '../includes/auth.php';
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cultivo = $_POST['cultivo'];
    $nitrogeno = $_POST['nitrogeno'];
    $fosforo = $_POST['fosforo'];
    $potasio = $_POST['potasio'];
    $ph = $_POST['ph'];
    $materia_organica = $_POST['materia_organica'];

    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO suelo_analisis (usuario_id, cultivo, nitrogeno, fosforo, potasio, ph, materia_organica) VALUES (:usuario_id, :cultivo, :nitrogeno, :fosforo, :potasio, :ph, :materia_organica)");
    $stmt->execute([
        'usuario_id' => $_SESSION['usuario_id'],
        'cultivo' => $cultivo,
        'nitrogeno' => $nitrogeno,
        'fosforo' => $fosforo,
        'potasio' => $potasio,
        'ph' => $ph,
        'materia_organica' => $materia_organica
    ]);

    // Determine if the soil is apt for the selected crop
    $apto = false;
    $recomendaciones = "";

    if ($cultivo == 'arroz') {
        if ($nitrogeno > 20 && $fosforo > 10 && $potasio > 15 && $ph >= 5.5 && $ph <= 6.5 && $materia_organica > 2) {
            $apto = true;
        } else {
            $recomendaciones .= "\n- Asegurar que el nitrógeno esté por encima de 20 ppm.";
            $recomendaciones .= "\n- Mantener el pH entre 5.5 y 6.5 con correctores como cal agrícola.";
            $recomendaciones .= "\n- Agregar materia orgánica como compost si está por debajo de 2%.";
        }
    } elseif ($cultivo == 'maiz') {
        if ($nitrogeno > 25 && $fosforo > 15 && $potasio > 20 && $ph >= 6.0 && $ph <= 7.0 && $materia_organica > 2.5) {
            $apto = true;
        } else {
            $recomendaciones .= "\n- Incrementar el fósforo si está por debajo de 15 ppm con fertilizantes como superfosfato.";
            $recomendaciones .= "\n- Ajustar el pH entre 6.0 y 7.0 con cal dolomítica si es necesario.";
            $recomendaciones .= "\n- Aplicar fertilizantes ricos en potasio si el nivel está por debajo de 20 ppm.";
        }
    } elseif ($cultivo == 'soya') {
        if ($nitrogeno > 30 && $fosforo > 20 && $potasio > 25 && $ph >= 6.5 && $ph <= 7.5 && $materia_organica > 3) {
            $apto = true;
        } else {
            $recomendaciones .= "\n- Mejorar el contenido de materia orgánica con abonos verdes y estiércol.";
            $recomendaciones .= "\n- Asegurar que el nitrógeno esté por encima de 30 ppm mediante rotación de cultivos.";
            $recomendaciones .= "\n- Usar fertilizantes fosfatados si el fósforo está por debajo de 20 ppm.";
        }
    }

    // Display result based on soil condition
    if ($apto) {
        echo "<div class='alert alert-success'>El suelo es apto para sembrar $cultivo.</div>";
    } else {
        echo "<div class='alert alert-danger'>El suelo no es apto para sembrar $cultivo. Recomendamos revisar los niveles de nutrientes y pH.</div>";
        echo "<div class='alert alert-warning'><strong>Consejos:</strong>" . nl2br($recomendaciones) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Calcular Propiedades del Suelo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <div class="container">
        <h1 class="mt-4 mb-3">Calcular Propiedades del Suelo</h1>
        <form method="POST" class="row g-3">
            <div class="col-md-4">
                <select name="cultivo" class="form-select" required>
                    <option value="arroz">Arroz</option>
                    <option value="maiz">Maíz</option>
                    <option value="soya">Soya</option>
                </select>
            </div>
            <div class="col-md-4">
                <input type="number" name="nitrogeno" class="form-control" placeholder="Nitrógeno (ppm)" required>
            </div>
            <div class="col-md-4">
                <input type="number" name="fosforo" class="form-control" placeholder="Fósforo (ppm)" required>
            </div>
            <div class="col-md-4">
                <input type="number" name="potasio" class="form-control" placeholder="Potasio (ppm)" required>
            </div>
            <div class="col-md-4">
                <input type="number" name="ph" class="form-control" placeholder="pH" step="0.1" required>
            </div>
            <div class="col-md-4">
                <input type="number" name="materia_organica" class="form-control" placeholder="Materia Orgánica (%)" step="0.1" required>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary w-100">Calcular</button>
            </div>
        </form>
        <a href="dashboard.php" class="btn btn-secondary mt-3">Regresar</a>
    </div>
</body>

</html>