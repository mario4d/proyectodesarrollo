<?php
$servername = "localhost";
$username = "userdb";
$password = "passworddb";
$database = "proyecto_db";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
$ID_Proveedor = $_POST['ID_Proveedor'];
$Nombre_Proveedor = $_POST['Nombre_Proveedor'];
$Contacto = $_POST['Contacto'];
$Direccion = $_POST['Direccion'];
$Telefono = $_POST['Telefono'];
$stmt = $conn->prepare("INSERT INTO Proveedores (ID_Proveedor, Nombre_Proveedor, Contacto, Direccion, Telefono) VALUES (ID_Proveedor, Nombre_Proveedor, Contacto, Direccion, Telefono)");
$stmt->bind_param("si", $ID_Proveedor, $Nombre_Proveedor, $Contacto, $Direccion; $Telefono); // "si" significa string y integer
if ($stmt->execute()) {
    echo "Nuevo registro creado exitosamente";
} else {
    echo "Error: " . $stmt->error;
}
$stmt->close();
$conn->close();
?>