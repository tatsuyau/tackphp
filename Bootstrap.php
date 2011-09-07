<?php
class Bootstrap{
	private $controllerName;
	private $actionName;

	public function dispatch(){
		if(!isset($_GET['mode'])){
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
				if(DEBUG_MODE === true){
					$errorBody = 'tackphp error: GET[mode] params more than 2 params.';
				}else{
					$errorBody = ERROR404;
				}
				throw new Exception($errorBody);
			}
			$controller_file = '../controller/'  . ucwords($controllerName) . 'Controller.php';
			if(file_exists($controller_file)){
				require_once($controller_file);
			}else{
				if(DEBUG_MODE === true){
					$errorBody = 'tackphp error: ' . ucwords($controllerName) . 'Controller.php is not found.';
				}else{
					$errorBody = ERROR404;
				}
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

			if(method_exists($controllerInst,$actionName) && 0 !== strpos($actionName,'_')){
				if($controllerInst->$actionName() === false){
					if(DEBUG_MODE === true){
						$errorBody = 'tackphp error: ' . $controllerName . '::' . $actionName . '() return false.';
					}else{
						$errorBody = ERROR404;
					}
					 throw new Exception($errorBody);
				}
				if(!file_exists($controllerInst->contents_for_layout)){
					if(DEBUG_MODE === true){
						$errorBody = 'tackphp error: ' . $contents_for_layout . ' is not found.';
					}else{
						$errorBody = ERROR404;
					}
					throw new Exception($errorBody);
				}
				if(!file_exists($controllerInst->layout)){
					if(DEBUG_MODE === true){
						$errorBody = 'tackphp error: ' . $controllerInst->layout . ' is not found.';
					}else{
						$errorBody = ERROR404;
					}
					throw new Exception($errorBody);
				}
			}else{
				if(DEBUG_MODE === true){
					$errorBody = 'tackphp error: ' . $controllerName . '::' . $actionName . '() method is not found.';
				}else{
					$errorBody = ERROR404;
				}
				throw new Exception($errorBody);
			}

		}catch(Exception $e){
				/*TODO エラーページ振り分け*/
				echo $e->getMessage(); 
		}
	}
}
