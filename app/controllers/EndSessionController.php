<?php
namespace Controllers;
use Models\postlist;
class EndSessionController
{
	protected $twig;

	public function __construct()
	{
		$loader = new \Twig_Loader_Filesystem(__DIR__ . '/../views');
		$this->twig = new \Twig_Environment($loader);
	}

    public function get()
    {
    	session_start();
    	if (isset($_SESSION['username']))
    	{   setcookie ('rememberme', "", time() - 3600,'/');	 
    		session_destroy();
    		$posts = postlist::getposts();
			echo $this->twig->render("index.html", array(
	    	"title" => "CHAT 24X7",
	    	"posts" => $posts
	    	));	
    	}
    }
}
?>