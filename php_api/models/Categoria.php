<?php

include_once '../models/base_model.php';
class Categoria extends BaseModel{
	#nombre, sub_categoria, sub_tipo_prod
	public $nombre;
	public $sub_categoria;
	public $sub_tipo_prod;

	public function fetchOne() {
		#get common stmt
		$res = parent::fetchOne();
		#handle Result of stmt
		if($res[1] >0) {
			$row = $res[0]->fetch(PDO::FETCH_ASSOC);
			$this->id = $row['id_C'];
			$this->nombre = $row['nombre'];
			$this->sub_categoria = $row['sub_categoria'];
			$this->sub_tipo_prod = $row['sub_tipo_prod'];
			return TRUE;
		}
		return FALSE;
	}

	public function postData() {
		$sql = "INSERT INTO $this->table (nombre, sub_categoria, sub_tipo_prod) VALUES (:nombre, :subCat, :subProd)";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':nombre', $this->nombre);
		$stmt->bindParam(':subCat', $this->sub_categoria);
		$stmt->bindParam(':subProd', $this->sub_tipo_prod);
		if($stmt->execute()) {
			return TRUE;
		}
		return FALSE;
	}

	public function checkParams(){
		$sql=array();
		if($this->nombre!=null){
			$sql[]="nombre='$this->nombre'";
		}
		if($this->sub_categoria!=null){
			$sql[]="sub_categoria='$this->sub_categoria'";
		}
		if($this->sub_tipo_prod!=null){
			$sql[]="sub_tipo_prod='$this->sub_tipo_prod'";
		}
		return $sql;
	}
}