<?php

class Module {
public function __construct(){

	}


public static function loginCheck(){
if(!isset($_SESSION['is_logged_in'])){
header('Location: '.ROOT_URL.'index.php?controller=users&action=login');
exit();
}elseif($_SESSION['user_data']['status'] != 1 ){
	header('Location: '.ROOT_URL.'index.php?controller=users&action=activenotice');
    exit();
}
}

	public static function sendEmail($email,$message,$title = false){
///Subject
$subject = $title ? $title : 'Email From Passdown';
// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= "From: <".SMTP_USER."> \r\n";
$headers .= "Cc:".SMTP_USER."\r\n";

$results = mail($email,$subject,$message,$headers);
return $results;
	}

}