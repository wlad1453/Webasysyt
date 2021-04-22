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
		.row-DateTime {width: 23%;}
		.row-Data {width: 16%;}

		table, td, th {
		  border: 1px solid black;
		  border-collapse: collapse;
		  padding: no;   
		  align: center;
		  text-align: center;
		}
		tr:nth-child(even){background-color: #e4f3fe}

	</style>
</head>

<body>
<div align="center"><h3>Редактирование объектов</h3></div>
<div>

<?php

require 'SQL_DB/BackEnd_credentials.php';

$obj_id = $_GET["id"];
$alias = $_GET["alias"];
$objects = array("id" => "0", "groupId" => "0",  "alias" => "", "caption" => "", "length" => "", "width" => "", "height" => "", "canPlace" => "", "placeRules" => "", "light" => "");
$obj_settings = array("objectId" => "", "alias" => "", "type" => "", "caption" => "", "value" => "", "variants" => "", "part" => "");


// echo "ID $obj_id, Alias $alias <br>";
	
	// echo "server: ". $cred_db["server"] . "<br>user: " . $cred_db["user"]. "<br>pwd: " . $cred_db["pwd"] . "<br>db: " . $cred_db["db"] . "<br><br>";	
	
	$conn = db_connect($cred_db);	
	$table = "objects"; $key = "id";
	read_db($conn, $table, $key, $objects, $obj_id);
	$table = "objects_settings"; $key = "objectId";
	read_db($conn, $table, $key, $obj_settings, $obj_id);
	
	function db_connect(&$cred) { //Passing arguments by reference
		// Create connection
		$conn = new mysqli($cred['server'], $cred['user'], $cred['pwd'], $cred['db']); 

		// Check connection
		if ($conn->connect_error) die("Connection failed: " . $conn->connect_error); 
		// echo "Connected successfully<br>";	

		return $conn;
	}
	
	function read_db(&$conn, $table, $key, &$arr, $obj_id) {
		// Reading DB
		// $sql = "SELECT Measmt_ID, DateTime, HA_U, HA_Um, HA_Bm, HA_B, R_KitT, R_LivT, R_BedT, R_KorT, R_BathT FROM Temp_sensors";
		$sql = "SELECT * FROM $table WHERE $key = $obj_id";
		// echo "$sql<br>";
		$result = $conn->query($sql);
		// print_r ($result->num_rows); echo "<br>";
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$arr = $row;
			// print_r(array_values($row)); echo "<br>";
		}
		/*
		echo "<table>
		<tr>
			<th>ID</th>			<th>groupId</th>		<th>alias</th> 
			<th>caption</th> 	<th>length</th> 		<th>width</th>
			<th>height</th> 	<th>canPlace</th> 		<th>placeRules</th> 
			<th>light</th>
		</tr>";
		
		if ($result->num_rows > 0) {
			  // output data of each row
			  while($row = $result->fetch_assoc()) {
				  
				echo "<tr>";
					echo "<td>" . $row["id"] . "</td>";			echo "<td>" . $row["groupId"] . "</td>";
					echo "<td>" . $row["alias"] . "</td>"; 		echo "<td>" . $row["caption"] . "</td>";		
					echo "<td>" . $row["length"] . "</td>";		echo "<td>" . $row["width"] . "</td>";
					echo "<td>" . $row["height"] . "</td>"; 	echo "<td>" . $row["canPlace"] . "</td>";		
					echo "<td>" . $row["placeRules"] . "</td>";	echo "<td>" . $row["light"] . "</td>"; 
				echo "</tr>";
			  }
		} else {
			echo "0 results";		
		}
		echo "</table>";*/
		
		
	}

function db_entry(&$conn, &$H_data) {
	
	// INSERT INTO `objects`(`groupId`, `alias`, `caption`, `length`, `width`, `height`, `canPlace`, `placeRules`, `light`) VALUES (31,"poplar","тополь",0.6,0.8,2.3,1,"inEarth",0)
	// INSERT INTO `objects`(`groupId`, `alias`, `caption`, `length`, `width`, `height`, `canPlace`, `placeRules`, `light`) VALUES (31,"walnut","орех",0.2,0.2,0.6,1,"inEarth",0)
	
	// require 'heatData.php'; 
		/*$Ut = 151; $Um = 70; $Bm = 50; $Bt = 30; $kitT = 26; $livT = 21; $bathT = 27; $corrT = 19; $bedT = 17; $TstT = 36.6;
		 DB: R_KitT	decimal(5,2), R_LivT decimal(5,2), R_BedT decimal(5,2), R_KorT decimal(5,2), R_BathT double(5,2), R_HrT*/

	date_default_timezone_set("Europe/Moscow");  
	$DateTime = date("Y-m-d H:i:s");
	
	$sql = "INSERT INTO Temp_sensors (DateTime, HA_U, HA_Um, HA_Bm, HA_B, R_KitT, R_LivT, R_BedT, R_KorT, R_BathT)
	VALUES ('" . $DateTime . "', " . $H_data['Ut'] . ", " . $H_data['Um'] . ", " . $H_data['Bm'] . ", " . $H_data['Bt'] . ", "
	. $H_data['kitT'] . ", " . $H_data['livT'] . ", " . $H_data['bedT'] . ", " . $H_data['corrT'] . ", " . $H_data['bathT'] . ")";
	
	// echo $sql . "<br>";

	if ($conn->query($sql) === TRUE) {
	  echo "New record created successfully at " . $DateTime . "<br><br>" ;
	} else {
	  echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
	
}
$conn->close();
?>

<div>
<form action="/action_page.php" method="get" target="_top">
  <h3>Объект</h3>  
  <table>
	  <tr>
		  <th>ID</th>	<th>GroupID</th>	<th>Alias</th>	<th>Caption</th>
		  <th>Lenght</th>	<th>Width</th>	<th>Height</th>	<th>CanPlace</th>
		  <th>placeRules</th>	<th>Light</th>
	  </tr>
  
	  <tr>
		  <td><input type="number" id="id" name="id" min="0" max="100000" readonly value="<?php echo $objects["id"] ?>"></td>
		  <td><input type="number" id="groupId" name="groupId" min="0" max="1000" value="<?php echo $objects["groupId"] ?>"> </td>
		  <td><input type="text"   id="alias"   name="alias" value="<?php echo  $objects["alias"] ?>" ></td>
		  <td><input type="text"   id="caption" name="caption" value="<?php echo $objects["caption"] ?>"></td>
		  <td><input type="number" step="0.01" id="length" name="length" min="0.01" max="10" value="<?php echo $objects["length"] ?>"> </td>
		  <td><input type="number" step="0.01" id="width"  name="width"  min="0.01" max="8" value="<?php echo $objects["width"] ?>"> </td>
		  <td><input type="number" step="0.01" id="height" name="height" min="0.01" max="5" value="<?php echo $objects["height"] ?>"> </td>
		  <td><select name="canPlace" id="canPlace" value="<?php echo $objects["canPlace"] ?>">
			<option value = 1> 1.</option>
			<option value = 2> 2.</option>
			<option value = 3> 3.</option>
		  </select>  </td>
		  <td><input type="text"   id="placeRules" name="placeRules" value="<?php echo $objects["placeRules"] ?>"></td>
		  <!-- <input type="number" id="light"      name="light"    min="0" max="1"> -->
		  <td><select name="light" id="light" value="<?php echo $objects["light"] ?>">
			<option value = 0> 0.</option>
			<option value = 1> 1.</option>
		  </select></td>
	  </tr>
  </table>
  <br>
  
  <h3>Свойства объекта</h3>
  <table>
	<tr> 
		<th>objectID</th>	<th>Alias</th>		<th>Type</th>	<th>Caption</th>
		<th>Value</th>		<th>Variants</th>	<th>Part</th>	
	</tr>
	<tr>
		  <td><input type="number" 	id="objectId"	name="objectId" min="0" max="1000" readonly value="<?php echo $obj_settings["objectId"] ?>" > </td>
		  <td><input type="text"   	id="aliasOS"   	name="aliasOS" 								value="<?php echo $obj_settings["alias"] ?>"></td>
		  <td><select name="type" 	id="type" 													value="<?php echo $obj_settings["type"] ?>">
			<option value = 1> 1.</option>
			<option value = 2> 2.</option>
		  </select></td>
		  <td><input type="text"   id="captionOS" 	name="captionOS" 	value="<?php echo $obj_settings["caption"] ?>"></td>
		  <td><input type="text"   id="value" 		name="value" 		value="<?php echo $obj_settings["value"] ?>"></td>
		  <td><input type="text"   id="variants" 	name="variants" 	value="<?php echo $obj_settings["variants"] ?>"></td>
		  <td><input type="text"   id="part" 		name="part" 		value="<?php echo $obj_settings["part"] ?>"></td>
	<tr>
  </table>
   
  <br><br><br>
  <input type="submit" value="Submit">
  <!-- <button type="submit">Submit</button> -->  
  <button type="submit" formaction="/action_page2.php">Новый объект</button>
  <button type="submit" formaction="/action_page3.php">Редактировать</button>
  <button type="submit" formaction="/action_page4.php">Удалить</button>
  
</form>
<br><br>
<iframe src="upload.php?alias=<?php echo $alias ?>" align="center" height="200" width="740" style="border: 1px solid black; overflow: hidden; overflow-y:auto;">
</iframe><br><br>
<button type="button"><a href="read_edit_objects.php">Вернуться к списку объектов</a></button>
</div>
</body>
</html>