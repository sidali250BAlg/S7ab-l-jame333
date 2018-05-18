<?php

	session_start();
	$title= 'Tripole consulter categorie';
	include 'includes/header.php';
	include 'includes/connect.php';
	include 'includes/navbar.php';


		if(isset($_SESSION['username']))
		{
			if(isset($_GET['action']))
			{
				if(isset($_GET['action']) == "edit")
				{	
					header('location:categorie_modifier.php?id='.$_GET['id']);
				}
			}

			$sql = $connect->prepare("SELECT * FROM categories");
			$sql->execute();

			$row = $sql->rowCount();
			$cats= $sql->fetchAll();
		if($row > 0)
		{
			echo "<div class='container'>";

			echo "<a href='categorie_ajouter.php'><input type='button' class='btn btn-primary' value='Ajouter nouvelle categorie'><br><br></a>";


			echo "<table class='table table-striped'";
				echo "<thead>";
				echo "<tr>";
				echo "<th>Nom categorie</th>";
				echo "<th>action</th>";
				echo "</tr>";
				echo "</thead>";

			foreach ($cats as $cat) {
				?>
				<tbody>
				<tr>
				<td><?php echo $cat['name_categorie'] ?></td>
				<form action=''  method='GET'>
				<td>
					<div class='btn btn-success' name='editer'>
						<a href='?action=editer&&id=<?php echo $cat['id_categorie']; ?>' style='text-decoration:none; color:#fff'>
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
				echo 'Tableau des categories est vides.'.'<br><br>';
				echo "<a href='categorie_ajouter.php'><input type='button' class='btn btn-primary' value='Ajouter nouvelle categorie'><br><br></a>";
			}


		
			include 'includes/footer.php';

		}else
		{
			header('location:../index.php');
		}
?>

