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
					header('location:sous_categorie_modifier.php?id='.$_GET['id']);
				}
			}

			$sql = $connect->prepare("SELECT * FROM categories");
			$sql->execute();
			$sql1 = $connect->prepare("SELECT * FROM sous_categories");
			$sql1->execute();

			$row = $sql->rowCount();
			$row1 = $sql1->rowCount();
			$cats= $sql->fetchAll();
			$cats1= $sql1->fetchAll();
		if($row > 0 and $row1 > 0)
		{
			echo "<div class='container'>";

			echo "<a href='sous_categorie.php'><input type='button' class='btn btn-primary' value='Ajouter nouvelle sous categorie'><br><br></a>";


			echo "<table class='table table-striped'";
				echo "<thead>";
				echo "<tr>";
				echo "<th>Nom categorie</th>";
				echo "<th>Nom sous_categorie</th>";
				echo "<th>action</th>";
				echo "</tr>";
				echo "</thead>";

			foreach ($cats as $cat) {
				foreach ($cats1 as $cat1) {
					if ($cat1['name_cat'] == $cat['name_categorie']) {
				?>
				<tbody>
				<tr>
				<td><?php echo $cat['name_categorie'] ?></td>
				<td><?php echo $cat1['name_sous_cat'] ?></td>
				<form action=''  method='GET'>
				<td>
					<div class='btn btn-success' name='editer'>
						<a href='?action=editer&&id=<?php echo $cat1['id_sous_cat']; ?>' style='text-decoration:none; color:#fff'>
								editer ou supprimer
						</a>
					</div>
					</td>
				</form>
				</tr>
				</tbody>
				<?php
			}
			}
			}
			echo "</table>";
			echo "</div>";

				
			}else{
				echo 'Tableau des categories est vides.'.'<br><br>';
				echo "<a href='sous_categorie.php'><input type='button' class='btn btn-primary' value='Ajouter nouvelle sous categorie'><br><br></a>";
			}


		
			include 'includes/footer.php';

		}else
		{
			header('location:../index.php');
		}
?>
