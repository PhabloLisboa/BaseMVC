<?php  

class loginController extends controller{

	public function index(){
		session_start();
		$_SESSION["email"] = "";
		$_SESSION["password"] = "";
		$user = new user;
		$this->loadView("loginView");
		if(isset($_POST["email"]) && isset($_POST["password"])){
			$_SESSION["email"] = addslashes($_POST["email"]);
			$_SESSION["password"] = addslashes($_POST["password"]);
			$_SESSION["password"] = md5($_SESSION["password"]);			
		}
		else{
			header("http://".$_SERVER['HTTP_HOST']);
		}

		if(isset($_SESSION["email"]) && !empty($_SESSION["email"])){
				try{
					if($user->checkUserData($_SESSION["email"],$_SESSION["password"])){
					header("Location: home");
					}
				}
				catch(Exception $e){
					$this->loadView("loginView",["message" => "Error"]);
				}
		}else{			
			$this->loadView("loginView");
		}

		ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);

	}

}

?>