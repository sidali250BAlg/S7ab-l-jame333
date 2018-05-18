<?php
	session_start();
	$title= 'categorie';
	include 'includes/header.php';
	include 'includes/connect.php';
	include 'includes/navbar.php';

	$id_cat = $_GET['id'];


		$sql = $connect->prepare("SELECT * FROM categories WHERE id_categorie=?");
		$sql->execute(array($id_cat));
		

		$row = $sql->rowCount();
		if($row > 0)
		{
			$data= $sql->fetch();
			
		}
		if (isset($_POST['submit'])) {
			$name = $_POST['nom_categorie'];
			$sql1 = $connect->prepare("UPDATE categories SET name_categorie ='$name' WHERE id_categorie=?");
			$sql1->execute(array($id_cat));
			header('location: categorie_consulter.php');
		}

		if (isset($_POST['delete'])) {
					$sql2 = "DELETE FROM categories WHERE id_categorie=$id_cat";
					$connect->exec($sql2);
					header('location: categorie_consulter.php');
				
			}

	
?>

<form action="" method="POST">
	<div class="row">
		<div class="col-md-3 xs-hidden"></div>
		<div class="col-md-6 col-xs-12">
			<div class="panel panel-primary">
				<div class="panel panel-heading">
					<h3>Modifier categorie</h3>
				</div>
				<div class="panel panel-body">
					<div class="form-group"></div>
						<label>nom categorie:</label>
						<input type="text" name="nom_categorie" class="form-control" value="<?php echo $data['name_categorie']; ?>">
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