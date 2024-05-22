<?php
// Credenciales de acceso a la base de datos
$hostname = '127.0.0.1'; //Url de la direccion dela base de datos 
//$username = 'Usser_consult';
$username = 'root'; //Usuario que se uso para esta conexion y la verifcacion 
//$password = 'Dw0&Q=]o95F]Wlj5y/TMvt:=UX'; //Password del usuario 
$password = ''; //Password del usuario 
$database = 'ventexafe'; //nombre de la db

// Conexión a la base de datos
$Conexion_usser_select = mysqli_connect($hostname, $username, $password, $database);

// Verificar la conexión
 if (mysqli_connect_error()) {
     exit('Fallo en la conexión de MySQL: ' . mysqli_connect_error());
 }else{
   // echo'Conexion is look well 😄 4';
}

?>