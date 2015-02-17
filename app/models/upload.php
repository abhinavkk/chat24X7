<?php
namespace Models;

class upload
{
	protected $db;
	public function __construct()
	{
		$this->db = self::getDB();
	}

	public static function getDB(){
		$configs = include '../config/config2.php';
		return new \PDO("mysql:dbname={$configs['dbname']}; host={$configs['host']}", "{$configs['username']}", "{$configs['password']}");
	}

	public static function post($comment,$username,$retime)
	{
		$db = self::getDB();
		$statement = $db->prepare("INSERT INTO comments(username,comment,time,likes) VALUES (:username,:comment,:retime,0)");
		$result=$statement->execute(array(
			"comment" => $comment,
			"username" => $username,
			"retime" => $retime
			));
		$statement = $db->prepare("Select id from comments where time='$retime'");
		$res=$statement->execute();
		$id=$statement->fetch(\PDO::FETCH_ASSOC);	
		return $id;
	}
}
?>