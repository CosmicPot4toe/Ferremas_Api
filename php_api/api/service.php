<?php
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: POST');

	include_once '../config/Database.php';
	include_once '../models/Producto.php';
	include_once '../models/Tienda.php';



	$db = new Database();
	$db = $db->connect();
	// dynamic modelS
	$model = $_GET['model'];
	switch ($model) {
		case 'Producto':
			$model = new Producto($db,'productos');
			break;
		case 'Tienda':
			$model = new Tienda($db,'tiendas');
			break;
		default:
			echo json_encode(array('message' => "$model doesn't exist!"));
			exit;
	}
	
	try {
		if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
			$data = json_decode(file_get_contents("php://input"));
			$model->id = isset($data->id) ? $data->id : NULL;
			if(! is_null($model->id)) {
				if($model->delete()) {
				echo json_encode(array('message' => 'Student deleted'));
				} else {
				echo json_encode(array('message' => 'Student Not deleted, try again!'));
				}
			} else {
			echo json_encode(array('message' => "Error: Student ID is missing!"));
			}
		}
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$data =(array) json_decode(file_get_contents("php://input"));
			foreach(get_object_vars($model) as $k=>$v){
				if ($k!="id"){
					$model->$k = $data[$k];
				}
			}
			if($model->postData()) {
				echo json_encode(array('message' => 'Student added'));
			} else {
				echo json_encode(array('message' => 'Student Not added, try again!'));
			}
		}
		if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
			$data =(array) json_decode(file_get_contents("php://input"));
			try {
				foreach(get_object_vars($model) as $k=>$v){
					$model->$k = $data[$k];
				}
				if(! is_null($model->id)) {
					if($model->putData()) {
					echo json_encode(array('message' => 'Student updated'));
					} else {
					echo json_encode(array('message' => 'Student Not updated, try again!'));
					}
				} else {
				echo json_encode(array('message' => "Error: Student ID is missing!"));
				}
			} catch (\Throwable $th) {
				echo $th;
			}
		}
		if ($_SERVER['REQUEST_METHOD'] === 'GET') {
			try {
				$res = $model->fetchAll();
				$models_ = array();
				$data = json_decode(file_get_contents("php://input"));
				if(isset($data->id)) {
					$model->id = $data->id;
					if($model->fetchOne()) {
						foreach ($model as $k => $v) {
							$models_[$k]=$v;
						}
						print_r(json_encode($models_));
					} else {
						echo json_encode(array('message' => "No records found!"));
					}
				} elseif($res[1] > 0) {
					$models = array();
					while($row = $res[0]->fetch(PDO::FETCH_ASSOC)) {
						foreach($row as $k => $v){
							$models_[$k]=$v;
						}
						array_push($models, $models_);
					}
					echo json_encode($models);
				} else {
					echo json_encode(array('message' => "No records found!"));
				}
			}catch (Throwable $th) {
				//throw $th;
				echo $th;
			}
		} 
	} catch (\Throwable $th) {
		//throw $th;
		echo $th;
	}