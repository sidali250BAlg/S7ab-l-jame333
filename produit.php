<?php

	session_start();
	$title= 'Produits Tripole';
	include 'includes/header.php';
	include 'includes/connect.php';
	include 'includes/navbar.php';

		
	$id_sous_cat = $_GET['id_sous_cat'];

	$sql1= $connect->prepare("SELECT * FROM sous_categories WHERE id_sous_cat=?");
	$sql1->execute(array($id_sous_cat));
	$prods1=$sql1->fetchAll();
	foreach ($prods1 as $row) {
		$name_sous_cat = $row['name_sous_cat'];
		$sql= $connect->prepare("SELECT * FROM produits WHERE sous_categorie=?");
		$sql->execute(array($name_sous_cat));
		$prods=$sql->fetchAll();
	}


	

	?>
	<div class='container' style="min-height: 1000px">
	<div class='row'>

	<?php
	foreach ($prods as $prod) {
	?>
		<div class='col-md-3'>
			<div class="panel panel-primary">
				<div class="panel panel-heading">
					<?php echo $prod['name_produit']; ?>
				</div>
				<div class="panel panel-body">
					<div class='col-md-12' align='center'>
						<img class='img-responsive' src='admin/uploads/<?php echo $prod['nom_image']; ?>'>
						<h5 align="left" style="font-weight: bold">Prix :</h5>
						<?php echo $prod['price_sell']; ?> DA
					</div>
				</div>
				<div class="panel panel-footer">
					<div align="right">
						<a href="?id_sous_cat=<?php echo $id_sous_cat; ?>&&id_produit=<?php echo $prod['id_produit']; ?>&&username=<?php echo $id_sous_cat; ?>"><input type="submit" name="command" value="commender" class="btn btn-primary btn-xs"></a>
					</div>
				</div>
			</div>
		</div>
						
<?php
	}
?>
</div>
</div>






<?php

	include 'includes/footer.php';


?>


