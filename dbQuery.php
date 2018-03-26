<?php
/**
 * Created by PhpStorm.
 * User: seth
 * Date: 3/23/18
 * Time: 1:23 PM
 */

use Model\SQLiteConnection;
require 'vendor/autoload.php';

class dbQuery
{
	private static $pdo;

	public function __construct() {
		self::$pdo = (new SQLiteConnection())->connect();
		if (self::$pdo != null)
			echo 'SQLite database connection acquired' , "\r\n";
		else
			echo 'SQLite database Failure!' , "\r\n";
	}

	public static function getCoins() {
		// construct a list of all coins present in database
		$DbCoins = [];
		$query = self::$pdo->query("SELECT name FROM sqlite_master WHERE type='table' ORDER BY name;");
		while($coin = $query->fetch(PDO::FETCH_ASSOC))
			$DbCoins[] = $coin['name'];

		return $DbCoins;
	}

	public static function getCoin($name) {
		$query = self::$pdo->query('SELECT * FROM ' . $name);
		$coin = [];
		while($row = $query->fetch(PDO::FETCH_ASSOC))
			$coin[] = $row;

		return $coin;
	}

}