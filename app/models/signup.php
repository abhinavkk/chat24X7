<?php
namespace Models;
class signup
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

	public static function newuser($name,$username,$password,$bday,$sex)
	{
		$db = self::getDB();
		$statement = 
		  $db->prepare("INSERT INTO signup Values(:name, :username, :password, :sex, :bday)");
		$result=$statement->execute(array(
		"name" => $name,
		"username" => $username,
		"password" => $password,
		"sex" => $sex,
		"bday" => $bday
		));
	}		
}
?>	