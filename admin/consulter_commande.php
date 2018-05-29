<?php

	session_start();
	$title= 'Produits Tripole';
	include 'includes/header.php';
	include 'includes/connect.php';
	include 'includes/navbar.php';
	if(isset($_SESSION['username']))
	{
			if(isset($_GET['action']))
			{
				if(isset($_GET['action']) == "valider")
				{	
					header('location:commande_valider.php?id='.$_GET['id']);
				}
			}

			$sql = $connect->prepare("SELECT
										commands.id_command, 
										commands.username, 
										commands.produit, 
										commands.sous_categorie,
										commands.date,
										commands.payer,
										commands.livrer,
										produits.id_produit,
										produits.price_buy,
										produits.price_sell

									FROM commands 
									INNER JOIN produits
									ON commands.produit=produits.name_produit ORDER BY commands.id_command DESC");
			$sql->execute();

			$row = $sql->rowCount();
			$prods= $sql->fetchAll();
		if($row > 0)
		{
			echo "<div class='container'>";

		
			echo "<h1 align='center'>Liste des commandes</h1><br><br>";

			echo "<table class='table table-striped'";
				echo "<thead>";
				echo "<tr>";
				echo "<th>id commande</th>";
				echo "<th>date</th>";
				echo "<th>Username</th>";
				echo "<th>Produit</th>";
				echo "<th>Sous_categorie</th>";
				echo "<th>Prix d'Achat</th>";
				echo "<th>Prix de Vente</th>";
				echo "<th>Action</th>";
				
				echo "</tr>";
				echo "</thead>";

			foreach ($prods as $prod) {
				?>
				<tbody>
				<tr>
				<td><?php echo $prod['id_command'] ?></td>	
				<td><?php echo $prod['date'] ?></td>
				<td><?php echo $prod['username'] ?></td>
				<td><?php echo $prod['produit'] ?></td>
				<td><?php echo $prod['sous_categorie'] ?></td>
				<td><?php echo $prod['price_buy'] ?></td>
				<td><?php echo $prod['price_sell'] ?></td>
				<?php
				if ($prod['payer'] == 0) 
				{?>
							<td>
							<div class="btn btn-primary" name="payer">
								<a href="commande_valider.php?idv=<?php echo $prod['id_command']; ?>" style='text-decoration:none; color:#fff'>payé</a>
							</div>
							<div class="btn btn-success" name="livrer">
								<a href="commande_valider.php?idl=<?php echo $prod['id_command']; ?>" style='text-decoration:none; color:#fff'>livré</a>
							</div>
							<div class='btn btn-danger' name='supprimer'>
								<a href="commande_valider.php?ids=<?php echo $prod['id_command']; ?>" style='text-decoration:none; color:#fff'>supprimer</a>
							</div>
							
						</td>
				<?php
				}else if ($prod['livrer'] == 0)
				{
					echo "<td>
							<div class='btn btn-success' name='livrer'><a href='commande_valider.php?idl=".$prod['id_command']."' style='text-decoration:none; color:#fff'>livré</a></div>
							<div class='btn btn-danger' name='supprimer'><a href='commande_valider.php?ids=".$prod['id_command']."' style='text-decoration:none; color:#fff'>supprimer</a></div>
						</td>";
				}else{
					echo "<td>
							produit payé et livré
						</td>";
					}
				?>
				</tr>
				</tbody>
				<?php
			}
			echo "</table>";
			echo "</div>";

				
			}else{
				echo 'Tableau des cammandes est vides.'.'<br><br>';
				
			}


		
			include 'includes/footer.php';

		}else
		{
			header('location:../index.php');
		}
?>

