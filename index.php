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
        
        <form action="index.php" method="POST">
            <div class="form-group">
                <label>Código</label>
                <input type="number" name="codigo" placeholder="Ingrese el ID del producto" maxlength="7" required>
            </div>
            <div class="form-group">
                <label>Nombre del Producto</label>
                <input type="text" name="nombre" placeholder="Ingrese el nombre del producto" required>
            </div>
            <div class="form-group">
                <label>Descripción del producto</label>
                <input type="text" name="descripcion" placeholder="Ingrese los detalles del producto" required>
            </div>
            <div class="form-group">
                <label>Precio del producto</label>
                <input type="number" name="precio" placeholder="Ingrese el precio" required>
            </div>
            <div class="form-group">
                <label>Stock</label>
                <input type="text" name="stock" placeholder="Ingrese el stock disponible" required>
            </div>
            <div class="form-group">
                <label>Marca</label>
                <input type="number" name="marca" placeholder="Ingrese la marcar" required>
            </div>
            <div class="form-group">
                <label>Modelo</label>
                <input type="text" name="modelo" placeholder="Ingrese el modelo" required>
            </div>
            
        </form>

        <br>
        <h2 class="text-center">Productos añadidos</h2>

        <div>
            <table>
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($_SESSION['productos'])) {
                        foreach ($_SESSION['productos'] as $indice => $producto) {
                            echo "<tr>
                                    <td>{$producto['codigo']}</td>
                                    <td>{$producto['nombre']}</td>
                                    <td>{$producto['descripcion']}</td>
                                    <td>{$producto['precio']}</td>
                                    <td>{$producto['stock']}</td>
            
                                    <td>
                                        <form action='index.php' method='POST' style='display:inline;'>
                                            <input type='hidden' name='indice' value='{$indice}'>
                                            <button type='submit' name='eliminar' class='btn btn-danger'>Eliminar</button>
                                        </form>
                                    </td>
                                </tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>