<?php 
	session_start();
	$title= 'Produits Tripole';
	include 'includes/header.php';
	include 'includes/connect.php';
	include 'includes/navbar.php';
	include 'functions/functions.php';

	$id_sous_categorie = $_GET['id_sous_cat'];
	$id_produit = $_GET['id_produit'];
	$username = $_GET['username'];

	$date = date('Y/m/d');

	$sql= $connect->prepare("SELECT * FROM produits WHERE id_produit=?");
	$sql->execute(array($id_produit));
	$prods= $sql->fetch();

	$sous_cat = $prods['sous_categorie'];
	$produit =$prods['name_produit'];
	$prix_produit = $prods['price_sell'];
	$qte_produit = 1;

	ajouterArticle($produit,$qte_produit,$prix_produit);




	$sql= $connect->prepare("SELECT * FROM commands WHERE username=? AND produit=? AND sous_categorie=?");
	$sql->execute(array($username, $produit, $sous_cat));
	$row= $sql->rowCount();

	if($row > 0)
	{

		?>
		<div class="container" style="height: 400px">
			<div class='alert alert-info'>
				Votre commande a deja passe, La quantite commander du produit : <br>
					<h3 align='center'><?php echo $produit; ?></h3><br>
			    est maintenant passé à : <br>
			    	<h3 align='center'><?php echo $_SESSION['panier']['qteProduit'][0]; ?></h3> 
			    Consulter votre panier pour modifier les quantitées;

			</div>
		</div>
		<?php
	}else
	{
		$insert= $connect->prepare("INSERT INTO commands VALUES ('', '$username', '$produit', '', '$sous_cat', '$date','','')");

		$insert->execute();

		?>
		<div class="container" style="height: 400px">
		<div class='alert alert-info'>Votre commande a passe, vous pouvez consulter votre panier pour modifier les quantitées</div>
		</div>
		<?php

	}



	header("refresh: 10;produit.php?id_sous_cat=$id_sous_categorie");





	include 'includes/footer.php';


?>