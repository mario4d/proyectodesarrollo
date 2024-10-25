<?php
include('ConexionS.php');

// Función para obtener productos pendientes
function obtenerProductosPendientes($pdo) {
    $query = "SELECT cp.Detalle_Producto, cp.Precio_Producto, cp.Cantidad_Producto, sp.ID_Solicitud, cp.Proveedor_ID
              FROM compra_productos cp
              JOIN solicitudes_producto sp ON cp.ID_Solicitud = sp.ID_Solicitud
              WHERE sp.Estado_Solicitud = 'Pendiente'";
    return $pdo->query($query);
}

// Contar el número de filas en la tabla productos para determinar el nuevo código
$query = "SELECT COUNT(*) as total_filas FROM productos";
$result = $pdo->query($query);
$row = $result->fetch(PDO::FETCH_ASSOC);

if ($row['total_filas'] > 0) {
    $nuevo_codigo = $row['total_filas'] + 1;
} else {
    $nuevo_codigo = 1; 
}

// Obtener productos pendientes
$productosPendientes = obtenerProductosPendientes($pdo); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Agregar un nuevo producto
    if (isset($_POST['agregar'])) {
        $codigo = $nuevo_codigo;
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
        $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
        $precio = isset($_POST['precio']) ? $_POST['precio'] : '';
        $stock = isset($_POST['stock']) ? $_POST['stock'] : '';
        $marca = isset($_POST['marca']) ? $_POST['marca'] : '';
        $modelo = isset($_POST['modelo']) ? $_POST['modelo'] : '';
        
        // Obtener el Proveedor_ID de la consulta
        $proveedor_id = null; // Inicializa la variable

        // Si hay productos pendientes, obtener el Proveedor_ID del primero
        if ($productosPendientes->rowCount() > 0) {
            $productoPendiente = $productosPendientes->fetch(PDO::FETCH_ASSOC);
            $proveedor_id = $productoPendiente['Proveedor_ID']; // Guarda el Proveedor_ID
        }

        // Inserción en la tabla productos, incluyendo ID_Proveedor
        $enviar = "INSERT INTO productos (Codigo, Nombre_Producto, Descripcion_Producto, Precio_Producto, Stock, Marca, Modelo, ID_Proveedor) 
                   VALUES (:codigo, :nombre, :descripcion, :precio, :stock, :marca, :modelo, :proveedor_id)";

        $stmt = $pdo->prepare($enviar);

        if ($stmt->execute([
            ':codigo' => $codigo,
            ':nombre' => $nombre,
            ':descripcion' => $descripcion,
            ':precio' => $precio,
            ':stock' => $stock,
            ':marca' => $marca,
            ':modelo' => $modelo,
            ':proveedor_id' => $proveedor_id // Inserta el Proveedor_ID
        ])) {
            header('Location: index.php'); // Redirige al index después de la inserción
            exit;
        } else {
            $errorInfo = $stmt->errorInfo();
            echo "Error al registrar el producto en la base de datos: " . htmlspecialchars($errorInfo[2]);
        }
    }

    // Actualizar el estado de una solicitud
    if (isset($_POST['actualizar_estado'])) {
        $id_solicitud = isset($_POST['id_solicitud']) ? $_POST['id_solicitud'] : '';

        $actualizar = "UPDATE solicitudes_producto SET Estado_Solicitud = 'Completada' WHERE ID_Solicitud = :id_solicitud";

        $stmt = $pdo->prepare($actualizar);

        if ($stmt->execute([':id_solicitud' => $id_solicitud])) {
            header('Location: index.php'); // Redirige al index después de la actualización
            exit;
        } else {
            $errorInfo = $stmt->errorInfo();
            echo "Error al actualizar el estado del producto: " . htmlspecialchars($errorInfo[2]);
        }
    }
}
?>
