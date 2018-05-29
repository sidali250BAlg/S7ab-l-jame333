<?php
	session_start();
	$title= 'categorie';
	include 'includes/header.php';
	include 'includes/connect.php';
	include 'includes/navbar.php';

	$id_pro = $_GET['id'];


		$sql = $connect->prepare("SELECT * FROM produits WHERE id_produit=?");
		$sql->execute(array($id_pro));
		

		$row = $sql->rowCount();
		if($row > 0)
		{
			$data= $sql->fetch();
			
		}
		if (isset($_POST['submit'])) {
			$name = $_POST['nom_produit'];
			$cat = $_POST['categorie'];
			$scat = $_POST['sous_categorie'];
			$prixA = $_POST['prix_achat'];
			$prixV = $_POST['prix_vente'];
			$descript = $_POST['descript'];
			$image = $_POST['image_produit'];
			$sql1 = $connect->prepare("UPDATE produits SET name_produit ='$name' ,categorie='$cat',sous_categorie='$scat', price_buy='$prixA', price_sell='$prixV' , description='$descript' , nom_image='$image'  WHERE id_produit=?");
			$sql1->execute(array($id_pro));
			header('location: produit_consulter.php');
		}

		if (isset($_POST['delete'])) {
					$sql2 = "DELETE FROM produits WHERE id_produit=$id_pro";
					$connect->exec($sql2);
					header('location: produit_consulter.php');
				
			}

	
?>

<form action="" method="POST">
	<div class="row">
		<div class="col-md-3 xs-hidden"></div>
		<div class="col-md-6 col-xs-12">
			<div class="panel panel-primary">
				<div class="panel panel-heading">
					<h3>Modifier produit</h3>
				</div>
				<div class="panel panel-body">
					<div class="form-group"></div>
						<label>nom produit:</label>
						<input type="text" name="nom_produit" class="form-control" value="<?php echo $data['name_produit']; ?>"><br>
						<label>categorie:</label>
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
								
						</select><br>	
						<label>categorie:</label>
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
								
						</select><br>	
						<label>sous categorie:</label>
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
								
						</select><br>		
						<label>prix d'achat</label>
						<input type="text" name="prix_achat" class="form-control" value="<?php echo $data['price_buy']; ?>"><br>
						<label>prix de vente:</label>
						<input type="text" name="prix_vente" class="form-control" value="<?php echo $data['price_sell']; ?>"><br>
						<label>description:</label>
						<input type="text" name="descript" class="form-control" value="<?php echo $data['description']; ?>"><br>
						<label>Importer l'image:</label>
						<input type="file" name="image_produit" id="image_produit"><br>
				</div>
				
				<div class="panel panel-footer" align="right">
					<input type="submit" name="submit" value="Modifier" class="btn btn-primary">
					<input type="submit" name="delete" value="Supprimer" class="btn btn-primary">
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