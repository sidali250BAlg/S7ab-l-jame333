<!DOCTYPE html>
 <html>
 <head>
  <title></title>
 </head>
 <body>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
  <label>recherche dans la date :</label>
  <input type="date" name="date1">
  <input type="date" name="date2">
  <input type="submit" name="search" value="recherche">
  <a href="dashboard.php">Back   </a><br><br>
  </form>
 </body>
 </html>

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
if (isset($_POST['search'])) {
    $date1 = $_POST['date1'];
    $date2 = $_POST['date2'];
    $sql1 = $connect->prepare('SELECT * FROM BV WHERE date=?');
    $sql1->execute(array($date1));
    $results1 = $sql1->fetchAll(PDO::FETCH_ASSOC);
    $first_id = $results1[0]['id'];
    $first_id = $first_id - 1;
    //echo $first_id;
    $sql2 = $connect->prepare('SELECT * FROM BV WHERE date=?');
    $sql2->execute(array($date2));
    $results2 = $sql2->fetchAll(PDO::FETCH_ASSOC);
    $last = end($results2);
    $last_id = $last['id'];
    $deference = $last_id - $first_id;
    $sql3 = $connect->prepare("SELECT * FROM BV LIMIT $first_id, $deference");
    $sql3->execute();
    $results3 = $sql3->fetchAll(PDO::FETCH_ASSOC);
    //print_r($results3);

    //print_r($results1);
    //echo array_search($date1, $results1);
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
   foreach( $results3 as $row ){
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

   }


  ?>