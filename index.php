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
	echo 'Connected to the SQLite database successfully!' . "\n\n";
else
	echo 'Whoops, could not connect to the SQLite database!' . "\n\n";

$query = $pdo->query('SELECT * FROM btcusd');

while($row = $query->fetch(PDO::FETCH_ASSOC)) {
	print_r( $row );
}
