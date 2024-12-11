<?php
$conexion = mysqli_connect("127.0.0.1", "root", "", "proyecto_backend", 3306);
$query = "SELECT * FROM productos";
$resultado = mysqli_query($conexion, $query);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista de Productos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>


    <div class="container mt-4">
        <h1 class="text-center mb-4">Productos</h1>

        <a href="/ecommerce" class="btn btn-dark mb-3">Volver</a>
        <div class="row g-4">
        <?php
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
                        </div>
                        <div class="pricing-body">
                            <p class="text-muted">' . $unaFila['descripcion'] . '</p>
                        </div>
                        <div class="pricing-footer">
                            <a href="#" class="btn btn-dark">Comprar</a>
                        </div>
                    </div>
                </div>';
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>

<?php
mysqli_close($conexion);
?>