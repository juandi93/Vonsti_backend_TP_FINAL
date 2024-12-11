<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Vonsti</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous" />
  <link rel="stylesheet" href="./style/style.css" />
</head>

<body>
  <!--Navbar-->
  <nav class="navbar navbar-expand-lg navbar-light shadow-5-strong">
    <div class="container">
      <a class="navbar-brand" href="#">Vonsti</a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#inicio">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#nosotros">Nosotros</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#cursos">Cursos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./productos.php">Shop</a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link ms-lg-3" href="../ecommerce/login.php">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- HERO -->
  <section id="hero" class="min-vh-100 d-flex align-items-center text-center">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h1 class="text-uppercase fw-semibold display-1 text-white">
            Fullstack Web Developer <br />& <br />Community Manager
          </h1>
          <div class="mt-5">
            <a href="" class="btn btn-light">Conocenos</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section id="nosotros" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="col-12 text-center mb-5">
          <h1 class="display-4 fw-semibold text-white">Nosotros</h1>
        </div>
      </div>
      <div class="row mt-5 align-items-center">
        <!-- Primera fila: Texto a la izquierda, imagen a la derecha -->
        <div class="col-lg-6 col-md-12 text-white mb-4 mb-lg-0">
          <h3 class="fw-semibold">Ser Fullstack Web Developer & Community Manager es nuestro enfoque primario.</h3>
          <p>
          Seamos honestos y dejemos de lado el verso del marketing: necesitas un sitio web que no solo se vea increíble, sino que también funcione de verdad. En resumen, eso es lo que hacemos. Si querés saber más sobre cómo trabajamos, recorré nuestro sitio web.
          </p>
        </div>
        <div class="col-lg-6 col-md-12">
          <img src="assets/gabrielle-henderson-HJckKnwCXxQ-unsplash.jpg" alt="Descripción de la imagen" class="img-fluid rounded">
        </div>
      </div>
      <div class="row mt-5 align-items-center">
        <!-- Segunda fila: Imagen a la izquierda, texto a la derecha -->
        <div class="col-lg-6 col-md-12 mb-4 mb-lg-0">
          <img src="assets/patrik-michalicka-r3iAqHb7JWs-unsplash.jpg" alt="Descripción de la imagen" class="img-fluid rounded">
        </div>
        <div class="col-lg-6 col-md-12 text-white">
          <h3 class="fw-semibold">Nuestra otra pasión es crear marcas personales poderosas.</h3>
          <p>
            Después de gestionar nuestro propio negocio como marca personal durante los últimos 8 años y de darnos cuenta de que esto nos apasiona, finalmente reunimos nuestras ideas en un curso completo desde la perspectiva VonSti. Aprendé qué funcionó y qué no.
          </p>
        </div>
      </div>
    </div>
  </section>

  <section id="cursos" class="section-padding">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center mb-5">
                <h1 class="display-4 text-black fw-semibold">Cursos</h1>
            </div>
        </div>
        <div class="row g-4">
            <?php
            $conexion = mysqli_connect("127.0.0.1", "root", "", "proyecto_backend", 3306);
            $query = "SELECT * FROM productos";
            $resultado = mysqli_query($conexion, $query);

            if (!$resultado) {
                echo "<p>Error en la consulta: " . mysqli_error($conexion) . "</p>";
                exit();
            }

            while ($unaFila = mysqli_fetch_assoc($resultado)) {
              echo '
              <div class="col-md-4 mb-4">
    <div class="pricing-card">
        <!-- Contenedor para ajustar la imagen -->
        <div class="image-container">
            <img src="data:image/jpeg;base64,' . $unaFila['imagen'] . '" class="img-fluid" alt="Imagen del producto">
        </div>
        <div class="pricing-header bg-basic">
            <h4 class="pricing-title">' . $unaFila['nombre'] . '</h4>
            <div class="pricing-price">$' . number_format($unaFila['precio'], 2) . '</div>
            <div class="pricing-period">/ curso</div>
        </div>
        <div class="pricing-body">
            <p class="text-muted">' . $unaFila['descripcion'] . '</p>
        </div>
        <div class="pricing-footer">
            <a href="./productos.php" class="btn btn-primary">Ver más</a>
        </div>
    </div>
</div>
';
          }
          

            mysqli_close($conexion);
            ?>
        </div>
    </div>
</section>

  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>