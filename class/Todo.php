<?php
class Todo{   
    
	//name of table in the DB
    private $todoTable = "todo";

	//Colums of todo table
    public $id;
    public $task;   
    public $created; 
	public $modified;
	
	//initialaze connexion to DB
    private $connexion;
	
	//create a connexion
    public function __construct($db){
        $this->connexion = $db;
    }	
	
	//list all tasks || list a single task 
	function read(){	

		if($this->id) { //list one task by id
			$stmt = $this->connexion->prepare("SELECT * FROM ".$this->todoTable." WHERE id = ?");
			$stmt->bind_param("i", $this->id);					
		} else { //list all tasks
			$stmt = $this->connexion->prepare("SELECT * FROM ".$this->todoTable);		
		}

		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}
	
	//create a new task
	function create(){
		
		$stmt = $this->connexion->prepare("
											INSERT INTO ".$this->todoTable."(`task`, `created`)
											VALUES(?,?)
										");
		
		$this->task = htmlspecialchars(strip_tags($this->task));
		$this->created = htmlspecialchars(strip_tags($this->created));
		
		
		$stmt->bind_param("ss", $this->task , $this->created);
		
		if($stmt->execute()){
			return true;
		}
	 
		return false;		 
	}
	
	//Modify task
	function update(){
	 
		$stmt = $this->connexion->prepare("
			UPDATE ".$this->todoTable." 
			SET task= ?, created = ?
			WHERE id = ?");
	 
		$this->id = htmlspecialchars(strip_tags($this->id));
		$this->task = htmlspecialchars(strip_tags($this->task));
		$this->created = htmlspecialchars(strip_tags($this->created));
	 
		$stmt->bind_param("ssi", $this->task, $this->created, $this->id);
		
		if($stmt->execute()){
			return true;
		}
	 
		return false;
	}
	
	// delete a task
	function delete(){
		
		$stmt = $this->connexion->prepare("
			DELETE FROM ".$this->todoTable." 
			WHERE id = ?");
			
		$this->id = htmlspecialchars(strip_tags($this->id));
	 
		$stmt->bind_param("i", $this->id);
	 
		if($stmt->execute()){
			return true;
		}
	 
		return false;		 
	}
}
?>