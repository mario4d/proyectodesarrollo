<?php
include('ConexionS.php');

// Función para obtener productos pendientes
function obtenerProductosPendientes($pdo) {
    $query = "SELECT cp.Detalle_Producto, cp.Precio_Producto, sp.ID_Solicitud
              FROM compra_productos cp
              JOIN solicitudes_producto sp ON cp.ID_Solicitud = sp.ID_Solicitud
              WHERE sp.Estado_Solicitud = 'Enviado'";
    return $pdo->query($query);
}

// Consulta para contar el número de filas en la tabla de productos
$query = "SELECT COUNT(*) as total_filas FROM productos";
$result = $pdo->query($query);
$row = $result->fetch(PDO::FETCH_ASSOC);

if ($row['total_filas'] > 0) {
    $nuevo_codigo = $row['total_filas'] + 1;
} else {
    $nuevo_codigo = 1; // Si no hay productos, el primer código será 1
}

$productosPendientes = obtenerProductosPendientes($pdo); // Obtener productos pendientes

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Manejo para agregar producto
    if (isset($_POST['agregar'])) {
        // Recoger los valores del formulario de manera segura
        $codigo = isset($_POST['codigo']) ? $_POST['codigo'] : '';
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
        $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
        $precio = isset($_POST['precio']) ? $_POST['precio'] : '';
        $stock = isset($_POST['stock']) ? $_POST['stock'] : '';
        $marca = isset($_POST['marca']) ? $_POST['marca'] : '';
        $modelo = isset($_POST['modelo']) ? $_POST['modelo'] : '';

        // Consulta SQL para insertar el producto
        $enviar = "INSERT INTO productos (Codigo, Nombre_Producto, Descripcion_Producto, Precio_Producto, Stock, Marca, Modelo) 
                   VALUES (:codigo, :nombre, :descripcion, :precio, :stock, :marca, :modelo)";

        // Preparar la consulta
        $stmt = $pdo->prepare($enviar);

        // Ejecutar la consulta con los parámetros
        if ($stmt->execute([
            ':codigo' => $codigo,
            ':nombre' => $nombre,
            ':descripcion' => $descripcion,
            ':precio' => $precio,
            ':stock' => $stock,
            ':marca' => $marca,
            ':modelo' => $modelo
        ])) {
            header('Location: index.php');
            exit;
        } else {
            $errorInfo = $stmt->errorInfo();
            echo "Error al registrar el producto en la base de datos: " . htmlspecialchars($errorInfo[2]);
        }
    }

    // Manejo para actualizar estado
    if (isset($_POST['actualizar_estado'])) {
        $id_solicitud = isset($_POST['id_solicitud']) ? $_POST['id_solicitud'] : '';

        // Consulta para actualizar el estado del producto
        $actualizar = "UPDATE solicitudes_producto SET Estado_Solicitud = 'Completada' WHERE ID_Solicitud = :id_solicitud";

        // Preparar la consulta
        $stmt = $pdo->prepare($actualizar);

        // Ejecutar la consulta con el parámetro
        if ($stmt->execute([':id_solicitud' => $id_solicitud])) {
            // Redirigir o mostrar un mensaje de éxito
            header('Location: index.php');
            exit;
        } else {
            $errorInfo = $stmt->errorInfo();
            echo "Error al actualizar el estado del producto: " . htmlspecialchars($errorInfo[2]);
        }
    }
}
?>
