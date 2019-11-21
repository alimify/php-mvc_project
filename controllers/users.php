<?php 

class Users extends Controller{

	protected function register(){

$viewmodel = new UserModel();
$this->returnView($viewmodel->register(),true);


	}

	protected function login(){
		
if(isset($_SESSION['is_logged_in'])){
header('Location: '.ROOT_URL);
exit();
}


$viewmodel = new UserModel();
$this->returnView($viewmodel->login(),true);
	}
protected function logout(){
	unset($_SESSION['is_logged_in']);
	unset($_SESSION['user_data']);
	session_destroy();
	header('Location: '.ROOT_URL);
}


	protected function userlists(){
Module::loginCheck();

$viewmodel = new UserModel();
$this->returnView($viewmodel->userLists(),true);
	}


	protected function activeNotice(){
		
if(!isset($_SESSION['is_logged_in'])){
header('Location: '.ROOT_URL);
exit();
}
$this->returnView(false,true);
	}



}