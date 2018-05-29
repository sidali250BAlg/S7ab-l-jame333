<?php 	
	$title = 'Enregistrer';
	include 'includes/header.php';
	include 'includes/connect.php';

	if(isset($_POST['submit']))
	{
		$username	= htmlspecialchars($_POST['username']);
		$email 		= htmlspecialchars($_POST['email']);
		$repeat_email = htmlspecialchars($_POST['repeat_email']);
		$telephone = htmlspecialchars($_POST['telephone']);
		$pass 		= htmlspecialchars($_POST['pass']);
		$repeat_pass = htmlspecialchars($_POST['repeat_pass']);
		if($username && $email && $repeat_email && $telephone && $pass && $repeat_pass)
		{
			if($email === $repeat_email)
			{
				if($pass === $repeat_pass)
				{
					$sql = $connect->prepare('SELECT * FROM users WHERE username=? AND email=?');
					$sql->execute(array($username , $email));
					$row= $sql->rowCount();

					if($row == 0)
					{
						$db = $connect->prepare("INSERT INTO users(username, email,telephone, password) VALUES ('$username','$email','$telephone' ,'$pass')");
						$db->execute();
						header('location:login.php');
					}else
					{
						echo "username ou email exist deja";
					}
				}else
				{
					echo "password n'est pas confirmee";
				}
			}else
			{
				echo "email n'est pas confirmee";
			}
		}else{
			echo "Veuillez remplir tout les champs";
		}

	}



?>





<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
	<div class="col-md-3 hidden-xs"></div>
	<div class="col-md-6 ">
		<div class="panel panel-primary">
			<div class="panel panel-heading">
				<h3>Signup</h3>
			</div>
			<div class="panel panel-body">
				<div class="form-group">
					<label>Username</label>
					<input type="text" name="username" class="form-control">
					<label>email</label>
					<input type="email" name="email" class="form-control">
					<label>Confirmer email</label>
					<input type="email" name="repeat_email" class="form-control">
					<label>Telephone</label>
					<input type="text" name="telephone" class="form-control">
					<label>Mot de passe</label>
					<input type="password" name="pass" class="form-control">
					<label>Confirmer mot de passe</label>
					<input type="password" name="repeat_pass" class="form-control">
				</div>
			</div>
			<div class="panel panel-footer" align="right">
				<input type="submit" class="btn btn-primary" name="submit" value="Enregistrer">
			</div>
		</div>	
</form>



















