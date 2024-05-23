<?php
// Incluir el archivo de conexión
require_once('../php-servicios/Conexion_db/conexion_usser_select.php');

// Comprobar si la sesión está iniciada
session_start();
// if (!isset($_SESSION['id'])) {
//     // Si no hay sesión iniciada, redireccionar o manejar el caso según tus necesidades
//     // Por ejemplo, redireccionar a una página de inicio de sesión
//     header("Location: ../Frames/pantalla-Login.html");
//     exit;
// }

// Obtener el ID de usuario de la sesión
$id_usser = $_SESSION['id'];
//$id_usser = 5;
// Preparar la consulta para obtener los datos del usuario
$sql = "SELECT profile_Description, Contact_description, instagram, x, whatsapp, facebook FROM seller_porfile WHERE Id_sellerP = ?";
$stmt = mysqli_prepare($Conexion_usser_select, $sql);

// Vincular parámetro(s) a la consulta preparada
mysqli_stmt_bind_param($stmt, "i", $id_usser);

// Ejecutar la consulta preparada
mysqli_stmt_execute($stmt);

// Vincular variables a los resultados de la consulta
mysqli_stmt_bind_result($stmt, $profile_Description, $Contact_description, $instagram, $x, $whatsapp, $facebook);

// Obtener los resultados
mysqli_stmt_fetch($stmt);

// Cerrar la consulta preparada
mysqli_stmt_close($stmt);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventex</title>
    <!-- Enlaces a tus hojas de estilo y fuentes -->
    <link rel="stylesheet" href="../Styles/Styles-Edit-RedesSocial.css">
    <link rel="stylesheet" href="../Componentes/header.css">
    <link rel="stylesheet" href="../Componentes/footer.css">
    <link href="https://fonts.googleapis.com/css2?family=Cabin&family=Cabin+Sketch&family=Hammersmith+One&family=Hind:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            <li><a href="" class="headerOption">Inicio</a></li>
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


    <!-- Contenido principal -->
    <main>
        <!-- Sección lateral 1 -->
        <section class="decor">
            <div class="circle1"></div>
            <div class="circle2"></div>
            <div class="circle3"></div>
        </section>
        <!-- Sección lateral 2 (formulario para actualizar redes sociales) -->
        <section class="form">
            <h1 class="form-title">Editar Redes Sociales</h1>
            <form action="../php-servicios/save_data/save-actulizacion-RedesSociales.php" method="post">
                <input type="hidden" name="id-usser-update" value=""><!-- aqui va ir lo de sesion -->
                <!-- Inputs para actualizar datos de redes sociales -->
                <div class="inputbox">
                    <label for="description">Descripción</label>
                    <input type="text" name="description" class="inp" placeholder=" " required value="<?php echo $profile_Description; ?>">
                </div>
                <div class="inputbox">
                    <label for="whatsapp">WhatsApp</label>
                    <input type="text" name="whatsapp" class="inp" placeholder=" " required value="<?php echo $whatsapp; ?>">
                </div>
                <div class="inputbox">
                    <label for="x">X</label>
                    <input type="text" name="x" class="inp" placeholder=" " required value="<?php echo $x; ?>">
                </div>
                <div class="inputbox">
                    <label for="facebook">Facebook</label>
                    <input type="text" name="facebook" class="inp" placeholder=" " required value="<?php echo $facebook; ?>">
                </div>
                <div class="inputbox">
                    <label for="instagram">Instagram</label>
                    <input type="text" name="instagram" class="inp" placeholder=" " required value="<?php echo $instagram; ?>">
                </div>
                <div class="inputbox">
                    <label for="contact_info">Información de contacto</label>
                    <input type="text" name="contact_info" class="inp" placeholder=" " required value="<?php echo $Contact_description; ?>">
                </div>
                <!-- Botón para enviar el formulario -->
                <div id="button-div">
                    <br><button type="submit" class="submit" id="button-sumit">Actualizar</button>
                </div>
            </form>
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