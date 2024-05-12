<?php

include_once '../config/Database.php';
class Student {

	private Database $conn;
	public $id;
	public $name;
	public $address;
	public $age;

	public function __construct($db){
			$this->conn = $db;
			var_dump($this->conn);
	}
	public function __toString() {
		return "Student";
	}
	public function fetchAll() {
		$stmt = $this->conn->prepare('SELECT * FROM students');
		if ($stmt==false){
			echo "prepared statement failed";
			die;
		}
		#$stmt->execute();
		return $stmt;
	}

	public function fetchOne() {

		$stmt = $this->conn->prepare('SELECT  * FROM students WHERE id = ?');
		$stmt->bindParam(1, $this->id);
		$stmt = $stmt->execute();        

		if($stmt->numColumns() && $stmt->columnType(0) != SQLITE3_NULL) {
			
			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			$this->id = $row['id'];
			$this->name = $row['name'];
			$this->address = $row['address'];
			$this->age = $row['age'];

			$this->conn->close();
			return TRUE;

		}
		$this->conn->close();
		return FALSE;
	}

	public function postData() {

		$stmt = $this->conn->prepare('INSERT INTO students SET name = :name, address = :address, age = :age');

		$stmt->bindParam(':name', $this->name);
		$stmt->bindParam(':address', $this->address);
		$stmt->bindParam(':age', $this->age);

		if($stmt->execute()) {
			$this->conn->close();
			return TRUE;
		}
		$this->conn->close();
		return FALSE;
	}

	public function putData() {

		$stmt = $this->conn->prepare('UPDATE students SET name = :name, address = :address, age = :age WHERE id = :id');

		$stmt->bindParam(':name', $this->name);
		$stmt->bindParam(':address', $this->address);
		$stmt->bindParam(':age', $this->age);
		$stmt->bindParam(':id', $this->id);

		if($stmt->execute()) {
			$this->conn->close();
			return TRUE;
		}
		$this->conn->close();
		return FALSE;
	}

	public function delete() {

		$stmt = $this->conn->prepare('DELETE FROM students WHERE id = :id');
		$stmt->bindParam(':id', $this->id);

		if($stmt->execute()) {
			$this->conn->close();
			return TRUE;
		}
		$this->conn->close();
		return FALSE;
	}


}