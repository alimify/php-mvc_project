<?php 
class UserModel extends Model{


public function register(){
if(!USER_REGISTRATION){return;}
$post = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
if($post['submit']){
	if($post['name']== '' || $post['email']== '' || $post['password']== ''){
noticeMsg::setNoticeMsg('Something went wrong,please check','error');
	}else{
$this->query("INSERT INTO users (name,email,password) VALUES(:name,:email,:password)");
$this->bind(':name',$post['name']);
$this->bind(':email',$post['email']);
$this->bind(':password',$post['password']);
$this->execute();

if($this->lastInsertId()){
header('Location: '.ROOT_URL.'index.php?controller=users&action=login');
}
return;
}}
	}

public function login(){
$post = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
if($post['submit']){
$this->query("SELECT * FROM users WHERE email = :email AND password = :password");
$this->bind(':email',$post['email']);
$this->bind(':password',$post['password']);
$row = $this->singleRow();
if($row){

$_SESSION['is_logged_in'] = true;
$_SESSION['user_data'] = array(
'id' => $row['id'],
'name' => $row['name'],
'email' => $row['email'],
'status' => $row['status'],
'role' => $row['role']
);

header('Location: '.ROOT_URL);
exit();

}else{

noticeMsg::setNoticeMsg('Something went wrong,please check','error');

}
return;
}}



public function userLists(){
	$this->callUserRoleUpdater(filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING));
	$sql = "SELECT id,name,email,(CASE WHEN role = 1 THEN 'Admin' ELSE 'Member' END) as role,status,join_time FROM users";
	$this->query($sql);
	$res = $this->resultSet();
	return $res;

}



private function callUserRoleUpdater($postHttp){
		if(!isset($postHttp['id']) || $_SESSION['user_data']['role'] !=1){return;}

if(isset($postHttp['active'])){
$ids = $postHttp['id'];
$count = 0;
foreach ($ids as $id) {
if($this->updateUserRole($id,1)){
$count++;
}
}
noticeMsg::setNoticeMsg("$count Account activated..",'success');

}elseif(isset($postHttp['deactive'])){
$ids = $postHttp['id'];
$count = 0;
foreach ($ids as $id) {
if($this->updateUserRole($id,2)){
$count++;
}
}
noticeMsg::setNoticeMsg("$count Account de-activated..",'success');
}
}



private function updateUserRole($id,$status){
	$sql = "UPDATE users SET status = :status WHERE id = :id";
	$this->query($sql);
	$this->bind(':status',$status);
	$this->bind(':id',$id);
	return $this->execute();
}

}