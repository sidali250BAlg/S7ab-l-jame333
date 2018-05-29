<?php
	session_start();
	$title= 'Insertion de slider';

  	if(isset($_SESSION['username']))
  	{

	include 'includes/header.php';
	include 'includes/connect.php';
	include 'includes/navbar.php';

		if(isset($_POST['submit']))
  		{
  			$nom_image= $_FILES['image_produit']['name'];
			$img_tmp = $_FILES['image_produit']['tmp_name'];

				if(!empty($img_tmp) )
				{
					include 'functions/upload_image_resizing _slider.php';

					$sql = $connect->prepare("SELECT * FROM slider WHERE name_img_slider=?");
					$sql->execute(array($nom_image));

					$row = $sql->rowCount();
					if($row == 0)
					{

						$sql= $connect->prepare("INSERT INTO slider VALUES ('','$nom_image')");
						$sql->execute();

						$erreur = "Insertion reussite";

					}else
					{
						$erreur =  'Cette image avec ce nom existe deja';	
					}

				}else
				{
					$erreur =  'Veuillez remplir le fichier de l\'image';
				}

		}
	
?>


<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
	<div class="row">
		<div class="col-md-3 xs-hidden"></div>
		<div class="col-md-6 col-xs-12">
			<div class="panel panel-primary">
				<div class="panel panel-heading">
					<h3>Ajouter une image slider</h3>
				</div>
				<div class="panel panel-body">
					<div class="form-group"></div>
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
  include 'includes/footer.php';
}else
{
  header('location:../index.php');
}
?>