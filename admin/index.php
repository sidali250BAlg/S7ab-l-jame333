<?php
	session_start();
	$title = 'Admin Dashboard';
	include 'includes/header.php';
	include 'includes/connect.php';
	include 'includes/navbar.php';

	if(isset($_SESSION['username']))
	{

	}else
	{
		header('location:../index.php');
	}
?>
	



<?php
	include 'includes/footer.php';

?>