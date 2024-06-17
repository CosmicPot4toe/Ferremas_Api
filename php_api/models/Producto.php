<?php

include_once '../models/base_model.php';

class Producto extends BaseModel{
	#nombre, marca, codigo_producto,descripcion,precio,stock,categoriaategory
	public $nombre;
	public $marca;
	public $codigo_producto;
	public $descripcion;
	public $precio;
	public $categoria_id;
	public $imagen_url;

	public function fetchOne() {
		#get common stmt
		$res = parent::fetchOne();
		#handle Result of stmt
		if($res[1] >0) {
			$row = $res[0]->fetch(PDO::FETCH_ASSOC);
			$this->id = $row['id'];
			$this->nombre = $row['nombre'];
			$this->marca = $row['marca'];
			$this->codigo_producto = $row['codigo_producto'];
			$this->descripcion = $row['descripcion'];
			$this->precio = $row['precio'];
			$this->categoria_id = $row['categoria_id'];
			$this->imagen_url = $row['imagen_url'];
			return TRUE;
		}
		return FALSE;
	}

	public function postData() {
		$sql = "INSERT INTO $this->table (id,nombre, marca, codigo_producto,descripcion,precio,categoria,imagen_url) VALUES (:id,:nombre, :marca, :cod_prod, :desc, :precio, :categoria,:imagen_url)";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':id', $this->id);
		$stmt->bindParam(':nombre', $this->nombre);
		$stmt->bindParam(':marca', $this->marca);
		$stmt->bindParam(':cod_prod', $this->codigo_producto);
		$stmt->bindParam(':desc', $this->descripcion);
		$stmt->bindParam(':precio', $this->precio);
		$stmt->bindParam(':categoria', $this->categoria_id);
		$stmt->bindParam(':imagen_url', $this->imagen_url);
		if($stmt->execute()) {
			return TRUE;
		}
		return FALSE;
	}
	public function checkParams(){
		$sql= array();
		if($this->nombre!=null){
			$sql[] ="nombre='$this->nombre'";
		}
		if($this->marca!=null){
			$sql[] ="marca='$this->marca'";
		}
		if($this->codigo_producto!=null){
			$sql[] ="codigo_producto='$this->codigo_producto'";
		}
		if($this->descripcion!=null){
			$sql[] ="descripcion='$this->descripcion'";
		}
		if($this->precio!=null){
			$sql[] ="precio=$this->precio";
		}
		if($this->categoria_id!=null){
			$sql[] ="categoria=$this->categoria_id";
		}
		if($this->imagen_url!=null){
			$sql[] ="imagen_url='$this->imagen_url'";
		}
		return $sql;
	}
	
}