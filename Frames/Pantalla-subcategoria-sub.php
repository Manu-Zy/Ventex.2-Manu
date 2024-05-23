<?php
    $subpro = $_POST['id'];
    $mywher = $_POST['categoria'];
    
    require_once('../php-servicios/Conexion_db/conexion_usser_select.php');

    $cats = mysqli_query($Conexion_usser_select, "SELECT DISTINCT Nombre_Cat FROM categoria");


    $subc = mysqli_query($Conexion_usser_select, "SELECT DISTINCT Nombre_Subcat,foto_subcategoria FROM subcategoria WHERE Categoria='$mywher';");
    $busc = "SELECT * FROM productos WHERE Subcategoria = '$subpro'";
    $ex = mysqli_query($Conexion_usser_select, $busc);
    // Verifica si la consulta fue exitosa
 
?>
<!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Ventex</title>
            <link rel="stylesheet" href="../Componentes/header.css">
            <link rel="stylesheet" href="../Componentes/productBoxSmaller.css">
            <link rel="stylesheet" href="../Componentes/footer.css">
            <link rel="stylesheet" href="../Styles/Styles-Subcategoria-sub.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        </head>
    <body>
<!-------------------------------------------------------------------------------------------------------->
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
<!-------------------------------------------------------------------------------------------------------->
<main>
    <article id="bar_perfil">
    </article>
    <section id="titulo_C">

        <h1 class="tituleishon"><?php echo $subpro ?></h1>
    </section>
    <article class="pr_productos_sub">
<!-------------------------------------------------------------------------------------------------------->
        <?php while($mostrar=mysqli_fetch_array($ex)) { ?>
                
            <form action="../Frames/pantalla-producto.php" method="post">
                <button class="productContainer" type="submit">
                    <div class="productPhoto">
                        <img src="../Product-Images/<?php echo $mostrar['Imagen']; ?>" class="productImage" />
                    </div>
                    <div class="productPrice">
                        <p class="priceStyle">$<?php echo $mostrar['Precio']; ?></p>
                    </div>
                    <div class="productName">
                        <p class="nameStyle"><?php echo $mostrar['Nombre_Prod']; ?></p>
                    </div>
                </button>
            </form>

        <?php }?>
    </article>
<!-------------------------------------------------------------------------------------------------------->

        <section class="more_subs">
            <article class="subcategoriesSection">
                <br>
                <?php while ($subcat = mysqli_fetch_array($subc)) { ?>
                    <form action="Pantalla-subcategoria-sub.php" method="post" class="subcategoria-form">
                        <button class="subcategoryButton" type="submit">
                            <div class="subcategoryPhotoContainer">
                                <img src="../Product-Images/Imagenes-subcategorias/<?php echo $subcat['foto_subcategoria']; ?>" alt="Nones" class="subcategoryPhoto">
                            </div>
                            <div class="subcategoryNameContainer">
                                <input type="hidden" value="<?php echo $mywher; ?>" name="categoria">
                                <input type="hidden" name="id" value="<?php echo $subcat['Nombre_Subcat']; ?>">
                                <p class="subcategoryName"><?php echo $subcat['Nombre_Subcat']; ?></p>
                            </div>
                        </button>
                    </form>
                <?php } ?>
            </article>
        </section>

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