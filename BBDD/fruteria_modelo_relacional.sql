CREATE DATABASE fruteria;

USE fruteria;

CREATE TABLE fruta(
    codigo_fruta INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(25) NOT NULL,
    precio DECIMAL(10,2),
    origen VARCHAR(30) NOT NULL,
    stock DECIMAL(10,2),
    temporada ENUM("Invierno","Primavera","Verano","Otoño","Perenne") NOT NULL,
    clase ENUM("Bayas","Cítricos","Cucurbitáceas","Exóticas","Fruta dulce","Frutos secos") NOT NULL,
    estado ENUM("ALTA","BAJA") NOT NULL
);

CREATE TABLE cliente(
    id INT AUTO_INCREMENT PRIMARY KEY
);

CREATE TABLE factura(
    num_factura INT AUTO_INCREMENT PRIMARY KEY,
    fecha_salida  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    cliente INT NOT NULL,
    FOREIGN KEY (cliente) REFERENCES cliente(id) ON DELETE NO ACTION ON UPDATE CASCADE
);

CREATE TABLE lineas_factura(
    num_linea INT AUTO_INCREMENT PRIMARY KEY,
    kilos DECIMAL(10,2),
    precio_kilo DECIMAL(10,2),
    factura INT NOT NULL,
    fruta INT NOT NULL,
    FOREIGN KEY (fruta) REFERENCES fruta(codigo_fruta) ON DELETE NO ACTION ON UPDATE CASCADE,
    FOREIGN KEY (factura) REFERENCES factura(num_factura) ON DELETE NO ACTION ON UPDATE CASCADE
);

CREATE TABLE proveedor(
    cif CHAR(9) PRIMARY KEY,
    razon_social VARCHAR(60) NOT NULL,
    email VARCHAR(60) NOT NULL,
    telefono CHAR(12) NOT NULL,
    dirección VARCHAR(200) NOT NULL,
    mapa TEXT NOT NULL,
    descripcion TEXT NOT NULL,
    estado ENUM("ALTA","BAJA") NOT NULL
);

CREATE TABLE albaran(
    num_albaran INT AUTO_INCREMENT PRIMARY KEY,
    fecha_entrada TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    proveedor CHAR(9) NOT NULL,
    FOREIGN KEY (proveedor) REFERENCES proveedor(cif) ON DELETE NO ACTION ON UPDATE CASCADE
);

CREATE TABLE lineas_albaran(
    num_linea INT AUTO_INCREMENT PRIMARY KEY,
    kilos DECIMAL(10,2),
    precio_kilo DECIMAL(10,2),
    albaran INT NOT NULL,
    fruta INT NOT NULL,
    FOREIGN KEY (fruta) REFERENCES fruta(codigo_fruta) ON DELETE NO ACTION ON UPDATE CASCADE,
    FOREIGN KEY (albaran) REFERENCES albaran(num_albaran) ON DELETE NO ACTION ON UPDATE CASCADE
);

CREATE TABLE empleado(
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Usuario VARCHAR(70) NOT NULL,
    Password VARCHAR(300) NOT NULL
);