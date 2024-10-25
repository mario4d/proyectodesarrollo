<?php
include_once '../CRUD.php';
include_once '../credenciales.php';

$pdo = new CRUD($host, $dbname, $username, $pass);
$fields = ['ID_Proveedor', 'Nombre_Proveedor'];
$table = 'proveedores';

$response = $pdo->selectAll($fields, $table);

echo json_encode($response);