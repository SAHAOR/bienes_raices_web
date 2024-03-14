<?php

//importar conexion
require 'includes/app.php';
$db=conectarDB();
//crear email y password
$email = "correo@correo.com";
$password= "123456";

$passwordHash = password_hash($password, PASSWORD_DEFAULT);
//query para crear usuario
$query = "INSERT INTO usuarios (email, password) VALUES ('$email', '$passwordHash');";
echo $query;

//agregarlo a base de datos
mysqli_query($db, $query);