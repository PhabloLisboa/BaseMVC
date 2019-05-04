<?php 
class Core {

		public function run(){
			$currentController;
			$currentAction;
			$params = [];
			$url = explode("index.php", $_SERVER["PHP_SELF"]);
			$url = end($url); 


			if(!empty($url)){
				$url = explode("/", $url);

				//Remove "/" of array's begin
				array_shift($url);

				$currentController = $url[0]."Controller";
				array_shift($url);

				if(isset($url[0])){
					$currentAction = $url[0];
					array_shift($url);
				}
				else{
					$currentAction = "index";
				}

				if(count($url) > 0){

					$params = $url;
				}

			}

			else{
				$currentController = "homeController";
				$currentAction = "index";				
			};

			$controller = new $currentController();
			call_user_func_array(array($controller, $currentAction),array($params));
		
		require_once "core/controller.php";
		}
	}
?>