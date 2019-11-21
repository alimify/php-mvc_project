<?php

class noticeMsg{

	public static function setNoticeMsg($text,$type){
if($type=='error'){
$_SESSION['NoticeErrMsg'] = $text;
}else{
$_SESSION['NoticeSuccMsg'] = $text;
}
	}
	public static function displayNoticeMsg(){
if(isset($_SESSION['NoticeErrMsg'])){
echo '<div class="alert alert-danger">'.$_SESSION['NoticeErrMsg'].'</div>';
unset($_SESSION['NoticeErrMsg']);
	}
if(isset($_SESSION['NoticeSuccMsg'])){
echo '<div class="alert alert-success">'.$_SESSION['NoticeSuccMsg'].'</div>';
unset($_SESSION['NoticeSuccMsg']);
	}
}
}