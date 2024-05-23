<?php
session_start();
require_once('../Conexion_db/conexion_usser_changes.php');

// Obtener el ID del usuario de la sesión
$Id_usser_regristro = $_SESSION['id'];
$box_color = 'Campo vacio';
$header_color = mysqli_real_escape_string($Conexion_usser_changes, $_POST['headerColor']);
$Category_color = mysqli_real_escape_string($Conexion_usser_changes, $_POST['CategoryColor']);
$Produc_type = mysqli_real_escape_string($Conexion_usser_changes, $_POST['productBoxPreviewStyle']);
$Catalogo_style = mysqli_real_escape_string($Conexion_usser_changes, $_POST['catalogStyle']);

echo $Id_usser_regristro, $Catalogo_style,$Produc_type, $header_color, $Category_color, $box_color;

$sentence = "INSERT INTO catalogo_seller (Id_vendedor,stylePage, Product_View_Style, Header_Color, Category_Color, Product_Box_Color) 
            VALUES ('$Id_usser_regristro', '$Catalogo_style','$Produc_type', '$header_color', '$Category_color', '$box_color')";
$guardar = mysqli_query($Conexion_usser_changes, $sentence);

if (!$guardar) {
    echo "Error al guardar los datos en la base de datos: " . mysqli_error($Conexion_usser_changes);
} else {
    // Mostrar el formulario y enviarlo automáticamente
    echo '<form id="redirectForm" action="../../Frames/pantalla-producto.php" method="post">';
    echo '<input type="hidden" name="id_product" value="' . $Id_prod . '">';
    echo '</form>';
    echo '<script>document.getElementById("redirectForm").submit();</script>';
}

mysqli_close($Conexion_usser_changes);
?>
