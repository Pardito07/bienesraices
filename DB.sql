CREATE DATABASE bienes_raices;
USE bienes_raices;

CREATE TABLE vendedores(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(45),
    apellido VARCHAR(45)
);

CREATE TABLE propiedades(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(60),
    precio DECIMAL(10,2),
    imagen VARCHAR(200),
    descripcion LONGTEXT,
    habitaciones INT,
    wc INT,
    estacionamiento INT,
    vendedorId INT,
    FOREIGN KEY (vendedorId) REFERENCES vendedores(id)
);

INSERT INTO vendedores(nombre, apellido) VALUES ('Juan', 'De la torre');
INSERT INTO vendedores(nombre, apellido) VALUES ('Karen', 'Perez');
SELECT * FROM vendedores;