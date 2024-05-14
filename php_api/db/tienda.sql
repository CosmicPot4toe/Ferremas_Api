DROP TABLE tiendas;

CREATE TABLE tiendas(
  id INTEGER PRIMARY KEY NOT NULL,
  nombre varchar(100) NOT NULL,
  direccion varchar(100) NOT NULL,
  comuna varchar(100) NOT NULL,
  region varchar(100) NOT NULL,
  email varchar(100) NOT NULL,
  telefono int(12) NOT NULL
); 

INSERT INTO tiendas(nombre, direccion, comuna, region, email, telefono) VALUES
('Ferremas La Florida','Av. Amercio Vezpucio 7301','La Florida','R.Metropolitana','ferre.florida@duoc.cl',56983903426);