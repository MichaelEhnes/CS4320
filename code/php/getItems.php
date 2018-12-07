<!--
written by: Parker Jones
tested by: Parker Jones
debugged by: Parker Jones
-->
<?php
require_once "../db.conf";

    
  $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    if($mysqli->connect_error){
        die('Connect Error('. $mysqli->connect_errno . ') ' . $mysqli->connect_error);
    }

//make sure to change the table not to users
//also change config file

    $query = "SELECT * FROM Items;";
          //$result = $mysqli->query($query);
    $result = $mysqli->query($query);
    $array = array();
     while($row = mysqli_fetch_array($result))
    {

       $array[] = array('key1' => $row['itemCode'], 'key2' => $row['itemName'], 'key3' => $row['itemCost']);
    }
    echo json_encode($array); 


$result->close();
$mysqli->close();

?>