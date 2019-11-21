<?php
session_start();
require('config.php');


//AutoLoader....
require_once 'vendor/autoload.php';


//Load Main Classes...
foreach (glob("./classes/*.php") as $class)
{
    include $class;
}


//Load Controllers...
foreach (glob("./controllers/*.php") as $controller)
{
    include $controller;
}

//Load Models...
foreach (glob("./models/*.php") as $model)
{
    include $model;
}



///Execute Views...
$bootstrap = new Bootstrap($_GET);
$controller = $bootstrap->createController();
if($controller){
	$controller->executeAction();
}