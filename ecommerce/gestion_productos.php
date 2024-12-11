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


if (isset($_GET['eliminar_id'])) {
    $id = intval($_GET['eliminar_id']);
    $query = "DELETE FROM productos WHERE id = $id";
    if (!mysqli_query($conexion, $query)) {
        echo "Error al eliminar el producto: " . mysqli_error($conexion);
    }
}


$query = "SELECT * FROM productos";
$resultado = mysqli_query($conexion, $query);

if (!$resultado) {
    die("Error al realizar la consulta: " . mysqli_error($conexion));
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-center">Gestión de Productos</h1>
            <a href="/ecommerce" class="btn btn-primary">Ir a E-commerce</a>
        </div>
        <a href="crear_producto.php" class="btn btn-success mb-3">Dar de Alta Producto</a>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Tipo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($producto = mysqli_fetch_assoc($resultado)) {
                    echo '
                        <tr>
                            <td>' . $producto['id'] . '</td>
                            <td>' . $producto['nombre'] . '</td>
                            <td>' . $producto['descripcion'] . '</td>
                            <td>$' . number_format($producto['precio'], 2) . '</td>
                            <td>' . $producto['tipo'] . '</td>
                            <td>
                                <a href="editar_producto.php?id=' . $producto['id'] . '" class="btn btn-warning btn-sm">Editar</a>
                                <a href="gestion_productos.php?eliminar_id=' . $producto['id'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'¿Estás seguro de eliminar este producto?\')">Eliminar</a>
                            </td>
                        </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php

mysqli_close($conexion);
?>
