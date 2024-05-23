<?php
session_start();
require('../Conexion_db/conexion_usser_select.php');

$columas = ['ID_Producto', 'Id_usser_regristro', 'Nombre_Prod', 'Descripcion', 'Precio', 'Categoria', 'Subcategoria', 'Imagen'];
$columa2=['Nombre_Prod'];
$table = "productos";
$idUser = $_SESSION['id'];
$campo = isset($_POST['searchP']) ? $Conexion_usser_select->real_escape_string($_POST['searchP']) : null;
$where = '';

if ($campo != null) {
    $where = "AND (";
    $cont = count($columa2);
    for ($i = 0; $i < $cont; $i++) {
        $where .= $columa2[$i] . " LIKE '%" . $campo . "%' OR ";
    }
    $where = substr_replace($where, "", -3);
    $where .= ")";
}

$consult = "SELECT " . implode(",", $columas) . " FROM $table WHERE Id_usser_regristro = $idUser $where";
$Conexion_usser_select->set_charset("utf8");
header('Content-Type: text/html; charset=utf-8');
$result = $Conexion_usser_select->query($consult);

if ($result === false) {
    die("Error in query: " . $Conexion_usser_select->error);
}

$num_rows = $result->num_rows;

if ($num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>
        <section class="productContainer" >
            <div class="productPhoto">
                <img src="../Product-Images/<?php echo $row['Imagen']; ?>" class="productImage" />
            </div>
            <div class="productPrice">
                <p class="priceStyle">$<?php echo $row['Precio']; ?></p>
            </div>
            <div class="productName">
                <p class="nameStyle"><?php echo $row['Nombre_Prod']; ?></p>
            </div>
            <div class="pointsButton">
                <img src="../Icons/3pointsV.png" alt="" class="pointsIcon">
            </div>
            <div></div>
            <ul class="optionsPoints hidden">
                <li>
                    <form action="../Frames/Pantalla-Edit-info-producto.php" method="post">
                        <input type="hidden" name="id_product" value="<?php echo $row['ID_Producto']; ?>">
                        <button type="submit" class="optionButton">Editar</button>
                    </form>
                </li>
                <li>
                    <form action="../Frames/pantalla-producto.php" method="post">
                        <input type="hidden" name="id_product" value="<?php echo $row['ID_Producto']; ?>">
                        <button type="submit" class="optionButton">Ver producto</button>
                    </form>
                </li>
                <li>
                    <form action="../php-servicios/deletion_data/deletion_products.php" method="post">
                        <input type="hidden" name="id_product" value="<?php echo $row['ID_Producto']; ?>">
                        <button type="submit" class="optionButton">Eliminar</button>
                    </form>
                </li>
            </ul>
        </section>
<?php
    }
} else {
    echo '<h1 id="Noresult">Sin resultados</h1>';
}
?>
