<!DOCTYPE html>
<html>
<head>
<style>
body { background-color: #c4e3ed;
	font-family: arial;
	}
.tempData {
	table-layout: fixed;
	width: 730px;
	border-collapse: collapse;  
	white-space: nowrap;
}
.row-ID {width: 10%;}
.row-DateTime {width: 23%;}
.row-Data {width: 16%;}
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

	<div align="center"><h3>Object groups</h3></div>
	
	<div align="center">
		<table class="tempData" width="740">
			<tr>
				<th class="row-1 row-ID">ID</th> <th class="row-1 row-ID">ParentID</th> <th>Alias</th> <th>Caption</th> 
			</tr>
		</table>
	<iframe src="read_DB.php?TabN=2" align="center" height="700" width="740" style="border:none; overflow: hidden; overflow-y:auto;">
	</div>
</body>
</html>