<?php
class Bootstrap{
	private $controllerName;
	private $actionName;

	public function dispatch(){
		if(empty($_GET['mode'])){
			$controllerName = DEFAULT_CONTROLLER;
			$actionName = DEFAULT_ACTION;
		}else{
			$params = explode("_",$_GET['mode'],3);
			$controllerName = $params[0];
			if(isset($params[1])){
				$actionName = $params[1];
			}else{
				$actionName = DEFAULT_ACTION;
			}
		}

		try{
			if(isset($params[2])){
				$errorBody = 'GET[mode] params more than 2 params.';
				throw new Exception($errorBody);
			}
			$controller_file = '../controller/'  . ucwords($controllerName) . 'Controller.php';
			if(file_exists($controller_file)){
				require_once($controller_file);
			}else{
				$errorBody = ucwords($controllerName) . 'Controller.php file is not found.';
				throw new Exception($errorBody);
			}

			$controllerClassName = $controllerName . 'Controller';
			$controllerInst = new $controllerClassName();

			$controllerInst->controllerName = $controllerName;
			$controllerInst->actionName = $actionName;

			foreach((array)$_GET as $key => $value){
				$controllerInst->_request[$key] = $value;
			}
			foreach((array)$_POST as $key => $value){
				$controllerInst->_request[$key] = $value;
			}

			if(!isset($controllerInst->layout)){
				$controllerInst->layout = DEFAULT_LAYOUT;
			}

			$controllerInst->contents_for_layout = '../view/' . $controllerName . '_' . $actionName . EXTENSION;

			if(defined('USE_DATABASE') && USE_DATABASE){
				$database = new database();
				if(!$database->isConnect){
					$errorBody = 'MySQL connect error.please set up database.php ';
					throw new Exception($errorBody);
				}
			}
			if(method_exists($controllerInst,$actionName) && 0 !== strpos($actionName,'_')){
				if($controllerInst->$actionName() === false){
					$errorBody = ucwords($controllerName) . '::' . $actionName . '() return false.';
					throw new Exception($errorBody);
				}
			}else{
				$errorBody = ucwords($controllerName) . '::' . $actionName . '() method is not found.';
				throw new Exception($errorBody);
			}

		}catch(Exception $e){
			if(DEBUG_MODE === true){
				$errorBody = '<strong>tackphp ERROR!</strong>' . $e->getMessage();
			}else{
				$errorBody = ERROR_MESSAGE;
			}

			$controllerName = ERROR_CONTROLLER;
			$errorControllerName = ERROR_CONTROLLER . 'Controller';
			$errorActionName = ERROR_ACTION;

			require_once  '../controller/'  . ucwords($errorControllerName) . '.php';
			$errorControllerInst = new $errorControllerName();

			$errorControllerInst->layout = DEFAULT_LAYOUT;
			$errorControllerInst->contents_for_layout = '../view/' . $controllerName . '_' . $errorActionName . EXTENSION;
			$errorControllerInst->$errorActionName($errorBody);
		}
	}
}
