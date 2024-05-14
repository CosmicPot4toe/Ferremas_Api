<?php

class BaseModel{
	protected $conn;
	protected $table;
	public $id;

	public function __construct(PDO $db,string $table){
		$this->conn = $db;
		$this->table = $table;
	}

	public function __toString() {
		return "BaseModel";
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
		$sql="SELECT  * FROM $this->table WHERE id = $this->id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();

		#get rowCount
		$sql="SELECT COUNT(*) FROM $this->table WHERE id = $this->id";
		$rowCount = $this->conn->query($sql)->fetchColumn();
		return [$stmt,$rowCount];
	}

	public function delete() {
		#common functionality for all tables until proven otherwise
		$sql="DELETE FROM $this->table WHERE id = $this->id";
		$stmt = $this->conn->prepare($sql);
		if($stmt->execute()) {
				return TRUE;
		}
		return FALSE;
	}

	public function postData() {
	}
	public function putData() {
	}
}