<!--
written by: mitchell hoffman
tested by: mitchell hoffman
debugged by: mitchell hoffman
-->
<?php
require_once "../db.conf";
require_once('dbcontroller.php');

$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if($mysqli->connect_error){
    die('Connect Error('. $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

$LocX = $_POST['coordx'];
$LocY = $_POST['coordy'];
$WarehouseID = $_SESSION['WarehouseID'];

    $query = "SELECT * FROM StoreItems WHERE WarehouseID = '$WarehouseID' AND itemLocX = '$LocX' AND itemLocY = '$LocY';";
    $result = $mysqli->query($query);
    $array = array();
     while($row = mysqli_fetch_array($result))
    {

       $array[] = array('key1' => $row['itemCode'], 'key2' => $row['itemName'], 'key3' => $row['itemQuantity']);
    }
    echo json_encode($array);



    $result->close();
    $mysqli->close();



?>