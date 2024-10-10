<?php
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['agregar'])) {
        
        $nombre = $_POST['Codigo'] ?? '';
        $cantidad = $_POST[''] ?? '';
        $precio = $_POST['precio'] ?? '';
        $detalle = $_POST['detalle'] ?? '';
        $id = $_POST['id'] ?? '';
        $nproveedor = $_POST['nproveedor'] ?? '';
        $ndepartamento = $_POST['ndepartamento'] ?? '';

        
        $producto = array(
            "nombre" => $nombre,
            "cantidad" => $cantidad,
            "precio" => $precio,
            "detalle" => $detalle,
            "id" => $id,
            "nproveedor" => $nproveedor,
            "ndepartamento" => $ndepartamento
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


if (!empty($_SESSION['productos'])) {
    foreach ($_SESSION['productos'] as $indice => $producto) {
        echo "<tr>
                <td>{$producto['nombre']}</td>
                <td>{$producto['cantidad']}</td>
                <td>{$producto['precio']}</td>
                <td>{$producto['detalle']}</td>
                <td>{$producto['id']}</td>
                <td>{$producto['nproveedor']}</td>
                <td>{$producto['ndepartamento']}</td>
                <td>
                    <form action='Operaciones.php' method='POST' style='display:inline;'>
                        <input type='hidden' name='indice' value='{$indice}'>
                        <button type='submit' name='eliminar' class='btn btn-danger'>Eliminar</button>
                    </form>
                </td>
            </tr>";
    }
}
?>
