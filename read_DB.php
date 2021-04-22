<!DOCTYPE html>
<html>
<head>
<style>
body { background-color: #c4e3ed;
	font-family: arial;
	
 	}
.tempData {
	table-layout: fixed;
	width: 100%;
	border-collapse: collapse;  
	white-space: nowrap;
	overflow: hidden;
}
.row-ID {width: 4%;}
.row-Dim {width: 6%;}
.row-Data {width: 16%;}

table, td, th {
  border: 2px solid black;
  padding: 5px;   
  align: center;
  text-align: center;
}
tr:nth-child(even){background-color: #e4f3fe}

</style>
</head>
<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->

<body>
<!-- <div align="center"><h3>Cottage 60. Temperature values</h3></div> -->

<div align="center" height="800" width="1240" style="overflow: hidden; overflow-y:auto;">
<?php

	require 'SQL_DB/BackEnd_credentials.php';
	
	$TabN = 0;
	
	if (!filter_has_var(INPUT_GET, "TabN")) $TabN = 0; 	else  $TabN = $_GET['TabN'];
	
	$conn = db_connect($cred_db);	
	read_db($conn, $TabN);
	
	function db_connect(&$cred) { //Passing arguments by reference
		// Create connection
		$conn = new mysqli($cred['server'], $cred['user'], $cred['pwd'], $cred['db']); 

		// Check connection
		if ($conn->connect_error) die("Connection failed: " . $conn->connect_error); 
		// echo "Connected successfully<br>";	

		return $conn;
	}

	function read_db(&$conn, $TabN) {
		$script = "edit_objects.php";
		
		// Reading DB
		// $sql = "SELECT Measmt_ID, DateTime, HA_U, HA_Um, HA_Bm, HA_B, R_KitT, R_LivT, R_BedT, R_KorT, R_BathT FROM Temp_sensors";
		if( $TabN == 1 ) { 
			$sql = "SELECT * FROM objects";
			
			echo "<table class=\"tempData\" width=\"940\" style=\"overflow-y:auto;\">
			<tr>
				<th class=\"row-1 row-ID\">ID</th> <th class=\"row-1 row-ID\">pID</th> <th class=\"row-1 row-Data\">Alias</th> <th class=\"row-1 row-Data\">Caption</th>	
				<th class=\"row-1 row-Dim\">length</th> <th class=\"row-1 row-Dim\">width</th> <th class=\"row-1 row-Dim\">height</th> <th class=\"row-1 row-Dim\">Place</th>
				<th class=\"row-1 row-Data\">placeRules</th> <th class=\"row-1 row-ID\">light</th>
			</tr>";			
		}
		if ( $TabN == 2 ) {		
			$sql = "SELECT * FROM objects_groups";
			
			echo "<table class=\"tempData\" width=\"940\" style=\"overflow-y:auto;\">
			<tr>
				<th class=\"row-1 row-ID\">ID</th> 
				<th class=\"row-1 row-ID\">ParentID</th> 
				<th class=\"row-1 row-Data\">Alias</th> 
				<th class=\"row-1 row-Data\">Caption</th>		
			</tr>";			
		}
		$result = $conn->query($sql);		
		
		
		if ($result->num_rows > 0) {
		  // output data of each row
		  while($row = $result->fetch_assoc()) {
			$edit = $script . "?id=" . $row["id"] . "&alias=" . $row["alias"];  
			
			if( $TabN == 1 ) { 

				echo "<tr>";
					echo "<td><a href=\"" . $edit . "\" target=\"_top\">" . $row["id"] . "</a></td>";		echo "<td>" . $row["groupId"] . "</td>";
					echo "<td><a href=\"" . $edit . "\" target=\"_top\">" . $row["alias"] . "</a></td>"; 	
					echo "<td><a href=\"" . $edit . "\" target=\"_top\">" . $row["caption"] . "</a></td>";	
					echo "<td>" . $row["length"] . "</td>"; 					echo "<td>" . $row["width"] . "</td>";	
					echo "<td>" . $row["height"] . "</td>"; 					echo "<td>" . $row["canPlace"] . "</td>";	
					echo "<td>" . $row["placeRules"] . "</td>"; 				echo "<td>" . $row["light"] . "</td>";	
				echo "</tr>";
			}
			
			if ( $TabN == 2 ) {			  
				echo "<tr>";
					echo "<td><a href=\"#\">" . $row["id"] . "</a></td>";	echo "<td>" . $row["parentId"] . "</td>";
					echo "<td><a href=\"#\">" . $row["alias"] . "</a></td>"; 		echo "<td><a href=\"#\">" . $row["caption"] . "</a></td>";	
				echo "</tr>";			
			} 
			
		  }
		}
		
		echo "</table>";		
	}
		
	$conn->close();	 
?>

</div>
</body>
</html>