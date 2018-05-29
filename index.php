<?php
	session_start();
	$title = 'Home';
	include ('includes/header.php');
	include ('includes/connect.php');
	include ('includes/navbar.php');

	$sql= $connect->prepare("SELECT * FROM slider");
	$sql->execute();

	$row= $sql->rowCount();
	
	if($row > 0)
	{	
		if($row < 8)
		{
		$imgs = $sql->fetchAll();
		$i = 1;
		foreach ($imgs as $img) {

			$image[$i] = $img['name_img_slider'];
			$i += 1;
		}
		?>

		<style type="text/css">
			body
			{
				
				background-image:url('images.jpg') ;
			}
		</style>

		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-7">
				<div id="myCarousel" class="carousel slide" data-ride="carousel">
				  <!-- Indicators -->
				  <ol class="carousel-indicators">
				    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				    <li data-target="#myCarousel" data-slide-to="1"></li>
				    <li data-target="#myCarousel" data-slide-to="2"></li>
				    <li data-target="#myCarousel" data-slide-to="3"></li>
				    <li data-target="#myCarousel" data-slide-to="4"></li>
				    <li data-target="#myCarousel" data-slide-to="5"></li>
				    <li data-target="#myCarousel" data-slide-to="6"></li>
				  </ol>

				  <!-- Wrapper for slides -->
				  <div class="carousel-inner">
				  	
				    <div class="item active">
				      <img src="admin/uploads/slider/<?php echo $image[1]; ?>">
				    </div>

				    <div class="item">
				      <img src="admin/uploads/slider/<?php echo $image[2]; ?>">
				    </div>

				    <div class="item">
				      <img src="admin/uploads/slider/<?php echo $image[3]; ?>">
				    </div>
				    <div class="item">
				      <img src="admin/uploads/slider/<?php echo $image[4]; ?>">
				    </div>
				    <div class="item">
				      <img src="admin/uploads/slider/<?php echo $image[5]; ?>">
				    </div>
				    <div class="item">
				      <img src="admin/uploads/slider/<?php echo $image[6]; ?>">
				    </div>
				    <div class="item">
				      <img src="admin/uploads/slider/<?php echo $image[7]; ?>">
				    </div>
				  </div>
				    

				  <!-- Left and right controls -->
				  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
				    <span class="glyphicon glyphicon-chevron-left"></span>
				    <span class="sr-only">Previous</span>
				  </a>
				  <a class="right carousel-control" href="#myCarousel" data-slide="next">
				    <span class="glyphicon glyphicon-chevron-right"></span>
				    <span class="sr-only">Next</span>
				  </a>
				</div>
			</div>
		</div>
		<?php
		}else
		{
			?>
				<div class="container">
					<div class="alert alert-warning">
						votre slider doit avoir 7 images, Veuillez choisir quelques images et supprimer les autre dans la page de consulter/slider
					</div>
				</div>
			<?php	
		}
	}

	?>
	
	
	<div class="col-md-3">
		<?php
		include 'includes/aside.php';
		?>
	</div>
	<div class="col-md-9">
		
	<?php

	$sql = $connect->prepare("SELECT DISTINCT(nom_panneau) FROM panneau_index");
	$sql->execute();

	$row = $sql->rowCount();
	$pans= $sql->fetchAll();
	if($row > 0)
	{	
		foreach($pans as $pan)
		{
		?>
				<div style="border:solid 0.5px #ccc; border-radius: 10px; margin:20px; padding: 20px; box-shadow: 5px 10px 8px  #888; background-color: #eaeaf9 ">
					<div style="border:solid 0.5px #ccc; border-radius: 10px; margin:10px; padding: 10px; background-color: #eae6f9 ">
						<h2 align="center" style="color: blue; font-family: 'Merriweather', serif;">

							<?php echo $pan['nom_panneau']; ?>
						</h2>
					</div>				
					<div class="row">
					<?php
						$sql = $connect->prepare("SELECT panneau_index.name_produit, panneau_index.nom_image, produits.price_sell FROM panneau_index INNER JOIN produits ON panneau_index.name_produit = produits.name_produit WHERE nom_panneau=?");
						$sql->execute(array($pan['nom_panneau']));

						$prods = $sql->fetchAll();

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
											<input type="submit" name="learn_more" value="learn_more" class="btn btn-primary btn-xs">
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
		}
	
	}else{
		echo "<div style='height:200px'>
			<h1 align='center'>La page d'acceuil est en conception</h1>
		</div>";
	}

	?>
	</div>
	<?php
	
	include 'includes/footer.php';

?>