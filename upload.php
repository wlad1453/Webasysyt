


<?php
$fExt = $_POST["fExt"];
$objectId = $_POST["objectId"];
$uploadOk = 1;

$alias = $_GET["alias"];
//$alias = "aliasTst" . ".";
// echo $alias;
?>

<!DOCTYPE html>
<html>
<body>
<div align = "center">

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
  Загрузка файла .svg  :
  <input type="file" 	name="fileToUpload" id="fileToUpload">
  <input type="hidden" 	name="fExt" 		id="fExt" 	value="svg">
  <input type="hidden" 	name="fName" 		id="fName" 	value="<?php echo $alias ?>">
  <input type="submit" value="Загрузить на сервер" name="submit">
</form><br>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
  Загрузка файла .blend:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="hidden" name="fExt" id="fExt" 	value="blend">
  <input type="hidden" name="fName" id="fName" 	value="<?php echo $alias ?>">
  <input type="submit" value="Загрузить на сервер" name="submit">
</form><br>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
  Загрузка файла .glb  :
  <input type="file" 	name="fileToUpload" id="fileToUpload">
  <input type="hidden" 	name="fExt" 	id="fExt" 	value="glb">
  <input type="hidden" 	name="fName" 	id="fName" 	value="<?php echo $alias ?>">
  <input type="submit" value="Загрузить на сервер" name="submit">
</form><br>

</div>
</body>
</html>


<?php
$fName = $_POST["fName"];
//echo "Name <br>";
//echo "Name: $fName <br>";

if( $fExt == "svg" )	$target_dir = "images/";
if( $fExt == "blend" )	$target_dir = "models/";
if( $fExt == "glb" )	$target_dir = "models/";

$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

//echo "1. target_file: $target_file imageFileType: $imageFileType<br>";
//echo $_FILES["name"] . "<br>";


if( $fExt == "svg" && $imageFileType != "svg" ) {
	echo "Расширение файла должно быть .svg<br><br>";
	$uploadOk = 0;
} 
if( $fExt == "blend" && $imageFileType != "blend" ) {
  echo "Расширение файла должно быть .blend<br><br>";
  $uploadOk = 0;
} 
if( $fExt == "glb" && $imageFileType != "glb" ) {
  echo "Расширение файла должно быть .glb<br><br>";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 20480000) {
  echo "Файл слишком большой.";
  $uploadOk = 0;
}

if ( $uploadOk == 1 ) {
	$target_file = $target_dir . $fName . "." . $imageFileType;
	// echo "Target $target_file <br>";
	if ( file_exists($target_file) ) {										// Check if file already exists
		echo "Файл с таким именем уже есть на сервере<br>Заменяем!<br><br>";
		unlink($target_file);
	}
}
//echo "2. target_file: $target_file imageFileType: $imageFileType<br>";
//echo $_FILES["name"] . "<br>";


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Файл не загружен.<br><br>";
  echo "<button type=\"button\"><a href=\"upload.html\"> Повторить? </a></button><br>";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "Файл ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])) . " загружен на сервер как " . $target_file . "<br><br>";
	echo "<button type=\"button\"><a href=\"upload.html\"> Загрузить еще? </a></button><br><br>";
  } else {
    echo "Произошла ошибка при загрузке файла.<br>";
	echo "<button type=\"button\"><a href=\"upload.html\"> Повторить? </a></button><br>";
  }
}

?>
