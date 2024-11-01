<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Departamento de Compra</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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

        .navbar span {
            margin-right: auto;
            font-weight: bold;
            font-size: 20px;
            margin: 0 30px;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
            gap: 20px; /* Espacio entre los cuadros */
        }

        .cuadro {
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 45%; /* Dos cuadros en fila */
            height: 300px; 
            padding: 30px; 
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .cuadro:hover {
            transform: scale(1.05); 
        }

        /* Responsivo para pantallas más pequeñas */
        @media (max-width: 768px) {
            .cuadro {
                width: 100%; /* Apilar los cuadros en pantallas pequeñas */
            }
        }

        h2 {
            margin: 0;
            color: #002147;
        }
        p {
            color: #555;
            margin: 10px 0;
        }
        button {
            margin-top: 10px;
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
    </div>

    <div class="container">
        <div class="cuadro">
            <h2>Realizar Solicitud</h2>
            <p></p>
            <button onclick="window.location.href='Solicitud.php'">Realizar Solicitud</button>
            <i class="fas fa-file-alt fa-2x" style="margin-top: 10px;"></i>
        </div>

        <div class="cuadro">
            <h2>Realizar Compra</h2>
            <p></p>
            <button onclick="window.location.href='pantalla_compras/p_compras.php'">Realizar Compra</button>
            <i class="fas fa-shopping-cart fa-2x" style="margin-top: 10px;"></i>
        </div>

        <div class="cuadro">
            <h2>Añadir Producto</h2>
            <p></p>
            <button onclick="window.location.href='index.php'">Añadir Producto</button>
            <i class="fas fa-box-open fa-2x" style="margin-top: 10px;"></i>
        </div>

        <div class="cuadro">
            <h2>Añadir Proveedor</h2>
            <p></p>
            <button onclick="window.location.href='Proveedores.php  '">Añadir Proveedor</button>
            <i class="fas fa-truck fa-2x" style="margin-top: 10px;"></i>
        </div>
    </div>

</body>
</html>
