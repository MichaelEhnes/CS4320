<?php
require_once "../db.conf";
require_once('dbcontroller.php');

$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if($mysqli->connect_error){
    die('Connect Error('. $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}


    $query = "SELECT * FROM Orders;";
    $result = $mysqli->query($query);
    $array = array();
     while($row = mysqli_fetch_array($result))
    {

       $array[] = array('key1' => $row['itemCode'], 'key2' => $row['itemName'], 'key3' => $row['itemQuantity'], key4 => $row['orderID']);
    }
    echo json_encode($array);
    $result->close();
    $mysqli->close();


?>