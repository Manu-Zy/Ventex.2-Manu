<?php
$recibir_datos = isset($_POST['busqueda']) ? $_POST['busqueda'] : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../Componentes/header.css" />
  <link rel="stylesheet" href="../Styles/Styles-Busqueda.css" />
  <link rel="stylesheet" href="../Componentes/productBox.css" />
  <title>Document</title>
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
        <li><a href="../Frames/Pantalla-Inicio.php" class="headerOption">Inicio</a></li>
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
        <input type="search" name="search-product" id="search-p" class="inputSearchHeader" onkeyup="getData()" value="<?php echo $recibir_datos ?>"/>
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
    <!-- <section class="resultTitleContainer">
        <h1 class="tit">
          Resultados similares a <span class="titResult">"Busqueda"</span>
        </h1>
    </section> -->
    <article class="left">
      <section class="titleContainer">
        <h1 class="tit">
          Resultados similares a <span class="titResult">"Busqueda"</span>
        </h1>
      </section>
      <section class="productsContainer" id="products_Container">
        
        </section>
      </article>
      <article class="rigth">
        <section class="usersContainer" id="users_Container">
          <!-- <div class="UserstitleContainer">
            <h1 class="titUsers">Usuarios similares</h1>
          </div> -->
        </section>
      </article>
    </main>

  <script>
    // document.addEventListener("DOMContentLoaded", getData);

    // function getData() {
    //   let input = document.getElementById("search-p").value;
    //   let content = document.getElementById("users_Container");
    //   let url = "../php-servicios/load_data/load-info-pantalla-busqueda-vendedores";
    //   let formData = new FormData();
    //   formData.append('search-p', input);

    //   fetch(url, {
    //       method: "POST",
    //       body: formData
    //     }).then(response => response.text())
    //     .then(data => {
    //       console.log(data);
    //       content.innerHTML = data;
    //     }).catch(err => console.log(err));
    // }

    //------------------------------------------------------------------------------------------------------------------------


     const usersContainer = document.querySelector(".usersContainer");

     window.addEventListener("scroll", () => {
       if (window.scrollY > 70) {
          usersContainer.classList.add("block");
       } else {
          usersContainer.classList.remove("block");
        }
      });



    document.addEventListener("DOMContentLoaded", getData);

    function getData() {
      fetchData(
        "../php-servicios/load_data/load-info-pantalla-busqueda-productos.php",
        "products_Container"
      );
      fetchData(
        "../php-servicios/load_data/load-info-pantalla-busqueda-vendedores.php",
        "users_Container"
      );
    }

    function fetchData(url, containerId) {
      let input = document.getElementById("search-p").value;
      let content = document.getElementById(containerId);
      let formData = new FormData();
      formData.append("search-p", input);

      fetch(url, {
        method: "POST",
        body: formData,
      })
        .then((response) => {
          if (!response.ok) {
            throw new Error("Network response was not ok");
          }
          return response.text();
        })
        .then((data) => {
          console.log(data);
          content.innerHTML = data;
        })
        .catch((error) => {
          console.error("Error fetching data:", error);
        });
    }
  </script>
</body>

</html>