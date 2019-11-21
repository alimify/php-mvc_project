<?php
///Development...
//error_reporting(0);

//Set Max Execution...
ini_set('max_execution_time', 600);

//DB Params
define("DB_HOST", "localhost");
define("DB_NAME", "passdown");
define("DB_USER", "root");
define("DB_PASS", "");

//Define URL
define("ROOT_PATH", $_SERVER['DOCUMENT_ROOT']."/passdown/");
define("ROOT_URL", "http://random.work/passdown/");


///User Registration
define("USER_REGISTRATION", true);



//API Credentials
define("API_USER", "");
define("API_PASS", "");


///SMTP Credentials 
define("SMTP_SERVER","");
define("SMTP_PORT","");
define("SMTP_USER",""); ///Enter Email
define("SMTP_PASS","");




///Recieved Mail ON...
define("REC_MAIL", "");
   