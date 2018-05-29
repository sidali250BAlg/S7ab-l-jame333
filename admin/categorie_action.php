<?php
	session_start();
	$title= 'Tripole consulter users';
	if(isset($_SESSION['username']))
	{
		include 'includes/header.php';
		include 'includes/connect.php';
		include 'includes/navbar.php';

		$id_cat = $_GET['id'];
		echo $id_cat;
		$sql = $connect->prepare("SELECT * FROM categories WHERE id_categorie=?");
		$sql->execute(array($id_cat));

		$row = $sql->rowCount();
		if($row > 0)
		{
			$cat = $sql->fetch();
		}
?>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
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
								<input type="text" name="new_name_cat" class="form-control" value="<?php echo $cat['name_categorie']; ?>">
						</div>
						<div class="panel panel-footer" align="right">
							<input type="submit" name="submit" value="editer" class="btn btn-primary">
						</div>
					</div>
				</div>
			</div>
		</form>

		<?php
			if(isset($_POST['submit']))
			{
				$new_name_cat = htmlspecialchars($_POST['new_name_cat']);
				$sql=$connect->prepare("UPDATE categories SET name_categorie=?");
				$sql->execute(array($new_name_cat));
			}

		include 'includes/footer.php';
	
	}else
	{
		header('location:../index.php');
	}

?>
	
