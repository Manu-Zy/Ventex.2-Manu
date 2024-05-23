<?php
require_once('../php-servicios/Conexion_db/conexion_usser_select.php');

// Comprobar si la sesión está iniciada
session_start();
// $usuario = 1;
// $prod = mysqli_query($conexion, "SELECT * FROM products WHERE owner_id = $usuario");
//$Id_usser = $_POST['Id_seller'];
if (isset($_POST['Id_seller'])) {
    $Id_seller = $_POST['Id_seller'];
    // Aquí puedes utilizar el ID del vendedor como necesites
} else {
    // Manejar el caso en que no se envíe el ID del vendedor
    $Id_seller = 5;
}
$cats = mysqli_query($Conexion_usser_select, "SELECT DISTINCT Nombre_Cat FROM categoria;");
$sql = "SELECT Name_Seller,profile_Description, Contact_description, instagram, x, whatsapp, facebook FROM seller_porfile WHERE Id_sellerP = ?";
$stmt = mysqli_prepare($Conexion_usser_select, $sql);

// Vincular parámetro(s) a la consulta preparada
mysqli_stmt_bind_param($stmt, "i", $Id_seller);

// Ejecutar la consulta preparada
mysqli_stmt_execute($stmt);

// Vincular variables a los resultados de la consulta
mysqli_stmt_bind_result($stmt, $Name_Seller, $profile_Description, $Contact_description, $instagram, $x, $whatsapp, $facebook);

// Obtener los resultados
mysqli_stmt_fetch($stmt);

// Cerrar la consulta preparada
mysqli_stmt_close($stmt);

$sql2 = "SELECT Imagen FROM usuarioregistrado WHERE ID_Usuario = ?";
$stmt = mysqli_prepare($Conexion_usser_select, $sql2);

mysqli_stmt_bind_param($stmt, "i", $Id_seller);

// Ejecutar la consulta preparada
mysqli_stmt_execute($stmt);

// Vincular variables a los resultados de la consulta
mysqli_stmt_bind_result($stmt, $Imagen);

// Obtener los resultados
mysqli_stmt_fetch($stmt);

// Cerrar la consulta preparada
mysqli_stmt_close($stmt);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventex</title>
    <link rel="stylesheet" href="../Styles/Styles-perifil-vc.css">
    <link rel="stylesheet" href="../Componentes/header.css">
    <link rel="stylesheet" href="../Componentes/extensibleSearchInput.css">
    <link rel="stylesheet" href="../Componentes/productBox.css">
    <link rel="stylesheet" href="../Styles/Styles-Subcategoria.css">

    <style>
        /* <-------Styles extensible search input*/
        .searchSection {
            text-align: left;
        }

        .searchButton {
            /*<------Color Button*/
            background-color: #182722;
        }

        #searchP:valid~.searchButton {
            /* <------Color of the button when te input is valid*/
            background-color: rgb(66, 94, 66);
        }
    </style>
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
        <!--Left------------------------------------------------------------------------------------------->
        <article class="left">
            <section class="personalInfo">
                <button type="submit" id="bot" class="btn calc">Reportar Vendedor</button>
                <div class="photoContainer"><img src="../Imgens-Pefil/<?php echo $Imagen ?>" alt="" class="profilePhoto"></div>
                <div class="nameContainer">
                    <p class="userName"><?php echo $Name_Seller ?></p>
                </div>
                <div class="descriptionContainer">
                    <p class="text"> <?php echo $profile_Description ?>

                    </p>
                </div>
            </section>
            <section class="personalInfo">
                <p class="userName">Información de contacto</p>
                <div class="socialMedia-container">
                    <div class="socialMedia"><a href="<?php echo $whatsapp ?>"><img src="../Icons/whatsapp.png" alt="" class="iconMedia"></a></div>
                    <div class="socialMedia"><a href="<?php echo $instagram ?>"><img src="../Icons/instagram.png" alt="" class="iconMedia"></a></div>
                    <div class="socialMedia"><a href="<?php echo $x ?>"><img src="../Icons/x.png" alt="" class="iconMedia"></a></div>
                </div>
                <p class="text"><?php echo $Contact_description ?>
                </p>
            </section>
            <section class="personalInfo">
                <section class="part-Comentarios">
                    <section class="textU">
                        <h1>Deja un Comentario</h1>
                    </section>
                    <form id="inputVal" method="post" action="../php-servicios/save_data/save-new-comentario-seller.php">
                        <input type="hidden" name="fecha_Coment" value="<?php echo date('Y-m-d'); ?>">
                        <input type="hidden" name="hora_comentario" value="<?php echo date('H:i:s'); ?>">
                        <input type="hidden" name="id_seller" value="<?php echo $Id_seller; ?>">
                        <input type="text" placeholder="Escribe una reseña" name="descripcion" id="text-Comen" style="width: 14vw;">
                        <article class="input-Comentar"><input class="submit-Com" type="submit" value="Comentar"></article>
                    </form>
                </section>
            </section>
            <section class="personalInfo">
                <section class="part-Reseñas">
                    <section class="textU">
                        <h1>Reseñas</h1>
                    </section>
                    <section class="contRes" id="contRes">

                    </section>
                </section>
            </section>
        </article>
        <form action="" method="post">
            <input type="hidden" name="id_seller" id="id_seller" value="<?php echo $Id_seller?>">
        </form>
        <script>
            document.addEventListener("DOMContentLoaded", getData);

            function getData() {
                let input = document.getElementById("id_seller").value;
                let content = document.getElementById("contRes");
                let url = "../php-servicios/load_data/load-info-comentarios-perfil-vc.php";
                let formData = new FormData();
                formData.append('id_seller', input);

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
        <!--Rigth------------------------------------------------------------------------------------------->
        <article class="rigth">
            <section class="searchSection">
                <div class="tit-c">
                    <p class="tit">Productos del Usuario</p>
                </div>
                <div class="searchContainer">
                    <form action="" method="post">
                        <input type="search" name="searchP" id="searchP" placeholder="Buscar" required onkeyup="getData()">
                        <input type="hidden" name="usser_id" id="usser_id" value="<?php echo $Id_seller; ?>">
                    </form>
                    <button class="searchButton"><img src="../Icons/lupaB.png" alt="" class="searchIcon"></button>
                </div>
            </section>
            <section id="container_all_products_seller">
                <button class="productContainer">
                    <div class="productPhoto"><img src="../Product-Images/<?php //echo $mostrar['image'] 
                                                                            ?>" class="productImage"></div>
                    <div class="productPrice">
                        <p class="priceStyle">$<?php //echo $mostrar['price'] 
                                                ?></p>
                    </div>
                    <div class="productName">
                        <p class="nameStyle"><?php //echo $mostrar['name'] 
                                                ?></p>
                    </div>
                </button>
                <button class="productContainer">
                    <div class="productPhoto"><img src="../Product-Images/<?php //echo $mostrar['image'] 
                                                                            ?>" class="productImage"></div>
                    <div class="productPrice">
                        <p class="priceStyle">$<?php //echo $mostrar['price'] 
                                                ?></p>
                    </div>
                    <div class="productName">
                        <p class="nameStyle"><?php //echo $mostrar['name'] 
                                                ?></p>
                    </div>
                </button>
                <button class="productContainer">
                    <div class="productPhoto"><img src="../Product-Images/<?php //echo $mostrar['image'] 
                                                                            ?>" class="productImage"></div>
                    <div class="productPrice">
                        <p class="priceStyle">$<?php //echo $mostrar['price'] 
                                                ?></p>
                    </div>
                    <div class="productName">
                        <p class="nameStyle"><?php //echo $mostrar['name'] 
                                                ?></p>
                    </div>
                </button>
                <button class="productContainer">
                    <div class="productPhoto"><img src="../Product-Images/<?php //echo $mostrar['image'] 
                                                                            ?>" class="productImage"></div>
                    <div class="productPrice">
                        <p class="priceStyle">$<?php //echo $mostrar['price'] 
                                                ?></p>
                    </div>
                    <div class="productName">
                        <p class="nameStyle"><?php //echo $mostrar['name'] 
                                                ?></p>
                    </div>
                </button>
                <button class="productContainer">
                    <div class="productPhoto"><img src="../Product-Images/<?php //echo $mostrar['image'] 
                                                                            ?>" class="productImage"></div>
                    <div class="productPrice">
                        <p class="priceStyle">$<?php //echo $mostrar['price'] 
                                                ?></p>
                    </div>
                    <div class="productName">
                        <p class="nameStyle"><?php //echo $mostrar['name'] 
                                                ?></p>
                    </div>
                </button>
                <button class="productContainer">
                    <div class="productPhoto"><img src="../Product-Images/<?php //echo $mostrar['image'] 
                                                                            ?>" class="productImage"></div>
                    <div class="productPrice">
                        <p class="priceStyle">$<?php //echo $mostrar['price'] 
                                                ?></p>
                    </div>
                    <div class="productName">
                        <p class="nameStyle"><?php //echo $mostrar['name'] 
                                                ?></p>
                    </div>
                </button>
                <button class="productContainer">
                    <div class="productPhoto"><img src="../Product-Images/<?php //echo $mostrar['image'] 
                                                                            ?>" class="productImage"></div>
                    <div class="productPrice">
                        <p class="priceStyle">$<?php //echo $mostrar['price'] 
                                                ?></p>
                    </div>
                    <div class="productName">
                        <p class="nameStyle"><?php //echo $mostrar['name'] 
                                                ?></p>
                    </div>
                </button>
                <button class="productContainer">
                    <div class="productPhoto"><img src="../Product-Images/<?php //echo $mostrar['image'] 
                                                                            ?>" class="productImage"></div>
                    <div class="productPrice">
                        <p class="priceStyle">$<?php //echo $mostrar['price'] 
                                                ?></p>
                    </div>
                    <div class="productName">
                        <p class="nameStyle"><?php //echo $mostrar['name'] 
                                                ?></p>
                    </div>
                </button>
            </section>

        </article>
    </main>
    <footer>

    </footer>
    <script>
        document.addEventListener("DOMContentLoaded", getData);

        function getData() {
            let input = document.getElementById("searchP").value;
            let id_usser = document.getElementById("usser_id").value;
            let content = document.getElementById("container_all_products_seller");
            let url = "../php-servicios/load_data/load-info-Pantalla-Perfil-Selller.php";
            let formData = new FormData();
            formData.append('searchP', input);
            formData.append('usser_id', id_usser);

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
    <!-- calculate Modal -------------------------------------------------------------------------------------------------->

    <div class="calculateModal hidden">
        <section class="part-Comentarios" style="width: 30vw;">
            <section class="textU">
                <h1>Reportar vendedor</h1>
            </section>
            <form id="inputVal" method="post" action="../php-servicios/save_data/save_new_reporter_seller.php">
                <input type="hidden" name="fecha_Comentr" value="<?php echo date('Y-m-d'); ?>">
                <input type="hidden" name="hora_comentarior" value="<?php echo date('H:i:s'); ?>">
                <input type="hidden" name="Id_sellerr" value="<?php echo $Id_seller; ?>">
                <input type="text" placeholder="Escribe el motivo" name="descripcionr" id="text-Comen" class="text-alining" style="width: 40vw;">
                <article class="input-Comentar"><input class="submit-Com" type="submit" value="Reportar"></article>
            </form>
        </section>
    </div>
    <div class="overlay hidden"></div>
    <div class="invisibleOverlay hidden"></div>
    <!-- ----------------------------------------------------------- -->
    <script src="../Scripts/Script-perfil-vc.js"></script>
</body>

</html>