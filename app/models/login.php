<?php
namespace Models;
class login
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

	public static function check($username,$password,$rememberme)
	{		
		$db = self::getDB();
		$statement = 
		  $db->prepare("Select * from signup where username = :username && password = :password");
		$statement->bindValue(':username', $username, \PDO::PARAM_STR);  
		$statement->bindValue(':password', $password, \PDO::PARAM_STR); 
		$statement->execute();
		$count=0;
		while($row = $statement->fetch(\PDO::FETCH_ASSOC))
		{
			$count++;
		}
        if ($count==1)
        {
        	if (isset($_POST['rememberme']))
        	  {  $value = sha1($_POST['password']);
        	     setcookie('rememberme',$value,time()+60*60*24*30,'/'); 
        	     $statement=$db->prepare("INSERT INTO cookie values (:username, :value)");
        	     $statement->bindValue(':username', $username, \PDO::PARAM_STR);
        	     $statement->bindValue(':value', $value, \PDO::PARAM_STR);
        	     $statement->execute();        	   
        	  }
        		$_SESSION['username']=$_POST['username'];
        		return true;
        }  

		else
			return false;
	}
}
?>	