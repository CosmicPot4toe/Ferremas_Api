<?php

class BaseModel{
	protected $conn;
	protected $table;
	protected $id_name;
	public $id;

	public function __construct(PDO $db,string $table,string $id_name="id"){
		$this->conn = $db;
		$this->table = $table;
		$this->id_name = $id_name;
	}
	public function IdName(){
		return $this->id_name;
	}
	public function __toString() {
		return $this->table;
	}
	public function fetchAll() {
		#common stmt
		$sql ="SELECT * FROM $this->table";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();

		#get rowCount
		$sql="SELECT COUNT(*) FROM $this->table";
		$rowCount = $this->conn->query($sql)->fetchColumn();
		return [$stmt,$rowCount];
	}

	public function fetchOne() {
		#common stmt
		$sql="SELECT * FROM $this->table WHERE $this->id_name = $this->id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();

		#get rowCount
		$sql="SELECT COUNT(*) FROM $this->table WHERE $this->id_name = $this->id";
		$rowCount = $this->conn->query($sql)->fetchColumn();
		return [$stmt,$rowCount];
	}

	public function delete() {
		#common functionality for all tables until proven otherwise
		$sql="DELETE FROM $this->table WHERE $this->id_name = $this->id";
		$stmt = $this->conn->prepare($sql);
		if($stmt->execute()) {
			return TRUE;
		}
		return FALSE;
	}

	public function postData() {
	}
	public function putData() {
		$query = "UPDATE $this->table SET ";
		$res=$this->checkParams();
		if(!empty($res)){
			$query .= implode(', ',$res). " WHERE $this->id_name = :id";
		}
		// echo "$query\n";
		// return TRUE;
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id', $this->id);
		if($stmt->execute()) {
			return TRUE;
		}
		return FALSE;
	}
	public function checkParams(){
		$sql =array();
		return $sql;
	}
}