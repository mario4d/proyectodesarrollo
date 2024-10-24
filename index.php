<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include('ConexionS.php'); 
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
        </ul>
    </nav>

    <div class="container">
        <h2>Añadir producto</h2>
        
        <form action="Operaciones.php" method="POST"> 
            <div class="form-group">
                <label for="codigo">Código</label>
                <input type="number" id="codigo" name="codigo" value="<?php echo $nuevo_codigo; ?>" readonly required>
            </div>
            <div class="form-group">
                <label for="nombre">Nombre del Producto</label>
                <input type="text" id="nombre" name="nombre" maxlength="20" placeholder="Ingrese el nombre del producto" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción del producto</label>
                <input type="text" id="descripcion" name="descripcion" maxlength="20" placeholder="Ingrese los detalles del producto" required>
            </div>
            <div class="form-group">
                <label for="precio">Precio del producto</label>
                <input type="text" id="precio" name="precio"  placeholder="Ingrese el precio" required oninput="validarNumero(this)">
            </div>
            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="text" id="stock" name="stock" placeholder="Ingrese el stock disponible" required oninput="validarNumero(this)">
            </div>
            <div class="form-group">
                <label for="marca">Marca</label>
                <input type="text" id="marca" name="marca" maxlength="20" placeholder="Ingrese la marca" required>
            </div>
            <div class="form-group">
                <label for="modelo">Modelo</label>
                <input type="text" id="modelo" name="modelo" maxlength="20" placeholder="Ingrese el modelo" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary" name="agregar">Guardar</button>
                <button type="reset" class="btn btn-secondary">Cancelar</button>
                <button type="button" onclick="window.location.href='Home.php'">Regresar</button>
            </div>
        </form>

        </div>
    </div>
</body>
</html>

<script>
        function validarNumero(input) {
            // Expresión regular que permite hasta 6 dígitos antes del punto y 2 dígitos después del punto
            const regex = /^\d{0,6}(\.\d{0,2})?$/;

            // Si el valor del input no cumple con el patrón, se limpia
            if (!regex.test(input.value)) {
                input.value = input.value.slice(0, -1);  // Elimina el último carácter ingresado
            }
        }
    </script>