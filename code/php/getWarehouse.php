<!--
written by: Liam
tested by: Liam
debugged by: Liam
-->
<?php
require_once "../db.conf";
require_once('dbcontroller.php');
    
    
  $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    if($mysqli->connect_error){
        die('Connect Error('. $mysqli->connect_errno . ') ' . $mysqli->connect_error);
    }

//make sure to change the table not to users
//also change config file
if($_SESSION['WarehouseID'] == "" || $_SESSION['WarehouseID'] == null){
    echo "You need to login!";
}

else{
    $warehouseID = $_SESSION['WarehouseID'];
    $query = "SELECT * FROM Warehouse WHERE WarehouseID = '$warehouseID';";
    $result = $mysqli->query($query);
    $array = array();
     while($row = mysqli_fetch_array($result))
    {

       $array[] = array('key1' => $row['WarehouseID'], 'key2' => $row['warehouseName'], 'key3' => $row['warehouseHeight'], 'key4' => $row['warehouseLength']);
    }

    echo json_encode($array);


    $result->close();
}
$mysqli->close();

?>