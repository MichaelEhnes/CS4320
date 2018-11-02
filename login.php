<?php
require_once "../db.conf";

    
  $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    if($mysqli->connect_error){
        die('Connect Error('. $mysqli->connect_errno . ') ' . $mysqli->connect_error);
    }

//store session 
//check out php session

$username = $_POST['username'];
$password = $_POST['password'];
 
//make sure to change the table not to users
//also change config file

    $query = "SELECT * FROM Users WHERE user = '$username' AND Passworduser = '$password';";

          $result = $mysqli->query($query);
          $row = mysqli_fetch_array($result);
        if(empty($row)){
        //end session 
        //possibly return error code or check 
            //echo("Could not find username");
        }
        else{
            //returns username so a cookie can be created
            echo $row['user'];
        }
        
            
$result->close();
$mysqli->close();

?>