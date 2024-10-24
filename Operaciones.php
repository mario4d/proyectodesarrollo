<?php

include('Conexion.php'); // Incluir la conexión a la base de datos

// Consulta para contar el número de filas en la tabla de productos
$query = "SELECT COUNT(*) as total_filas FROM productos";
$result = $pdo->query($query);
$row = $result->fetch(PDO::FETCH_ASSOC);

if ($row['total_filas'] > 0) {
    $nuevo_codigo = $row['total_filas'] + 1;
} else {
    // Si no hay productos, el primer código será 1
    $nuevo_codigo = 1;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recoger los valores del formulario de manera segura
    $codigo = $nuevo_codigo;
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
    $precio = isset($_POST['precio']) ? $_POST['precio'] : '';
    $stock = isset($_POST['stock']) ? $_POST['stock'] : '';
    $marca = isset($_POST['marca']) ? $_POST['marca'] : '';
    $modelo = isset($_POST['modelo']) ? $_POST['modelo'] : '';

    // Consulta SQL para insertar el producto
    $enviar = "INSERT INTO productos (Codigo, Nombre_Producto, Marca_Producto, Modelo_Producto, Descripcion_Producto, Precio_Producto, Stock) 
               VALUES (:codigo, :nombre, :marca, :modelo, :descripcion, :precio, :stock)";

    // Preparar la consulta
    $stmt = $pdo->prepare($enviar);

    // Ejecutar la consulta con los parámetros
    if ($stmt->execute([
        ':codigo' => $codigo,
        ':nombre' => $nombre,
        ':marca' => $marca,
        ':modelo' => $modelo,
        ':descripcion' => $descripcion,
        ':precio' => $precio,
        ':stock' => $stock
    ])) {
        // Si la inserción es exitosa, redirigir a la página principal
        header('Location: index.php');
        exit;
    } else {
        // Mostrar mensaje de error si ocurre un problema
        echo "Error al registrar el producto en la base de datos.";
    }
}

?>
