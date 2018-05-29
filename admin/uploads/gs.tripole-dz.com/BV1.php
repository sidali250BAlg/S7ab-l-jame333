<?php
    $i = true;
    $servername = "185.98.131.90";
    $username = "tripo982530_1we7w";
    $password = "ljs7c0audr";

    try 
    {
         $connect = new PDO("mysql:host=$servername;dbname=tripo982530_1we7w", $username, $password);
 
         $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     
    }
    catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
if (isset($_POST['show'])) {
$i = false;
$code = $_POST['code_product'];
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
}else{$i = true; $error = 'Sorry! product not found!'; echo $error;}
}
if (isset($_POST['show1'])) {
$code = $_POST['code_produit'];
$qt1 = $_POST['amount'];
$pv1 = $_POST['pv'];
$sql = $connect->prepare('SELECT * FROM product WHERE code_product=?');
$sql->execute(array($code));
$count = $sql->rowCount();
$results = $sql->fetchAll(PDO::FETCH_ASSOC);
if ($count == 1) {
$id = $results[0]['id_product'];
$cod = $results[0]['code_product'];
$name = $results[0]['name_product'];
$amount = $results[0]['qte_product'];
$pa = $results[0]['price_buy_product'];
$reste = (int)$amount - (int)$qt1;
$sql1 = "UPDATE product SET qte_product='$reste' WHERE id_product=$id";
$stmt = $connect->prepare($sql1);
$stmt->execute();
$p1 = (int)$qt1 * (int)$pv1;
$date = date("Y/m/d");
$sql2 = "INSERT INTO BV VALUES ('', '$id', '$cod', '$name', '$qt1', '$pv1', '$p1', '$date' )";
$sql3 = "INSERT INTO BVH VALUES ('', '$cod', '$name', '$qt1', '$pv1', '$p1', '$date' )";
$connect->exec($sql2);
$connect->exec($sql3);
}	
}
if (isset($_POST['submit'])) {
	header("location: BV2.php");
	
	
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
		<h1 style="text-align: center;">BON DE LIVRAISON</h1><br><h3 style="text-align: left;">Entrer le code de produit et cliquer sur afficher :</h3>
		<label>Code produit :</label>
		<input type="text" name="code_product"><br><br>

		
		<a href="dashboard.php">Back   </a>
		
		<input type="submit" name="show" value="afficher">

		</div></center>


		<table align="center" style="margin-top: 100px;">
			<tr>
				<th>ID</th>
				<th>Code produit</th>
				<th>Nom</th>
				<th>Quantite</th>
				<th>Prix de vente</th>
				<th>chiffre d'affaire </th>
			</tr>
			<tr>
			<td><label><?php if($i==false){echo($id);} ?></label></td>
			<td><input type="text" name="code_produit" value="<?php if($i==false){echo($cod);} ?>"></td>
			<td><input type="text" name="name" value="<?php if($i==false){echo($name);} ?>"></td>
			<td><input type="text" name="amount" value="<?php if($i==false){echo($amount);} ?>"></td>
			<td><input type="text" name="pv" value="<?php if($i==false){echo($pv);} ?>"></td>
			<td><?php  if($i==false){$p = (int)$amount * (int)$pv; echo $p;}?></td>
			<td><input type="submit" name="show1" value="Ajouter"></td>
			<td><input type="submit" name="submit" value="valider"></td>
			</tr>

	</form>

</body>
</html>