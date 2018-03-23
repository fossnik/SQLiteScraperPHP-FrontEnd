<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>My Coins and Stuff</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<?php
		require __DIR__ . '/dbQuery.php';

		// declare a new database query object
		$queryDb = new dbQuery;

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
				echo '<a href="index.php?' .
					'coin=' . $coinName .
					'&snapshot=' . $key .
					'">' . $date . '</a>';
		}

	function getCoin($coin, $snapKey) {
		echo 'I will attempt to grab snapshot #' . $snapKey .
		' of ' . $coin . '<br>';
	}

	if (isset($_GET['snapshot'])) {
		getCoin($_GET['coin'], $_GET['snapshot']);
		echo '<table>';
		foreach ($queryDb->getcoin($_GET['coin'])[$_GET['snapshot']] as $key => $string) {
			echo
				'<tr>' .
					'<td>' . $key . '</td>' .
					'<td>' . $string . '</td>' .
			'</tr>';
		}
		echo '</table>';
	}
	?>
</body>
</html>