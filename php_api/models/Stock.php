<?php

include_once '../models/base_model.php';
class Stock extends BaseModel{
	#nombre, sub_categoria, sub_tipo_prod
	public $cantidad;
	public $sucursal;
	public $producto;

	public function fetchOne() {
		#get common stmt
		$res = parent::fetchOne();
		#handle Result of stmt
		if($res[1] >0) {
			$row = $res[0]->fetch(PDO::FETCH_ASSOC);
			$this->id = $row['id'];
			$this->cantidad = $row['cantidad'];
			$this->sucursal = $row['sucursal'];
			$this->producto = $row['producto'];
			return TRUE;
		}
		return FALSE;
	}

	public function postData() {
		$sql = "INSERT INTO $this->table (cantidad,sucursal,producto) VALUES (:cantidad,:sucursal,:producto)";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':cantidad', $this->cantidad);
		$stmt->bindParam(':sucursal', $this->sucursal);
		$stmt->bindParam(':producto', $this->producto);
		if($stmt->execute()) {
			return TRUE;
		}
		return FALSE;
	}

	public function checkParams(){
		$sql=array();
		if($this->cantidad!=null){
			$sql[]="cantidad='$this->cantidad'";
		}
		if($this->sucursal!=null){
			$sql[]="sucursal='$this->sucursal'";
		}
		if($this->producto!=null){
			$sql[]="producto='$this->producto'";
		}
		return $sql;
	}
}