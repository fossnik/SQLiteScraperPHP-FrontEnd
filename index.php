<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>My Coins and Stuff</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<?php
		include_once("controller/Controller.php");
		$controller = new Controller();
		$controller->invoke();
	?>
</body>
</html>