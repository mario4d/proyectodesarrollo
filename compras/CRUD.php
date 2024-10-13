<?php
class CRUD {
    private $pdo;

    // CONSTRUCTOR
    public function __construct($host, $dbname, $username, $password) {
        try {
            $dsn = "mysql:host=$host;dbname=$dbname";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO:: ATTR_EMULATE_PREPARES => false
            ];
            $this->pdo = new PDO($dsn, $username, $password, $options);

            //echo ('[ ' . $dsn . ' '. $username . $password . '] La conexion funciona correctamente');

        } catch (PDOException $e) {
            //echo ('Ocurrio un error en la conexion: ' . $e->getMessage());
        }
    }

    // INSERT FUNCTIONS
    public function insertCompraProducto($values) {
        $query = 'INSERT INTO compra_productos (ID_Compra, Codigo_Producto, Cantidad_Producto, Precio_Producto, Proveedor_ID, Departamento_ID, Detalle_Producto) VALUES (?, ?, ?, ?, ?, ?, ?)';
        
        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(1, $values['idcompra'],       PDO::PARAM_INT);
        $stmt->bindParam(2, $values['idproducto'],     PDO::PARAM_INT);
        $stmt->bindParam(3, $values['cantidad'],       PDO::PARAM_INT);
        $stmt->bindParam(4, $values['precio'],         PDO::PARAM_STR);
        $stmt->bindParam(5, $values['idproveedor'],    PDO::PARAM_INT);
        $stmt->bindParam(6, $values['iddepartamento'], PDO::PARAM_INT);
        $stmt->bindParam(7, $values['detalle'],        PDO::PARAM_STR);
        try {
            $stmt->execute();
            return 'Insert en compraProducto realizado con exito';
        } catch (PDOException $e) {
            return 'Ocurrio un error al insertar: ' . $e->getMessage();
        }
    }
        // INSERTS PARA CADA TABLA ...


    // SELECT FUNCTIONS
    public function selectCompraProducto($fields, $table, $id) {
        $processedFields = implode(', ', $fields);
    }


    // UPDATE FUNCTIONS
    public function updateCompraProducto() {}


    // DELETE FUNCTIONS
    public function deleteCompraProducto() {}


    // READALL FUNCTIONS
    public function selectAllCompraProducto() {}
}
?>