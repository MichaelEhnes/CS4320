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
    $query = "SELECT * FROM StoreItems WHERE WarehouseID = '$warehouseID';";
    $result = $mysqli->query($query);
    $array2 = array();
     while($row = mysqli_fetch_array($result))
    {

       $array2[] = array('key1' => $row['itemCode'], 'key2' => $row['itemName'], 'key3' => $row['itemQuantity'], 'key4' => $row['itemCost'], 'key5' => $row['itemLocX'], 'key6' => $row['itemLocY']);
    }
    echo json_encode($array2); 


    $result->close();
}
$mysqli->close();

?>