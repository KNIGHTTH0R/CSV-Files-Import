<?php
include("csv.php");
$csv = new csv();
if (isset($_POST['sub']))
{
    $csv->import($_FILES['file']['tmp_name']);
}
if(isset($_POST['exp']))
{
	$csv->export();
}
?>
<!DOCTYPE html>
<html>
<head>
   <title>CSV</title>
</head>
<body>
<form method="post" enctype="multipart/form-data">
	<input type="file" name= "file">
	<input type="submit" name="sub" value="Import">
<br>
<form method="post">
	<input type= "submit" name="exp" value="export">
</form>
</body>
</html>