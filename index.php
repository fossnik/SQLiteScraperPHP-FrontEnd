<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>My Coins and Stuff</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<?php
	require __DIR__ . '/dbQuery.php';

	// declare a new database query object
	$queryDb = new dbQuery;
	?>
</head>
<body>
	<?php
		echo
		'<h1>Select Your Coin</h1>',
			'<form action="#" method="post">',
				'<select name="coin">',
					'<option value="">---------</option>';

		foreach ($queryDb->getCoins() as $dbCoin)
			echo '<option value="'.$dbCoin.'">'.$dbCoin.'</option>';

		echo
			'</select>',
			'<input type="submit" name="submit" value="Query Snapshot Dates from DB"/>',
			'</form>';
		if(isset($_POST['submit'])) {
			$coinName = $_POST['coin'];
			$snapshots[] = $queryDb->getcoin($coinName);

			$snapshotDates = [];
			foreach ($snapshots[0] as $snapshot)
				$snapshotDates[] = $snapshot['dateCreated'];

			echo '<form action="#" method="post">';

			foreach ($snapshotDates as $key => $date)
				echo '<a href="index.php?snapshot=' . $key . '">' . $date . '</a>';

		}

	function getCoin($snapshot) {
		echo 'I will attempt to grab snapshot #'.
		$snapshot;
	}

	if (isset($_GET['snapshot']))
		getCoin($_GET['snapshot']);

	?>

</body>
</html>