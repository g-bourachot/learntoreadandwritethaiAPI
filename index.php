<?php
 
require 'vendor/slim/Slim.php';
\Slim\Slim::registerAutoloader();


$app = new \Slim\Slim();
 
$app->get('/', function() use($app) {
    $app->response->setStatus(200);
    echo "Welcome to Slim 3.0 based API";
}); 
 
$app->run();