<?php
session_start();
session_destroy(); // Destruir la sesión
header('Location: /sistema_calidad_suelo/pages/login.php'); // Redirigir al login
exit();
