<?php
namespace Controllers;
use Models\upload;

class PostUploadController
{ 
	protected $twig;

	public function __construct()
	{
		$loader = new \Twig_Loader_Filesystem(__DIR__ . '/../views');
		$this->twig = new \Twig_Environment($loader);
	}

	public function post_xhr()
	{
		session_start();
		$response=$_POST['det'];
		$username=$_SESSION['username'];
		$time=time();
		$retime=date('Y-m-d H:i:s', $time);
		$post = upload::post($response['comment'],$username,$retime);
		$return = array(
			"username" => $username,
			"comment" => $response['comment'],
			"id" => $post['id'],
			"time" => $retime);
		echo json_encode($return);
	}
}
?>
