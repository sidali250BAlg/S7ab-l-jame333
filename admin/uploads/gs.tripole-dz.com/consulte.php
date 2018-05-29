<?php 
session_start();
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
$sql = $connect->prepare('SELECT * FROM product');
$sql->execute();
$results = $sql->fetchAll(PDO::FETCH_ASSOC);
$s = 0; 
       

?>
<style type="text/css">
	th,td{
		width: 160px;
	}
	.id1{
		text-align: center;
		width: 90px;
	}
	.id2{
		text-align: right;
	}
	.id3{
		width: 250px;
		text-align: left
	}
	tr{
		border-bottom:solid 0.5px #ccc 
	}

</style>
<h2 align="center">Tableau d'inventaire</h2>
<table align="center" style="border: solid;">
   <tr>
     <th>ID</th>
     <th class='id3'>Code produit</th>
     <th class='id3'>Nom produit</th>
     <th>Quantite</th>
     <th class='id2'>Prix achat</th>
     <th class='id2'>Prix vente</th>
   </tr>
   <?php foreach( $results as $row ){
   echo "<tr><td class='id1'>";
     echo $row['id_product'];
     echo "</td><td class='id3'>";
     echo $row['code_product'];
     echo "</td><td class='id3'>";
     echo $row['name_product'];
     echo "</td><td class='id1'>";
     echo $row['qte_product'];
     echo "</td><td class='id2'>";
     echo $row['price_buy_product'];
     $s = $s + ($row['price_buy_product'] * $row['qte_product']);
     echo "</td><td class='id2'>";
     echo $row['price_sell_product'];
     echo "</td>";
   echo "</tr>";

   }
 ?>
 </table>
 <center><?php echo "chiffre d'affaire total est : ".$s.' DA'; ?></center>
		