<?php
require 'ConexionS.php';

try {
    $query = "SELECT ID_Departamento, Nombre_Departamento FROM departamentos";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
} catch (PDOException $e) {
    echo "Error en la consulta para mostrar los departamentos: " . $e->getMessage();
    exit();
}

try {
    $stmtCount = $pdo->query("SELECT COUNT(*) as total FROM solicitudes_producto");
    $row = $stmtCount->fetch(PDO::FETCH_ASSOC);
    $id_solicitud = $row['total'] + 1;
} catch (PDOException $e) {
    echo "Error en la consulta para mostrar el id de solicitud: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Departamento de Compra - Realizar Solicitud</title>
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
        .navbar a {
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
            width: 90%; /* Ajustado a un 90% para mejor ajuste */
            max-width: 600px; /* Tamaño máximo para pantallas grandes */
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .formulario input, 
        .formulario select {
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
        <span>Departamento de Compra</span>
        <a href="#">Inicio</a>
        <a href="#">Acerca de</a>
        <a href="#">Servicios</a>
        <a href="#">Contacto</a>
    </div>

    <div class="container">
        <div class="formulario">
            <h2>Formulario de Solicitud</h2>

            <form action="ConsultaS.php" method="POST">
                <label>ID de Solicitud</label>
                <input type="text" name="id_solicitud" value=<?php echo $id_solicitud; ?> readonly>

                <label>Fecha de Solicitud</label>
                <input type="date" name="fecha_solicitud" required>

                <label>Motivo de Solicitud</label>
                <input type="text" placeholder="Escriba el motivo de su solicitud" name="motivo_solicitud" required>

                <label>Nombre del Producto</label>
                <input type="text" placeholder="Escriba el nombre del producto" name="nombre_producto" required>

                <label>Marca del Producto</label>
                <input type="text" placeholder="Escriba la marca del producto" name="marca_producto" required>

                <label>Modelo del Producto</label>
                <input type="text" placeholder="Escriba el modelo del producto" name="modelo_producto" required>

                <label>Cantidad Solicitada</label>
                <input type="text" id="cantidad" placeholder="Coloque la cantidad que esta solicitando" name="cantidad_producto" required oninput="validarEntrada(this)">

                <label>Departamento Proveniente</label>
                <select name="departamento" required>
                    <?php
                        try {
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                $id = $row['ID_Departamento'];
                                $nombre = $row['Nombre_Departamento'];
                                echo "<option value='$id'>$nombre</option>";
                            }
                        } catch (Exception $e) {
                            echo "<option>Error al cargar departamentos</option>";
                        }
                    ?>
                </select>

                <label>Estado de Solicitud</label>
                <input type="text" value="Pendiente" name="estado_solicitud" readonly>

                <div class="buttons-container">
                    <button type="button" onclick="window.location.href='Home.php'">Regresar</button>
                    <button type="button" onclick="window.location.href='Solicitud.php'">Recargar</button>
                    <button type="submit">Enviar Solicitud</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function validarEntrada(input) {
            // Elimina caracteres no numéricos
            input.value = input.value.replace(/[^0-9]/g, '');
        }
    </script>
    <?php
        if (isset($_GET['mensaje'])) {
            if ($_GET['mensaje'] === 'success') {
                echo "<script>
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 1500
                    });
                </script>";
            } elseif ($_GET['mensaje'] === 'error') {
                $detalles = isset($_GET['detalles']) ? htmlspecialchars($_GET['detalles']) : 'Something went wrong!';
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: '$detalles',
                    });
                </script>";
            }
        }
    ?>
</body>
</html>
