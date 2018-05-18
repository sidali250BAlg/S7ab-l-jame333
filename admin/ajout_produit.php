<?php
	session_start();
	$title= 'categorie';
	include 'includes/header.php';
	include 'includes/connect.php';
	include 'includes/navbar.php';


	
	if(isset($_POST['submit']))
	{
		$nom_produit = mysql_real_escape_string(htmlentities($_POST['nom_produit']));
		$categorie = mysql_real_escape_string(htmlentities($_POST['categorie']));
		$sous_categorie = mysql_real_escape_string(htmlentities($_POST['sous_categorie']));
		$price_buy = mysql_real_escape_string(htmlentities($_POST['price_buy']));
		$price_sell = mysql_real_escape_string(htmlentities($_POST['price_sell']));
		$description = mysql_real_escape_string(htmlentities($_POST['description']));

		$nom_image= $_FILES['image_produit']['name'];

		$img_tmp = $_FILES['image_produit']['tmp_name'];

		if(!empty($nom_produit) && !empty($categorie) && !empty($sous_categorie) && !empty($img_tmp) )
		{	

			include 'functions/upload_image_resizing.php';

			$sql = $connect->prepare("SELECT * FROM produits WHERE name_produit=? AND sous_categorie=?");
			$sql->execute(array($nom_produit, $sous_categorie));

			$row = $sql->rowCount();
			if($row == 0)
			{

				$sql= $connect->prepare("INSERT INTO produits VALUES ('','$nom_produit','$categorie', '$sous_categorie', '$price_buy', '$price_sell','$description','$nom_image')");
				$sql->execute();

			}else
			{
				$erreur =  'Ce nom existe deja';	
			}

		}else
		{
			echo 'Veuillez remplir tout les champs et l\'image';
		}
		

		

	}
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
	<div class="row">
		<div class="col-md-3 xs-hidden"></div>
		<div class="col-md-6 col-xs-12">
			<div class="panel panel-primary">
				<div class="panel panel-heading">
					<h3>Ajouter produit</h3>
				</div>
				<div class="panel panel-body">
					<div class="form-group"></div>
						<label>nom produit:</label>
						<input type="text" name="nom_produit" class="form-control">
						<label>Selectionner une categorie</label>
						<select name="categorie" class="form-control">
							<?php
								$sql = $connect->prepare("SELECT * FROM categories");
								$sql->execute();
								$cats= $sql->fetchAll();
							 foreach ($cats as $cat)
							 {
							 	echo "<option>".$cat['name_categorie']."</option>";
							 } 

							?>
								
						</select>
						<label>Selectionner une sous categorie</label>
						<select name="sous_categorie" class="form-control">
							<?php
								$sql = $connect->prepare("SELECT DISTINCT(name_sous_cat) FROM sous_categories");
								$sql->execute();
								$cats= $sql->fetchAll();
							 foreach ($cats as $cat)
							 {
							 	echo "<option>".$cat['name_sous_cat']."</option>";
							 } 

							?>
								
						</select>
						<label>Prix d'achat:</label>
						<input type="text" name="price_buy" class="form-control">
						<label>Prix de vente:</label>
						<input type="text" name="price_sell" class="form-control">
						<label>Description:</label>
						<input type="text" name="description" class="form-control">
						<label>Importer l'image:</label>
						<input type="file" name="image_produit" id="image_produit">
				</div>
				<div class="panel panel-footer" align="right">
					<input type="submit" name="submit" value="Ajouter" class="btn btn-primary">
				</div>
			</div>
		</div>
	</div>

</form>

<?php 
	if(!empty($erreur))
	{
		echo "<div class='container'>";
		echo "<div class='alert alert-info'>". $erreur ."</div>";
		echo "</div>";
	}
 ?>


<?php
	include 'includes/footer.php';
?>