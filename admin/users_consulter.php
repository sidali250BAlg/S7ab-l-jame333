<?php

	session_start();
	$title= 'Tripole consulter users';
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
			echo'<input class="form-control" id="myInput" type="text" placeholder="Search..">'.'<br>';
			echo "<table class='table table-striped'";
				echo "<thead>";
				echo "<tr>";
				echo "<th>username</th>";
				echo "<th>email</th>";
				echo "<th>telephone</th>";
				echo "<th>action</th>";
				echo "</tr>";
				echo "</thead>";
				echo '<body id="myTable">';

			foreach ($users as $user) {
				echo "<tr>";
				echo "<td>".$user['username']."</td>";
				echo "<td>".$user['email']."</td>";
				echo "<td>".$user['telephone']."</td>";
				if ($user['validation'] == 0) {
					echo "<td>
							<div class='btn btn-success' name='valider'><a href='users_action.php?id=".$user['id_user']."' style='text-decoration:none; color:#fff'>valider</a></div>
							<div class='btn btn-danger' name='supprimer'><a href='users_action.php?ids=".$user['id_user']."' style='text-decoration:none; color:#fff'>supprimer</a></div>
					</td>";
				}else{
				echo "<td>
							<div class='btn btn-danger' name='supprimer'><a href='users_action.php?ids=".$user['id_user']."' style='text-decoration:none; color:#fff'>supprimer</a></div>
					</td>";
					}
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
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>