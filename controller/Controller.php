<?php
/**
 * Created by PhpStorm.
 * User: seth
 * Date: 3/22/18
 * Time: 7:46 PM
 */

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
			echo
				'<option value="'.$dbCoin.'">' .
				strtoupper(str_replace("usd", "", $dbCoin)) .
				'</option>\n';

		echo
			'</select>',
			'<input type="submit" name="submit" value="Query Snapshot Dates from DB"/>',
			'</form>';

		// invoke when coin selected
		if(isset($_POST['submit'])) {
			$coinName = $_POST['coin'];

			$snapshots[] = $this->model->getCoinSnapshots($coinName);

			$snapshotDates = [];
			foreach ($snapshots[0] as $snapshot)
				$snapshotDates[] = $snapshot['dateCreated'];

			echo '<form action="#" method="post">';

			foreach ($snapshotDates as $propertyName => $date)
				echo
					'<a href="index.php?' .
					'coin=' . $coinName .
					'&snapshot=' . $propertyName . '">' . $date .
					'</a>';
		}

		// invoke when snapshot selected
		if (isset($_GET['snapshot'])) {
			$coin = $_GET['coin'];
			$snapshotNumber = $_GET['snapshot'];
			$coinSnapshots = $this->model->getCoinSnapshots($coin);

			echo
				'<table>',
				'<tr><th colspan="2">',
				'<em>' . $coin . '</em> snapshot ' . $snapshotNumber .
				'</th></tr>';

			foreach ($coinSnapshots[$snapshotNumber] as $propertyName => $propertyValue)
				echo
					'<tr>',
					'<td>' . $propertyName . '</td>',
					'<td>' . $propertyValue . '</td>',
					'</tr>';

			echo '</table>';

			// Previous and Next buttons for Snapshot Navigation
			if ((int)$snapshotNumber > 0)
				echo
					'<button><a href="index.php?coin=' . $coin .
					'&amp;snapshot=' . (((int)$snapshotNumber) - 1) . '">Prev</a></button>';

			if ((int)$snapshotNumber < count($coinSnapshots) - 1)
				echo
					'<button><a href="index.php?coin=' . $coin .
					'&amp;snapshot=' . (((int)$snapshotNumber) + 1) . '">Next</a></button>';
		}
	}
}