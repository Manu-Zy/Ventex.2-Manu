<?php
session_start();
require_once('../Conexion_db/conexion_usser_changes.php');

// Validar la existencia de los datos en el formulario
if (!isset($_POST['nombre'], $_POST['correo'], $_POST['fecha'], $_POST['telefono'])) {
    // Redireccionar en caso de datos faltantes
    //header('Location: ../../Frames/Pantalla-Edit-Info-Personal.php');
    exit();
}
$archivo = null;

// Verificar si se ha enviado un archivo
if (isset($_FILES["Imagen"]) && $_FILES["Imagen"]["size"] > 0) {
    $archivo = basename($_FILES["Imagen"]["name"]);
    $targetDirectory = "../../Imgens-Pefil/";  // Ruta relativa al directorio del script
    $targetFile = $targetDirectory . $archivo;

    $esImagen = getimagesize($_FILES["Imagen"]["tmp_name"]);
    if ($esImagen !== false) {
        if (move_uploaded_file($_FILES["Imagen"]["tmp_name"], $targetFile)) {
            echo "El archivo $archivo ha sido subido correctamente.";
        } else {
            echo "Hubo un error al subir el archivo.";
        }
    } else {
        echo "El archivo no es una imagen válida.";
    }
} else {
    // Si no se ha subido un archivo, utiliza el valor anterior
    $archivo = mysqli_real_escape_string($Conexion_usser_changes, $_POST['imagenanterior']);
}

// Recoger los datos del formulario
$idup = $_SESSION['id'];
$Nom = mysqli_real_escape_string($Conexion_usser_changes,$_POST['nombre']);
$correo = mysqli_real_escape_string($Conexion_usser_changes,$_POST['correo']);
$fecha = mysqli_real_escape_string($Conexion_usser_changes,$_POST['fecha']);
$telefono = mysqli_real_escape_string($Conexion_usser_changes,$_POST['telefono']);
echo$archivo;

// Hacer la sentencia de actualización (UPDATE) con sentencia preparada
$sql = "UPDATE usuarioregistrado SET Nombre_Us=?, Correo=?, Fecha_Nac=?, telefono=?, Imagen=? WHERE ID_Usuario = $idup";
$stmt = mysqli_prepare($Conexion_usser_changes, $sql);

// Vincular parámetros
mysqli_stmt_bind_param($stmt, "sssis", $Nom, $correo, $fecha, $telefono, $archivo);

// Ejecutar la sentencia de actualización
$envio = mysqli_stmt_execute($stmt);

// Verificar si hubo errores en la consulta
if (!$envio) {
    // Mostrar un mensaje de error y detalles de MySQL
    echo '<SCRIPT> alert("Tu registro no se pudo actualizar")</SCRIPT>';
    echo 'Error de MySQL: ' . mysqli_error($Conexion_usser_changes);
} else {
    // Redireccionar si todo está bien y cambiar nombre
    
    // Hacer la segunda sentencia de actualización (UPDATE) con sentencia preparada
    $sql2 = "UPDATE seller_porfile SET Name_Seller = ? WHERE Id_sellerP = $idup";
    
    
    // Verificar la conexión antes de preparar la segunda sentencia
    if ($Conexion_usser_changes) {
        $stmt2 = mysqli_prepare($Conexion_usser_changes, $sql2);

        // Verificar la preparación de la segunda sentencia
        if ($stmt2) {
            mysqli_stmt_bind_param($stmt2, "s", $Nom);
            $envio2 = mysqli_stmt_execute($stmt2);

            // Verificar si hubo errores en la consulta
            if (!$envio2) {
                // Mostrar un mensaje de error y detalles de MySQL
                echo '<SCRIPT> alert("Error al actualizar el perfil del vendedor")</SCRIPT>';
                echo 'Error de MySQL: ' . mysqli_error($Conexion_usser_changes);
            } else {
                header('Location: ../../Frames/pantalla-Login.html');
            }
        } else {
            // Mostrar un mensaje de error si la preparación falla
            echo 'Error al preparar la segunda sentencia SQL';
        }
    } else {
        // Mostrar un mensaje de error si la conexión no está establecida
        echo 'Error en la conexión a la base de datos';
        die;
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($Conexion_usser_changes);
}