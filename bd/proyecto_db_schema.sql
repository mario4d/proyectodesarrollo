-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS proyecto_db;
USE proyecto_db;

-- Crear tabla metodos_pago_cobro
CREATE TABLE metodos_pago_cobro (
    ID_Metodo INT PRIMARY KEY AUTO_INCREMENT,
    Tipo ENUM('Pago', 'Cobro') NOT NULL,
    Nombre ENUM('Efectivo', 'Cheque') NOT NULL
);
INSERT INTO metodos_pago_cobro (Tipo, Nombre)
VALUES ('Pago', 'Efectivo'),('Pago', 'Cheque'),('Cobro', 'Efectivo'),('Cobro', 'Cheque');

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
    Ubicacion_Departamento VARCHAR(100)
);
INSERT INTO departamentos (Nombre_Departamento, Especificacion_Departamento, Ubicacion_Departamento)
VALUES ('Soporte Técnico', 'Encargado del mantenimiento y solución de problemas técnicos.', 'Primer Piso'),
('Contabilidad', 'Gestiona las finanzas y los registros contables.', 'Segundo Piso'),
('Recursos Humanos', 'Administra el personal y procesos de contratación.', 'Tercer Piso'),
('Bienes Patrimoniales', 'Manejo y control de los activos de la empresa.', 'Cuarto Piso'),
('Compra', 'Encargado de las adquisiciones y proveedores.', 'Quinto Piso');


-- Crear tabla productos
CREATE TABLE productos (
    Codigo INT PRIMARY KEY AUTO_INCREMENT,
    Nombre_Producto VARCHAR(100),
	Marca_Producto VARCHAR(100),
	Modelo_Producto VARCHAR(100),
    Descripcion_Producto VARCHAR(255),
    Precio_Producto DECIMAL(10,2),
    Stock Int,
    Departamento_ID INT,
    FOREIGN KEY (Departamento_ID) REFERENCES departamentos(ID_Departamento)
);
-- Tabla provincia
CREATE TABLE `provincia` (
  `codigo_provincia` varchar(2) NOT NULL,
  `nombre_provincia` varchar(50) NOT NULL,
  PRIMARY KEY (`codigo_provincia`)
) ;

-- Tabla distrito
CREATE TABLE `distrito` (
  `codigo_provincia` varchar(2) NOT NULL,
  `codigo_distrito` varchar(4) NOT NULL,
  `codigo` varchar(2) NOT NULL,
  `nombre_distrito` varchar(150) NOT NULL,
  PRIMARY KEY (`codigo_distrito`),
  FOREIGN KEY (`codigo_provincia`) REFERENCES `provincia`(`codigo_provincia`) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Tabla corregimiento
CREATE TABLE `corregimiento` (
  `codigo_provincia` varchar(2) NOT NULL,
  `codigo_distrito` varchar(4) NOT NULL,
  `codigo_corregimiento` varchar(6) NOT NULL,
  `nombre_corregimiento` varchar(150) NOT NULL,
  PRIMARY KEY (`codigo_corregimiento`),
  FOREIGN KEY (`codigo_provincia`) REFERENCES `provincia`(`codigo_provincia`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`codigo_distrito`) REFERENCES `distrito`(`codigo_distrito`) ON DELETE CASCADE ON UPDATE CASCADE
) ;

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
    Turno_Hora VARCHAR(15),
    Departamento_ID INT,
    Correo VARCHAR(100),
    Telefono VARCHAR(15),
    codigo_provincia VARCHAR(2),
    codigo_distrito VARCHAR(4),
    codigo_corregimiento VARCHAR(6),
    FOREIGN KEY (Departamento_ID) REFERENCES departamentos(ID_Departamento),
    FOREIGN KEY (codigo_provincia) REFERENCES provincia(codigo_provincia) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (codigo_distrito) REFERENCES distrito(codigo_distrito) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (codigo_corregimiento) REFERENCES corregimiento(codigo_corregimiento) ON DELETE SET NULL ON UPDATE CASCADE
);
INSERT INTO empleados (
    Cedula, Nombre, Segundo_Nombre, Apellido, Segundo_Apellido, 
    Genero, Usa_AC, Estado_Civil, Apellido_Casada, Turno_Hora, 
    Departamento_ID, Correo, Telefono, codigo_provincia, codigo_distrito, codigo_corregimiento
) 
VALUES (
    '8-1009-525', 'Brayan', 'Bladimir', 'Rodriguez', 'Rodriguez', 
    1, -- Genero: 1 para hombre
    0, -- Usa_AC: 0 (no tiene apellido de casado)
    0, -- Estado_Civil: no se especificó
    NULL, -- Apellido_Casada: no aplica
    NULL, -- Turno_Hora: no se especificó
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

-- Crear tabla bienes_patrimoniales
CREATE TABLE bienes_patrimoniales (
    ID_Bien INT PRIMARY KEY AUTO_INCREMENT,
    Codigo_Producto INT,
    Proveedor_ID INT,
    Departamento_ID INT,
    Depreciacion DECIMAL(10,2),
    Descripcion TEXT,
    Marca TEXT,
    Modelo TEXT,
    Comentarios TEXT,
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
    Motivo_Solicitud VARCHAR (255),
    ID_Departamento INT,
    Estado_Solicitud ENUM('Pendiente', 'Completada', 'Cancelada') NOT NULL,
    FOREIGN KEY (ID_Producto) REFERENCES productos(Codigo),
    FOREIGN KEY (ID_Departamento) REFERENCES departamentos(ID_Departamento)
);

-- Crear tabla depreciacion
CREATE TABLE depreciacion (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(100) NOT NULL
);

