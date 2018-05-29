<?php

	session_start();
	$title= 'categorie';
	include 'includes/header.php';
	include 'includes/connect.php';
	include 'includes/navbar.php';

		$sql = $connect->prepare("SELECT * FROM users WHERE rank != 1");
		$sql->execute();

		$row = $sql->rowCount();
		$users= $sql->fetchAll();
		if($row > 0)
		{

			echo "<div class='container'>";
			echo "<table class='table table-striped'";

			foreach ($users as $user) {
				echo "<thead>";
				echo "<tr>";
				echo "<th>username</th>";
				echo "<th>email</th>";
				echo "<th>telephone</th>";
				echo "<th>action</th>";
				echo "</tr>";
				echo "</thead>";
				echo "<body>";
				echo "<tr>";
				echo "<td>".$user['username']."</td>";
				echo "<td>".$user['email']."</td>";
				echo "<td>".$user['telephone']."</td>";
				echo "<td>
							<div class='btn btn-success' name='valider'>valider</div>
							<div class='btn btn-danger' name='supprimer'>supprimer</div>
					</td>";
				echo "</tr>";
				echo "</body>";
			}
			echo "</table>";
			echo "</div>";
				
		}else{
			echo 'Tableau des utilisteurs est vides, pas de nouveaux abonnees';
		}

		
	include 'includes/footer.php';
?>