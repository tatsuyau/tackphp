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
	require_once('../model/' . ucwords($modelName) . '.php');
}

/*start enjoy tackphp!*/
require_once('../Bootstrap.php');
$bootstrap = new Bootstrap();
$bootstrap->dispatch();
