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
		<select name="country">
			<option value="">---------</option>
			<?php
				foreach ($queryDb->getCoins() as $dbCoin)
					echo '<option value="'.$dbCoin.'">'.$dbCoin.'</option>';
				?>
		</select>

</body>
</html>