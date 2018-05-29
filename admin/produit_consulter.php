<?php

	session_start();
	$title= 'Tripole consulter produit';
	include 'includes/header.php';
	include 'includes/connect.php';
	include 'includes/navbar.php';


		if(isset($_SESSION['username']))
		{
			if(isset($_GET['action']))
			{
				if(isset($_GET['action']) == "edit")
				{	
					header('location:produit_modifier.php?id='.$_GET['id']);
				}
			}

			$sql = $connect->prepare("SELECT * FROM produits");
			$sql->execute();

			$row = $sql->rowCount();
			$prods= $sql->fetchAll();
		if($row > 0)
		{
			echo "<div class='container'>";

			echo "<a href='ajout_produit.php'><input type='button' class='btn btn-primary' value='Ajouter nouveau produit'><br><br></a>";


			echo "<table class='table table-striped'";
				echo "<thead>";
				echo "<tr>";
				echo "<th>Nom produit</th>";
				echo "<th>Categorie</th>";
				echo "<th>Sous_categorie</th>";
				echo "<th>Prix d'Achat</th>";
				echo "<th>Prix de Vente</th>";
				echo "<th>Description</th>";
				
				echo "</tr>";
				echo "</thead>";

			foreach ($prods as $prod) {
				?>
				<tbody>
				<tr>
				<td><?php echo $prod['name_produit'] ?></td>
				<td><?php echo $prod['categorie'] ?></td>
				<td><?php echo $prod['sous_categorie'] ?></td>
				<td><?php echo $prod['price_buy'] ?></td>
				<td><?php echo $prod['price_sell'] ?></td>
				<td><?php echo $prod['description'] ?></td>
				
				<form action=''  method='GET'>
				<td>
					<div class='btn btn-success' name='editer'>
						<a href='?action=editer&&id=<?php echo $prod['id_produit']; ?>' style='text-decoration:none; color:#fff'>
								editer ou supprimer
						</a>
					</div>
					</td>
				</form>
				</tr>
				</tbody>
				<?php
			}
			echo "</table>";
			echo "</div>";

				
			}else{
				echo 'Tableau des produits est vides.'.'<br><br>';
				echo "<a href='ajout_produit.php'><input type='button' class='btn btn-primary' value='Ajouter nouveau produit'><br><br></a>";
			}


		
			include 'includes/footer.php';

		}else
		{
			header('location:../index.php');
		}
?>

