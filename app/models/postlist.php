<?php
namespace Models;

class postlist
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

	public static function getposts()
	{
		$db = self::getDB();
		$posts = array();

		$statement = 
		  $db->prepare("Select * FROM comments order by time desc");
		$statement->execute();  

		 while($row = $statement->fetch(\PDO::FETCH_ASSOC))
		 {
		 	$posts[] = $row;
		 }
		 return $posts;
	}
}
?>		 