<?php

// Función para mostrar los productos vistos recientemente
function mostrarProductosVistosRecientemente($Conexion_usser_select) {
    // Verificar si existe la cookie de productos vistos recientemente
    $productos_vistos = isset($_COOKIE['productos_vistos']) ? json_decode($_COOKIE['productos_vistos'], true) : [];

    // Verificar si hay productos vistos recientemente
    if (!empty($productos_vistos)) {
        echo '<section class="productos-Recomendados">';
        echo '<h1>Vistos recientemente</h1>';
        echo '<section class="slider">';
        foreach ($productos_vistos as $producto_id) {
            // Consultar la información del producto desde la base de datos
            $sql = "SELECT * FROM productos WHERE id = $producto_id";
            $resultado = $Conexion_usser_select->query($sql);
            if ($resultado->num_rows > 0) {
                $row = $resultado->fetch_assoc();
                // Mostrar los productos
                echo '<section class="card">';
                echo '<div class="image"><img src="' . $row['Imagen'] . '"></div>';
                echo '<span class="title">' . $row['Nombre_Prod'] . '</span>';
                echo '<span class="price">$' . $row['Precio'] . '</span>';
                echo '</section>';
            }
        }
        echo '</section>';
        echo '</section>';
    } else {
        echo '<p styles="text-aling:center;">No hay productos vistos recientemente.</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../Componentes/header.css">
  <link rel="stylesheet" href="../Componentes/footer.css">
  <link rel="stylesheet" href="../Styles/Styles-Inicio.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Inicio</title>
</head>

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

  <main>

    <section class="presentacion">
      <div class="circle1"></div>
      <div class="circle2"></div>
      <div class="ventex"><span>Ventex</span></div>
      <div class="slogan">
        <span>En busca de nuevos emprendedores.</span><br>
        <span>Sé tú el siguiente.</span>
      </div>
    </section>

    <section class="productos-Recomendados">
      <h1>Productos Recomendados</h1>
      <section class="slider" id="resultados">

        <script>
          document.addEventListener("DOMContentLoaded", getData);

          function getData() {

            let content = document.getElementById("resultados");
            let url = "../php-servicios/load_data/load-info-pantalla-Inicio.php";
            let formData = new FormData();


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

      </section>
    </section>

    <section class="ad">
      <div class="e-card playing">
        <div class="image"></div>
        <div class="wave"></div>
        <div class="infotop">
          <span>Gran Variedad de Productos</span>
        </div>
      </div>
    </section>

    <section class="productos-Recomendados">
      <h1>Vistos recientemente</h1>
      <div id="contenedor"></div>

    </section>
    </section>
    <script>
      document.addEventListener("DOMContentLoaded", getData);

      function getData() {
        //let input = document.getElementById("searchP").value;
        let content = document.getElementById("contenedor");
        let url = "../php-servicios/load_data/load-info-productos-visitados.php";
        let formData = new FormData();
        //formData.append('searchP', input);

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