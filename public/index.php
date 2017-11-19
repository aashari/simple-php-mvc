<?php

require_once("../vendor/autoload.php");

#get client access url
$uri = @$_SERVER['REDIRECT_URL']?$_SERVER['REDIRECT_URL']:@$_SERVER['PATH_INFO'];
#replace duplicate slash
$uri = preg_replace('/(\/+)/','/',$uri);
$uri = ltrim(rtrim($uri,'/'),'/');
#explode url by slash
$uri = explode('/', $uri);

#getHTTPMethod 
$requestMethod = @$_SERVER['REQUEST_METHOD'];
$requestMethod = strtolower($requestMethod);
if(empty($requestMethod)) $requestMethod = "get";

#setting default controller and method
$controller = "home";
$method = "index";

#uri to controller
if(@$uri[0]) {
    $controller = $uri[0];
    unset($uri[0]);
}

#uri to method
if(@$uri[1]) {
    $method = $uri[1];
    unset($uri[1]);
}

#get the reset of uri as parameters
$parameters = array_values($uri);

#translate the controller
$controller = str_replace('-', ' ', $controller);
$controller = ucwords($controller);
$controller = str_replace(' ','',$controller);
$controller = $controller."Controller";

#translate the method
$method = str_replace('-', ' ', $method);
$method = ucwords($method);
$method = str_replace(' ','',$method);
$method = lcfirst($method);

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