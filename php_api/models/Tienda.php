<?php

include_once '../models/base_model.php';
class Tienda extends BaseModel{
	#nombre, direccion, comuna, region, email, telefono
	public $nombre;
	public $direccion;
	public $comuna;
	public $region;
	public $email;
	public $cel;

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
		$sql = "INSERT INTO $this->table (nombre, direccion, comuna,region,email,telefono) VALUES (:nombre, :dir, :comuna, :region, :email, :cel)";
		$stmt = $this->conn->prepare($sql);
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

	public function putData(string $sql=null) {
		#:dir, :comuna, :region, :email, :cel
		$sql = "UPDATE $this->table SET nombre = :nombre, direccion = :dir, comuna= :comuna, region = :region, email =:email, telefono = :cel WHERE $this->id_name = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':nombre', $this->nombre);
		$stmt->bindParam(':direccion', $this->direccion);
		$stmt->bindParam(':comuna', $this->comuna);
		$stmt->bindParam(':region', $this->region);
		$stmt->bindParam(':email', $this->email);
		$stmt->bindParam(':telefono', $this->telefono);
		$stmt->bindParam(':id', $this->id);
		if($stmt->execute()) {
			return TRUE;
		}
		return FALSE;
	}
}