<?php
require('ConexionS.php');

try {
    $stmtCount = $pdo->query("SELECT COUNT(*) as total FROM proveedores");
    $row = $stmtCount->fetch(PDO::FETCH_ASSOC);
    $ID_Proveedor = $row['total'] + 1;
} catch (PDOException $e) {
    echo "Error en la consulta para mostrar el id de los proveedores: " . $e->getMessage();
    exit();
}



?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Proveedor</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            display: flex;
            flex-direction: column;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .navbar {
            background-color: #002147;
            color: white;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            font-size: 18px;
        }
        .navbar a{
            color: white;
            margin: 0 30px;
            text-decoration: none;
            font-weight: bold;
        }

        .container {
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .formulario {
            width: 90%;
            max-width: 600px;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .formulario input {
            width: 100%;
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        .buttons-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #002147;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #004080;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <span>Departamento de compra</span>
    </div>

    <div class="container">
        <div class="formulario">
            <h2>Formulario de Proveedor</h2>

            <form action="insert.php" method="POST">
                <label for="ID_Proveedor">ID Proveedor</label>
                <input type="text" id="ID_Proveedor" name="ID_Proveedor" value=<?php echo $ID_Proveedor; ?> readonly>

                <label for="Nombre_Proveedor">Nombre del Proveedor</label>
                <input type="text" id="Nombre_Proveedor" placeholder="Ingrese el nombre del proveedor" name="Nombre_Proveedor" required>

                <label for="Correo">Correo</label>
                <input type="email" id="Correo" placeholder="Ingrese el correo del proveedor" name="Correo" required oninput="validarCorreo(this)">

                <label for="Direccion">Dirección</label>
                <input type="text" id="Direccion" placeholder="Ingrese la dirección del proveedor" name="Direccion" required>

                <label for="Telefono">Teléfono</label>
                <input type="text" id="Telefono" name="Telefono" required 
                    oninput="validarTelefono(this)" maxlength="8" placeholder="123-4567">

                <div class="buttons-container">
                    <button type="button" onclick="window.location.href='Home.php'">Regresar</button>
                    <button type="button" onclick="window.location.href='Proveedores.php'">Recargar</button>
                    <button type="submit">Enviar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function validarTelefono(input) {
            let valor = input.value.replace(/[^0-9]/g, '');
            
            if (valor.length > 3) {
                valor = valor.slice(0, 3) + '-' + valor.slice(3);
            }
            input.value = valor;
        }

        function validarCorreo(input) {
            input.value = input.value.trim();

            if (!input.value.includes('@')) {
                input.setCustomValidity("El correo debe contener un '@'.");
            } else if (!input.value.endsWith('.com')) {
                input.setCustomValidity("El correo debe terminar con '.com'.");
            } else {
                input.setCustomValidity("");
            }
        }


        <?php if (isset($_GET['mensaje'])): ?>
            <?php if ($_GET['mensaje'] === 'success'): ?>
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Proveedor registrado correctamente',
                    showConfirmButton: false,
                    timer: 1500
                });
            <?php elseif ($_GET['mensaje'] === 'error'): ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No se pudo registrar el proveedor. Intente nuevamente.',
                });
            <?php endif; ?>
        <?php endif; ?>
    </script>

</body>
</html>
