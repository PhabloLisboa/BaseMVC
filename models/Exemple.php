<?php 

class user extends model{
	protected $email;
	protected $pass;
	protected $name;

	public function __construct($email="guest", $pass="guest", $name="guest"){
		parent::__construct();
		$this->setEmail($email);
		$this->setName($name);
		$this->setPass($pass);

	}

	public function getEmail(){
		return $this->email;
	}
	public function getName(){
		return $this->name;
	}

	protected function setEmail($email){
		$this->email = $email;
	}
	protected function setName($name){
		$this->name = $name;
	}
	protected function setPass($pass){
		$this->pass = md5($pass);
	}

	public function checkExistsUser($id ="", $email =""){
		$email = addslashes($email);
		$id = addslashes($id);
		if((isset($id) && !empty($id))||(isset($email) && !empty($email))){
			$sql= $this->pdo->prepare("SELECT * FROM user WHERE email='$email' OR id='$id'");
			$sql->execute();

			if($sql->rowCount() > 0){
				return true;
			}
			else{
				return false;
			}

		}else{
			return false;
		}
	}

	public function addUser($email,$name = "", $pass = ""){
		$email = addslashes($email);
		$name = addslashes($name);
		$pass = addslashes($pass);
		$pass = md5($pass);
		if($this->checkExistsUser(null, $email)) {
			throw new Exception('This user just have a account!');
		}else{
			$sql= $this->pdo->prepare("INSERT INTO user SET email = '$email', name = '$name', password = '$pass'");
			$sql->execute();
		}
	}

	public function removeUser($id){
		$id = addslashes($id);
		if(!$this->checkExistsUser($id)) {
			throw new Exception("This user just haven't a account!");
		}else{
			$sql= $this->pdo->prepare("DELETE FROM user WHERE id='$id'");
			$sql->execute();
		}
	}

	public function updateUser($id,$email = "",$name = "", $pass = ""){
		$id = addslashes($id);
		$email = addslashes($email);
		$name = addslashes($name);
		$pass = md5($pass);
		$pass = addslashes($pass);
		$sql= $this->pdo->prepare("SELECT * FROM user WHERE id='$id'");
		$sql->execute();
		if($sql->rowCount() > 0){
			$sql= $this->pdo->prepare("UPDATE user SET name='$name', email='$email', password='$pass' WHERE id='$id'");
			$sql->execute();	
		}else{
			throw new Exception("User not Found!");
		}
	}

	public function checkUserData($email, $pass){
		$email = addslashes($email);
		$pass = addslashes($pass);
		if($this->checkExistsUser(null, $email)){
			$sql= $this->pdo->prepare("SELECT * FROM user WHERE email='$email'AND password='$pass'");
			$sql->execute();
			if($sql->rowCount() > 0){
				return true;
			}
			else{
				throw new Exception("Incorrect Login");
			}
		}
		else{
			throw new Exception("This user just haven't a account!");
		}
	}
}


?>