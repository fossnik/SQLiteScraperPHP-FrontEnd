<?php
/**
 * Created by PhpStorm.
 * User: seth
 * Date: 3/22/18
 * Time: 7:44 PM
 */
require 'vendor/autoload.php';

use App\SQLiteConnection;

$pdo = (new SQLiteConnection())->connect();
if ($pdo != null)
	echo 'SQLite database connection acquired' . "\r\n";
else
	echo 'SQLite database Failure!' . "\r\n";

//$query = $pdo->query('SELECT * FROM btcusd');
//
//while($row = $query->fetch(PDO::FETCH_ASSOC)) {
//	print_r( $row );
//}

$query = $pdo->query("SELECT name FROM sqlite_master WHERE type='table';");
while($coin = $query->fetch(PDO::FETCH_ASSOC))
	echo $coin['name'] . "\r\n";
