<?php
/**
 * Created by PhpStorm.
 * User: seth
 * Date: 3/22/18
 * Time: 7:46 PM
 */

namespace App;

/**
 * SQLite connnection
 */
class SQLiteConnection {
	/**
	 * PDO instance
	 * @var type
	 */
	private $pdo;

	/**
	 * return in instance of the PDO object that connects to the SQLite database
	 * @return \PDO
	 */
	const PATH_TO_SQLITE_FILE = 'db/coinsnapshot.db';

	public function connect() {
		if ($this->pdo == null) {
			try {
				$this->pdo = new \PDO("sqlite:" . self::PATH_TO_SQLITE_FILE);
			} catch (\PDOException $e) {
				throw new \PDOException("This is a Problem Connecting to DB");
			}
		}
		return $this->pdo;
	}
}