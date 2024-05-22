<?php
require_once('../php-servicios/Conexion_db/conexion_usser_select.php');
session_start();

    $cats = mysqli_query($Conexion_usser_select, "SELECT DISTINCT Nombre_Cat FROM categoria");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/Styles-Add-Prod.css">
    <link rel="stylesheet" href="../Componentes/header.css">
    <link rel="stylesheet" href="../Componentes/footer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cabin&family=Cabin+Sketch&family=Hammersmith+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cabin&family=Cabin+Sketch&family=Hammersmith+One&family=Hind:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Ventex</title>
</head>

<body>

<header>

<?php
require_once('../php-servicios/Conexion_db/conexion_usser_select.php');
$cats = mysqli_query($Conexion_usser_select, "SELECT DISTINCT Nombre_Cat FROM categoria;");
?>
<section>
    <p class="logo">Ventex</p>
</section>
<nav>
    <ul class="menu">
        <li><a href="pantalla-Inicio.php" class="headerOption">Inicio</a></li>
        <li><a href="#" id="categorias" class="headerOption">Categorías</a>
            <div class="invisible"></div>
            <ul class="menuv">
                <?php while ($cat = mysqli_fetch_array($cats)) { ?>
                    <li class="ca">
                        <a href="Pantalla-Subcategoria?categoria=<?php echo $cat['Nombre_Cat']; ?>" name="" class="linkCategoriesOption">
                            <div class="categorieSection">
                                <p class="categorieOption"><?php echo $cat['Nombre_Cat']; ?></p>
                            </div>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </li>
        <li><a href="" class="headerOption planHeaderButton">Planes</a></li>
        <li><a href="" class="headerOption">Vender</a></li>
    </ul>
</nav>
<section class="busqueda">
    <form class="busquedaForm" action="../Frames/Pantalla-Busqueda.php" method="post" onsubmit="return enviarFormulario()">
        <input type="search" placeholder="Buscar" name="busqueda" class="inputSearchHeader" require>
        <button class="searchButtonHeader">
            <img src="../Icons/lupaB.png" alt="" class="imageSearchHeader">
        </button>
    </form>
</section>
<section class="imgProfile">
    <div></div>
</section>

<!--- MODAL VENDER ----------------------------------------------------------------------------------->

<article class="sellModalContainer hidden">
<section class="sellModalInformationContainer ">
    <h1 class="titleModal">Ventex</h1>
    <p class="infoModal">asasc sdsdsd sdsdsd sdsd sdsdssd ssd sdss</p>
</section>
<section class="sellModalPlansContainer ">
    <button class="closePlansButto">x</button>
    <div class="titlePlansSellerModalContainer">
    <h1 class="titlePlansSellerModal">Planes</h1>
    </div>
    <section class="planSellerModalContainer ">

    <div class="planContainer normal">
        <div class="planNameContainer">
            <p class="planName">Basico </p>
            <p class="subTextPlanName">(Plan Mejorado)</p>
        </div>
        <p class="pricePlan"><span class="price">GRATIS</span></p>
        <div class="benefitsPlan">
            <ul class="planBenefitsList">
            <li>publicación de productos</li>
            <li>perfil basico con filtrado de productos</li>
            </ul>
        </div>
        <button class="planButton basicButton">Continuar con plan gratuito</button>
    </div>

    <div class="crownContiner">
        <img src="../Icons/corona-premium.png" alt="" class="crownPremium">
        <div class="planContainer premium">
        <form action="" method="post" class="formPremiumPlan">
            <div class="planNameContainer">
            <p class="planName premiumName">Premium </p>
            <p class="subTextPlanName">(Plan Mejorado)</p>
            </div>
            <p class="pricePlan">$ <span class="price">20.00</span></p>
            <div class="benefitsPlan">
            <ul class="planBenefitsList">
                <li>publicación de productos</li>
                <li>perfil basico con filtrado de productos</li>
                <li>Catalogos personalizados.</li>
                <li>Registro de Pedidos</li>
                <li>Registro de ventas</li>
            </ul>
            </div>
            <button class="planButton premiumButton">
            Obtener plan Premium
            <img src="../Icons/cocodrilo-premium.png" alt="" class="cocoPremium">
            </button>
        </form>
        </div>
    </div>
    </section>
</section>
</article>
<div class="overlaySellModal hidden"></div>
<script src="../Scripts/Script-plansModal.js"></script>
<!---------------------------------------------------------------------------------------------------->

</header>

    <!-- Contenido principal -->
    <main>
        <section class="decor">
            <div class="circle1"></div>
            <div class="circle2"></div>
            <div class="circle3"></div>
        </section>
        <!-- Columna lateral 2 -->
        
        <section class="form">
            <h1 class="form-title">Agregar Nuevo Producto</h1>
            <!-- Formulario para agregar nuevo producto -->
            <form action="..\php-servicios\save_data\save-regristrer-new-product.php" id="form_product" method="post" enctype="multipart/form-data">    
            <!-- Campo de entrada para el nombre del producto -->
                <div class="input-container">
                    <!-- Etiqueta para describir el campo -->
                    <label for="product_name">Nombre del producto</label>
                    <input type="text" name="product_name" class="inp" placeholder=" " required>
                </div>
                <div class="input-container">
                    <!-- Etiqueta para describir el campo -->
                    <label for="product_price">Precio</label>
                    <input type="number" name="product_price" class="inp" placeholder=" " min="0" required>
                </div>
                <!-- Campo de entrada para la descripción del producto -->
                <div class="input-container">
                    <!-- Etiqueta para describir el campo -->
                    <label for="product_description">Descripción</label>
                    <input type="text" name="product_description" class="inp" placeholder=" " required>
                </div>
                <!-- Contenedor para los selectores de categoría y subcategoría -->
                <div class="input-container">
                    <!-- Selector de categoría -->
                    <select name="product_category" id="product_category" class="select-container" require>
                        <option value="">Categoría</option>
                        <?php
                        // Consulta SQL para obtener todas las categorías
                        $sql_categorias = "SELECT DISTINCT Nombre_Cat FROM categoria";
                        $result_categorias = mysqli_query($Conexion_usser_select, $sql_categorias);

                        // Verificar si se obtuvieron resultados
                        if ($result_categorias && mysqli_num_rows($result_categorias) > 0) {
                            // Recorrer los resultados y mostrar cada categoría como una opción en el selector
                            while ($row = mysqli_fetch_assoc($result_categorias)) {
                                echo '<option value="' . $row['Nombre_Cat'] . '">' . $row['Nombre_Cat'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                    </div>
                    <div class="input-container">
                    <!-- Selector de subcategoría -->
                    <select name="product_subcategory" id="product_subcategory" class="select-container" require>
                        <option value="">Subcategoría</option>
                    </select>
                    </div>
                
                    <!-- Sección para subir una foto del producto -->
                    <div id="up-photo">
                        <label for="product_image" class="custom-file-input">Añadir Imagen</label>
                        <input type="file" name="product_image" id="archivo" accept="image/*" onchange="previewImage(event, '#imgPreview')">
                    </div>
                     <!-- script para mostrar imagen en contenedor -->
                        <script>
                        function previewImage(event, querySelector){
                        const input = event.target;
                        $imgPreview = document.querySelector(querySelector);

                        if(!input.files.length) return

                        file = input.files[0];

                        objectURL = URL.createObjectURL(file);

                        $imgPreview.src = objectURL;
                        }
                    </script>
                    <!-- Botón para enviar el formulario -->
                    <div id="button-div">
                        <button type="submit" class="submit" id="button-sumit">Publicar Producto</button>
                    </div>
                    
            </form>
        </section>
    <script>
        $(document).ready(function() {
            // Manejar el cambio en el primer selector de categoría
            $('#product_category').change(function() {
                // Realizar una solicitud AJAX para obtener las subcategorías de la categoría seleccionada
                $.ajax({
                    url: '../php-servicios/load_data/load-subcategoria-pantallas-Edit-Add-Producto.php',
                    type: 'POST',
                    dataType: 'json',
                    data: $('#form_product').serialize(), // Serializar los datos del formulario
                    success: function(response) {
                        // Limpiar el selector de subcategorías
                        $('#product_subcategory').empty();
                        console.log('#product_subcategory')
                        // Agregar una opción por defecto
                        $('#product_subcategory').append($('<option>', {
                            value: '',
                            text: 'Subcategoría'
                        }));

                        // Agregar las subcategorías obtenidas al selector
                        $.each(response, function(index, subcategoria) {
                            $('#product_subcategory').append($('<option>', {
                                value: subcategoria,
                                text: subcategoria
                            }));
                        });
                    }
                });
            });
        });
    </script>
    <section class="cont-img">
        <img src="" id="imgPreview">
    </section>
    </main>

    <!-- Pie de página -->
    <footer>
        <section class="con">
            <section class="name-year">
                <h1>2023-Ventex</h1>
            </section>
            <section class="logo-ventex">
                <h1>Ventex</h1>
            </section>
            <section class="socialmedia-ventex">
                <a href=""><i class="fa-brands fa-facebook"></i></a>
                <a href=""><i class="fa-brands fa-square-x-twitter"></i></a>
                <a href=""><i class="fa-brands fa-tiktok"></i></a>
            </section>
        </section>
        <section class="aviso">
            <span>Ventex no pide a través de SMS o de las redes sociales datos bancarios, tarjetas de crédito, clave NIP,
                contraseñas o datos sensibles de cualquier tipo. 
                <br>Si necesitas aclarar cualquier duda, puedes contactar con el Call Center en 800 225 5748.
            </span>
        </section>
    </footer>
</body>

</html>