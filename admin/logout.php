<?php ob_start();
session_start();

if($_SESSION['login'] != true){
	header('location:../login.php');
}else{
	
	session_destroy();

 unset($_SESSION['login']);
 unset($_SESSION['userid']);
 unset($_SESSION['username']);

	header('location:../login.php');
	
}	
	
?>