
<?php

	require 'connection.php';

	class class_model{

		public $host = db_host;
		public $user = db_user;
		public $pass = db_pass;
		public $dbname = db_name;
		public $conn;
		public $error;
 
		public function __construct(){
			$this->connect();
		}
 
		private function connect(){
			$this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
			if(!$this->conn){
				$this->error = "Fatal Error: Can't connect to database".$this->conn->connect_error;
				return false;
			}
		}

		public function user_account($user_id){
			$stmt = $this->conn->prepare("SELECT * FROM `users` WHERE `id` = ?") or die($this->conn->error);
		    $stmt->bind_param("i", $user_id);
			if($stmt->execute()){
				$result = $stmt->get_result();
				$fetch = $result->fetch_array();
				return array(
					'complete_name'=> $fetch['name']
					// 'last_name'=>$fetch['last_name']
				);
			}	
		}


	    public function add_user($name, $user_type, $username, $password, $status){
	       $stmt = $this->conn->prepare("INSERT INTO `users` (`name`, `user_type`, `username`, `password`, `status`) VALUES(?, ?, ?, ?, ?)") or die($this->conn->error);
			$stmt->bind_param("sssss", $name, $user_type, $username, $password, $status);
			if($stmt->execute()){
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}

	    public function fetchAll_user(){ 
            $sql = "SELECT * FROM  users";
				$stmt = $this->conn->prepare($sql); 
				$stmt->execute();
				$result = $stmt->get_result();
		        $data = array();
		         while ($row = $result->fetch_assoc()) {
		                   $data[] = $row;
		            }
		         return $data;

		  }

	    public function edit_user($name, $user_type, $username, $password, $status, $id){
			$sql = "UPDATE `users` SET  `name` = ?, `user_type` = ?, `username` = ?, `password` = ?, `status` = ?  WHERE id = ?";
			 $stmt = $this->conn->prepare($sql);
			$stmt->bind_param("sssssi", $name, $user_type, $username, $password, $status, $id);
			if($stmt->execute()){
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}

	   public function delete_user($user_id){
				$sql = "DELETE FROM users WHERE id = ?";
				 $stmt = $this->conn->prepare($sql);
				$stmt->bind_param("i", $user_id);
				if($stmt->execute()){
					$stmt->close();
					$this->conn->close();
					return true;
				}
			}



	 
			 public function fetchAll_employees(){ 
				 $sql = "SELECT * FROM  employee";
					 $stmt = $this->conn->prepare($sql); 
					 $stmt->execute();
					 $result = $stmt->get_result();
					 $data = array();
					  while ($row = $result->fetch_assoc()) {
								$data[] = $row;
						 }
					  return $data;
	 
			   }
	 ///unfinish
			 public function edit_employee($name, $user_type, $username, $password, $status, $id){
				 $sql = "UPDATE `users` SET  `name` = ?, `user_type` = ?, `username` = ?, `password` = ?, `status` = ?  WHERE id = ?";
				  $stmt = $this->conn->prepare($sql);
				 $stmt->bind_param("sssssi", $name, $user_type, $username, $password, $status, $id);
				 if($stmt->execute()){
					 $stmt->close();
					 $this->conn->close();
					 return true;
				 }
			 }
	 
			public function delete_employee($emp_id){
					 $sql = "DELETE FROM employee WHERE emp_id = ?";
					  $stmt = $this->conn->prepare($sql);
					 $stmt->bind_param("i", $emp_id);
					 if($stmt->execute()){
						 $stmt->close();
						 $this->conn->close();
						 return true;
					 }
				 }

	}	
?>