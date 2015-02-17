<?php
namespace Models;

class vote
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

	public static function upvote($id)
	{
		$db = self::getDB();
		$statement = $db->prepare("Select likes from comments where id= :id");
		$statement->bindValue(':id', $id, \PDO::PARAM_INT);
		$result=$statement->execute();
		$likes=$statement->fetch(\PDO::FETCH_ASSOC);
		$likes=$likes['likes'];
		$likes=$likes+1;
		$statement = $db->prepare("UPDATE comments SET likes = :likes WHERE id=:id");
		$statement->bindValue(':likes', $likes, \PDO::PARAM_INT);
		$statement->bindValue(':id', $id, \PDO::PARAM_INT);
		$statement->execute();
		return $likes;
	}
}
?>