<?php
//variables para la conexión a la base de datos
$servername = "db";
$username = "root";
$password = "Proj#2023";
$db = "fruteria";

//Conexión a la base de datos
$connect = mysqli_connect($servername, $username, $password, $db);

//Verificar la conexión
if ($connect->connect_error) {
  die("Error al conectar la base de datos: " . $connect->connect_error);
}
?>