<?php
include_once '../CRUD.php';
include_once '../credenciales.php';

$pdo = new CRUD($host, $dbname, $username, $pass);

$fields = ['ID_Solicitud', 'Descripcion_Solicitud', 'Cantidad_Solicitada', 'ID_Departamento', 'Estado_Solicitud'];

$result = $pdo->selectOne($fields, 'solicitudes_producto', "Estado_Solicitud = 'Enviado'");

$processedResults = [];

// Recorremos cada fila del resultado de las solicitudes
foreach ($result as $row) {
    // Obtenemos el ID del departamento
    $idDepartamento = $row['ID_Departamento'];
    
    // Realizamos una consulta para obtener el nombre del departamento
    $resultDep = $pdo->selectOne(['Nombre_Departamento'], 'departamentos', 'ID_Departamento = ' . $idDepartamento);
    
    // Verificamos que se haya encontrado el nombre del departamento
    if ($resultDep && count($resultDep) > 0) {
        $nombreDepartamento = $resultDep[0]['Nombre_Departamento'];
    } else {
        $nombreDepartamento = null; // O un valor por defecto si no se encuentra
    }
    
    // Agregamos los datos al array procesado
    $processedResults[] = [
        'ID_Solicitud' => $row['ID_Solicitud'],
        'Descripcion_Solicitud' => $row['Descripcion_Solicitud'],
        'Cantidad_Solicitada' => $row['Cantidad_Solicitada'],
        'ID_Departamento' => $idDepartamento,
        'Nombre_Departamento' => $nombreDepartamento, // Incluimos el nombre del departamento
        'Estado_Solicitud' => $row['Estado_Solicitud'],
    ];
}

// Codificamos el resultado procesado en JSON
echo json_encode($processedResults);
