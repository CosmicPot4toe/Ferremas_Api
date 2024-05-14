<?php

include_once '../models/base_model.php';
class Categoria extends BaseModel{
	#nombre, sub_categoria, sub_tipo_prod
	public $nombre;
	public $subCat;
	public $subProd;

	public function fetchOne() {
		#get common stmt
		$res = parent::fetchOne();
		#handle Result of stmt
		if($res[1] >0) {
			$row = $res[0]->fetch(PDO::FETCH_ASSOC);
			$this->id = $row['id_C'];
			$this->nombre = $row['nombre'];
			$this->subCat = $row['sub_categoria'];
			$this->subProd = $row['sub_tipo_prod'];
			return TRUE;
		}
		return FALSE;
	}

	public function postData() {
		$sql = "INSERT INTO $this->table (nombre, sub_categoria, sub_tipo_prod) VALUES (:nombre, :subCat, :subProd)";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':nombre', $this->nombre);
		$stmt->bindParam(':subCat', $this->subCat);
		$stmt->bindParam(':subProd', $this->subProd);
		if($stmt->execute()) {
			return TRUE;
		}
		return FALSE;
	}

	public function putData(string $sql=null) {
		$sql = "UPDATE $this->table SET nombre = :nombre, sub_categoria = :subCat, sub_tipo_prod= :subProd WHERE $this->id_name = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':nombre', $this->nombre);
		$stmt->bindParam(':subCat', $this->subCat);
		$stmt->bindParam(':id', $this->id);
		if($stmt->execute()) {
			return TRUE;
		}
		return FALSE;
	}
}