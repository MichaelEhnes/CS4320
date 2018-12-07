<!--
written by: Liam
tested by: Liam
debugged by: Liam
-->
<?php
require_once "../db.conf";
require_once('dbcontroller.php');
if(!empty($_SESSION)){
    session_destroy();
    echo 'session destroyed';
}

//$url = 'http://ec2-18-221-234-28.us-east-2.compute.amazonaws.com/SoftwareEngineering/';

header("Location: http://ec2-18-221-234-28.us-east-2.compute.amazonaws.com/SoftwareEngineering/");
exit;
?>