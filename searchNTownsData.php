<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Search Database</title>
	<?php
		require_once('dbasefunctions.php');
		
	?>
</head>
<body>
<p>Searching a database </p>
	<?php
		$conn =  SetUpConnection();
		$data = "O'Donnel";
		$escaped = EscapeInput($conn,$data);
		echo "$data escaped is $escaped";
	?>
</body>