<?php
require_once('../php-servicios/Conexion_db/conexion_usser_select.php');
$mywher = isset($_GET['id']) ? $_GET['id'] : null;
$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : null;
$subc = mysqli_query($Conexion_usser_select, "SELECT DISTINCT Categoria FROM productos WHERE Id_usser_regristro='$mywher';");
$busque_diseno_usser = mysqli_query($Conexion_usser_select, "SELECT stylePage, Product_View_Style, Product_Box_Color, Header_Color, Category_Color FROM catalogo_seller WHERE Id_vendedor='$mywher';");
$diseñador = mysqli_fetch_array($busque_diseno_usser);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventex</title>
    <link rel="stylesheet" href="./Styles-Product-Box/product-box-1.css" id="style-product-box">
    <link rel="stylesheet" href="./Styles-Frames/Styles-catalogo-1.css" id="style-catalog">
    <link rel="stylesheet" href="./Queries-responsive/queries-catalogo-1.css" id="style-catalog">
    <!-- <script src="catalog-styles-election.js"></script>-->
</head> 
<style>

</style>
<body>
    <header>
        <nav>
            <article class="headerContainer" style="background-color: <?php echo $diseñador['Header_Color']; ?>;">
                <div class="logoContainer"></div>
                <input type="search" placeholder="Buscar" class="search" name="searchP" id="searchP" onkeyup="getData()">
            </article>
            <article class="categoriesContainer">
                <form action="../Catalog/catalogo.php" method="get">
                    <input type="hidden" name="id" value="<?php echo $mywher; ?>">
                    <button class="categoryButton" type="submit" style="background-color: <?php echo $diseñador['Category_Color']; ?>;">All</button>
                </form>

                <?php
                while ($categorias_button = mysqli_fetch_array($subc)) {
                ?>
                    <form action="../Catalog/catalogo.php" method="get">
                        <input type="hidden" name="id" value="<?php echo $mywher; ?>">
                        <input type="hidden" name="categoria" value="<?php echo $categorias_button['Categoria']; ?>">
                        <button class="categoryButton" type="submit" style="background-color: <?php echo $diseñador['Category_Color']; ?>;"><?php echo $categorias_button['Categoria']; ?></button>
                    </form>
                <?php
                }
                ?>
            </article>
        </nav>
    </header>

    <main id="sectionProductsContainer">
    </main>
    <footer></footer>

    <form action="">
        <input type="hidden" name="id_usser" value="<?php echo $mywher ?>" id="id_usser">
        <input type="hidden" name="categoria" value="<?php echo $categoria ?>" id="categoria">
    </form>
    <script>
        let stylePage = "<?php echo $diseñador['stylePage']; ?>";
        let productBoxStyle = "<?php echo $diseñador['Product_View_Style']; ?>";

        const Page = document.getElementById('style-catalog');
        const productBox = document.getElementById('style-product-box');

        Page.href = `./Styles-Frames/Styles-catalogo-${stylePage}.css`;
        productBox.href = `./Styles-Product-Box/product-box-${productBoxStyle}.css`;

        console.log(`width: ${screen.width} height: ${screen.height}`);
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", getData);

        function getData() {
            let id_usser = document.getElementById("id_usser").value;
            let categoria = document.getElementById("categoria").value;
            let searchP = document.getElementById("searchP").value;

            let content = document.getElementById("sectionProductsContainer");
            let url = "../php-servicios/load_data/load-info-pantalla-catalogos.php";
            let formData = new FormData();
            formData.append('id_usser', id_usser);
            formData.append('categoria', categoria);
            formData.append('searchP', searchP);

            fetch(url, {
                method: "POST",
                body: formData
            }).then(response => response.text())
            .then(data => {
                console.log(data);
                content.innerHTML = data;
            }).catch(err => console.log(err));
        }
        
    </script>
</body>
</html>
