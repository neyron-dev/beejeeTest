<?
define("DS",DIRECTORY_SEPARATOR);
use Framework\Application;
use Framework\Router;

$app = Application::getInstance();
echo $app->run();