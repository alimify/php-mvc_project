<?php 

abstract class Model{
	protected $dbh;
	protected $stmt;
	
	public function __construct(){
$this->dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
	}

public function query($query){
$this->stmt = $this->dbh->prepare($query);
}

public function bind($param,$value,$type= null){

if(is_null($type)){
	switch (true) {
		case is_int($value):
$type = PDO::PARAM_INT;
			break;
		case is_null($value):
$type = PDO::PARAM_NULL;
		break;
		case is_bool($value):
$type = PDO::PARAM_BOOL;
		break;
		default:
$type = PDO::PARAM_STR;
			break;
	}
}

$this->stmt->bindValue($param,$value,$type);
}

public function execute(){
return $this->stmt->execute();
}

public function resultSet(){
$this->execute();
return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function lastInsertId(){
	return $this->dbh->lastInsertId();
}

public function singleRow(){
$this->execute();
return $this->stmt->fetch(PDO::FETCH_ASSOC);
}


public function apiData($url)
{
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_USERPWD, API_USER.":".API_PASS);
curl_setopt($curl,CURLOPT_ENCODING,'gzip');
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($curl, CURLOPT_TIMEOUT, 10);
$header[] = "Accept-Language: en";
$header[] = "User-Agent: Mozilla/5.0 (Windows; U; Windows NT 6.0; de; rv:1.9.2.3) Gecko/20100401 Firefox/3.6.3";
$header[] = "Pragma: no-cache";
$header[] = "Cache-Control: no-cache";
$header[] = "Accept-Encoding: gzip,deflate";
$header[] = "Content-Encoding: gzip";
$header[] = "Content-Encoding: deflate";
curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
$res = curl_exec($curl);
$getinfo = curl_getinfo($curl);
curl_close($curl);
return $res;
}


//End Class 
}