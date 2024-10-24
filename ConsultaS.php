<?php
include 'Conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_solicitud = $_POST['id_solicitud'];
    $fecha_solicitud = $_POST['fecha_solicitud'];
    $nombre_producto = $_POST['nombre_producto'];
    $marca_producto = $_POST['marca_producto'];
    $modelo_producto = $_POST['modelo_producto'];
    $cantidad_solicitada = $_POST['cantidad_producto'];
    $motivo_solicitud = $_POST['motivo_solicitud'];
    $departamento = $_POST['departamento'];
    $estado_solicitud = $_POST['estado_solicitud'];

    $descripcion_solicitud = $nombre_producto . ", " . $marca_producto . ", " . $modelo_producto;


    $sql = "INSERT INTO solicitudes_producto (ID_Solicitud, Fecha_Solicitud, Descripcion_Solicitud, Cantidad_Solicitada, Motivo_Solicitud, ID_Departamento, Estado_Solicitud) 
            VALUES (:id_solicitud, :fecha_solicitud, :descripcion_solicitud, :cantidad_solicitada, :motivo_solicitud, :departamento, :estado_solicitud)";
    $stmt = $pdo->prepare($sql);
    
    $stmt->bindParam(':id_solicitud', $id_solicitud);
    $stmt->bindParam(':fecha_solicitud', $fecha_solicitud);
    $stmt->bindParam(':descripcion_solicitud', $descripcion_solicitud);
    $stmt->bindParam(':cantidad_solicitada', $cantidad_solicitada);
    $stmt->bindParam(':motivo_solicitud', $motivo_solicitud);
    $stmt->bindParam(':departamento', $departamento);
    $stmt->bindParam(':estado_solicitud', $estado_solicitud);

    try {
        if ($stmt->execute()) {
            header("Location: Solicitud.php?mensaje=success");
            exit();
        } else {
            header("Location: Solicitud.php?mensaje=error");
            exit();
        }
    } catch (PDOException $e) {
        header("Location: Solicitud.php?mensaje=error&detalles=" . urlencode($e->getMessage()));
        exit();
    }
}
?>

