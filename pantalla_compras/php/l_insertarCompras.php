<?php
include '../credenciales.php';
include_once('../CRUD.php');

$pdo = new CRUD($host, $dbname, $username, $pass);

$data = [
    'cantidad' => $_POST['cantidadProd'],
    'precio' => $_POST['precioProd'],
    'preveedor' => $_POST['proveedor'],
    'idDep' => $_POST['idDepartamento'],
    'detalle' => $_POST['detalleCompra'],
    'idSolicitud' => $_POST['idSolicitud'],
    'total' => $_POST['totalProducto']
];


// Insertar en la tabla compra_productos
$result = $pdo->insertCompraProducto($data);

// Actualizar el estado de la solicitud a "pendiente"
if ($result === 'Insert en compraProducto realizado con exito') {
    $updateResult = $pdo->updateEstadoSolicitud($data['idSolicitud'], 'Pendiente');
    echo json_encode(['insert' => $result, 'update' => $updateResult]);
} else {
    echo json_encode(['error' => $result]);
}