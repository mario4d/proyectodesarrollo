<?php
include('ConexionS.php');
$enviar = "INSERT INTO Proveedores (ID_Proveedor, Nombre_Proveedor, Contacto, Direccion, Telefono) 
               VALUES (:ID_Proveedor, :Nombre_Proveedor, :Contacto, :Direccion, :Telefono)";
?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">
    <title>proveedores</title>
</head>
<body>
    <form  action="insert.php" method="post">
        <h1>agregar Proveedor</h1>
        <label for="ID_Proveedor">ID Proveedor</label>
        <input type="text" id="ID_Proveedor" name="ID_Proveedor" required>

        <label for="Nombre_Proveedor">Nombre Proveedor</label>
        <input type="text" id="Nombre_Proveedor" name="Nombre_Proveedor" required>

        <label for="Contacto">Contacto</label>
        <input type="text" id="Contacto" name="Contacto" required>

        <label for="Direccion">Direccion</label>
        <input type="text" id="Direccion" name="Direccion" required>

        <label for="Telefono">Telefono</label>
        <input type="text" id="Telefono" name="Telefono" required>

        <button id="enviar ">Enviar</button>
        </form>
  
</body>

</html>