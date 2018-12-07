<!--
written by: Michael
tested by: Michael
debugged by: Michael
-->
<!DOCTYPE html>

<html>
    <head>
        <title>Warehouse Managment and Pathway Tool</title>
        <script src="http://code.jquery.com/jquery-1.5.js"></script>
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
            #list{
                margin: 0 auto;
                width : 100%;
                text-align: center;
                align-self: center;
            }
            #button{
                margin: 0 auto;
                width: 60%;
            }
        </style>
      <script>
            var dat;
            
            $(document).ready(function(){ 

              $.get('getItems.php', function(data) {
                $.ajax({
                  type: "GET",
                  url: "getItems.php",
//dat is array with values as such: itemCode, itemName, itemCost, itemQuantity
                 success:function(data) {
                      dat = $.parseJSON(data); 
                     var i = 0;
                    while(i < dat.length){
                    //need to convert item itemCost to number type here
                        var cost = Number(dat[i].key3);
                        cost = cost.toFixed(2);
                        console.log(typeof cost);
                        //var cost = temp.toFixed(2);
                        //This will append html code to the website will need to add more and have a option to add items, delete items and what not. 
                        $('#list').append("<div><p>"+ " " + dat[i].key2 + " " + "$" + cost + "</p></div>");
                                          
                                          
                                          
                                          
                                          
                                          
                            i++;
                        }
                        },
                     error: function(data) {
                        alert("Failed to Connect");
                    },
                        })  

                    });


            });
        </script>

    
    </head>

    <body>
         <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="splashpage.php">List</a>
            <a href="search.php">Search</a>
            <a href="Warehouse.html">Map</a>
            <a href="AddUser.php">Add User</a>
            <a href="logout.php">Logout</a>
        </div>
        <span style="font-size:30px;cursor:pointer" onclick="openNav()"> &#9776;</span>
         

        <h1>LIST OF ITEMS</h1>
            <div id="list">
            </div>


<!--<a id="btnEmpty" href="index.php?action=empty">Empty Cart</a>-->
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
    require_once("dbcontroller.php");
    $db_handle = new DBController();
    foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["quantity"]*$item["price"];
		?>
				<tr>
				<td><img src="<?php echo $item["image"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?></td>
				<td><?php echo $item["code"]; ?></td>
				<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
				<td style="text-align:right;"><?php echo "$ ".$item["price"]; ?></td>
				<td style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
				<td style="text-align:center;"><a href="index.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
				</tr>
				<?php
				$total_quantity += $item["quantity"];
				$total_price += ($item["price"]*$item["quantity"]);
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
<!--<div class="no-records">Your Cart is Empty</div>-->
<?php 
}
?>
    

        
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
    </body>
</html>
