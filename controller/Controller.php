<?php
/**
 * Created by PhpStorm.
 * User: seth
 * Date: 3/22/18
 * Time: 7:46 PM
 */

//namespace Controller;

include_once("model/Model.php");

class Controller {
	private $model;

	public function __construct() {
		// declare a new database query object
		$this->model = new Model();
	}

	public function invoke() {
		echo
		'<h1>Select Your Coin</h1>',
		'<form action="#" method="post">',
		'<select name="coin">',
		'<option value="">Coins</option>';

		foreach ($this->model->getCoins() as $dbCoin)
			echo '<option value="'.$dbCoin.'">' .
				strtoupper(str_replace("usd", "", $dbCoin)) .
				'</option>\n';

		echo
		'</select>',
		'<input type="submit" name="submit" value="Query Snapshot Dates from DB"/>',
		'</form>';

		if(isset($_POST['submit'])) {
			$coinName = $_POST['coin'];

			$snapshots[] = $this->model->getCoin($coinName);

			$snapshotDates = [];
			foreach ($snapshots[0] as $snapshot)
				$snapshotDates[] = $snapshot['dateCreated'];

			echo '<form action="#" method="post">';

			foreach ($snapshotDates as $propertyName => $date)
				echo '<a href="index.php?' .
					'coin=' . $coinName .
					'&snapshot=' . $propertyName .
					'">' . $date . '</a>';
		}

		function getCoin($coin, $snapKey) {
			echo 'Snapshot #' . $snapKey .
				' of ' . $coin . '<br>';
		}

		if (isset($_GET['snapshot'])) {
			$presentCoin = $this->model->getcoin($_GET['coin']);
			getCoin($_GET['coin'], $_GET['snapshot']);
			echo '<table>';
			foreach ($presentCoin[$_GET['snapshot']] as $propertyName => $propertyValue) {
				echo
					'<tr>' .
					'<td>' . $propertyName . '</td>' .
					'<td>' . $propertyValue . '</td>' .
					'</tr>';
			}
			echo '</table>';

			if (((int)$_GET['snapshot']) > 0)
				echo
					'<button><a href="index.php?coin=' .	$_GET['coin'] .
					'&amp;snapshot=' . (((int)$_GET['snapshot']) - 1) . '">Prev</a></button>';

			if (((int)$_GET['snapshot']) < count($presentCoin) - 1)
				echo
					'<button><a href="index.php?coin=' .	$_GET['coin'] .
					'&amp;snapshot=' . (((int)$_GET['snapshot']) + 1) . '">Next</a></button>';

		}
	}
}