--DROP TABLE students;
DROP TABLE productos;
DROP TABLE categoriaProducto;
DROP TABLE categoria;
DROP TABLE tiendas;
DROP TABLE stock;

CREATE TABLE categoria(
  id INTEGER PRIMARY KEY NOT NULL,
  nombre varchar(100) NOT NULL
);

CREATE TABLE categoriaProducto(
  id INTEGER PRIMARY KEY NOT NULL,
  nombre varchar(100) NOT NULL,
  subcategoria varchar(100) NOT NULL,
  sub_tipo_prod varchar(100) NOT NULL,
	id_cat INTEGER,
	FOREIGN KEY (id_cat) REFERENCES categoria(id)  
); --el resto de los atributos no son necesarios aca pero los pongo por conveniencia

CREATE TABLE productos(
  id INTEGER PRIMARY KEY NOT NULL,
  nombre varchar(100) NOT NULL,
  marca varchar(100) NOT NULL,
  codigo_producto varchar(50) NOT NULL,
	descripcion varchar(445) NOT NULL,
  precio int(7) NOT NULL,
  stock int(7) NOT NULL,
	categoria INTEGER,
	FOREIGN KEY (categoria) REFERENCES categoriaProducto(id)  
);

CREATE TABLE tiendas(
  id INTEGER PRIMARY KEY NOT NULL,
  nombre varchar(100) NOT NULL,
  direccion varchar(200) NOT NULL,
  comuna varchar(100) NOT NULL,
  region varchar(100) NOT NULL,
  email varchar(100) NOT NULL,
  telefono varchar(20) NOT NULL
); 

CREATE TABLE stock(
  id INTEGER PRIMARY KEY NOT NULL,
	cantidad int(3) NOT NULL,
  sucursal INTEGER,
	producto INTEGER,
	FOREIGN KEY (sucursal) REFERENCES tiendas(id),
	FOREIGN KEY (producto) REFERENCES productos(id)
); 


INSERT INTO tiendas(nombre, direccion, comuna, region, email, telefono) VALUES
('Ferremas La Florida','La Florida 1200','La Florida','Metropolitana','contacto@ferremas.cl','950142401'),
('Ferremas La Condes','Las Condes 8000','Las condes','Metropolitana','contacto@ferremas.cl','950142401');
--
-- Dumping data for table `students`
--
INSERT INTO categoria(nombre) VALUES
('Herramientas Manuales'),
('Materiales Basicos'),
('Equipos de Seguridad'),
('Tornillos y Anclajes'),
('Fijación y Adhesivos'),
('Equipos de Medición');

INSERT INTO categoriaProducto(nombre, subcategoria, sub_tipo_prod,id_cat) VALUES
('Herramientas Manuales','Taladro','Percutor',1),
('Materiales Basicos','Cemento','Fraguado Rapido',2),
('Equipos de Seguridad','Cascos','HPE',3);

INSERT INTO productos(nombre, marca, codigo_producto,descripcion,precio,stock,categoria) VALUES
('Taladro','Razen?', '00001', 'lorem Ipsum yadayada pedro me la come',30000,30,1),
('Taladro','smthsmt', '00002', 'lorem Ipsum yadayada pedro me la come',25000,10,1);


INSERT INTO stock(cantidad,sucursal,producto) VALUES
(30,2,1),
(40,1,1);