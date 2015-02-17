<?php
namespace Models;

class rememberme
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

  public static function cookie_check()
  {
      $hashcheck=$_COOKIE['rememberme']; 
      $db=self::getDB();
      $statement = $db->prepare("Select username from cookie where hash='$hashcheck'");
      $statement->execute();
      $user = $statement->fetch(\PDO::FETCH_ASSOC);
      $username = $user['username'];
        if($username)
        	{ $check=1;
        	  $_SESSION['username']=$username;
        	} 	
        else 
        	{ $check=0;
        	  setcookie ('rememberme', "", time() - 3600,'/');	
        	}
        return $check;   
	}
}  

?>