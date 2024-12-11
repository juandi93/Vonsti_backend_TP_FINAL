<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];

    $conexion = mysqli_connect("127.0.0.1", "root", "", "proyecto_backend", 3306);

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $imagenTmp = $_FILES['imagen']['tmp_name'];
        $imagenContenido = base64_encode(file_get_contents($imagenTmp));
        $query = "UPDATE productos SET nombre='$nombre', descripcion='$descripcion', precio='$precio', imagen='$imagenContenido' WHERE id='$id'";
    } else {
        $query = "UPDATE productos SET nombre='$nombre', descripcion='$descripcion', precio='$precio' WHERE id='$id'";
    }

    mysqli_query($conexion, $query);
    mysqli_close($conexion);

    header("Location: gestion_productos.php");
    exit();
}

$id = $_GET['id'];
$conexion = mysqli_connect("127.0.0.1", "root", "", "proyecto_backend", 3306);
$query = "SELECT * FROM productos WHERE id='$id'";
$resultado = mysqli_query($conexion, $query);
$producto = mysqli_fetch_assoc($resultado);
mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Editar Producto</h1>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Producto</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $producto['nombre']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" required><?php echo $producto['descripcion']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" class="form-control" id="precio" name="precio" value="<?php echo $producto['precio']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen del Producto (opcional)</label>
                <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
                <?php if (!empty($producto['imagen'])): ?>
                    <img src="data:image/jpeg;base64,<?php echo $producto['imagen']; ?>" alt="Imagen actual" class="img-thumbnail mt-2" style="max-height: 150px;">
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Producto</button>
            <a href="gestion_productos.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
