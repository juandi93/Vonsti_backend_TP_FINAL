<?php
session_start();


if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}


$conexion = mysqli_connect("127.0.0.1", "root", "", "proyecto_backend", 3306);

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion']);
    $precio = mysqli_real_escape_string($conexion, $_POST['precio']);
    $tipo = "Curso";


    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $imagen = file_get_contents($_FILES['imagen']['tmp_name']);
        $imagenBase64 = base64_encode($imagen);
    } else {
        $imagenBase64 = null;
    }


    $query = "INSERT INTO productos (nombre, descripcion, precio, tipo, imagen) VALUES ('$nombre', '$descripcion', '$precio', '$tipo', '$imagenBase64')";
    if (mysqli_query($conexion, $query)) {
        header("Location: gestion_productos.php");
        exit();
    } else {
        echo "Error al insertar: " . mysqli_error($conexion);
    }
}


mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dar de Alta Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Dar de Alta Producto</h1>
        <form method="POST" action="crear_producto.php" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Producto</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del producto" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Descripción del producto" required></textarea>
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" class="form-control" id="precio" name="precio" placeholder="Precio del producto" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen del Producto</label>
                <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Producto</button>
            <a href="gestion_productos.php" class="btn btn-secondary">Volver</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
