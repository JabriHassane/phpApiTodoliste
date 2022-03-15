<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/Database.php';
include_once '../class/Todo.php';

//get a connection with DB
$database = new Database();
$db = $database->getConnection();

//intialize a new task to do
$tasks = new Todo($db);

//Transforme the user input to a Php Object and decod it
$tasks->id = (isset($_GET['id']) && $_GET['id']) ? $_GET['id'] : '0';

$result = $tasks->read();

if($result->num_rows > 0){    
    $taskRecords=array();
    $taskRecords["tasks"]=array(); 
	while ($item = $result->fetch_assoc()) { 	
        extract($item); 
        $taskDetails=array(
            "id" => $id,
            "task" => $task,           
			"created" => $created,
            "modified" => $modified			
        ); 
       array_push($taskRecords["tasks"], $taskDetails);
    }    
    http_response_code(200);     
    echo json_encode($taskRecords);
}else{     
    http_response_code(404);     
    echo json_encode(
        array("message" => "No item found.")
    );
} 