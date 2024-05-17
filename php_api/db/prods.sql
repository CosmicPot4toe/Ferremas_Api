
--DROP TABLE students;
DROP TABLE productos;
DROP TABLE categorias;

CREATE TABLE categorias(
  id_C INTEGER PRIMARY KEY NOT NULL,
  nombre varchar(100) NOT NULL,
  sub_categoria varchar(100) NOT NULL,
  sub_tipo_prod varchar(100) NOT NULL
); --el resto de los atributos no son necesarios aca pero los pongo por conveniencia

CREATE TABLE productos(
  id INTEGER PRIMARY KEY NOT NULL,
  nombre varchar(100) NOT NULL,
  marca varchar(100) NOT NULL,
  codigo_producto varchar(50) NOT NULL,
	descripcion varchar(445) NOT NULL,
  precio int(7) NOT NULL,
  stock int(7) NOT NULL,
	id_C INTEGER,
	FOREIGN KEY (id_C) REFERENCES categorias(id_C)  
);

--
-- Dumping data for table `students`
--
INSERT INTO categorias(nombre, sub_categoria, sub_tipo_prod) VALUES
('Taladros','Percutor','Inalambrico');

INSERT INTO productos(nombre, marca, codigo_producto,descripcion,precio,stock,id_C) VALUES
('Taladro','Razen?', '00001', 'lorem Ipsum yadayada pedro me la come',30000,30,1),
('Taladro','smthsmt', '00002', 'lorem Ipsum yadayada pedro me la come',25000,10,1);
