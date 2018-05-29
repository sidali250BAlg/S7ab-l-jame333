<?php
	session_start();
	$title= 'Sous categorie';
	include 'includes/header.php';
	include 'includes/connect.php';
	include 'includes/navbar.php';

	$id_cat = $_GET['id'];


		$sql = $connect->prepare("SELECT * FROM sous_categories WHERE id_sous_cat=?");
		$sql->execute(array($id_cat));
		

		$row = $sql->rowCount();
		if($row > 0)
		{
			$data= $sql->fetch();
			
		}
		if (isset($_POST['submit'])) {
			$name = $_POST['nom_sous_categorie'];
			$sql1 = $connect->prepare("UPDATE sous_categories SET name_sous_cat ='$name' WHERE id_sous_cat=?");
			$sql1->execute(array($id_cat));
			header('location: sous_categorie_consulter.php');
		}

		if (isset($_POST['delete'])) {
					$sql2 =$connect->prepare("DELETE FROM sous_categories WHERE id_sous_cat=?");
					$sql2->execute(array($id_cat));
					header('location: sous_categorie_consulter.php');
				
			}

	
?>

<form action="" method="POST">
	<div class="row">
		<div class="col-md-3 xs-hidden"></div>
		<div class="col-md-6 col-xs-12">
			<div class="panel panel-primary">
				<div class="panel panel-heading">
					<h3>Modifier Sous categorie</h3>
				</div>
				<div class="panel panel-body">
					<div class="form-group"></div>
						<label>nom sous categorie:</label>
						<input type="text" name="nom_sous_categorie" class="form-control" value="<?php echo $data['name_sous_cat']; ?>">
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