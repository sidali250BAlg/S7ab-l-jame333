<?php

$servername = "185.98.131.90";
    $username = "tripo982530_1we7w";
    $password = "ljs7c0audr";

    try {
    $connect = new PDO("mysql:host=$servername;dbname=tripo982530_1we7w", $username, $password);
 
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully"; 
      }
    catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
if (isset($_POST['show'])) {
$i = false;
$code = $_POST['code_produit'];
$sql = $connect->prepare('SELECT * FROM product WHERE code_product=?');
$sql->execute(array($code));
$count = $sql->rowCount();
$results = $sql->fetchAll(PDO::FETCH_ASSOC);
//print_r($results);
if ($count == 1) {
$id = $results[0]['id_product'];
$cod = $results[0]['code_product'];
$name = $results[0]['name_product'];
$amount = $results[0]['qte_product'];
$pa = $results[0]['price_buy_product'];
$pv = $results[0]['price_sell_product'];	
}else{
	header("location: update2.php");	
}
}
if (isset($_POST['update'])) {
$i = true;
$code = $_POST['code_produit'];
$sql = $connect->prepare('SELECT * FROM product WHERE code_product=?');
$sql->execute(array($code));
$results = $sql->fetchAll(PDO::FETCH_ASSOC);
//print_r($results);
$id = $results[0]['id_product'];	
$code1 = $_POST['code_produit'];
$name1 = $_POST['name_product'];
$amount1 = $_POST['amount_product'];
$pa1 = $_POST['price_buy_p'];
$pv1 = $_POST['price_sell_p'];
$sql1 = "UPDATE product SET code_product='$code1', name_product='$name1', qte_product='$amount1', price_buy_product='$pa1', price_sell_product='$pv1' WHERE id_product=$id";
$stmt = $connect->prepare($sql1);
$stmt->execute();
header('location: dashboard.php');
}
if (isset($_POST['delete'])) {
	$i = true;
	$code2 = $_POST['code_produit'];
	$sql2 = "DELETE FROM product WHERE code_product=$code2";
	$connect->exec($sql2);
	echo "product deleted";  
}

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
		<form  method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
		<center><div style="margin-top: 10%; border-radius: 20px; border: solid; width: 50%; padding-bottom: 20px;">
		<h1 style="text-align: center;">Stock</h1>
		<label>Code produit :</label>
		<input type="text" name="code_produit" value="<?php if($i==false){echo($cod);}  ?>"><br><br>

		<label>nom : </label>
		<input type="text" name="name_product" value="<?php if($i==false){echo($name);} ?>"><br><br>

		<label>Quantite : </label>
		<input type="text" name="amount_product" value="<?php if($i==false){echo($amount);} ?>"><br><br>

		<label>Prix achat : </label>
		<input type="text" name="price_buy_p" value="<?php if($i==false){echo($pa);} ?>"><br><br>

		<label>Prix vante : </label>
		<input type="text" name="price_sell_p" value="<?php if($i==false){echo($pv);} ?>"><br><br>

		<a href="dashboard.php">Back   </a>
		<input type="submit" name="update" value="modifier le produit">
		<input type="submit" name="delete" value="supprimer le produit">

		</div></center>





	

	</form>

</body>
</html>
