<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>My Coins and Stuff</title>
	<?php
	require __DIR__ . '/dbQuery.php';

	// declare a new database query object
	$queryDb = new dbQuery;
	?>
</head>
<body>

	<h1>Select Your Coin</h1>
		<form action="#" method="post">
			<select name="coin">
				<option value="">---------</option>
				<?php
				foreach ($queryDb->getCoins() as $dbCoin)
					echo '<option value="'.$dbCoin.'">'.$dbCoin.'</option>';
				?>
			</select>
			<input type="submit" name="submit" value="Query Coin from DB"/>
		</form>
		<?php
		if(isset($_POST['submit'])) {
			$coinName = $_POST['coin'];
			$snapshots[] = $queryDb->getcoin($coinName);

			$snapshotDates = [];
			foreach ($snapshots[0] as $snapshot)
				$snapshotDates[] = $snapshot['dateCreated'];

			echo '<form action="#" method="post">';
			foreach ($snapshotDates as $key => $date)
				echo '<input type="radio" name="radio" value="'.$key.'">'.$date;
			echo '</form>';
		}
		?>
</body>
</html>