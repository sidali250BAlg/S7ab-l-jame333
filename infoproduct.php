<?php 
  session_start();
  $title= 'informations';
  include 'includes/header.php';
  include 'includes/connect.php';
  include 'includes/navbar.php';
  include 'functions/functions.php';
  
?>
<!DOCTYPE html>
 <html>
 <head>
    <title>Produit</title>
 </head>
 <body>
    <form action="" method="POST">
    <div class="col-md-3"></div>

    <div class="col-md-6 col-xs-12" style="margin:100px auto ">
    

    
        
         
 <?php  
    include 'includes/connect.php';
    $name = prot_inj($_GET['nomprod']);
    $show = $connect->prepare("SELECT * FROM produits WHERE name_produit=?");
    $show->execute(array($name));
    $results = $show->fetchAll();
    foreach ($results as $row) {  
 ?>
    <div style="padding-left: 35%"><img  class='img-responsive image1'  src='admin/uploads/<?php echo $row['nom_image']; ?>'></div><br>
    <table style="border-spacing: 10px;" class="table table-striped" >
        <tbody>
        <tr>
        <th>Nom:</th>
        <td style="width:70%"><?php echo $row['name_produit'] ?></td>
        </tr>
        <tr>
         <th>Categorie:</th>   
         <td><?php echo $row['categorie'] ?></td>
        </tr>
        <tr>
         <th>Sous_Categorie:</th>   
         <td><?php echo $row['sous_categorie'] ?></td>
         
        </tr>
        <tr>
         <th>Prix:</th>
         <td><?php echo $row['price_sell'] ?></td>      
        </tr>
        <tr >
        <th>Description:</th>
        <td><span><?php echo $row['description'] ?></span></td>
        </tr>
      
        </tbody>
        
        
    <?php  } ?>

 </table>
 <div align="right">
   <a href="?id=<?php echo $prod['id_produit']; ?>">
  <input type="submit" name="commander" value="Commander" class="btn btn-primary btn-sm">
</a>
 </div>
 </div>
     <div class="col-md-3"></div>

</form>
 </body>
 </html>

<?php

  include 'includes/footer.php';


?>


