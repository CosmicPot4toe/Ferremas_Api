# PHP REST API
La mismisima que nos dio el profe la segunda clase de API solo que esta tiene 2 modelos semi-funcionales(explicare mas abajo) y escalable, no tiene checks para evitar problemas con los cuerpos de los requests pero eso sera para otra ver. mas adelante 

### Models
- existen 2 modelos, Students y Productos, ambos estan conectados a la misma tabla, esto se puede cambiar en sus respectivos documentos, los cuales tienen que reflejar su tabla en la BDD

### BDD
- La BDD esta programada(tablas creadas) en sql, solo hay que crear las otras tablas, me gustaria usar una BDD en sqlite3 en vez de mySQl por que es mas facil compartir las tablas creadas

### Config
- en caso de migrar a sqlite3 el archivo completo debera cambiar ya que la conexion entre php y sqlite3 es diferente a mysql, esto porque no necesitamos un servidor
---
Esto es todo lo que tenia que decir, es mas facil escribirlo que hablarlo - pero si me piden escribir minimo 3 lineas en una prueba no puedo, honestly can some1 explain that to me? 