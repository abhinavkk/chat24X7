<?php
namespace Controllers;
use Models\login;
use Models\postlist;
use Models\rememberme;
class HomeController
{
	protected $twig;

	public function __construct()
	{
		$loader = new \Twig_Loader_Filesystem(__DIR__ . '/../views');
		$this->twig = new \Twig_Environment($loader);
	}

    // $_SERVER['REQUEST_METHOD'] - request method
    public function get()
    {
	    
	    session_start();
	    $posts = postlist::getposts();       
        if(isset($_COOKIE['rememberme']))
        {
            $check = rememberme::cookie_check();
            if($check==1)
            {   echo $this->twig->render("user.html",array(
                "title" => "CHAT 24X7",
                "posts" => $posts,
                "user" => $_SESSION['username']
                ));
            }
        }        
        else
	    {    echo $this->twig->render("index.html", array(
		    "title" => "CHAT 24X7",
		    "posts" => $posts
		    ));
        }
    }

    public function post()
    {
    	session_start();
    	if(isset($_POST['submit']) && isset($_POST['username']) && isset($_POST['password']))
    	{   
    		$username=$_POST['username'];
    		$password=$_POST['password'];
    		$rememberme=isset($_POST['rememberme']);

    		$login=login::check($username,$password,$rememberme);

    		if($login)
    		{
    			$message = "Welcome";
    			$posts = postlist::getposts();
    			echo $this->twig->render("user.html",array(
    				"message" => $message,
    				"posts" => $posts,
    				"user" => $_SESSION['username']
    				));
    		} 		
    		else {
    			$message = "Invalid username or password";
    			echo $this->twig->render("error.html",array(
    				"message" => $message));
    		}
    	}
	    else{
	   		$posts = postlist::getposts();
	   		echo $this->twig->render("index.html", array(
	    	"title" => "CHAT 24X7",
	    	"posts" => $posts
	   		 ));
	   	}
	    	
   	}
   
}
?>    