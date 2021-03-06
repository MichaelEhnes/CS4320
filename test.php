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
        </style>

<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
        
        if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
        
        
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM Items");
            
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

<BODY>
<div id="shopping-cart">
    
    <a href="list.php?">
<div class="txt-heading">Shopping Cart</div>

<a id="btnEmpty" href="test.php?action=empty">Empty Cart</a>
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
echo $_SESSION['cart_item'];
    foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["quantity"]*$item["itemCost"];
		?>
				<tr>
				<td><?php echo $item["itemName"]; ?></td>
				<td><?php echo $item["itemCode"]; ?></td>
				<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
				<td  style="text-align:right;"><?php echo "$ ".$item["itemCost"]; ?></td>
				<td  style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
				<td style="text-align:center;"><a href="test.php?action=remove&code=<?php echo $item["itemCode"]; ?>" class="btnRemoveAction">Remove Item</a></td> 
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
    
    <form action="test.php" method="GET">
    <input type="text" name="query" />
    <input type="submit" value="Search" />
</form>
     
    
<div id="product-grid">
	<div class="txt-heading">Products</div>
	<?php

   $query = $_GET["query"];

	$product_array = $db_handle->searchProd($query);
    
    
    
    
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
	?>
		<div class="product-item">
			<form method="post" action="test.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">

			<div class="product-tile-footer">
			<div class="product-title"><?php echo $product_array[$key]["itemName"]; ?></div>
			<div class="product-price"><?php echo "$".$product_array[$key]["itemCost"]; ?></div>
			<div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" />
                <input type="submit" value="Add to Cart" class="btnAddAction" /></div>
			</div>
			</form>
		</div>
	<?php
		}
	}
    else
    {
        
        echo "<H1> Empty Table</h1>";
    }
	?>
</div>
</BODY>
</HTML>