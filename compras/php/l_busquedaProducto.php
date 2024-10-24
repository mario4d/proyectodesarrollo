<?php
include_once '../CRUD.php';
include_once '../credenciales.php';

$pdo = new CRUD($host, $dbname, $username, $pass);

$id = $_POST['idproducto'];
$fields = ['Codigo', 'Nombre_Producto', 'Precio_Producto', 'Departamento_ID'];

$result = $pdo->selectOne($fields, 'productos', $id);

echo json_encode($result);