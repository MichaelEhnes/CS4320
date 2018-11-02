<?php
class DBController {
	private $host = "localhost";
	private $user = "ec2-user";
	private $password = "Liam";
	private $database = "test";
	private $conn;
	
	function __construct() {
		$this->conn = $this->connectDB(); 
	}
	
	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
        if($conn->connect_error)
             {echo "<h1> nope1 </h1>";}
        
		return $conn;
	}
	
     
    

    
    
	function runQuery($query) {
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
        else
        {echo "<h1> nope </h1>";}
	}
	
	function numRows($query) {
		$result  = mysqli_query($this->conn,$query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;	
	}
}
?>