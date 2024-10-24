<?php
include_once '../CRUD.php';
include_once '../credenciales.php';

$pdo = new CRUD($host, $dbname, $username, $pass);
$fields = ['ID_Departamento', 'Nombre_Departamento'];
$table = 'departamentos';

$response = $pdo->selectAll($fields, $table);

echo json_encode($response);