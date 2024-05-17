<?php

include_once '../models/base_model.php';

class Producto extends BaseModel{
	#nombre, marca, codigo_producto,descripcion,precio,stock,id_Category
	public $nombre;
	public $marca;
	public $codigo_producto;
	public $descripcion;
	public $precio;
	public $stock;
	public $id_C;

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
			$this->stock = $row['stock'];
			$this->id_C = $row['id_C'];
			return TRUE;
		}
		return FALSE;
	}

	public function postData() {
		$sql = "INSERT INTO $this->table (nombre, marca, codigo_producto,descripcion,precio,stock,id_C) VALUES (:nombre, :marca, :cod_prod, :desc, :precio, :stock, :id_Cat)";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':nombre', $this->nombre);
		$stmt->bindParam(':marca', $this->marca);
		$stmt->bindParam(':cod_prod', $this->codigo_producto);
		$stmt->bindParam(':desc', $this->descripcion);
		$stmt->bindParam(':precio', $this->precio);
		$stmt->bindParam(':stock', $this->stock);
		$stmt->bindParam(':id_Cat', $this->id_C);
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
		if($this->precio!=null){
			$sql[] ="stock=$this->stock";
		}
		if($this->id_C!=null){
			$sql[] ="id_C=$this->id_C";
		}
		return $sql;
	}
	
}