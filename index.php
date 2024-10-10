<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Producto</title>
    <link rel="stylesheet" href="css/estilo.css">                  
</head>
<body>
    <div class="container">
        <h2>Añadir producto</h2>
        
        
        <form action="Operaciones.php" method="POST">
            <table>
                <thead>
                    <tr>
                        <th>Código</th>
                        <td><input type="number" name="id" placeholder="Ingrese el ID del producto" required></td>
                    </tr>
                    <tr>
                        <th>Nombre del Producto</th>
                        <td><input type="text" name="nombre" placeholder="Ingrese el nombre del producto" required></td>
                    </tr>
                    <tr>
                        <th>Descripción del producto</th>
                        <td><input type="text" name="detalle" placeholder="Ingrese los detalles del producto" required></td>
                    </tr>
                    <tr>
                        <th>Precio del producto</th>
                        <td><input type="number" name="precio" placeholder="Ingrese el precio" required></td>
                    </tr>
                    <tr>
                        <th>Depreciación del producto</th>
                        <td><input type="number" name="cantidad" placeholder="Ingrese la cantidad" required></td>
                    </tr>
                    
                    <tr>
                        <th>Stock</th>
                        <td><input type="text" name="nproveedor" placeholder="Ingrese el nombre del proveedor" required></td>
                    </tr>
                    
                </thead>
            </table>

            <div class="text-center">
                <button type="submit" class="btn btn-primary" name="agregar">Guardar</button>
                <button type="reset" class="btn btn-secondary">Cancelar</button>
            </div>
            
            <br>
            <h2 class="text-center">Productos añadidos</h2>
        </form>

        
        <div>
            <table border="1" width="100%">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
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
