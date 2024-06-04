<?php

include_once '../models/base_model.php';
class Tienda extends BaseModel{
	#nombre, direccion, comuna, region, email, telefono
	public $nombre;
	public $direccion;
	public $comuna;
	public $region;
	public $email;
	public $telefono;

	public function fetchOne() {
		#get common stmt
		$res = parent::fetchOne();
		#handle Result of stmt
		if($res[1] >0) {
			$row = $res[0]->fetch(PDO::FETCH_ASSOC);
			$this->id = $row['id'];
			$this->nombre = $row['nombre'];
			$this->direccion = $row['direccion'];
			$this->comuna = $row['comuna'];
			$this->region = $row['region'];
			$this->email = $row['email'];
			$this->telefono = $row['telefono'];
			return TRUE;
		}
		return FALSE;
	}

	public function postData() {
		$sql = "INSERT INTO $this->table (id,nombre, direccion, comuna,region,email,telefono) VALUES (:id,:nombre, :direccion, :comuna, :region, :email, :cel)";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':id', $this->id);
		$stmt->bindParam(':nombre', $this->nombre);
		$stmt->bindParam(':direccion', $this->direccion);
		$stmt->bindParam(':comuna', $this->comuna);
		$stmt->bindParam(':region', $this->region);
		$stmt->bindParam(':email', $this->email);
		$stmt->bindParam(':cel', $this->telefono);
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
		if($this->direccion!=null){
			$sql[]="direccion='$this->direccion'";
		}
		if($this->comuna!=null){
			$sql[]="comuna='$this->comuna'";
		}
		if($this->region!=null){
			$sql[]="region='$this->region'";
		}
		if($this->email!=null){
			$sql[]="email='$this->email'";
		}
		if($this->telefono!=null){
			$sql[]="telefono=$this->telefono";
		}
		return $sql;
	}

}