<?php

include 'ConexionS.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ID_Proveedor = $_POST['ID_Proveedor'];
    $Nombre_Proveedor = $_POST['Nombre_Proveedor'];
    $Contacto = $_POST['Correo'];
    $Direccion = $_POST['Direccion'];
    $Telefono = $_POST['Telefono'];

    $sql = "INSERT INTO Proveedores (ID_Proveedor, Nombre_Proveedor, Contacto, Direccion, Telefono)
            VALUES (:id_proveedor, :nombre_proveedor, :correo_proveedor, :direccion_proveedor, :telefono_proveedor)";
    $stmt = $pdo ->prepare($sql);

    $stmt->bindParam(':id_proveedor', $ID_Proveedor);
    $stmt->bindParam(':nombre_proveedor', $Nombre_Proveedor);
    $stmt->bindParam(':correo_proveedor', $Contacto);
    $stmt->bindParam(':direccion_proveedor', $Direccion);
    $stmt->bindParam(':telefono_proveedor', $Telefono);


    try {
        if ($stmt->execute()) {
            header("Location: Proveedores.php?mensaje=success");
            exit();
        } else {
            header("Location: Proveedores.php?mensaje=error");
            exit();
        }
    } catch (PDOException $e) {
        header("Location: Proveedores.php?mensaje=error&detalles=" . urlencode($e->getMessage()));
        exit();
    }

}
?>