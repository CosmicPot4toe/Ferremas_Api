<?php
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: POST');

	include_once '../config/Database.php';
	include_once '../models/Producto.php';
	include_once '../models/Tienda.php';
	include_once '../models/CategoriaP.php';
	include_once '../models/Categoria.php';
	include_once '../models/Stock.php';

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
		case 'CategoriaProducto':
			$model = new CategoriaP($db,'categoriaProducto');
			break;
		case 'Categoria':
			$model = new Categoria($db,'categoria');
			break;
		case 'Stock':
			$model = new Stock($db,'stock');
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
				echo json_encode(array('message' => "$model deleted"));
				} else {
				echo json_encode(array('message' => "$model Not deleted, try again!"));
				}
			} else {
			echo json_encode(array('message' => "Error: $model ID is missing!"));
			}
		}
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$data =(array) json_decode(file_get_contents("php://input"));
			foreach(get_object_vars($model) as $k=>$v){
				$model->$k = $data[$k];
			}
			if($model->postData()) {
				echo json_encode(array('message' => "$model added"));
			} else {
				echo json_encode(array('message' => "$model Not added, try again!"));
			}
		}
		if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
			$data =(array) json_decode(file_get_contents("php://input"));
			foreach($data as $k=>$v){
				$model->$k = $data[$k];
			}
			if(! is_null($model->id)) {
				if($model->putData()) {
				echo json_encode(array('message' => "$model updated"));
				} else {
				echo json_encode(array('message' => "$model Not updated, try again!"));
				}
			} else {
			echo json_encode(array('message' => "Error: $model ID is missing!"));
			}
		}
		if ($_SERVER['REQUEST_METHOD'] === 'GET') {
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
		} 
	} catch (\Throwable $th) {
		echo $th;
	}