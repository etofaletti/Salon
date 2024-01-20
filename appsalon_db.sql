CREATE DATABASE appsalon_mvc;
USE appsalon_mvc;

CREATE TABLE usuarios(
	id INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(60),
    apellido VARCHAR(60),
    email VARCHAR(30),
    telefono VARCHAR(10),
    admin BOOLEAN,
    confirmado BOOLEAN,
    token VARCHAR(15),
    PRIMARY KEY (id)
);

CREATE TABLE servicios(
	id INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(60),
    precio DECIMAL(5,2),
    PRIMARY KEY (id)
);

CREATE TABLE citas(
	id INT NOT NULL AUTO_INCREMENT,
    fecha DATE,
    hora TIME,
	usuarioId INT,
    FOREIGN KEY (usuarioId) REFERENCES usuarios (id) ON UPDATE SET NULL ON DELETE SET NULL,
    PRIMARY KEY (id)
);

CREATE TABLE citasServicios(
	id INT NOT NULL AUTO_INCREMENT,
    citaId	INT,
    servicioId INT,
    FOREIGN KEY (citaId) REFERENCES citas (id)  ON UPDATE SET NULL ON DELETE SET NULL,
	FOREIGN KEY (servicioId) REFERENCES servicios (id)  ON UPDATE SET NULL ON DELETE SET NULL,
    PRIMARY KEY (id)
);






