<?php
// Incluir el archivo de conexión
require_once('../php-servicios/Conexion_db/conexion_usser_select.php');

// Comprobar si la sesión está iniciada
session_start();
if (!isset($_SESSION['id'])) {
//     // Si no hay sesión iniciada, redireccionar o manejar el caso según tus necesidades
//     // Por ejemplo, redireccionar a una página de inicio de sesión
    header('Location:..\Frames\pantalla-Login.html');
    exit(); // Asegúrate de detener el script después de la redirección
}



// Obtener el ID de usuario de la sesión
if (!isset($_POST['id_product'])) {
    $id_product = 5;
} else {
    $id_product = $_POST['id_product'];
}
// Código para almacenar productos visitados en cookies
if (isset($_POST['id_product'])) {
    $id_producto = $_POST['id_product'];
    // Obtener productos visitados almacenados en la cookie, si los hay
    $productos_visitados = isset($_COOKIE['productos_visitados']) ? json_decode($_COOKIE['productos_visitados'], true) : [];
    // Agregar el nuevo producto visitado a la lista
    $productos_visitados[] = $id_producto;
    // Convertir la lista de productos visitados a formato JSON y guardarla en la cookie
    setcookie('productos_visitados', json_encode($productos_visitados), time() + (86400 * 30), "/"); // 86400 = 1 día
}


//extraido desde el perfil con el boton del editar producto

// Preparar la consulta para obtener los datos del usuario
$sql = "SELECT Nombre_Prod, Descripcion, Precio, Categoria, Subcategoria, Id_usser_regristro,Imagen FROM productos WHERE ID_Producto = ?";
// Verificar si la preparación de la consulta tuvo éxito

$stmt = mysqli_prepare($Conexion_usser_select, $sql);
if (!$stmt) {
    exit('Error en la preparación de la consulta: ' . mysqli_error($Conexion_usser_select));
}
// Vincular parámetro(s) a la consulta preparada
mysqli_stmt_bind_param($stmt, "i", $id_product);

// Ejecutar la consulta preparada
mysqli_stmt_execute($stmt);

// Vincular variables a los resultados de la consulta
mysqli_stmt_bind_result($stmt, $Nombre_Prod, $Descripcion, $Precio, $Categoria, $Subcategoria, $id_Seller, $Imagen);

// Obtener los resultados
mysqli_stmt_fetch($stmt);

// Cerrar la consulta preparada
mysqli_stmt_close($stmt);


$sql2 = "SELECT Contact_description,profile_Description,instagram,x,whatsapp FROM seller_porfile WHERE Id_sellerP = ?";
// Verificar si la preparación de la consulta tuvo éxito


$stmt2 = mysqli_prepare($Conexion_usser_select, $sql2);
if (!$stmt2) {
    exit('Error en la preparación de la consulta: ' . mysqli_error($Conexion_usser_select));
}
// Vincular parámetro(s) a la consulta preparada
mysqli_stmt_bind_param($stmt2, "i", $id_Seller);

// Ejecutar la consulta preparada
mysqli_stmt_execute($stmt2);

// Vincular variables a los resultados de la consulta
mysqli_stmt_bind_result($stmt2, $Descripcion_contact, $profile_Description, $instagram, $x, $whatsapp);

// Obtener los resultados
mysqli_stmt_fetch($stmt2);

// Cerrar la consulta preparada
mysqli_stmt_close($stmt2);
$more = mysqli_query($Conexion_usser_select, "SELECT * FROM productos WHERE Categoria = '$Categoria' ORDER BY RAND() LIMIT 15");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Producto</title>
    <link rel="stylesheet" href="../Styles/Styles-producto.css">
    <link rel="stylesheet" href="../Componentes/header.css">
    <link rel="stylesheet" href="../Componentes/footer.css">
    <link rel="stylesheet" href="../Componentes/cardProduct.css">
    <link rel="stylesheet" href="../Componentes/productBoxSmaller.css">
    <link rel="stylesheet" href="../Componentes/calculationModal.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                        <a href="Pantalla-Subcategoria.php?categoria=<?php echo $cat['Nombre_Cat']; ?>" name="" class="linkCategoriesOption">
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
    <p class="infoModal">Con Ventex, los emprendedores estudiantiles pueden gestionar y promocionar sus productos de manera eficiente. Compra un plan y desbloquea todo el potencial de tu negocio.</p>
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
    <main>

        <!-- Parte principal que muestra el producto------------------------------------->

        <section class="contenedor-Producto">
            <section id="img-Producto">
                <img src="../Product-Images/<?php echo $Imagen ?>">
            </section>
            <article id="description">
                <section class="desc">
                    <h1 class="name-Product"><?php echo $Nombre_Prod ?></h1>
                    <span class="category"><?php echo $Categoria ?></span>
                    <span id="price-product">$<?php echo $Precio ?></span>
                    <span id="desc-Contacto"><?php echo $Descripcion_contact ?></span>
                    <span id="text-desc"><?php echo $Descripcion ?> y mas información innecesaria solo para llenar el campo, y pues ajjaamamm, ya estoy muerto, me quiero ir a mimir</span>
                    <form action="../Frames/pantalla-perfil-vc.php" method="post" id="form-seller">
                        <input type="hidden" name="Id_seller" value="<?php echo $id_Seller; ?>">
                        <input type="submit" id="bot" value="Ver perfil del vendedor">
                    </form>
                    <button type="submit" id="bot" class="btn calc">Reportar Producto</button>
   
                </section>
            </article>
        </section>
        <!-- ------------------------------------------------------------------------------ -->

        <!-- Contedor de los productos relacionados --------------------------------------- -->

        <?php
        $productos = mysqli_query($Conexion_usser_select, "SELECT * FROM productos WHERE Categoria='$Categoria' AND Subcategoria='$Subcategoria'"); ?>
        <article class="productsContainer">
            <div class="subcategoryTitleContainer">
                <h2 class="subcategoryTitle">Productos Similares</h2>
            </div>
            <section class="subcategoryCarrusel">
                <section class="containerCarrusel">
                    <button class="carruselButton prev">
                        <</button>
                            <section class="carrusel">
                                <section class="productsCarrusel">
                                    <?php while ($producto = mysqli_fetch_array($productos)) { ?>
                                        <form action="../Frames/pantalla-producto.php" method="post">
                                            <input type="hidden" name="id_product" value="<?php echo $producto['ID_Producto']; ?>">
                                            <button class="productContainer" type="submit">
                                                <div class="productPhoto">
                                                    <img src="../Product-Images/<?php echo $producto['Imagen']; ?>" class="productImage" />
                                                </div>
                                                <div class="productPrice">
                                                    <p class="priceStyle">$<?php echo $producto['Precio']; ?></p>
                                                </div>
                                                <div class="productName">
                                                    <p class="nameStyle"><?php echo $producto['Nombre_Prod']; ?></p>
                                                </div>
                                            </button>
                                        </form>
                                    <?php } ?>
                                </section>
                            </section>
                            <button class="carruselButton next">></button>
                </section>
                <!-- ---------------------------------------------------------------------------- -->

                <!-- Contenedor Información de contacto -->
            </section>
        </article>
        <section class="cont-Contact">
            <div class="subcategoryTitleContainer">
                <h2 class="productDescriptionTitle">Información de contacto</h2>
            </div>
            
            <section class="part-Desc">
                <article id="descriptionD">
                    <p class="contactDescription">
                        <?php echo $profile_Description ?>
                        Holas como están papus, nomás vengo a poner info random para ver si es cierto o no que esta madre jala, así que no me pongan mucha atención, solo dusfruten mis amores
                    </p>
                </article>
            </section>
            <section class="part-Redes">
                <article id="contacto">
                    <article class="redes">
                        <a href="<?php echo $instagram ?>" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                        <a href="<?php echo $whatsapp ?>" target="blank"><i class="fa-brands fa-whatsapp"></i></a>
                        <a href="<?php echo $x ?>" target="blank"><i class="fa-brands fa-x-twitter"></i></a>
                    </article>
                </article>
            </section>
        </section>
        <!-- ---------------------------------------------------------------------------------- -->
        <!-- Contenedor de la valoración -->


        <section class="cont-Valoracion">
            <section class="writeCommentSection">
                <section class="part-Comentarios">
                    <div class="subcategoryTitleContainer">
                        <h2 class="productDescriptionTitle">Deja un Comentario</h2>
                    </div>
                    <form id="inputVal" method="post" action="../php-servicios/save_data/save_new_comentario.php">
                        <input type="hidden" name="fecha_Coment" value="<?php echo date('Y-m-d'); ?>">
                        <input type="hidden" name="hora_comentario" value="<?php echo date('H:i:s'); ?>">
                        <input type="hidden" name="id_prod" value="<?php echo $id_product; ?>">
                        <textarea placeholder="Escribe una reseña del producto" name="descripcion" id="text-Comen" required></textarea>
                        <!-- <input type="text" placeholder="Escribe una reseña del producto" name="descripcion" id="text-Comen"> -->
                        <article class="input-Comentar"><input class="submit-Com" type="submit" value="Comentar"></article>
                    </form>
                </section>
            </section>
            
            <section class="reviewSectionContainer">
                <section class="part-Reseñas">
                    <div class="subcategoryTitleContainer">
                        <h2 class="productDescriptionTitle">Reseñas</h2>
                    </div>
                    <section class="contRes" id="contRes">
    
                    </section>
                </section>
            </section>
        </section>
        <form action="" method="post">
            <input type="hidden" value="<?php echo $id_product ?>" name="id_product" id="id_product">
        </form>
        <script>
            document.addEventListener("DOMContentLoaded", getData);

            function getData() {
                let input = document.getElementById("id_product").value;
                let content = document.getElementById("contRes");
                let url = "../php-servicios/load_data/load-info-comentarios-Pantalla-seller.php";
                let formData = new FormData();
                formData.append('id_product', input);

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
    </main>
         <!-- repormodal Modal -------------------------------------------------------------------------------------------------->

        <div class="calculateModal hidden">
        <section class="part-Comentarios" style="width: 30vw;">
                <section class="textU">
                    <h1>Reportar producto</h1>
                </section>
                <form id="inputVal" method="post" action="../php-servicios/save_data/save-reporter-productos.php">
                    <input type="hidden" name="fecha_Comentr" value="<?php echo date('Y-m-d'); ?>">
                    <input type="hidden" name="hora_comentarior" value="<?php echo date('H:i:s'); ?>">
                    <input type="hidden" name="id_prodr" value="<?php echo $id_product; ?>">
                    <input type="text" placeholder="Escribe el motivo" name="descripcionr" id="text-Comen" class="text-alining" style="width: 40vw;">
                    <article class="input-Comentar"><input class="submit-Com" type="submit" value="Reportar"></article>
                </form>
            </section>
        </div>

        <div class="overlay hidden"></div>
        <div class="invisibleOverlay hidden"></div>
    <!-- ----------------------------------------------------------- -->
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
    <script src="../Scripts/Script-producto.js"></script>
   
</body>

</html>