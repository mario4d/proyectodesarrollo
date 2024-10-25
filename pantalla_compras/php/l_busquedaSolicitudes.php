<?php
include_once '../CRUD.php';
include_once '../credenciales.php';

$pdo = new CRUD($host, $dbname, $username, $pass);

$fields = ['ID_Solicitud', 'Descripcion_Solicitud', 'Cantidad_Solicitada', 'ID_Departamento', 'Estado_Solicitud'];

$result = $pdo->selectOne($fields, 'solicitudes_producto', "Estado_Solicitud = 'Enviado'");

$processedResults = [];


foreach ($result as $row) {
    
    $idDepartamento = $row['ID_Departamento'];
    
    
    $resultDep = $pdo->selectOne(['Nombre_Departamento'], 'departamentos', 'ID_Departamento = ' . $idDepartamento);
    
    
    if ($resultDep && count($resultDep) > 0) {
        $nombreDepartamento = $resultDep[0]['Nombre_Departamento'];
    } else {
        $nombreDepartamento = null; 
    }
    
    
    $processedResults[] = [
        'ID_Solicitud' => $row['ID_Solicitud'],
        'Descripcion_Solicitud' => $row['Descripcion_Solicitud'],
        'Cantidad_Solicitada' => $row['Cantidad_Solicitada'],
        'ID_Departamento' => $idDepartamento,
        'Nombre_Departamento' => $nombreDepartamento, 
        'Estado_Solicitud' => $row['Estado_Solicitud'],
    ];
}


echo json_encode($processedResults);
