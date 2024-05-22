<?php
// Credenciales de acceso a la base de datos
$hostname = '127.0.0.1'; //Url de la direccion dela base de datos 
$username = 'root'; 
//$username = 'Usser_Deletion'; //Usuario que se uso para esta conexion y la verifcacion 
//$password = '(p`u})=8h4/C?-@6d+3}>LUaEnd'; //Password del usuario 
$password = ''; //Password del usuario 
$database = 'ventexafe'; //nombre de la db

// Conexión a la base de datos
$Conexion_usser_delete = mysqli_connect($hostname, $username, $password, $database);

// Verificar la conexión
if (mysqli_connect_error()) {
    exit('Fallo en la conexión de MySQL: ' . mysqli_connect_error());
}else{
    echo'Conexion is look well :D 3';
}
?>