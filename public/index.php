<?php

// require_once __DIR__ . '/../app/Controllers/BookingController.php';



$url=$_GET['url']?? 'home';
$urlParts = explode('/', $url);
$route = !empty($urlParts[0]) ? $urlParts[0] : 'home';


if ($route === 'home') {
        $controllerName = 'BookingController';

    $methodName = !empty($urlParts[1]) ? $urlParts[1] : 'showSlot';
} 
else {
   
    $controllerName = ucfirst($route) . 'Controller';
    
   
      $methodName = !empty($urlParts[1]) ? $urlParts[1] : 'index';
}

$controllerPath = '../app/Controllers/' . $controllerName . '.php';

if (file_exists($controllerPath)) {
    require_once $controllerPath;
    $controller = new $controllerName;
    $controller->$methodName();

} 
else {
    http_response_code(404);
    echo "Error: Page '$controllerName' not found.";
}