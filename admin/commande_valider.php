<?php
include 'includes/connect.php';


if(isset($_GET['idv'])){
	$id = $_GET['idv'];
	$sql = $connect->prepare("UPDATE commands SET payer = 1 WHERE id_command=?");
	$sql->execute(array($id));
	header('location: consulter_commande.php');

}

if(isset($_GET['idl'])){
	$id = $_GET['idl'];
	$sql = $connect->prepare("UPDATE commands SET livrer = 1 WHERE id_command=?");
	$sql->execute(array($id));
	header('location: consulter_commande.php');

}

if (isset($_GET['ids'])) {
	$id = $_GET['ids'];
	$sql =$connect->prepare("DELETE FROM commands WHERE id_command=?");
	$sql->execute(array($id));
	header('location: consulter_commande.php');
}

?>