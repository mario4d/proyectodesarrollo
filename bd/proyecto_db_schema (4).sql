-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS proyecto_db;
USE proyecto_db;

-- Crear tabla metodos_pago_cobro
CREATE TABLE metodos_pago_cobro (
    ID_Metodo INT PRIMARY KEY AUTO_INCREMENT,
    Nombre ENUM('Efectivo', 'Cheque') NOT NULL
);
INSERT INTO metodos_pago_cobro ( Nombre)
VALUES ('Efectivo'),('Cheque');

-- Crear tabla clientes
CREATE TABLE clientes (
    ID_Cliente INT PRIMARY KEY AUTO_INCREMENT,
    Nombre_Cliente VARCHAR(100),
    Contacto VARCHAR(100),
    Direccion VARCHAR(100),
    Telefono VARCHAR(15)
);

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
INSERT INTO departamentos (Nombre_Departamento, Especificacion_Departamento, Ubicacion_Departamento, Jefe_Departamento)
VALUES ('Tecnologia', 'Departamento de Tecnologia', 'Edificio A - Piso 2', '8-1009-525'),
('Contabilidad', 'Departamento de Contabilidad', 'Edificio B - Piso 3', 'Ram Singh'),
('Bienes Patrimoniales', 'Departamento de Bienes Patrimoniales', 'Edificio C - Piso 1', 'Josue Estrada'),
('Recursos Humanos', 'Departamento de Recursos Humanos', 'Edificio D - Piso 2', 'Alberto Rangel'),
('Compra', 'Departamento de Compras', 'Edificio E - Piso 4', 'Mario Duque');


-- Crear tabla productos
CREATE TABLE productos (
    Codigo INT PRIMARY KEY AUTO_INCREMENT,
    Nombre_Producto VARCHAR(100),
    Descripcion_Producto VARCHAR(255),
    Precio_Producto DECIMAL(10,2),
    Stock Int,
    motivo_Solicitud VARCHAR (255),
    Marca VARCHAR(100),
    Modelo VARCHAR(100),
    ID_Proveedor INT,
    FOREIGN KEY (ID_Proveedor) REFERENCES proveedores(ID_Proveedor)
);
-- Tabla provincia
CREATE TABLE `provincia` (
  `codigo_provincia` varchar(2) NOT NULL,
  `nombre_provincia` varchar(50) NOT NULL,
  PRIMARY KEY (`codigo_provincia`)
) ;
ALTER TABLE `provincia`
  ADD UNIQUE KEY `codigo_provincia` (`codigo_provincia`);
COMMIT;
-- Tabla distrito
CREATE TABLE `distrito` (
  `codigo_provincia` varchar(2) NOT NULL,
  `codigo_distrito` varchar(4) NOT NULL,
  `codigo` varchar(2) NOT NULL,
  `nombre_distrito` varchar(150) NOT NULL,
  PRIMARY KEY (`codigo_distrito`)
);
ALTER TABLE `distrito`
  ADD UNIQUE KEY `llave` (`codigo_distrito`);
COMMIT;


-- Tabla corregimiento
CREATE TABLE `corregimiento` (
  `codigo_provincia` varchar(2) NOT NULL,
  `codigo_distrito` varchar(4) NOT NULL,
  `codigo` varchar(2) NOT NULL,
  `codigo_corregimiento` varchar(6) NOT NULL,
  `nombre_corregimiento` varchar(150) NOT NULL,
  PRIMARY KEY (`codigo_corregimiento`)
) ;
ALTER TABLE `corregimiento`
  ADD UNIQUE KEY `unico` (`codigo_corregimiento`);
COMMIT;
-- Tabla empleados
CREATE TABLE empleados (
    Cedula VARCHAR(20) PRIMARY KEY,
    Nombre VARCHAR(50) NOT NULL,
    Segundo_Nombre VARCHAR(50),
    Apellido VARCHAR(50) NOT NULL,
    Segundo_Apellido VARCHAR(50),
    Genero TINYINT,
    Usa_AC TINYINT,
    Estado_Civil TINYINT,
    Apellido_Casada VARCHAR(50),
    Departamento_ID INT,
    Correo VARCHAR(100),
    Telefono VARCHAR(15),
    codigo_provincia VARCHAR(2),
    codigo_distrito VARCHAR(4),
    codigo_corregimiento VARCHAR(6),
    FOREIGN KEY (Departamento_ID) REFERENCES departamentos(ID_Departamento)
);
INSERT INTO empleados (
    Cedula, Nombre, Segundo_Nombre, Apellido, Segundo_Apellido, 
    Genero, Usa_AC, Estado_Civil, Apellido_Casada, 
    Departamento_ID, Correo, Telefono, codigo_provincia, codigo_distrito, codigo_corregimiento
) 
VALUES (
    '8-1009-525', 'Brayan', 'Bladimir', 'Rodriguez', 'Rodriguez', 
    1, -- Genero: 1 para hombre
    0, -- Usa_AC: 0 (no tiene apellido de casado)
    0, -- Estado_Civil: no se especificó
    NULL, -- Apellido_Casada: no aplica
    (SELECT ID_Departamento FROM departamentos WHERE Nombre_Departamento = 'Tecnologia'), 
    'brayan.rodriguez2@utp.ac.pa', 
    '6444-1636', -- Teléfono
    (SELECT codigo_provincia FROM provincia WHERE nombre_provincia = 'Panama Oeste'), -- Código de provincia
    (SELECT codigo_distrito FROM distrito WHERE nombre_distrito = 'La Chorrera'), -- Código de distrito
    (SELECT codigo_corregimiento FROM corregimiento WHERE nombre_corregimiento = 'Barrio Colon') -- Código de corregimiento
);


-- Agregar la clave foránea en la tabla departamentos;
-- Relacionar departamentos con empleados mediante un ALTER TABLE
ALTER TABLE empleados
ADD CONSTRAINT FK_Empleados_Departamento
FOREIGN KEY (Departamento_ID) REFERENCES departamentos(ID_Departamento);
-- Crear tabla cheques
CREATE TABLE cheques (
    ID_Cheque INT PRIMARY KEY AUTO_INCREMENT,
    Numero_Cheque VARCHAR(50) UNIQUE,
    Fecha_Emision DATE,
    Fecha_Cobro DATE,
    Monto DECIMAL(10,2),
    Estado ENUM('Emitido', 'Anulado', 'Cobrado', 'Pendiente') NOT NULL,
    Proveedor INT,
    Comentarios TEXT,
    FOREIGN KEY (Proveedor) REFERENCES proveedores(ID_Proveedor)
);

-- Crear tabla cuentas_x_pagar
CREATE TABLE cuentas_x_pagar (
    ID_Factura INT PRIMARY KEY,
    Proveedor_ID INT,
    Fecha_Emision DATE,
    Fecha_Vencimiento DATE,
    Monto_Pagar DECIMAL(10,2),
    Estado_Pago ENUM('Pendiente', 'Pagado') NOT NULL,
    ID_Metodo INT,
    ID_Cheque INT,
    Comentarios TEXT,
    FOREIGN KEY (Proveedor_ID) REFERENCES proveedores(ID_Proveedor),
    FOREIGN KEY (ID_Metodo) REFERENCES metodos_pago_cobro(ID_Metodo),
    FOREIGN KEY (ID_Cheque) REFERENCES cheques(ID_Cheque)
);

-- Crear tabla cuentas_x_cobrar
CREATE TABLE cuentas_x_cobrar (
    ID_Factura INT PRIMARY KEY,
    Cliente_ID INT,
    Fecha_Emision DATE,
    Fecha_Vencimiento DATE,
    Monto_Cobrar DECIMAL(10,2),
    Estado_Cobro ENUM('Pendiente', 'Cobrado') NOT NULL,
    ID_Metodo INT,
    ID_Cheque INT,
    Comentarios TEXT,
    FOREIGN KEY (Cliente_ID) REFERENCES clientes(ID_Cliente),
    FOREIGN KEY (ID_Metodo) REFERENCES metodos_pago_cobro(ID_Metodo),
    FOREIGN KEY (ID_Cheque) REFERENCES cheques(ID_Cheque)
);

-- Crear tabla conciliacion_bancaria
CREATE TABLE conciliacion_bancaria (
    ID_Conciliacion INT PRIMARY KEY AUTO_INCREMENT,
    Dia INT,
    Mes INT,
    Ano INT,
    Dia_anterior INT,
    mes_anterior INT,
    ano_anterior INT,
    salario_anterior DECIMAL(10,2),
    mas_deposito DECIMAL(10,2),
    mas_cheques_anulados DECIMAL(10,2),
    mas_notas_creditos DECIMAL(10,2),
    mas_ajustes_libro DECIMAL(10,2),
    sub1 DECIMAL(10,2),
    subtotal1 DECIMAL(10,2),
    menos_cheques_girados DECIMAL(10,2),
    menos_nota_debito DECIMAL(10,2),
    menos_ajustes_libros DECIMAL(10,2),
    sub2 DECIMAL(10,2),
    saldo_libro DECIMAL(10,2),
    saldo_banco DECIMAL(10,2),
    mas_deposito_transito DECIMAL(10,2),
    menos_cheques_circulacion DECIMAL(10,2),
    mas_ajustes_banco DECIMAL(10,2),
    sub3 DECIMAL(10,2),
    saldo_conciliado DECIMAL(10,2)
);

-- Crear tabla registro_ingreso_gasto
CREATE TABLE registro_ingreso_gasto (
    ID_Registro INT PRIMARY KEY AUTO_INCREMENT,
    Fecha_Registro DATE,
    Descripcion VARCHAR(255),
    Categoria ENUM('Ingreso', 'Gasto') NOT NULL,
    Monto DECIMAL(12,2),
    Fuente_Ingresos VARCHAR(100),
    Destino_Gastos VARCHAR(100),
    ID_Metodo INT,
    ID_Cheque INT,
    Comentarios_Adicionales TEXT,
    FOREIGN KEY (ID_Metodo) REFERENCES metodos_pago_cobro(ID_Metodo),
    FOREIGN KEY (ID_Cheque) REFERENCES cheques(ID_Cheque)
);



-- Crear tabla bienes_patrimoniales
CREATE TABLE bienes_patrimoniales (
    ID_Bien INT PRIMARY KEY AUTO_INCREMENT,
    Codigo_Producto INT,
    Proveedor_ID INT,
    Departamento_ID INT,
    Depreciacion DECIMAL(10,2),
    Descripcion TEXT,
    Marca TEXT,
    Serie INT,
    Placa INT,
    Modelo TEXT,
    fecha DATETIME,
    FOREIGN KEY (Codigo_Producto) REFERENCES productos(Codigo),
    FOREIGN KEY (Proveedor_ID) REFERENCES proveedores(ID_Proveedor),
    FOREIGN KEY (Departamento_ID) REFERENCES departamentos(ID_Departamento)
);

-- Crear tabla planilla
CREATE TABLE planilla (
    ID_Planilla INT PRIMARY KEY AUTO_INCREMENT,
    Cedula_Empleado VARCHAR(20),
    Horas_Trabajadas FLOAT,
    Salario_Por_Hora FLOAT,
    Numero_Posicion INT,
    Salario_Bruto FLOAT,
    Seguro_Social FLOAT,
    Seguro_Educativo FLOAT,
    Impuesto_Renta FLOAT,
    Descuento_1 FLOAT,
    Descuento_2 FLOAT,
    Descuento_3 FLOAT,
    Deducciones FLOAT,
    Salario_Neto FLOAT,
    FOREIGN KEY (Cedula_Empleado) REFERENCES empleados(Cedula)
);

-- Crear tabla Users
CREATE TABLE Users (
    Cedula VARCHAR(20),
    Username VARCHAR(50) PRIMARY KEY,
    Password VARCHAR(255),
    Tipo ENUM('Contabilidad', 'Recursos Humanos', 'Bienes Patrimoniales', 'Tecnologia', 'Compra') NOT NULL,
    FOREIGN KEY (Cedula) REFERENCES empleados(Cedula)
);
INSERT INTO Users (
    Cedula, Username, Password, Tipo
) 
VALUES (
    '8-1009-525', -- Cédula
    'xbrayan02', -- Username
    'tobii0212', -- Password
    'Tecnologia' -- Tipo de usuario
);

-- Crear tabla Solicitudes_Producto
CREATE TABLE Solicitudes_Producto (
    ID_Solicitud INT PRIMARY KEY AUTO_INCREMENT,
    Fecha_Solicitud DATE,
    Descripcion_Solicitud VARCHAR(255),
    ID_Producto INT,
    Cantidad_Solicitada INT,
    motivo_Solicitud VARCHAR (255),
    ID_Departamento INT,
    Estado_Solicitud ENUM('Pendiente', 'Completada', 'Cancelada','Enviado') NOT NULL,
    FOREIGN KEY (ID_Producto) REFERENCES productos(Codigo),
    FOREIGN KEY (ID_Departamento) REFERENCES departamentos(ID_Departamento)
);
-- Crear tabla compra_productos
CREATE TABLE compra_productos (
    ID_Compra INT PRIMARY KEY AUTO_INCREMENT,
    Cantidad_Producto INT,
    Precio_Producto DECIMAL(10,2),
    Proveedor_ID INT,
    Departamento_ID INT,
    Detalle_Producto TEXT,
    ID_Solicitud INT,
    Total_Producto INT,
    FOREIGN KEY (Proveedor_ID) REFERENCES proveedores(ID_Proveedor),
    FOREIGN KEY (Departamento_ID) REFERENCES departamentos(ID_Departamento),
    FOREIGN KEY (ID_Solicitud) REFERENCES Solicitudes_Producto(ID_Solicitud)
);
-- Crear tabla depreciacion
CREATE TABLE depreciacion (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(100) NOT NULL
);

