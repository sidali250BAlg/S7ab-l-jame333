<?php

	session_start();
	$title = 'Login';
	include 'includes/header.php';
	include 'includes/connect.php';
	include 'functions/functions.php';

if(isset($_POST['submit']))
	{
		$username=htmlspecialchars($_POST['username']);
		$pass=htmlspecialchars($_POST['pass']);
		if($username && $pass)
		{
			$sql=$connect->prepare('SELECT * FROM users WHERE username=? AND password=?');
			$sql->execute(array($username,$pass));
			$row=$sql->rowCount();
			if($row > 0)
			{
				$data = $sql->fetch();
				if($data['rank'] == 1 )
				{	
					header('location:admin/index.php');
					$_SESSION['username']=$username;
				}else
				{
					if($data['validation'] == 1)
					{
						
						$_SESSION['username']=$username;
						crationPanier();
						header('location:index.php');

					}else
					{
						header('location:login.php');
					}
				}
			}
		}
	}
?>


<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
	<div class="col-md-3 hidden-xs"></div>
	<div class="col-md-6 ">
		<div class="panel panel-primary">
			<div class="panel panel-heading">
				<h3>Login</h3>
			</div>
			<div class="panel panel-body">
				<div class="form-group">
					<label>Username</label>
					<input type="text" name="username" class="form-control">
					<label>Password</label>
					<input type="password" name="pass" class="form-control">
				</div>
			</div>
			<div class="panel panel-footer" align="right">
				<input type="submit" class="btn btn-primary" name="submit" value="Login">
			</div>
		</div>	
</form>



<?php
	include 'includes/footer.php';
?>