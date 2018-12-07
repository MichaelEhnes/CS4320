<?php
require_once "../db.conf";
require_once('dbcontroller.php');

$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

$itemName = $_POST['itemName'];
$itemCode = $_POST['itemCode'];
$quantity = $_POST['quantity'];
$cost = $_POST['cost'];

if($mysqli->connect_error){
    die('Connect Error('. $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

$query = "insert into Items(itemCode, itemName, itemQuantity, itemCost) values('$itemCode', '$itemName', '$quantity', '$cost');";

$result = $mysqli->query($query);

$result->close();
$mysqli->close();


?>