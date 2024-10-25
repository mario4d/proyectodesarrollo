<?php 
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
<div class="container">
    <div class="left-side">
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
                <input type="text" id="descripcion" name="descripcion" maxlength="70" placeholder="Ingrese los detalles del producto" required>
            </div>
            <div class="form-group">
                <label for="precio">Precio del producto</label>
                <input type="text" id="precio" name="precio" placeholder="Ingrese el precio" required oninput="validarNumero(this)">
            </div>
            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="text" id="stock" name="stock" placeholder="Ingrese el stock disponible" maxlength="7" required oninput="validarEntrada(this)">
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
                <button type="button" class="btn btn-regresar" onclick="window.location.href='Home.php'">Regresar</button>
            </div>
        </form>
    </div>

    <div class="right-side">
        <h2>Productos Completados</h2>
        <table>
            <thead>
                <tr>
                    <th>marca | modelo | nombre</th>
                    <th>Precio del Producto</th>
                    <th>Cantidad</th> <!-- Nueva columna para la cantidad -->
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $productosPendientes->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['Detalle_Producto']); ?></td>
                        <td><?php echo htmlspecialchars($row['Precio_Producto']); ?></td>
                        <td><?php echo htmlspecialchars($row['Cantidad_Producto']); ?></td> <!-- Mostrar la cantidad -->
                        <td>
                            <form action="Operaciones.php" method="POST" style="display:inline;">
                                <input type="hidden" name="id_solicitud" value="<?php echo htmlspecialchars($row['ID_Solicitud']); ?>">
                                <button type="submit" name="actualizar_estado" class="btn btn-success">Actualizar Estado</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function validarNumero(input) {
        const regex = /^\d{0,6}(\.\d{0,2})?$/;

        if (!regex.test(input.value)) {
            input.value = input.value.slice(0, -1);  // Elimina el último carácter ingresado
        }
    }
    function validarEntrada(input) {
        // Elimina caracteres no numéricos
        input.value = input.value.replace(/[^0-9]/g, '');
    }
</script>

</body>
</html>
