 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 </head>
 <body>
 	<form method="POST" action="histo.php">
 	<label>recherche dans la date :</label>
 	<input type="date" name="date1">
 	<input type="date" name="date2">
 	<input type="submit" name="search" value="recherche">
 	<a href="dashboard.php">Back   </a><br><br>
 	</form>
 </body>
 </html>


 <?php 
    //$NBV = $NBV + 1;
	$servername = "185.98.131.90";
    $username = "tripo982530_1we7w";
    $password = "ljs7c0audr";

    try {
    $connect = new PDO("mysql:host=$servername;dbname=tripo982530_1we7w", $username, $password);
 
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
    catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
	//$N = 0;
	$sql = $connect->prepare('SELECT * FROM BVH');
	$sql->execute();
	$results = $sql->fetchAll();
	//print_r($results);
	echo '<h1 align="center">Historique</h1>';
	echo '<table align="center" style="border: solid;">
   <tr>
     <th>ID</th>
     <th>Code produit</th>
     <th>Nom produit</th>
     <th>Quantite</th>
     <th>Prix vente</th>
     <th>chiffre daffaire</th>
     <th>Date</th>
   </tr>';
   foreach( $results as $row ){
   echo "<tr><td>";
     //$N = $N + 1; echo $N;
     //echo "</td><td>";
     echo $row['id'];
     echo "</td><td>";
     echo $row['code'];
     echo "</td><td>";
     echo $row['name'];
     echo "</td><td>";
     echo $row['amount'];
     //$s = $s + ($row['price_buy_product'] * $row['qte_product']);
     echo "</td><td>";
     echo $row['price_sell'];
     echo "</td><td>";
     echo $row['CA'];
     echo "</td><td>";
     echo $row['date'];
     echo "</td>";
   echo "</tr>";
   }
   echo "</table>";



   
 ?>