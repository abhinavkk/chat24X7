<?php
require_once __DIR__ . "	/../vendor/autoload.php";

Toro::serve(array(
	"/" => "Controllers\\HomeController",
	"/signup" => "Controllers\\NewUserController",
	"/logout" => "Controllers\\EndSessionController",
	"/post" => "Controllers\\PostUploadController",
	"/vote" => "Controllers\\PostVoteController"
	));
?>