<?php

include_once '../models/base_model.php';
class CategoriaP extends BaseModel{
	#nombre, sub_categoria, sub_tipo_prod
	public $nombre_categoria;
	public $subcategoria;
	public $sub_tipo_producto;
	public $categoria;

	public function fetchOne() {
		#get common stmt
		$res = parent::fetchOne();
		#handle Result of stmt
		if($res[1] >0) {
			$row = $res[0]->fetch(PDO::FETCH_ASSOC);
			$this->id = $row['id'];
			$this->nombre_categoria = $row['nombre_categoria'];
			$this->subcategoria = $row['subcategoria'];
			$this->sub_tipo_producto = $row['sub_tipo_producto'];
			$this->categoria = $row['categoria'];
			return TRUE;
		}
		return FALSE;
	}

	public function postData() {
		$sql = "INSERT INTO $this->table (id,nombre, subcategoria, sub_tipo_prod,id_cat) VALUES (:id, :nombre, :subCat, :subProd,:id_cat)";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':id', $this->id);
		$stmt->bindParam(':nombre', $this->nombre_categoria);
		$stmt->bindParam(':subCat', $this->subcategoria);
		$stmt->bindParam(':subProd', $this->sub_tipo_producto);
		$stmt->bindParam(':id_cat', $this->categoria);
		if($stmt->execute()) {
			return TRUE;
		}
		return FALSE;
	}

	public function checkParams(){
		$sql=array();
		if($this->nombre_categoria!=null){
			$sql[]="nombre='$this->nombre_categoria'";
		}
		if($this->subcategoria!=null){
			$sql[]="subcategoria='$this->subcategoria'";
		}
		if($this->sub_tipo_producto!=null){
			$sql[]="sub_tipo_prod='$this->sub_tipo_producto'";
		}
		if($this->categoria!=null){
			$sql[]="id_cat=$this->categoria";
		}
		return $sql;
	}
}