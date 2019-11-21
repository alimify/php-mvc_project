<?php

class Bootstrap{
	private $controller;
	private $action;
	private $request;

	public function __construct($request){
		$this->request = $request;

		//For controller
	$this->controller = isset($this->request['controller']) ? $this->request['controller'] : 'home';
	$this->action = isset($this->request['action']) ? $this->request['action'] : 'index';

	}
public function createController(){
	//Check class
if(class_exists($this->controller)){
	$parents = class_parents($this->controller);
	//Check extend
	if(in_array("Controller", $parents)){
if(method_exists($this->controller, $this->action)){
return new $this->controller($this->action,$this->request);
}else{
	//If method not exist
	echo "<h1>Method not exist.</h1>";
	return;
}

	}else{
	//If controller not exist
	echo "<h1>Controller not exist.</h1>";
	return;
	}
}else{
	//If class not exist
	echo "<h1>Class not exist.</h1>";
	return;
}
}


}