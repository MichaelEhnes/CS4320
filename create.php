<?php
require_once "../db.conf";

  $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);


    if($mysqli->connect_error){
        die('Connect Error('. $mysqli->connect_errno . ') ' . $mysqli->connect_error);
    }


$username = $_POST['username'];
$password = $_POST['password'];
$DOB = $_POST['DOB'];
    
//make sure to change values and what not 

          $query = "INSERT INTO users (username, password, addDate, changeDate) VALUES ('$username', '$password', now(), '$DOB');";
          $result = $mysqli->query($query);
         echo "Account Created";
$result->close();
$mysqli->close();

?>