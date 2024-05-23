<?php
session_start();

if (!isset($_SESSION['id'])) {
    // Si no hay sesión iniciada, redireccionar a la página de inicio de sesión
    header("Location: ../Frames/pantalla-Login.html");
    exit;
}

if ($_SESSION['Type'] === 2) {
    // No redireccionar
} else {
    header("Location: ../Frames/Pantalla-Perfil-Vip.php");
}

require_once('../php-servicios/Conexion_db/conexion_usser_select.php');

// Obtener el ID de usuario de la sesión
$id_usser = $_SESSION['id'];

// Preparar la consulta para obtener los datos del usuario
$sql = "SELECT instagram, x, whatsapp, facebook FROM seller_porfile WHERE Id_sellerP = ?";
$stmt = mysqli_prepare($Conexion_usser_select, $sql);

// Vincular parámetro(s) a la consulta preparada
mysqli_stmt_bind_param($stmt, "i", $id_usser);

// Ejecutar la consulta preparada
mysqli_stmt_execute($stmt);

// Vincular variables a los resultados de la consulta
mysqli_stmt_bind_result($stmt, $instagram, $x, $whatsapp, $facebook);

// Obtener los resultados
mysqli_stmt_fetch($stmt);

// Cerrar la consulta preparada
mysqli_stmt_close($stmt);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Perfil</title>
    <link rel="stylesheet" href="../Componentes/header.css">
    <link rel="stylesheet" href="../Componentes/footer.css">
    <link rel="stylesheet" href="../Componentes/extensibleSearchInput.css">
    <link rel="stylesheet" href="../Styles/Styls-profile.css">
    <link rel="stylesheet" href="../Componentes/productBoxSmallerWithPoints.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style>
        /* <-------Styles extensible search input*/
        .searchSection {
            text-align: left;
        }

        .searchButton {
            /*<------Color Button*/
            background-color: black;
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
                <input type="search" placeholder="Buscar" name="busqueda" class="inputSearchHeader" required>
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
            <section class="sellModalInformationContainer">
                <h1 class="titleModal">Ventex</h1>
                <p class="infoModal">Con Ventex, los emprendedores estudiantiles pueden gestionar y promocionar sus productos de manera eficiente. Compra un plan y desbloquea todo el potencial de tu negocio.</p>
            </section>
            <section class="sellModalPlansContainer">
                <button class="closePlansButto">x</button>
                <div class="titlePlansSellerModalContainer">
                    <h1 class="titlePlansSellerModal">Planes</h1>
                </div>
                <section class="planSellerModalContainer">
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
        <section class="parent">
            <section class="parent_Child">
                <section class="parent_FirstChild">
                    <article id="background">
                        <article id="profile_Card_Img">
                            <img id="profile_Img" src="../Imgens-Pefil/<?php echo $_SESSION['img']; ?>">
                        </article>
                    </article>
                </section>

                <section class="parent_LastChild">
                    <article class="info">
                        <a href="Pantalla-Edit-Info-Personal.php" class="edit"><i class="fa-solid fa-user-pen"></i></a>
                        <h1><?php echo $_SESSION['name']; ?></h1>
                        <h2><?php echo $_SESSION['email']; ?></h2>
                        <section class="details">
                            <section class="data">
                                <table>
                                    <tr>
                                        <td>Fecha de nacimiento: </td>
                                        <td><?php echo $_SESSION['birthdate']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Número de teléfono: </td>
                                        <td><?php echo $_SESSION['phone']; ?></td>
                                    </tr>
                                </table>
                            </section>
                        </section>

                        <section class="socialMedia">
                            <section class="info-edit">
                                <h1>Informacion de Contacto</h1>
                                <a href="Pantalla-Edit-RedesSocial.php"><i class="fa-solid fa-pen"></i></a>
                            </section>

                            <section>
                                <a href="<?php echo $facebook ?>"><i class="fa-brands fa-facebook"></i></a>
                                <a href="<?php echo $x ?>"><i class="fa-brands fa-square-x-twitter"></i></a>
                                <a href="<?php echo $whatsapp ?>"><i class="fa-brands fa-tiktok"></i></a>
                            </section>

                            <a href="../Frames/Pantalla-Pago-Suscripcion.php" class="subs">Suscribirse</a>
                            <a href="../php-servicios/deletion_data/deletion_session_usser.php" class="subs">Cerrar Sesión <i class="fa-solid fa-right-from-bracket"></i></a>
                        </section>
                    </article>
                </section>
            </section>

            <!-- Info del vendedor -->
            <section class="parent_Child">
                <section class="parent_LastChild">
                    <section class="group">
                        <div class="searchSection">
                            <div class="searchContainer">
                                <input type="search" name="searchP" id="searchP" placeholder="Buscar" required onkeyup="getData()">
                                <button class="searchButton"><img src="../Icons/lupaB.png" alt="" class="searchIcon"></button>
                            </div>
                            <form action="../Frames/Pantalla-AddP.php" method="post">
                                <button class="addProductButton" type="submit">Agregar Producto</button>
                            </form>

                        </div>
                        <script>
                            document.addEventListener("DOMContentLoaded", getData);

                            function getData() {
                                let input = document.getElementById("searchP").value;
                                let content = document.getElementById("resultados");
                                let url = "../php-servicios/load_data/load-info-pantalla-perfil.php";
                                let formData = new FormData();
                                formData.append('searchP', input);

                                fetch(url, {
                                        method: "POST",
                                        body: formData
                                    }).then(response => response.text())
                                    .then(data => {
                                        content.innerHTML = data;
                                        asignarEventos();
                                    }).catch(err => console.log(err));
                            }

                            function asignarEventos() {
                                const optionsButton = document.querySelectorAll('.pointsButton');
                                const optionsList = document.querySelectorAll('.optionsPoints');
                                const invisibleOverlay = document.querySelector('.invisibleOverlay');

                                optionsButton.forEach((but, index) => {
                                    but.addEventListener('click', () => {
                                        optionsList.forEach((list, i) => {
                                            if (i !== index) {
                                                list.classList.add('hidden');
                                            }
                                        });
                                        optionsList[index].classList.toggle('hidden');
                                        invisibleOverlay.classList.toggle('hidden');
                                    });
                                });

                                invisibleOverlay.addEventListener('click', () => {
                                    optionsList.forEach(list => list.classList.add('hidden'));
                                    invisibleOverlay.classList.add('hidden');
                                });
                            }
                        </script>
                        <div id="resultados"></div>
                    </section>
                </section>
            </section>
        </section>
    </main>

    <div class="invisibleOverlay hidden"></div>

    <footer>
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
    </footer>

</body>

</html>