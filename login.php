<?php
require_once('./lib/auth.php');

$login = new Auth();

if(!isset($_POST['submit'])) {
	header("Location: index.php");
	exit;

} else {
	$username = $_POST['user'];
	$password = $_POST['pass'];

	$login->verify($username,$password);
}


?>
