<?php

/*config*/
require_once('../config.php');

/*database*/
require_once('../database.php');

/*controller model super class*/
require_once('../controller/Controller.php');
require_once('../model/Model.php');

/*ROOT PATH*/
define('WEBROOT',dirname($_SERVER['SCRIPT_NAME']));

/*mode autoload*/
function __autoload($modelName){
	$model_exists	= file_exists('../model/' . ucwords($modelName) . '.php');
	if($model_exists){
		require_once('../model/' . ucwords($modelName) . '.php');
	}
	$libs_exists	= file_exists('../libs/' . ucwords($modelName) . '.php');
	if($libs_exists){
		require_once('../libs/' . ucwords($modelName) . '.php');
	}
}

/*start enjoy tackphp!*/
require_once('../Bootstrap.php');
$bootstrap = new Bootstrap();
$bootstrap->dispatch();
