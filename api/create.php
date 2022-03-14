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

if(!empty($data->task) && !empty($data->created)){    

    $tasks->task = $data->task;	
    $tasks->created = date('Y-m-d H:i:s'); 
    
    if($tasks->create()){         
        http_response_code(201);         
        echo json_encode(array("message" => "task was created successfully."));
    } else{         
        http_response_code(503);        
        echo json_encode(array("message" => "soory! Unable to create item."));
    }
}else{    
    http_response_code(400);    
    echo json_encode(array("message" => "Unable to create task. Data is incomplete."));
}
?>