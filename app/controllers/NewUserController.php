<?php
namespace Controllers;
use Models\signup;
class NewUserController
{
	protected $twig;

	public function __construct()
	{
		$loader = new \Twig_Loader_Filesystem(__DIR__ . '/../views');
		$this->twig = new \Twig_Environment($loader);
	}

    public function post()
    {
    	session_start();
    	if(isset($_POST))
    	{
    		$name=$_POST['name'];
    		$username=$_POST['username'];
    		$password=$_POST['password'];
    		$bday=$_POST['bday'];
    		$gender=$_POST['gender'];
    		$sex;
    		if($gender=="Male")
    			$sex="M";
    		else
    			$sex="F";

    		signup::newuser($name,$username,$password,$bday,$sex);
    		$message = "Welcome";
    		echo $this->twig->render("user.html",array(
    			"message" => $message));

    	}
    	else
    	{   $posts = postlist::getposts();
    		echo $this->twig->render("index.html", array(
	    	"title" => "CHAT 24X7",
            "posts" => $posts
	   		 ));
    	}
    }
}