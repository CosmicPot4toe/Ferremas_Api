<?php

include_once '../models/base_model.php';
class Categoria extends BaseModel{
	#nombre, sub_categoria, sub_tipo_prod
	public $nombre;

	public function fetchOne() {
		#get common stmt
		$res = parent::fetchOne();
		#handle Result of stmt
		if($res[1] >0) {
			$row = $res[0]->fetch(PDO::FETCH_ASSOC);
			$this->id = $row['id'];
			$this->nombre = $row['nombre'];
			return TRUE;
		}
		return FALSE;
	}

	public function postData() {
		$sql = "INSERT INTO $this->table (nombre) VALUES (:nombre)";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':nombre', $this->nombre);
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
		return $sql;
	}
}