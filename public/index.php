<?php

require_once("../vendor/autoload.php");

$routes = [];

require_once("../router.php");

#get client access url
$uri = @$_SERVER['REDIRECT_URL']?$_SERVER['REDIRECT_URL']:@$_SERVER['PATH_INFO'];
#replace duplicate slash
$uri = preg_replace('/(\/+)/','/',$uri);
$uri = ltrim(rtrim($uri,'/'),'/');

#getHTTPMethod 
$requestMethod = @$_SERVER['REQUEST_METHOD'];
$requestMethod = strtolower($requestMethod);
if(empty($requestMethod)) $requestMethod = "get";

$currentRoute = $routes[$uri][$requestMethod];
$currentRoute = explode('@',$currentRoute);

#translate the controller
$controller = $currentRoute[0];

#translate the method
$method = $currentRoute[1];

#require controller
$path = "../controllers/".$controller.".php";

#require controller
require_once("../controllers/Controller.php");
#require model
require_once("../models/Model.php");

if(file_exists($path)){
    require_once($path);
    $controller = new $controller();
    echo $controller->$method($parameters);
}else{
    echo "Controller not found!";
    exit();
}

function load($type,$name){
    require_once("../".$type."/".$name.".php");
    return new $name;
}

function view($name){
    return file_get_contents("../views/".$name.".view.php");
}

function config(){
    return json_decode(file_get_contents("../config.json"));
}
