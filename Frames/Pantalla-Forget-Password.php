<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Componentes/footer.css">
    <!-- <link rel="stylesheet" href="../Styles/Styles-Edit-Profile.css"> -->
    <link rel="stylesheet" href="../Componentes/Styles-Form.css">
    <link rel="stylesheet" href="../Componentes/header-form.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Ventex</title>
</head>
<body>
    <header>
        <article class="title">
            <h1>Ventex</h1>
        </article>
    </header>

    <main>
        <section class="decor">
            <div class="circle1"></div>
            <div class="circle2"></div>
            <div class="circle3"></div>
        </section>
        <section class="form">
            <form action="" method="PUT">
                <br><h1 class="form-title">Restablecer Contraseña</h1>
                <section class="input-container">
                    <label for="password">Nueva Contraseña</label>
                    <input class="input" type="password" name="password">
                </section>

                <section class="input-container">
                    <label for="again-Password">Escríbela de nuevo</label>
                    <input class="input" type="password" name="again-Password">
                </section>
                <input class="submit" type="submit" name="login" value="Cambiar Contraseña">
            
                <p class="signup-link">
                        ¿No tienes una cuenta?
                        <a href="../Frames/pantalla-registro.html">Registrate</a>
                </p>
            </form>
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