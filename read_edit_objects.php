<!DOCTYPE html>
<html>
<head>
<style>
body { background-color: #c4e3ed;
	font-family: arial;
	}
.tempData {
	table-layout: fixed;
	width: 930px;
	border-collapse: collapse;  
	white-space: nowrap;
}
.row-ID {width: 4%;}
.row-Dim {width: 6%;}
.row-DateTime {width: 23%;}
.row-Data {width: 16%;}
.row-Sep {width: 5%;}
.row-sb {width: 3%;
		border: none;}

table, td, th {
  border: 2px solid black;
  padding: 5px;
  align: center;
  text-align: center;
}

</style>
</head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<body>

	<div align="center"><h2>Объекты</h2>
	<h4>Для редактирования - выбрать объект ID</h4></div>
	
	<div align="center">
		<table class="tempData" width="1200">
			<tr>
				<th class="row-1 row-ID">ID</th> <th class="row-1 row-ID">pID</th> <th class="row-1 row-Data">Alias</th> <th class="row-1 row-Data">Caption</th>	
				<th class="row-1 row-Dim">length</th> <th class="row-1 row-Dim">width</th> <th class="row-1 row-Dim">height</th> <th class="row-1 row-Dim">Place</th>
				<th class="row-1 row-Data">placeRules</th> <th class="row-1 row-Dim">light</th>
				
			</tr>
		</table>
	<iframe src="read_DB.php?TabN=1" align="center" height="350" width="940" style="border:none; overflow: hidden; overflow-y:auto;">
	<button type="button"><a href="SetUpPage.php"> Назад </a></button>
	</div>
</body>
</html>