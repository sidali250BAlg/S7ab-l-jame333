<?php
include 'includes/connect.php';


if(isset($_GET['id'])){
	$id = $_GET['id'];
	$sql = $connect->prepare("UPDATE users SET validation = 1 WHERE id_user=?");
	$sql->execute(array($id));
	header('location: users_consulter.php');

}

if (isset($_GET['ids'])) {
	$id = $_GET['ids'];
	$sql =$connect->prepare("DELETE FROM users WHERE id_user=?");
	$sql->execute(array($id));
	header('location: users_consulter.php');
}

?>