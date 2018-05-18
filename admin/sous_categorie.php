<?php
	$title= 'categorie';
	include 'includes/header.php';
	include 'includes/connect.php';
	include 'includes/navbar.php';

	if(isset($_POST['submit']))
	{
		$categorie = mysql_real_escape_string(htmlentities($_POST['categorie']));
		$sous_cat = mysql_real_escape_string(htmlentities($_POST['nom_sous_cat']));

		$sql = $connect->prepare("SELECT * FROM sous_categories WHERE nam_sous_cat=?");
		$sql->execute(array($sous_cat));

		$row = $sql->rowCount();
		if($row == 0)
		{
			$sql= $connect->prepare("INSERT INTO sous_categories VALUES ('','$categorie','$sous_cat')");
			$sql->execute();
		}else
		{
			$erreur =  'Ce nom existe deja';
		}

	}
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
	<div class="row">
		<div class="col-md-3 xs-hidden"></div>
		<div class="col-md-6 col-xs-12">
			<div class="panel panel-primary">
				<div class="panel panel-heading">
					<h3>Ajouter sous categorie</h3>
				</div>
				<div class="panel panel-body">
					<div class="form-group">
						<label>Selectionner une categorie</label>
						<select name="categorie" class="form-control">
							<?php
								$sql = $connect->prepare("SELECT * FROM categories");
								$sql->execute(array($categorie));
								$cats= $sql->fetchAll();
							 foreach ($cats as $cat)
							 {
							 	echo "<option>".$cat['name_categorie']."</option>";
							 } 

							?>
								
						</select>
						<label>nom sous categorie:</label>
						<input type="text" name="nom_sous_cat" class="form-control">
					</div>
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