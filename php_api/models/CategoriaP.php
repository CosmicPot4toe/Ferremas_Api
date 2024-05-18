<?php

include_once '../models/base_model.php';
class CategoriaP extends BaseModel{
	#nombre, sub_categoria, sub_tipo_prod
	public $nombre;
	public $subcategoria;
	public $sub_tipo_prod;
	public $id_cat;

	public function fetchOne() {
		#get common stmt
		$res = parent::fetchOne();
		#handle Result of stmt
		if($res[1] >0) {
			$row = $res[0]->fetch(PDO::FETCH_ASSOC);
			$this->id = $row['id'];
			$this->nombre = $row['nombre'];
			$this->subcategoria = $row['subcategoria'];
			$this->sub_tipo_prod = $row['sub_tipo_prod'];
			$this->id_cat = $row['id_cat'];
			return TRUE;
		}
		return FALSE;
	}

	public function postData() {
		$sql = "INSERT INTO $this->table (nombre, subcategoria, sub_tipo_prod,id_cat) VALUES (:nombre, :subCat, :subProd,:id_cat)";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':nombre', $this->nombre);
		$stmt->bindParam(':subCat', $this->subcategoria);
		$stmt->bindParam(':subProd', $this->sub_tipo_prod);
		$stmt->bindParam(':id_cat', $this->id_cat);
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
		if($this->subcategoria!=null){
			$sql[]="subcategoria='$this->subcategoria'";
		}
		if($this->sub_tipo_prod!=null){
			$sql[]="sub_tipo_prod='$this->sub_tipo_prod'";
		}
		if($this->id_cat!=null){
			$sql[]="id_cat=$this->id_cat";
		}
		return $sql;
	}
}