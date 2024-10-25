<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- ESTILO PRINCIPAL -->
  <link rel="stylesheet" href="style.css">

  <title>Compra</title>
</head>

<body>
  <div class="navbar">
    <span>Departamento de Compra</span>
    <a href="#">Inicio</a>
    <a href="#">Acerca de</a>
    <a href="#">Servicios</a>
    <a href="#">Contacto</a>
  </div>

  <form class="formulario">
    <h1 class="tituloFormularioCompras">Compras</h1>
    <div class="listaSolicitudes sides">
      <h2>Solicitudes recibidas</h2>
      <ul id="lista">
        <!-- Los ítems se generarán aquí -->
      </ul>
    </div>

    <div class="formularioCompra sides">
      <h2>Realizar compras</h2>
      <div id="formularioCompra"></div>
    </div>
  </form>

  <script src="./main.js"></script>
</body>

</html>