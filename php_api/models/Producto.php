<?php

include_once '../models/base_model.php';

class Producto extends BaseModel{
	#nombre, marca, codigo_producto,descripcion,precio,stock,id_Category
	public $nombre;
	public $marca;
	public $cod_prod;
	public $desc;
	public $precio;
	public $stock;
	public $id_Cat;

	public function fetchOne() {
		#get common stmt
		$res = parent::fetchOne();
		#handle Result of stmt
		if($res[1] >0) {
			$row = $res[0]->fetch(PDO::FETCH_ASSOC);
			$this->id = $row['id'];
			$this->nombre = $row['nombre'];
			$this->marca = $row['marca'];
			$this->cod_prod = $row['codigo_producto'];
			$this->desc = $row['descripcion'];
			$this->precio = $row['precio'];
			$this->stock = $row['stock'];
			$this->id_Cat = $row['id_Category'];
			return TRUE;
		}
		return FALSE;
	}

	public function postData() {
		$sql = "INSERT INTO $this->table (nombre, marca, codigo_producto,descripcion,precio,stock,id_Category) VALUES (:nombre, :marca, :cod_prod, :desc, :precio, :stock, :id_Cat)";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':nombre', $this->nombre);
		$stmt->bindParam(':marca', $this->marca);
		$stmt->bindParam(':cod_prod', $this->cod_prod);
		$stmt->bindParam(':desc', $this->desc);
		$stmt->bindParam(':precio', $this->precio);
		$stmt->bindParam(':stock', $this->stock);
		$stmt->bindParam(':id_Cat', $this->id_Cat);
		if($stmt->execute()) {
			return TRUE;
		}
		return FALSE;
	}

	public function putData(string $sql=null) {
		$sql = "UPDATE $this->table SET nombre = :nombre,marca = :marca,codigo_producto= :cod_prod,descripcion = :desc,precio =:precio,stock = :stock,id_Category = :id_Cat WHERE id = :id";

		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':nombre', $this->nombre);
		$stmt->bindParam(':marca', $this->marca);
		$stmt->bindParam(':cod_prod', $this->cod_prod);
		$stmt->bindParam(':desc', $this->desc);
		$stmt->bindParam(':precio', $this->precio);
		$stmt->bindParam(':stock', $this->stock);
		$stmt->bindParam(':id_Cat', $this->id_Cat);
		$stmt->bindParam(':id', $this->id);
		if($stmt->execute()) {
			return TRUE;
		}
		return FALSE;
	}

}