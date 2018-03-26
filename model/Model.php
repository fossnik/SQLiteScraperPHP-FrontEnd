<?php
/**
 * Created by PhpStorm.
 * User: seth
 * Date: 3/23/18
 * Time: 1:23 PM
 */

use Controller\Controller;
require 'vendor/autoload.php';

class Model
{
	private $pdo;

	const PATH_TO_SQLITE_FILE = 'db/coinsnapshot.db';

	public function __construct() {
		$this->connect();
		if ($this->pdo != null)
			echo 'SQLite database connection acquired' , "\r\n";
		else
			echo 'SQLite database Failure!' , "\r\n";
	}

	public function connect() {
		if ($this->pdo == null) {
			try {
				$this->pdo = new \PDO("sqlite:" . self::PATH_TO_SQLITE_FILE);
			} catch (\PDOException $e) {
				throw new \PDOException("This is a Problem Connecting to DB");
			}
		}
	}
	
	public function getCoins() {
		// construct a list of all coins present in database
		$DbCoins = [];
		$query = $this->pdo->query("SELECT name FROM sqlite_master WHERE type='table' ORDER BY name;");
		while($coin = $query->fetch(PDO::FETCH_ASSOC))
			$DbCoins[] = $coin['name'];

		return $DbCoins;
	}

	public function getCoin($name) {
		$query = $this->pdo->query('SELECT * FROM ' . $name);
		$coin = [];
		while($row = $query->fetch(PDO::FETCH_ASSOC))
			$coin[] = $row;

		return $coin;
	}

}