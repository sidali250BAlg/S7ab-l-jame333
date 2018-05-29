<?php
	session_start();
	$title = 'Home';
	include ('includes/header.php');
	include ('includes/connect.php');
	include ('includes/navbar.php');

	if(isset($_SESSION['username']))
		{
			if(isset($_GET['action']))
			{
				if(isset($_GET['action']) == "edit")
				{	
					header('location:slider_modifier.php?id='.$_GET['id']);
				}
			}

			$sql = $connect->prepare("SELECT * FROM slider");
			$sql->execute();

			$row = $sql->rowCount();
			$prods= $sql->fetchAll();
		if($row > 0)
		{
			echo "<div class='container'>";

			echo "<a href='slider.php'><input type='button' class='btn btn-primary' value='Ajouter nouvelle image slider'><br><br></a>";


			echo "<table class='table table-striped'";
				echo "<thead>";
				echo "<tr>";
				echo "<th>Nom image slider</th>";
				
				echo "</tr>";
				echo "</thead>";

			foreach ($prods as $prod) {
				?>
				<tbody>
				<tr>
				<td><?php echo $prod['name_img_slider'] ?></td>
				
				<form action=''  method='GET'>
				<td>
					<div class='btn btn-success' name='editer'>
						<a href='?action=editer&&id=<?php echo $prod['id_slider']; ?>' style='text-decoration:none; color:#fff'>
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
				echo 'Tableau des images slider est vides.'.'<br><br>';
				echo "<a href='slider.php'><input type='button' class='btn btn-primary' value='Ajouter nouvelle image slider'><br><br></a>";
			}


		
			include 'includes/footer.php';

		}else
		{
			header('location:../index.php');
		}
?>

