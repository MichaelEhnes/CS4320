<!DOCTYPE html>
<html>
    <head>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script
			  src="https://code.jquery.com/jquery-3.3.1.min.js"
			  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
			  crossorigin="anonymous"></script>
        
        <title>Warehouse Managment and Pathway Tool</title>
        <style>
            .sidenav {
                height: 100%; /* 100% Full-height */
                width: 0; /* 0 width - change this with JavaScript */
                position: fixed; /* Stay in place */
                z-index: 1; /* Stay on top */
                top: 0; /* Stay at the top */
                left: 0;
                background-color: #111; /* Black*/
                overflow-x: hidden; /* Disable horizontal scroll */
                padding-top: 60px; /* Place content 60px from the top */
                transition: 0.5s; /* 0.5 second transition effect to slide in the sidenav */
            }

            .sidenav a {
                padding: 8px 8px 8px 32px;
                text-decoration: none;
                font-size: 25px;
                color: #818181;
                display: block;
                transition: 0.3s;
            }
            
            .sidenav a:hover {
                color: #f1f1f1;
            }

            .sidenav .closebtn {
                position: absolute;
                top: 0;
                right: 25px;
                font-size: 36px;
                margin-left: 50px;
            }
            body{
                background: #66c2ff;
            }
            h1{
                font-family: Arial, Helvetica, sans-serif;
                font-weight: bold;
                font-size: 4.5vw;
                text-align: center;
            }
            {
    box-sizing: border-box;
}

form.example input[type=text] {
    padding: 10px;
    font-size: 17px;
    border: 1px solid grey;
    float: left;
    width: 91%;
    background: #f1f1f1;
}

form.example button {
    float: left;
    width: 5%;
    padding: 10px;
    background: #2196F3;
    color: white;
    font-size: 17px;
    border: 1px solid grey;
    border-left: none;
    cursor: pointer;
}

form.example button:hover {
    background: #0b7dda;
}

form.example::after {
    content: "";
    clear: both;
    display: table;
}
#search{
    margin: 0 auto;
    width: 50%
}
#searchfunction{
    margin: 0 auto;
    width: 35%
}
        </style>

<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
        
        if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
        
         
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery     
            ("SELECT * FROM Items WHERE itemCode='" .$_GET["code"] . "'");
       
            //WHERE itemName LIKE '%$item%''
            
            
			$itemArray = array($productByCode[0]["itemCode"]=>array('itemName'=>$productByCode[0]["itemName"], 'itemCode'=>$productByCode[0]["itemCode"], 'quantity'=>$_POST["quantity"], 'itemCost'=>$productByCode[0]["itemCost"]));
			
			if(!empty($_SESSION["cart_item"])) 
            {
				if(in_array($productByCode[0]["itemCode"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
						if($productByCode[0]["itemCode"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
}
}

?>

    </head>

<body>
         <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="splashpage.php">List</a>
            <a href="search.php">Search</a>
            <a href="Warehouse.html">Map</a>
            <a href="AddUser.html">Add User</a>
            <a href="logout.php">Logout</a>
        </div>
        <span style="font-size:30px;cursor:pointer" onclick="openNav()"> &#9776;</span>

        <h1>SEARCH</h1>
        
        <div id="search">
        <form class="example" action="search.php" method="post">
            <input type="text" placeholder="Search.." name="searchItem">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
        </div>
        <br>
        <script>
            /* Set the width of the side navigation to 250px */
    function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

/* Set the width of the side navigation to 0 */
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
        </script>


<div id = "searchfunction">
<?php
    require_once "../db.conf";
    $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    if($mysqli->connect_error){
        die('Connect Error('. $mysqli->connect_errno . ') ' . $mysqli->connect_error);
    }

    $item = $_POST['searchItem'];

    if(isset($_POST['searchItem']))
    {
        $query = "SELECT * FROM Items WHERE itemName LIKE '%$item%'";
        $result = $mysqli->query($query);
        $array = array();
        
        while($row = mysqli_fetch_array($result))
        {
            if(!isset($row)){ echo $row;}
            $array[] = array('key1' => $row['itemCode'], 'key2' => $row['itemName'], 'key3' => $row['itemCost']);
        }
        
        foreach($array as $key => $arrKey){ ?>
            
            <div class="product-item">
			<form method="post" action="search.php?action=add&code=<?php echo $array[$key]["key1"]; ?>">

			<div class="product-tile-footer">
			<div class="product-title"><?php echo $array[$key]["key2"]; ?></div>
			<div class="product-price"><?php echo "$".$array[$key]["key3"]; ?></div>
			<div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" />
                <input type="submit" value="Add to Cart" class="btnAddAction" /></div>
			</div>
			</form>
		</div>
        <br>
            
        <?php    
        }
    }

    $mysqli->close();

?>
</div>

<!-- Beginning of Shopping Cart Display -->    
    
<div id="shopping-cart"> 
<div class="txt-heading" align="center"><h2>Shopping Cart</h2></div>

<a id="btnEmpty" href="search.php?action=empty" align="center">Empty Cart</a>
<?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
?>	
<table class="tbl-cart" cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th style="text-align:left;">Name</th>
<th style="text-align:left;">Code</th>
<th style="text-align:right;" width="5%">Quantity</th>
<th style="text-align:right;" width="10%">Unit Price</th>
<th style="text-align:right;" width="10%">Price</th>
<th style="text-align:center;" width="5%">Remove</th>
</tr>	
<?php		

    foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["quantity"]*$item["itemCost"];
		?>
				<tr>
				<td><?php echo $item["itemName"]; ?></td>
				<td><?php echo $item["itemCode"]; ?></td>
				<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
				<td  style="text-align:right;"><?php echo "$ ".$item["itemCost"]; ?></td>
				<td  style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
				<td style="text-align:center;"><a href="search.php?action=remove&code=<?php echo $item["itemCode"]; ?>" class="btnRemoveAction">Remove Item</a></td> 
				</tr>
				<?php
				$total_quantity += $item["quantity"];
				$total_price += ($item["itemCost"]*$item["quantity"]);
		}
		?>

<tr>
<td colspan="2" align="right">Total:</td>
<td align="right"><?php echo $total_quantity; ?></td>
<td align="right" colspan="2"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
<td></td>
</tr>
</tbody>
</table>		
  <?php
} else {
?>
<div class="no-records">Your Cart is Empty</div>
<?php 
}
?>
</div>


</body>
</html>