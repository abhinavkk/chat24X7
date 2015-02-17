<?php
namespace Controllers;
use Models\vote;

class PostVoteController
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
		$resp=$_POST['dat'];
		$id=$resp['uni'];
		$likes=vote::upvote($id);
		echo $likes;
	}
}
?>