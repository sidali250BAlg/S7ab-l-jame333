<?php

	session_start();
	$title= 'Panier';
	include 'includes/header.php';
	include 'includes/connect.php';
	include 'includes/navbar.php';
	include 'functions/functions.php';
	if(isset($_SESSION['username']))
	{
		$nbProduit = count($_SESSION['panier']['libelleProduit']);

		if($nbProduit <= 0)
		{
			echo "<pre>";
			print_r($_SESSION['panier']);
			echo "</pre>";
		}else
		{
				echo 'Tableau des cammandes est vides.'.'<br><br>';
		}

			



		include 'includes/footer.php';

	}else
	{
		header('location:index.php');
	}
?>

