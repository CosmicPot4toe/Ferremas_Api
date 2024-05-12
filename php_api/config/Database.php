<?php

class Database extends SQLite3 {
    // private $host = "localhost";
    // private $user = "root";
    // private $db = "yep";
    // private $pwd = "root";
    // private $conn = NULL;
	function __construct(){
		try {
			$this->open("../db/db.slite3");
		} catch (\Throwable $th) {
			//throw $th;
			echo $th;
		}
	}
    // public function connect() {
    //     try{
    //         // $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->pwd);
    //         // $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //     } catch(PDOException $exp) {
    //         echo "Connection Error: " . $e->getMessage();
    //     }
    //     return $this->conn;
    // }

}