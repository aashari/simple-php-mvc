<?php

require_once("../vendor/autoload.php");

$routes = [];

require_once("../router.php");

#get client access url
$uri = @$_SERVER['REDIRECT_URL'] ? $_SERVER['REDIRECT_URL'] : @$_SERVER['PATH_INFO'];
#replace duplicate slash
$uri = preg_replace('/(\/+)/', '/', $uri);
$uri = ltrim(rtrim($uri, '/'), '/');

#getHTTPMethod 
$requestMethod = @$_SERVER['REQUEST_METHOD'];
$requestMethod = strtolower($requestMethod);
if (empty($requestMethod)) $requestMethod = "get";

$params = [];

$currentRoute = @$routes[$uri][$requestMethod];
if (!$currentRoute) {
    foreach ($routes as $route => $val) {
        $currentRoute = explode('/', $uri);
        $thisRoute = explode('/', $route);
        if (count($currentRoute) == count($thisRoute)) {
            $totalCount = 0;
            for ($i = 0; $i < count($currentRoute); $i++) {
                if ($currentRoute[$i] == $thisRoute[$i]) {
                    $totalCount++;
                } else if (strpos($thisRoute[$i], '$') === 0) {
                    $totalCount++;
                    $params[substr($thisRoute[$i], 1)] = $currentRoute[$i];
                }
            }
            if ($totalCount == count($currentRoute)) {
                $currentRoute = $val[$requestMethod];
            } else {
                $currentRoute = null;
            }
        }
    }
}

if (!$currentRoute) {
    notFound();
}

$currentRoute = explode('@', $currentRoute);

#translate the controller
$controllerFile = $currentRoute[0];

$controller = explode("/", $controllerFile);
$controller = end($controller);

#translate the method
$method = $currentRoute[1];

#require controller
$path = "../controllers/" . $controllerFile . ".php";

#require controller
require_once("../controllers/Controller.php");
#require model
require_once("../models/Model.php");

if (file_exists($path)) {
    require_once($path);
    $controller = new $controller();
    echo $controller->$method($params);
} else {
    notFound();
}

function load($type, $name)
{
    require_once("../" . $type . "/" . $name . ".php");
    return new $name;
}

function config()
{
    return json_decode(file_get_contents("../config.json"));
}

function notFound()
{
    echo "Controller not found!";
    exit();
}