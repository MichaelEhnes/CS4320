<?php
require_once "../db.conf";
require_once('dbcontroller.php');
if(!empty($_SESSION)){    
      $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    if($mysqli->connect_error){
        die('Connect Error('. $mysqli->connect_errno . ') ' . $mysqli->connect_error);
    }

    echo "<h1> connected </h1>";
    $username = $_POST['username'];
    $password = $_POST['password'];
    $storeName = $_POST['storeName'];
    $storeID = $_POST['storeID'];
    $userType = $_POST['selectorName'];

    $query = "INSERT INTO Users(user, Passworduser, adminCred, WarehouseID, warehouseName) VALUES ('$username', '$password', '$userType', '$storeID', '$storeName');";

        $result = $mysqli->query($query);

        if($result){
            echo "Succ";
        }
        else{
            echo "Yeet";
        }


    $result->close();
    $mysqli->close();
}
else{
    echo $_SESSION['user'];
}
?>