<?php
include './credenciales.php';
include_once('./CRUD.php');

$pdo = new CRUD($host, $dbname, $username, $pass);

$data = [
    'idcompra' => $_POST['idcompra'],
    'idproducto' => $_POST['idproducto'],
    'cantidad' => $_POST['cantidad'],
    'precio' => $_POST['precio'],
    'idproveedor' => $_POST['idproveedor'],
    'iddepartamento' => $_POST['iddepartamento'],
    'detalle' => $_POST['detalle']
];

$result = $pdo->insertCompraProducto($data);

echo json_encode($result);
