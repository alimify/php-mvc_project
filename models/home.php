<?php 
class HomeModel extends Model{
	public function Index(){
		return;
	}

	
	public function Event(){
		return;
	}


public function morningShift(){
	$date = isset($_GET['time']) ? date('Y-m-d',round($_GET['time']/1000)) : date('Y-m-d');
	$res['date'] = isset($_GET['time']) ? date('l, d F Y',round($_GET['time']/1000)) : date('l, d F Y');
	$sql = "SELECT a.*,users.name,DATE(event_time) FROM (SELECT * FROM events WHERE DATE(event_time) = '$date' AND shift = 1) a LEFT JOIN users ON a.uid = users.id";
	$this->query($sql);
	$res['query'] = $this->resultSet();
	echo json_encode($res);
	return;
}

public function eveningShift(){
	$date = isset($_GET['time']) ? date('Y-m-d',round($_GET['time']/1000)) : date('Y-m-d');
	$res['date'] = isset($_GET['time']) ? date('l, d F Y',round($_GET['time']/1000)) : date('l, d F Y');
	$sql = "SELECT a.*,users.name FROM (SELECT * FROM events WHERE DATE(event_time) = '$date' AND shift = 2) a LEFT JOIN users ON a.uid = users.id";
	$this->query($sql);
	$res['query'] = $this->resultSet();
	echo json_encode($res);
	return;
}

	
public function eventCloseList(){
	$date = isset($_GET['time']) ? date('Y-m-d',round($_GET['time']/1000)) : date('Y-m-d');
	$res['date'] = isset($_GET['time']) ? date('l, d F Y',round($_GET['time']/1000)) : date('l, d F Y');
	$sql = "SELECT a.*,users.name FROM (SELECT * FROM events WHERE DATE(event_time) = '$date' AND status = 2 ) a LEFT JOIN users ON a.uid = users.id";
	$this->query($sql);
	$res['query'] = $this->resultSet();
	echo json_encode($res);
	return;
}


public function closeShift(){
		$postHttp = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
		$data = json_decode($_POST['data']);
		$ids = $data->id;
		$message = $data->message;
		
	    if(!$data){return false;}
	   //$data = explode(",", $data);
	    $true = 0;
	    $false = 0;
	    
	    foreach ($ids as $item) {
	    	$this->closeShiftById(intval($item)) ? ($true++) : ($false++);
	    }
	    $results['true'] = $true;
		$results['false'] = $false;
		$results['sendPending'] = $this->sendPendingEvent($_GET['time'],$message);
	    return isset($results) ? $results : false;
}

	public function eventResults(){
		$postHttp = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
		$days = intval($postHttp['days']);
		$sort = intval($postHttp['sort']);
		$daySQL = $days ? " WHERE event_time >= DATE_SUB(CURDATE(), INTERVAL :days DAY)" : '';
		$sSQL = $sort == 3 ? ",priority ASC" : "";
		$sortSQL = " ORDER BY event_time DESC".$sSQL;
		$sql = "SELECT a.*,users.name FROM(SELECT * FROM events".$daySQL.$sortSQL.") a LEFT JOIN users ON a.uid = users.id"; 
		$this->query($sql);
		$this->bind(':days',$days);
		$rows = $this->resultSet();
		echo json_encode($rows ? $rows : false);
	}

	public function createEvent(){
		$postHttp = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
		$shift = $postHttp['shift'];
		$ticket = $postHttp['ticket'];
		$type = $postHttp['type'];
		$jiraSummary = $postHttp['jiraSummary'];
		$nocSummary = $postHttp['nocSummary'];
		$priority = $postHttp['priority'];
		$fileId = $postHttp['fileId'];
		$uid = $_SESSION['user_data']['id'];
		$results['query'] =  false;
		$results['file'] = false;

if($shift && $ticket && $type && $jiraSummary && $nocSummary && $priority){
        $query = "INSERT INTO events(shift,ticket,type,jiraSummary,nocSummary,priority,fileId,uid) VALUES(:shift,:ticket,:type,:jiraSummary,:nocSummary,:priority,:fileId,:uid)";
        $this->query($query);
        $this->bind(':shift',$shift);
        $this->bind(':ticket',$ticket);
        $this->bind(':type',$type);
        $this->bind(':jiraSummary',$jiraSummary);
        $this->bind(':nocSummary',$nocSummary);
        $this->bind(':priority',$priority);
        $this->bind(':fileId',$fileId);
        $this->bind(':uid',$uid);
        $this->execute();
        $queryId = $this->lastInsertId();
        if($queryId){
        $this->query("SELECT a.*,users.name FROM(SELECT * FROM events WHERE id = :id) a LEFT JOIN users ON users.id = a.uid");
        $this->bind(':id',$queryId);
        $results['query'] = $this->singleRow();
        $dir = ROOT_PATH."uploads/attachment/".$fileId;

        if(@move_uploaded_file($_FILES['file']['tmp_name'],$dir)){
        	$results['file'] = true;
        }
        
        }
}

echo json_encode($results);

	}


public function csvCompile(){
		$postHttp = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
		$days = intval($postHttp['days']);
		$row = intval($postHttp['row']);
		$order = strtoupper($postHttp['order']);
		$daySQL = " WHERE event_time >= DATE_SUB(CURDATE(), INTERVAL :days DAY)";

switch ($row) {
	case 1:
 $sortCol = "event_time";
		break;
	case 2:
 $sortCol = "ticket";
		break;
		case 3:
 $sortCol = "type";
		break;
		case 4:
 $sortCol = "jiraSummary";
		break;
		case 5:
 $sortCol = "nocSummary";
		break;
		case 6:
 $sortCol = "priority";
		break;
		case 7:
 $sortCol = "status";
		break;
		case 8:
$sortCol = 'name';
			break;
		
	default:
$sortCol = "shift";
		break;
}


		$sortSQL = " ORDER BY :sortCol :order";
		$fileLink = 'uploads/csv/'.time().'.csv';
        $file = ROOT_PATH.$fileLink;
       

	$sql = "SELECT 'ShiftBook', 'Event Time', 'Ticket','Type','Jira Summary','Noc Summary','Priority','Status','Reporter','Attachment'
UNION 
SELECT * FROM (SELECT a.shift,a.event_time,a.ticket,a.type,a.jiraSummary,a.nocSummary,a.priority,a.status,users.name,a.Attachment FROM(SELECT CONCAT('Shift ',shift) as shift,event_time,ticket,type,jiraSummary,nocSummary,CONCAT('S',priority) AS priority,(CASE WHEN status = 1 THEN 'Closed' ELSE 'Pending' END) AS status,uid,(CASE WHEN fileId THEN 'Download' ELSE 'No' END) AS Attachment  FROM events) a LEFT JOIN users ON a.uid = users.id$daySQL$sortSQL) b INTO OUTFILE '$file' FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '".'"'."' LINES TERMINATED BY '\n'";
	$this->query($sql);
	$this->bind(':days',$days);
	$this->bind(':sortCol',$sortCol);
	$this->bind(':order',$order);
	$results = $this->execute();
	echo json_encode($results ? $fileLink : false);
}


private function closeShiftById($id){
	$sql = "UPDATE events SET status = :status WHERE id = :id ";
	$this->query($sql);
	$this->bind(':id',$id);
	$this->bind(':status',1);
return	$this->execute();
}


private function sendPendingEvent($time,$message){
	$date = isset($time) ? date('Y-m-d',round($time/1000)) : date('Y-m-d');
	$sql = "SELECT a.*,users.name,(CASE WHEN a.fileId THEN 'Yes' WHEN !a.fileId THEN 'No' END) as attachment FROM(SELECT * FROM events WHERE status = 2 AND DATE(event_time) = :date) a JOIN users ON users.id = a.uid";
	$this->query($sql);
	$this->bind(':date',$date);
$res = $this->resultSet();
$c = $message." => Pending List :: => ";
foreach ($res as $item) {
$c.= 'Shift '.$item['shift'].'|| EventTime :'.$item['event_time'].'|| Ticket :'.$item['ticket'].'||  Type:'.$item['type'].'  
|| JiraSummary:'.$item['jiraSummary'].' ||  nocSummary:'.$item['nocSummary'].'|| Priority:S'.$item['priority'].'|| Reporter:'.$item['name'].'|| Attachment :'.$item['attachment'].'     ';
}
$count = count($res);
$title = "Passdown Pending Events ($count) - $date";
$c.= "=> Submitted By -".$_SESSION['user_data']['name'];
return Module::sendEmail(REC_MAIL,$c,$title);
}

public function getDaywName(){
	$month = isset($_GET['time']) ? date('m',round($_GET['time']/1000)) : date('m');
	$year = isset($_GET['time']) ? date('Y',round($_GET['time']/1000)) : date('Y');
	$daysInMonth = $this->daysInMonth($year,$month);
	$loop = array();
	for ($i=1; $i <= $daysInMonth; $i++) { 
		$loop[] = array('day' => $i,'name' => $this->getDayName("$i-$month-$year"),'shift1' => $this->havePendingEvent("$year-$month-$i",1),'shift2' => $this->havePendingEvent("$year-$month-$i",2));
	}
return $loop;	
}
private function getDayName($date){
	return date('D',strtotime($date));
}

private function havePendingEvent($date,$shift){
	$sql = "SELECT COUNT(*) as count FROM events WHERE status = 2 AND shift = $shift AND DATE(event_time) = :date LIMIT 0,1";
	$this->query($sql);
	$this->bind(':date',$date);
$res = $this->singleRow();
return $res['count'];
}

public function showDateEvent(){
	$getHttp = filter_input_array(INPUT_GET,FILTER_SANITIZE_STRING);
	$date = $getHttp['date'];
	$this->query("SELECT a.*,b.name FROM(SELECT * FROM eventsbydate WHERE event_time = :date) a LEFT JOIN users b ON b.id = a.uid");
	$this->bind(':date',$date);
$res=$this->resultSet();
	return $res;
}

public function createDateEvent(){
	$postHttp = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
	$uid = $_SESSION['user_data']['id'];
	$date = $postHttp['date'];
	$fileId = $postHttp['fileId'];
	$location = $postHttp['location'];
	$subject = $postHttp['subject'];
	$startTime = $postHttp['startTime'];
	$endTime = $postHttp['endTime'];
	$summary = $postHttp['summary'];
	$dir = ROOT_PATH."uploads/attachment/".$fileId;
	$file = false;

	if(@move_uploaded_file($_FILES['file']['tmp_name'],$dir)){
		$file = $fileId;
	 }
   
	 $this->query("INSERT INTO eventsbydate(uid,subject,location,startTime,endTime,summary,fileId,event_time) VALUES(:uid,:subject,:location,:startTime,:endTime,:summary,:fileId,:event_time)");
	 $this->bind(':uid',$uid);
	 $this->bind(':subject',$subject);
	 $this->bind(':location',$location);
	 $this->bind(':startTime',$startTime);
	 $this->bind(':endTime',$endTime);
	 $this->bind(':summary',$summary);
	 $this->bind(':fileId',$file);
	 $this->bind(':event_time',$date);
$res=$this->execute();
return array('results' => $res, 'file' => $file);
}


/*
Calender
*/

private $currentYear=0; 
private $currentMonth=0;
private $currentDay=0;
private $currentDate=null;
private $daysInMonth=0;


private function daysInMonth($year = false, $month = false){
	$year = $year ? $year : date('Y');
	$month = $month ? $month : date('m');
	return date('t',strtotime("$year-$month-01"));
}

private function weekInMonth($year = false,$month = false){
	$year = $year ? $year : date('Y');
	$month = $month ? $month : date('m');
	$daysInMonth = $this->daysInMonth($year,$month);
	$weeks = ceil($daysInMonth/7);
	$monthEndingDay = date('N',strtotime("$year-$month-".$daysInMonth));
	$monthStartDay = date('N',strtotime("$year-$month-01"));
	if($monthEndingDay<$monthStartDay){
		$weeks++;
	}
return $weeks;
}

public function dayLabels(){
	$labels = array("Mon","Tue","Wed","Thu","Fri","Sat","Sun");
	$contents = '';
	foreach ($labels as $Index=>$label) {
		$contents.= '<li class="'.($label==6?'end title':'start title').' title">'.$label.'</li>';
	}
	return $contents;
}

private function calenderNavigation(){
         
	$nextMonth = $this->currentMonth==12?1:intval($this->currentMonth)+1;
	 
	$nextYear = $this->currentMonth==12?intval($this->currentYear)+1:$this->currentYear;
	 
	$preMonth = $this->currentMonth==1?12:intval($this->currentMonth)-1;
	 
	$preYear = $this->currentMonth==1?intval($this->currentYear)-1:$this->currentYear;
	 
	return
		'<div class="header">'.
			'<a class="prev" href="'.ROOT_URL.'index.php?controller=home&action=maintenance&month='.sprintf('%02d',$preMonth).'&year='.$preYear.'">Prev</a>'.
				'<span class="title">'.date('Y M',strtotime($this->currentYear.'-'.$this->currentMonth.'-1')).'</span>'.
			'<a class="next" href="'.ROOT_URL.'index.php?controller=home&action=maintenance&month='.sprintf("%02d", $nextMonth).'&year='.$nextYear.'">Next</a>'.
		'</div>';
}


private function calendershowDay($cellNumber){
         
	if($this->currentDay==0){
		 
		$firstDayOfTheWeek = date('N',strtotime($this->currentYear.'-'.$this->currentMonth.'-01'));
				 
		if(intval($cellNumber) == intval($firstDayOfTheWeek)){
			 
			$this->currentDay=1;
			 
		}
	}
	 
	if( ($this->currentDay!=0)&&($this->currentDay<=$this->daysInMonth) ){
		 
		$this->currentDate = date('Y-m-d',strtotime($this->currentYear.'-'.$this->currentMonth.'-'.($this->currentDay)));
		 
		$cellContent = $this->currentDay;
		 
		$this->currentDay++;   
		 
	}else{
		 
		$this->currentDate =null;

		$cellContent=null;
	}
		 
	$dcontent = "<a href='".ROOT_URL."index.php?controller=home&action=showdatevent&date=".$this->currentYear."-".$this->currentMonth."-".$cellContent."'>".$cellContent."</a>";

	return '<li id="li-'.$this->currentDate.'" class="'.($cellNumber%7==1?' start ':($cellNumber%7==0?' end ':' ')).
			($cellContent==null?'mask':'').'">'.$dcontent.'</li>';
}

public function calenderShow() {
	$postHttp = filter_input_array(INPUT_GET,FILTER_SANITIZE_STRING);
	$year  = isset($postHttp['year']) ? $postHttp['year'] : date("Y",time());
	$month = isset($postHttp['month']) ? $postHttp['month'] : date("m",time());
	$this->currentYear=$year;
	$this->currentMonth=$month;
	$this->daysInMonth=$this->daysInMonth($year,$month);  

	$content='<div id="calendar">'.
					'<div class="box">'.
					$this->calenderNavigation().
					'</div>'.
					'<div class="box-content">'.
							'<ul class="label">'.$this->dayLabels().'</ul>';   
							$content.='<div class="clear"></div>';     
							$content.='<ul class="dates">';    
							 
							$weeksInMonth = $this->weekInMonth($year,$month);
							// Create weeks in a month
							for( $i=0; $i<$weeksInMonth; $i++ ){
								 
								//Create days in a week
								for($j=1;$j<=7;$j++){
									$content.= $this->calendershowDay($i*7+$j);
								}
							}
							 
							$content.='</ul>';
							 
							$content.='<div class="clear"></div>';     
		 
					$content.='</div>';
			 
	$content.='</div>';
	return $content;   
}

	////End Of Controller
}