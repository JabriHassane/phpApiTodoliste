<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/Database.php';
include_once '../class/Todo.php';
 
//get a connection with DB
$database = new Database();
$db = $database->getConnection();

//intialize a new task to do
$tasks = new Todo($db);

//Transforme the user input to a Php Object and decod it
$data = json_decode(file_get_contents("php://input"));

if(!empty($data->id)) {
	$tasks->id = $data->id;
	if($tasks->delete()){    
		http_response_code(200); 
		echo json_encode(array("message" => "task was deleted successfully."));
	} else {    
		http_response_code(503);   
		echo json_encode(array("message" => "Sorry! Unable to delete task."));
	}
} else {
	http_response_code(400);    
    echo json_encode(array("message" => "Unable to delete task. Data is incomplete."));
}
?>