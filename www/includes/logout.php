<?php
session_start();

// Finalizar la sesión
session_unset();
session_destroy();

// Redirigir al usuario a la página de inicio de sesión
header('Location: ./../login.php');
exit;
?>
