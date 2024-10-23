<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include('conexion.php'); 
include('Operaciones.php'); 

?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Producto</title>
    <link rel="stylesheet" href="css/estilo.css"> 
</head>
<body>
    <nav>
        <ul>
            <li><a href="#"> Compra producto </a></li>
            <li><a href="#">Solicitud</a></li>
            <li><a href="#">Añadir producto</a></li>
            <li><a href="#">Proveedores</a></li>
        </ul>
    </nav>

    <div class="container">
        <h2>Añadir producto</h2>
        
        <form action="Operaciones.php" method="POST"> 
            <div class="form-group">
                <label for="codigo">Código</label>
                <input type="number" id="codigo" name="codigo" placeholder="Ingrese el ID del producto" maxlength="7" required>
            </div>
            <div class="form-group">
                <label for="nombre">Nombre del Producto</label>
                <input type="text" id="nombre" name="nombre" placeholder="Ingrese el nombre del producto" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción del producto</label>
                <input type="text" id="descripcion" name="descripcion" placeholder="Ingrese los detalles del producto" required>
            </div>
            <div class="form-group">
                <label for="precio">Precio del producto</label>
                <input type="number" id="precio" name="precio" placeholder="Ingrese el precio" required>
            </div>
            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="text" id="stock" name="stock" placeholder="Ingrese el stock disponible" required>
            </div>
            <div class="form-group">
                <label for="marca">Marca</label>
                <input type="text" id="marca" name="marca" placeholder="Ingrese la marca" required>
            </div>
            <div class="form-group">
                <label for="modelo">Modelo</label>
                <input type="text" id="modelo" name="modelo" placeholder="Ingrese el modelo" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary" name="agregar">Guardar</button>
                <button type="reset" class="btn btn-secondary">Cancelar</button>
            </div>
        </form>

        </div>
    </div>
</body>
</html>
