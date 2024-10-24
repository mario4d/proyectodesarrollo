<?php

include('conexion.php'); // Incluir la conexión a la base de datos


$query = "SELECT COUNT(*) as total_filas FROM productos";
$result = $est->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nuevo_codigo = $row['total_filas'] + 1;
} else {
    // Si no hay productos, el primer código será 1
    $nuevo_codigo = 1;
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recoger los valores del formulario de manera segura
    $codigo = isset($_POST['codigo']) ? $_POST['codigo'] : '';
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
    $precio = isset($_POST['precio']) ? $_POST['precio'] : '';
    $stock = isset($_POST['stock']) ? $_POST['stock'] : '';
    $marca = isset($_POST['marca']) ? $_POST['marca'] : '';
    $modelo = isset($_POST['modelo']) ? $_POST['modelo'] : '';

    // Consulta SQL para insertar el producto
    $enviar = "INSERT INTO productos (Codigo, Nombre_Producto, Marca_Producto, Modelo_Producto, Descripcion_Producto, Precio_Producto, Stock) 
               VALUES ('$codigo', '$nombre', '$descripcion', '$precio', '$stock', '$marca', '$modelo')";

    // Ejecutar la consulta y verificar si se ha insertado correctamente
    if ($est->query($enviar) === TRUE) {
        // Si la inserción es exitosa, redirigir a la página principal
        header('Location: index.php');
        exit;
    } else {
        // Mostrar mensaje de error si ocurre un problema
        echo "Error al registrar el producto en la base de datos: " . $est->error;
    }
}

?>
