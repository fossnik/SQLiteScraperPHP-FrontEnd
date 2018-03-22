<?php
/**
 * Created by PhpStorm.
 * User: seth
 * Date: 3/22/18
 * Time: 4:26 PM
 */

class database
{
	private $pdo;

	function __construct($path){
		try {
			if($this->pdo == null) {
				$this->pdo = new PDO($path,"","", array(
					PDO::ATTR_PERSISTENT => true
				));
			}
			return $this->pdo;
		} catch(PDOException $e) {
			print "PDOException:\n".$e->getMessage();
		}
	}
}