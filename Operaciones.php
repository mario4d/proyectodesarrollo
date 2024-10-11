<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['agregar'])) {
        
        $codigo = $_POST['codigo'] ?? '';
        $nombre = $_POST['nombre'] ?? '';
        $descripcion = $_POST['descripcion'] ?? '';
        $precio = $_POST['precio'] ?? '';
        $stock = $_POST['stock'] ?? '';
        

        
        $producto = array(
            "codigo" => $codigo,
            "nombre" => $nombre,
            "descripcion" => $descripcion,
            "precio" => $precio,
            "stock" => $stock,
            
        );

        
        if (!isset($_SESSION['productos'])) {
            $_SESSION['productos'] = array();
        }

       
        $_SESSION['productos'][] = $producto;

       
        header("Location: index.php");
        exit();
    }

    if (isset($_POST['eliminar'])) {
        $indice = $_POST['indice'] ?? -1;

        
        if ($indice >= 0 && isset($_SESSION['productos'][$indice])) {
            unset($_SESSION['productos'][$indice]);
            
            $_SESSION['productos'] = array_values($_SESSION['productos']);
        }

       
        header("Location: index.php");
        exit();
    }
}
?>