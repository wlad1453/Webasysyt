<!DOCTYPE html>
<html>

<head>	<link rel="stylesheet" href="structure.css">  </head>

<body>
<div align="center"><h2>Dynamic object groups structure</h2></div>
<div align="center">
<br><br>

<nav class="menu">
  <ul>
  
<?php

	require 'SQL_DB/BackEnd_credentials.php';
	
	// echo "server: ". $cred_db["server"] . "<br>user: " . $cred_db["user"]. "<br>pwd: " . $cred_db["pwd"] . "<br>db: " . $cred_db["db"] . "<br><br>";	
	
	$conn = db_connect($cred_db);
	
	read_db($conn);
	
	function db_connect(&$cred) { //Passing arguments by reference
		// Create connection
		$conn = new mysqli($cred['server'], $cred['user'], $cred['pwd'], $cred['db']); 

		// Check connection
		if ($conn->connect_error) die("Connection failed: " . $conn->connect_error); 
		// echo "Connected successfully<br>";	

		return $conn;
	}

	function read_db(&$conn) {
		// Reading DB
		// $sql = "SELECT Measmt_ID, DateTime, HA_U, HA_Um, HA_Bm, HA_B, R_KitT, R_LivT, R_BedT, R_KorT, R_BathT FROM Temp_sensors";
		$elem0_id = 0;
		$elem2_id = 0;
		
		$sql = "SELECT *  FROM objects_groups WHERE parentId = 0 AND id > " . $elem0_id;
		$result = $conn->query($sql);
		
		while ($result->num_rows > 0) {
			
			$row = $result->fetch_assoc();
			echo "<li><a href=\"edit_objects_groups.html?item=" . $row["id"] . "\">" . $row["caption"] . "</a>";
			$elem0_id = $row["id"];  // echo "elem0 = " . $elem0_id;
			
			//$result = NULL;
			
			$sql = "SELECT * FROM objects_groups WHERE parentId = " . $elem0_id . " AND id > " . $elem2_id; //" . $elem0_id . " 
			// echo $sql;
			$result = $conn->query($sql);
			
			if ($result->num_rows > 0) {
				echo "<ul>";
				
				// $row = $result->fetch_assoc();
				
				// echo "result level 2 not 0 Id = " . $row["id"] . "parentId = " . $row["parentId"] . ".." . $row["alias"];
				
				while ( $row = $result->fetch_assoc() ) {
					// $row = $result->fetch_assoc();
					// echo "ResultRow";
					echo "<li><a href=\"edit_objects_groups.html?item=" . $row["id"] . "\">" . $row["caption"] . "</a></li>";
					
					$elem2_id = $row["id"];  
					
					$sql = "SELECT *  FROM objects_groups WHERE parentId = " . $elem0_id ." AND id > " . $elem2_id;
					$result = $conn->query($sql);
				}
				echo "</ul>";
				
			}
			echo "</li>";
			
			$sql = "SELECT *  FROM objects_groups WHERE parentId = 0 AND id > " . $elem0_id;
			$result = $conn->query($sql);
			
			
		}
		
		/*
		while ($result->num_rows > 0) {
	
		    // print_r (each($result)); echo "<br>";		   
		   				   
			while($row = $result->fetch_assoc()) {
				  
				// echo   "ID: " . $row["id"] . " ParentId: " . $row["parentId"] . " alias " . $row["alias"] . " caption " . $row["caption"] . "<br>";	
				if ( $row["id"] > $elem_num ) {
					echo "<li><a href=\"#\">" . $row["caption"] . "</a></li>";
					$elem0_id = $row["id"];  
					continue; // break;
				}
			}
			$sql = "SELECT *  FROM objects_groups WHERE parentId = 0 AND id > " . $elem0_id;
			$result = $conn->query($sql);
			
			print_r( "Second DB reading");
			
			$sql = "SELECT *  FROM objects_groups WHERE parentId = 0 AND id > " . $elem0_id;
			$result = $conn->query($sql);
			while ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					
				
			}
			
			
		} */
		
		
		
		
	}
		
	$conn->close();	 
?>
</ul>
</nav>
</div>
</body>
</html>