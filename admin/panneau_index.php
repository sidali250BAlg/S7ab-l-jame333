<?php
	session_start();
	$title = 'Home';
	include 'includes/header.php';
	include 'includes/connect.php';
	include 'includes/navbar.php';

	if(isset($_POST['submit']))
	{
		$nom_panneau = htmlspecialchars($_POST['nom_panneau']);
		$name_produit = htmlspecialchars($_POST['name_produit']);
		$nom_image = htmlspecialchars($_POST['nom_image']);

		$sql = $connect->prepare("SELECT * FROM panneau_index WHERE name_produit=?");
		$sql->execute(array($name_produit));

		$row = $sql->rowCount();
		if($row == 0)
		{
			$sql= $connect->prepare("INSERT INTO panneau_index VALUES ('','$nom_panneau', '$name_produit','$nom_image')");
			$sql->execute();
		}else
		{
			$erreur =  'Ce produit existe deja';	
		}
	}


?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
	<div class="row">
		<div class="col-md-3 xs-hidden"></div>
		<div class="col-md-6 col-xs-12">
			<div class="panel panel-primary">
				<div class="panel panel-heading">
					<h3>Ajouter un panneau dans la page d'acceuil:</h3>
				</div>
				<div class="panel panel-body">
					<div class="form-group"></div>
						<label>Nom du panneau:</label>
						<input type="text" name="nom_panneau" class="form-control">
						<label>Selectionner un produit:</label>
						<select name="name_produit" class="form-control">
							<option>...</option>
							<?php
								$sql = $connect->prepare("SELECT DISTINCT(name_produit) FROM produits");
								$sql->execute();
								$prods= $sql->fetchAll();
							 foreach ($prods as $prod)
							 {
							 	echo "<option>".$prod['name_produit']."</option>";
							 } 

							?>								
						</select>
						<label>Selectioner le nom de l'image:</label>
						<select name="nom_image" class="form-control">
							<option>...</option>
							<?php
								$sql = $connect->prepare("SELECT DISTINCT(nom_image) FROM produits");
								$sql->execute();
								$prods= $sql->fetchAll();
							 foreach ($prods as $prod)
							 {
							 	echo "<option>".$prod['nom_image']."</option>";
							 } 

							?>								
						</select>
						
				</div>
				<div class="panel panel-footer" align="right">
					<input type="submit" name="submit" value="Ajouter" class="btn btn-primary">
				</div>
			</div>
		</div>
	</div>

</form>
	



<?php
	include 'includes/footer.php';
?>