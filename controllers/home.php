<?php 

class Home extends Controller{
	
	protected function Index(){
Module::loginCheck();
$viewmodel = new HomeModel();
$this->ReturnView($viewmodel->Index(),true);
	}

	protected function morningShift(){
Module::loginCheck();
header('Content-Type: application/json');
$viewmodel = new HomeModel();
$viewmodel->morningShift();	
	}

	protected function eveningShift(){
Module::loginCheck();
header('Content-Type: application/json');
$viewmodel = new HomeModel();
$viewmodel->eveningShift();	
	}

	protected function eventCloseList(){
Module::loginCheck();
header('Content-Type: application/json');
$viewmodel = new HomeModel();
$viewmodel->eventCloseList();	
	}

protected function closeShift(){
Module::loginCheck();
header('Content-Type: application/json');
$viewmodel = new HomeModel();
echo json_encode($viewmodel->closeShift());	
}
	protected function Event(){
		Module::loginCheck();
		$model = new HomeModel();
		$this->ReturnView($model->Event(),true);
	}

protected function eventResults(){
	Module::loginCheck();
	header('Content-Type: application/json');
	$model = new HomeModel();
	$model->eventResults();
}


	protected function createEvent(){
		Module::loginCheck();
        header('Content-Type: application/json');
		$model = new HomeModel();
		$model->createEvent();
	}

	protected function csvCompile(){
		Module::loginCheck();
		header('Content-Type: application/json');
		$model = new HomeModel();
		$model->csvCompile();
	}

protected function maintenance(){
	Module::loginCheck();
	$model = new HomeModel();

	$this->ReturnView($model->calenderShow(),true);
}

protected function getDaywName(){
	Module::loginCheck();
	header('Content-Type: application/json');
	$viewmodel = new HomeModel();
	echo json_encode($viewmodel->getDaywName());	
		}
protected function showdatevent(){
	Module::loginCheck();
	$model = new HomeModel();
	$this->ReturnView($model->showDateEvent(),true);
}

protected function createDateEvent(){
	Module::loginCheck();
	header('Content-Type: application/json');
	$viewmodel = new HomeModel();
	echo json_encode($viewmodel->createDateEvent());	
		}


}