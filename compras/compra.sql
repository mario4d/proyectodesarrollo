-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS proyecto_db;
USE proyecto_db;

-- Crear tabla proveedores
CREATE TABLE proveedores (
    ID_Proveedor INT PRIMARY KEY AUTO_INCREMENT,
    Nombre_Proveedor VARCHAR(100),
    Contacto VARCHAR(100),
    Direccion VARCHAR(100),
    Telefono VARCHAR(15)
);

-- Crear tabla departamentos
CREATE TABLE departamentos (
    ID_Departamento INT PRIMARY KEY AUTO_INCREMENT,
    Nombre_Departamento VARCHAR(50) NOT NULL,
    Especificacion_Departamento VARCHAR(150),
    Ubicacion_Departamento VARCHAR(100),
    Jefe_Departamento VARCHAR(20)
);

-- Crear tabla productos
CREATE TABLE productos (
    Codigo INT PRIMARY KEY AUTO_INCREMENT,
    Nombre_Producto VARCHAR(100),
    Descripcion_Producto VARCHAR(255),
    Precio_Producto DECIMAL(10,2),
    Depreciacion_Producto DECIMAL(10,2),
    Departamento_ID INT,
    FOREIGN KEY (Departamento_ID) REFERENCES departamentos(ID_Departamento)
);

-- Crear tabla compra_productos
CREATE TABLE compra_productos (
    ID_Compra INT PRIMARY KEY AUTO_INCREMENT,
    Codigo_Producto INT,
    Cantidad_Producto INT,
    Precio_Producto DECIMAL(10,2),
    Proveedor_ID INT,
    Departamento_ID INT,
    Detalle_Producto TEXT,
    FOREIGN KEY (Codigo_Producto) REFERENCES productos(Codigo),
    FOREIGN KEY (Proveedor_ID) REFERENCES proveedores(ID_Proveedor),
    FOREIGN KEY (Departamento_ID) REFERENCES departamentos(ID_Departamento)
);
