<?php
require_once('../php-servicios/Conexion_db/conexion_usser_select.php');
session_start();
$id_usser = $_SESSION['id'];
//$id_usser = 5;
$sql = "SELECT ID_Producto, Nombre_Prod FROM productos WHERE Id_usser_regristro = $id_usser";

$result = $Conexion_usser_select->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventex</title>
    <link rel="stylesheet" href="../Styles/Styles-pedidos.css">
    <link rel="stylesheet" href="../Componentes/header.css">
    <link rel="stylesheet" href="../Componentes/footer.css">
    <link rel="stylesheet" href="../Componentes/extensibleSearchInput.css">
    <link rel="stylesheet" href="../Componentes/modalForm.css">
    <link rel="stylesheet" href="../Componentes/calculationModal.css">

    <style>
        /* <-------Styles extensible search input*/
        .searchSection {
            text-align: left;
        }

        .containerSearchSection {
            min-width: 20vw;
            height: 8vh;
            display: flex;
            align-items: center;
        }

        .searchButton {
            /* <------Color Button*/
            background-color: rgb(174, 186, 175);
        }

        #searchP:valid~.searchButton {
            /* <------Color of the button when te input is valid*/
            background-color: rgb(148, 156, 148);
        }

        #input_more_little1 {
            margin-left: .1vw;
        }

        #input_more_little2 {
            margin-left: 3vw;
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
        <article class="container">
            <section class="table-header">
                <div colspan="3" class="searchSection">
                    <div class="containerSearchSection">
                        <div class="searchContainer">
                            <input type="search" name="searchP" id="searchP" placeholder="Buscar" onkeyup="getData()" required>
                            <button class="searchButton"><img src="../Icons/lupaB.png" alt="" class="searchIcon"></button>
                        </div>
                    </div>
                </div>
                <div class="table-name-container">
                    <h1 class="table-name">Pedidos</h1>
                </div>
                <div class="table-options">
                    <button class="btn calc" onclick="calcular2()">Calcular</button>
                    <button class="btn addOrder">Agregar Pedido</button>
                </div>
            </section>
            <table class="tableContainer">
                <tr class="table-header-data">
                    <th class="header-data">Terminar</th>
                    <th class="header-data">ID-pedido</th>
                    <th class="header-data">Nombre</th>
                    <th class="header-data">ID-producto</th>
                    <th class="header-data">Usuario-Cliente</th>
                    <th class="header-data">Fecha</th>
                    <th class="header-data">Hora</th>
                    <th class="header-data">Lugar</th>
                    <th class="header-data">Cantidad</th>
                    <th class="header-data">Precio</th>
                    <th class="header-data">Descripción</th>
                </tr>
                <tbody id="container_data_pedidos">


                </tbody>
            </table>
        </article>

        <!-- calculate Modal -------------------------------------------------------------------------------------------------->

        <div class="calculateModal hidden">
                <h1 class="titleCalculate">Recopilación de ganancias</h1>
                
                <h2 class="resultCalculation" id="parrafoSalida"></h2>
        </div>

        <div class="overlay hidden"></div>
        <div class="invisibleOverlay hidden"></div>

        <!-- Form Modal -------------------------------------------------------------------------------------------------->

        <article class="modalFormMainContainer hidden">
            <section class="titleFormContainer">
                <h1 class="titleForm">Agregar Pedido</h1>
            </section>
            <section class="contentFormInputs">
                <form action="../php-servicios/save_data/save_new_pedido.php" method="post" class="formInputs">
                    <div class="inputContainer">
                        <input type="text" name="nombre_producto" class="input" required>
                        <label for="nombre_producto" class="inputText">
                            <pre> Nombre del Producto</pre>
                        </label>
                    </div>
                    <div class="inputContainer">
                        <select name="id_producto" class="input" required>
                            <option value="" class="inputText">Selecciona el producto</option>
                            <?php
                            // Itera sobre los resultados de la consulta y genera opciones para cada producto
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row["ID_Producto"] . '">' . $row["Nombre_Prod"] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="inputContainer">
                        <input type="text" name="nombre_cliente" class="input" required>
                        <label for="nombre_cliente" class="inputText">
                            <pre> Nombre del Cliente </pre>
                        </label>
                    </div>
                    <div class="inputContainerSmall">
                        <input type="time" name="hora_entrega" class="input" required>
                        <label for="hora_entrega" class="inputText">
                            <pre> Hora de Entrega </pre>
                        </label>
                    </div>
                    <div class="inputContainerSmall">
                        <input type="date" name="fecha_entrega" class="input" required>
                        <label for="fecha_entrega" class="inputText">
                            <pre> Fecha de Entrega </pre>
                        </label>
                    </div>
                    <div class="inputContainer">
                        <input type="text" name="direccion_entrega" class="input" required>
                        <label for="direccion_entrega" class="inputText">
                            <pre> Dirección de Entrega </pre>
                        </label>
                    </div>
                    <div class="inputContainer">
                        <input type="text" name="descripcion_pedido" class="input" required>
                        <label for="descripcion_pedido" class="inputText">
                            <pre> Descripción del Pedido </pre>
                        </label>
                    </div>
                    <div class="inputContainer input_more_little" style="width: 11vw;" id="input_more_little1">
                        <input type="number" name="cantidad_producto" class="input" required>
                        <label for="cantidad_producto" class="inputText">
                            <pre> Cantidad </pre>
                        </label>
                    </div>
                    <div class="inputContainer" style="width: 11vw;" id="input_more_little2">
                        <input type="number" name="precio_producto" class="input" required>
                        <label for="precio_producto" class="inputText">
                            <pre> Precio </pre>
                        </label>
                    </div>
                    <input type="submit" value="Agregar Pedido" class="but">
                    <button class="cancel"> Cancelar </button>
                </form>
            </section>
            </section>
        </article>

        <div class="formOverlay hidden"></div>
        <!---------------------------------------------------------------------------------------------------------------->
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
    <script>
        document.addEventListener("DOMContentLoaded", getData);

        function getData() {
            let input = document.getElementById("searchP").value;
            let content = document.getElementById("container_data_pedidos");
            let url = "../php-servicios/load_data/load-info-pantalla-pedidos.php";
            let formData = new FormData();
            formData.append('searchP', input);

            fetch(url, {
                    method: "POST",
                    body: formData
                }).then(response => response.text())
                .then(data => {
                    //console.log(data);
                    content.innerHTML = data;
                    asignarEventos();
                }).catch(err => console.log(err));
        }

        function asignarEventos() {
            const optionsButton = document.querySelectorAll('.checkButton');
            const optionsList = document.querySelectorAll('.pointsOptions');
            const invisibleOverlay = document.querySelector('.invisibleOverlay');

            optionsButton.forEach((but, index) => {
                but.addEventListener('click', () => {
                    optionsList[index].classList.remove('hidden');
                    invisibleOverlay.classList.remove('hidden');
                });
            });
            invisibleOverlay.addEventListener('click', closeOptionsList);

            /*--------------------------------------------------------------------*/
            document.addEventListener("DOMContentLoaded", function() {
                // Obtener los botones de editar y eliminar
                const editButtons = document.querySelectorAll('.editButton');
                const deleteButtons = document.querySelectorAll('.deleteButton');

                // Agregar event listener para el botón de editar
                editButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        // Enviar el formulario correspondiente
                        const form = this.parentNode.querySelector('form');
                        form.submit();
                    });
                });

                // Agregar event listener para el botón de eliminar
                deleteButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        // Enviar el formulario correspondiente
                        const form = this.parentNode.querySelector('form');
                        form.submit();
                    });
                });
            });

        }
    </script>
    <!--------------------------------------------------------------------------------->
    <script src="../Scripts/Script-pedidos.js"></script>
    <!--------------------------------------------------------------------------------->
</body>

</html>