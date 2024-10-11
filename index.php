<!DOCTYPE html>
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
            <li><a href="#">Inicio</a></li>
            <li><a href="#">Acerca de</a></li>
            <li><a href="#">Servicios</a></li>
            <li><a href="#">Contacto</a></li>
        </ul>
    </nav>

    <div class="container">
        <h2>Añadir producto</h2>
        
        <form action="Operaciones.php" method="POST">
            <div class="form-group">
                <label>Código</label>
                <input type="number" name="id" placeholder="Ingrese el ID del producto" maxlength="7" required>
            </div>
            <div class="form-group">
                <label>Nombre del Producto</label>
                <input type="text" name="nombre" placeholder="Ingrese el nombre del producto" required>
            </div>
            <div class="form-group">
                <label>Descripción del producto</label>
                <input type="text" name="detalle" placeholder="Ingrese los detalles del producto" required>
            </div>
            <div class="form-group">
                <label>Precio del producto</label>
                <input type="number" name="precio" placeholder="Ingrese el precio" required>
            </div>
            <div class="form-group">
                <label>Stock</label>
                <input type="text" name="nproveedor" placeholder="Ingrese el nombre del proveedor" required>
            </div>
            <div class="form-group">
                <label>ID proveedor</label>
                <input type="number" name="id_proveedor" placeholder="Ingrese el ID del proveedor" required>
            </div>
            <div class="form-group">
                <label>Nombre de proveedor</label>
                <input type="text" name="nombre_proveedor" placeholder="Ingrese el nombre del proveedor" required>
            </div>
            <div class="form-group">
                <label>Teléfono del proveedor</label>
                <input type="number" name="telefono_proveedor" placeholder="Ingrese el teléfono del proveedor" required>
            </div>
            <div class="form-group">
                <label>Email del proveedor</label>
                <input type="email" name="email_proveedor" placeholder="Ingrese el email del proveedor" required>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary" name="agregar">Guardar</button>
                <button type="reset" class="btn btn-secondary">Cancelar</button>
            </div>
            
            <br>
            <h2 class="text-center">Productos añadidos</h2>
        </form>

        <div>
            <table>
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Depreciación</th>
                        <th>Stock</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'Operaciones.php';
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
