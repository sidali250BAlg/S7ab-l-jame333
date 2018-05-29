<?php
	session_start();
	$title= 'categorie';
	include 'includes/header.php';
	include 'includes/connect.php';
	include 'includes/navbar.php';

	if(isset($_POST['submit']))
	{
		$categorie = htmlentities($_POST['nom_categorie']);

		$sql = $connect->prepare("SELECT * FROM categories WHERE name_categorie=?");
		$sql->execute(array($categorie));

		$row = $sql->rowCount();
		if($row == 0)
		{
			$sql= $connect->prepare("INSERT INTO categories VALUES ('','$categorie')");
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
					<h3>Ajouter categorie</h3>
				</div>
				<div class="panel panel-body">
					<div class="form-group"></div>
						<label>nom categorie:</label>
						<input type="text" name="nom_categorie" class="form-control">
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