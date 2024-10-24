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
  <form>
    <h1>Compras</h1>
    <div>
      <label for="idproducto">Codigo de producto</label>
      <input type="text" id="idproducto">
      <button id="buscar-producto">buscar</button>
    </div>

    <label id="mostrar-nombrepr">Nombre del producto: </label>

    <label id="mostrar-preciopr">Precio del producto: </label>

    <label id="mostrar-proveedor">Proveedor: </label>

    <label id="mostrar-departamento">Departamento: </label>

    <label for="cantidad">Cantidad de producto</label>
    <input type="text" id="cantidad">

    <label for="detalle">Detalle de producto</label>
    <input type="text" id="detalle">

    <button id="enviar">Enviar</button>
  </form>
  <script src="./main.js"></script>
</body>

</html>