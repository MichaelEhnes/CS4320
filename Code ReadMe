Code Readme 
http://ec2-18-221-234-28.us-east-2.compute.amazonaws.com/SoftwareEngineering/

All scripts and webpages have all the following requirements to run: A successful login for the index.html page, a internet connection that does not restrict web access to the website and SQL database, and an up to date browser that can support javascript and HTML 5. 
1. index.html: Verifies a user of the account so they will have access to the websites features. This will eventually be necessary for the _____ pages. 
a. Important Code: $('#form').submit(function(event){...} - Submits the users information to the login.php script where that page will store the user’s information so they have access to all the necessary functions. 
2. Warehouse.html : Gets the user’s personal warehouse information. This page will present a dynamic GUI that will present a model of the warehouse in a 10x10 ft squares. 
a. Important Code: .get('getWarehouse.php', function(data){....} - Gets the user’s warehouse information including its size, its name, and ID. This information will pull it from the session page of Login.php eventually. 
3. Create.php : Will create users for the website. This is given to Admin accounts so they can assign different roles for their warehouse. 
a. Important Code: $query = "INSERT INTO users (username, password, addDate, changeDate) VALUES ('$username', '$password', now(), '$DOB');";. - Submits user data to the SQL database. 
4. getItems.php : Gets all items from the item catalog (item database). This will mainly be used for customers for shopping they can then add items in a shopping cart where the items are stored in a php session. 
a. Important Code: $query = “Select * FROM user;”; - gets all items from the database. 
	5.	dbcontroller.php : creates a session for user to login. We have no created a secure login session for this script so we will keep it offline until then.  
	6.	Search.php - used to create an instance of a shopping cart for the user. It does this by create a php session that stores each item that the user clicks on to order.  
a. Important Code: case "remove": 
if(!empty($_SESSION["cart_item"])) { foreach($_SESSION["cart_item"] as $k => $v) { if($_GET["code"] == $k) unset($_SESSION["cart_item"][$k]); if(empty($_SESSION["cart_item"])) unset($_SESSION["cart_item"]); 
} break; 
case "empty": unset($_SESSION["cart_item"]); break; 
This removes items from the shopping cart. If the shopping cart becomes empty it will end the php session. 
if(!empty($_POST["quantity"])) { 
$productByCode = $db_handle->runQuery("SELECT * FROM Items"); This creates a list of all available items to be purchased. 
f(!empty($_SESSION["cart_item"])) { if(in_array($productByCode[0]["itemCode"],array_keys($_SESSION["ca t_item"]))) { foreach($_SESSION["cart_item"] as $k => $v) { if($productByCode[0]["itemCode"] == $k) { if(empty($_SESSION["cart_item"][$k]["quantity"])) { $_SESSION["cart_item"][$k]["quantity"] = 0; } $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"]; } } } else { $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray); } } else { $_SESSION["cart_item"] = $itemArray; } } 
This will create the shopping cart queue and add the selected item to the queue. 
	7.	SplashPage.php: This page is essentially just an echo if every item that is in the warehouse  
	8.	SearchItems.php: This page Holds the search bar and enables the user to search through the database and add the item they search for to their personal shopping cart  
	9.	AddUser.php: This page enables the user to add another user to the database and push that information through to be used as a login later.  
	10.	Unnecessary, unfinished, or retired pages: splashpage.html, getWarehouse.html, searchItems.php, test.php.  
Database Layout
create table StoreItems (
	id int primary key auto_increment,
    WarehouseID varchar(255) NOT NULL,
	itemCode varchar(255) NOT NULL,
    itemName varchar(255) NOT NULL,
    itemQuantity int,
    itemCost FLOAT,
    itemLocX int,
    itemLocY int
    );
create table Orders(
	id int primary key auto_increment,
    orderID varchar(255) NOT NULL,
	itemCode varchar(255) NOT NULL,
    itemName varchar(255) NOT NULL,
    itemQuantity int
    );
create table Warehouse (
		WarehouseID varchar(255) primary key,
        warehouseName varchar(255),
        warehouseHeight int,
        warehouseLength int
    );
        
create table searchOrder (
		id int primary key auto_increment,
        orderCode varchar(255),
        quantity int NOT NULL
        );
create table Users (
	id int primary key auto_increment,
    user varchar(255) NOT NULL,
    Passworduser varchar(255) NOT NULL,
	adminCred varchar(255),
    WarehouseID varchar(255),
    warehouseName varchar(255)
    );
    
create table Items (
	itemCode varchar(255) primary key NOT NULL,
    itemName varchar(255) NOT NULL,
    itemQuantity int,
    itemCost FLOAT
    );
insert into Items(itemCode, itemName, itemQuantity, itemCost) values("XYZ", "Motherboard - AMD4", 3, "55.72");
insert into Users( user, passwordUser, adminCred, WarehouseID, warehouseName) values ('user' , 'pass', 'ADMIN' ,'TemporaryWarehouse' , 'TempWareHouse');

insert into Warehouse(WarehouseID, warehouseName, warehouseHeight, warehouseLength) values ('TemporaryWarehouse' , 'TempWareHouse',  100, 100 );
insert into Orders(id, orderID, itemCode, itemName, itemQuantity) values(0, '123412341234', "CD134adfYIs", "Samsung USB 3.0 128GB",  12);
insert into StoreItems(	id, WarehouseID, itemCode, itemName, itemQuantity, itemCost, itemLocX, itemLocY) values(0, 'TemporaryWarehouse', "CD134adfYIs", "Samsung USB 3.0 128GB",  243, "43.79", 1, 1);
