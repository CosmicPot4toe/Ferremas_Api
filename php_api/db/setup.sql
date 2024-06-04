--DROP TABLE students;
DROP TABLE productos;
DROP TABLE categoriaProducto;
DROP TABLE categoria;
DROP TABLE tiendas;
DROP TABLE stock;

CREATE TABLE categoria(
  id int(3) PRIMARY KEY NOT NULL,
  nombre varchar(100) NOT NULL
);

CREATE TABLE categoriaProducto(
  id int(3) PRIMARY KEY NOT NULL,
  nombre varchar(100) NOT NULL,
  subcategoria varchar(100) NOT NULL,
  sub_tipo_prod varchar(100) NOT NULL,
	id_cat int(3),
	FOREIGN KEY (id_cat) REFERENCES categoria(id)  
); --el resto de los atributos no son necesarios aca pero los pongo por conveniencia

CREATE TABLE productos(
  id int(3) PRIMARY KEY NOT NULL,
  nombre varchar(100) NOT NULL,
  marca varchar(100) NOT NULL,
  codigo_producto varchar(50) NOT NULL,
	descripcion TEXT NOT NULL,
  precio int(7) NOT NULL,
	categoria int(3),
	imagen_url varchar(200)NOT NULL,
	FOREIGN KEY (categoria) REFERENCES categoriaProducto(id)  
);

CREATE TABLE tiendas(
  id int(3) PRIMARY KEY NOT NULL,
  nombre varchar(100) NOT NULL,
  direccion varchar(200) NOT NULL,
  comuna varchar(100) NOT NULL,
  region varchar(100) NOT NULL,
  email varchar(100) NOT NULL,
  telefono varchar(20) NOT NULL
); 

CREATE TABLE stock(
  id int(3) PRIMARY KEY NOT NULL,
	cantidad int(3) NOT NULL,
  sucursal int(3),
	producto int(3),
	FOREIGN KEY (sucursal) REFERENCES tiendas(id),
	FOREIGN KEY (producto) REFERENCES productos(id)
); 


INSERT INTO tiendas(id,nombre, direccion, comuna, region, email, telefono) VALUES
  (1,'Ferremas La Florida','La Florida 1200','La Florida','Metropolitana','contacto@ferremas.cl','950142401'),
  (2,'Ferremas La Condes','Las Condes 8000','Las condes','Metropolitana','contacto@ferremas.cl','950142401'),
  (3,'Ferremas Lo Barnechea','vieja Cuica #123','Lo Barnechea','Metropolitana','contacto@ferremas.cl',916056028),
  (4,'Ferremas Lo Barneshea','Av. Cuico 42069','LO banershea','Metropolitana','tumamitaencalzone@yopmail.com',950142401);
--
-- Dumping data for table `students`
--
INSERT INTO categoria(id,nombre) VALUES
  (1,'Herramientas Manuales'),
  (2,'Materiales Basicos'),
  (3,'Equipos de Seguridad'),
  (4,'Tornillos y Anclajes'),
  (5,'Fijación y Adhesivos'),
  (6,'Equipos de Medición');

INSERT INTO categoriaProducto(id,nombre, subcategoria, sub_tipo_prod,id_cat) VALUES
  (1,'Herramientas Manuales','Taladro','Percutor',1),
  (2,'Materiales Basicos','Cemento','Fraguado Rapido',2),
  (3,'Equipos de Seguridad','Cascos','HPE',3),
  (4,'Tornillos','Clavos','pepe',4),
  (5,'Adhesivos','Gotita','Secado Instantaneo',5);

INSERT INTO productos(id,marca, nombre, codigo_producto,descripcion,precio,categoria,imagen_url) VALUES
(1,'BOSCH','Taladro percutor eléctrico 13 mm 750W', 'BOSCH-1001', 'Especificaciones
Garantía 2 años
Modelo	GSB 13 RE
Uso de la herramienta	Industrial
Voltaje	220 V
Marca	Bosch
Tipo de taladro	Taladro eléctrico
Conectividad/conexión	Cableado
Niveles de potencia	1
Velocidad	3800 RPM
Potencia	750 W
Tamaño del mandril	13 mm
Largo del cable	2 m
Características   El taladro percutor Bosch GSB 13 RE, tiene 750W de potencia, es súper liviano y compacto. Permite trabajos con menos vibración y menos ruido, además, cuenta con una carcasa reforzada de alta calidad que aumenta la vida útil de la herramienta. Viene con una empuñadura de goma para un agarre seguro y cómodo, lo que reduce el esfuerzo y la fatiga del usuario al finalizar un día de trabajo. También cuenta con interruptor de velocidad variable y botón de bloqueo ideal para trabajos continuos.


Información adicional
El taladro percutor eléctrico Bosch GSB 13 RE destaca en el ámbito industrial gracias a su potencia de 750W y su diseño compacto y ligero. Su rendimiento excepcional se combina con una construcción robusta que incluye una carcasa reforzada de alta calidad, lo que garantiza durabilidad y una larga vida útil en entornos de trabajo exigentes. Además, la herramienta ofrece un manejo más cómodo con una empuñadura de goma que reduce la fatiga del usuario y permite un agarre seguro durante largas jornadas laborales.

Este taladro no solo brinda un rendimiento potente, sino que también incorpora características como un interruptor de velocidad variable y un botón de bloqueo, lo que facilita la adaptación a diversas tareas y mejora la comodidad en trabajos continuos. El paquete incluye accesorios útiles, como una llave de mandril, una empuñadura auxiliar y un limitador de profundidad, agregando versatilidad a la herramienta. Con una garantía de 2 años respaldando su calidad, el Bosch GSB 13 RE se posiciona como una opción confiable para profesionales que buscan eficiencia y durabilidad en sus proyectos industriales.',79990,1,'https://sodimac.scene7.com/is/image/SodimacCL/7404727_01?wid=1500&hei=1500&qlt=70'),
(2,'Cemento','Cemento Miramas', 'CEM-1001', 'El cemento es un conglomerante formado a partir de una mezcla de caliza y arcilla calcinadas y posteriormente molidas. Es la argamasa o mezcla de materiales empleados en el campo de la construcción para cohesionar, fijar o cubrir pisos y paredes. El aglomerante está compuesto por clinker, yeso y ciertos aditivos químicos. Mezclado con agua fragua y endurece.',8650,2,'https://realplaza.vtexassets.com/arquivos/ids/14250769/image-2a8ca8391884494d9fc555672d585b0f.jpg?v=637327739933900000'),
(3,'MSA','CASCO DE SEGURIDAD MSA V-GARD GORRA', 'MSA-1001', 'DESCRIPCIÓN
Protéjase contra altos impactos y disfrute de protección dieléctrica con el Casco MSA V-Gard Gorra.

Con ajustes verticales y horizontales, la visera se puede extender hacia adelante y se puede ajustar la altura del casco.

Su cinta de suspensión única aumenta la capacidad de disipación de energía.

Fabricado en HPE de alta densidad para una protección duradera y segura. ¡Opte por la mejor protección disponible!',10072,3,'https://www.apro.cl/cdn/shop/files/166947-1600-auto.jpg?v=1712337196&width=900'),
(4,'Clavo 10cm','Clavitos Pedro','CP-0001','Lorem Ipsum
asdfasdfasdadf',1290,4,'https://media1.tenor.com/m/_1hMqyFC4LEAAAAd/pop-cat.gif'),
(7,'Poxipol','La Gotita Adhesivo Instantáneo','POXI-1001','La Gotita es un adhesivo instantáneo, fácil de usar, para pequeños arreglos en el hogar, que pega en pocos segundos gran variedad de materiales.

Adhesivo instantáneo
Fácil de usar
Para pequeños arreglos en el hogar

Tipo de Producto
Cintas Adhesivas
Contenido
2 ml
País de Origen
Uruguay',3390,5,'https://santaisabel.vtexassets.com/arquivos/ids/174160/Adhesivo-Poxipol-La-gotita-2-Ml.jpg?v=637574805183700000');


INSERT INTO stock(id,cantidad,sucursal,producto) VALUES
(1,30,2,1),
(2,40,1,1),
(3,20,1,3),
(4,100,3,4);