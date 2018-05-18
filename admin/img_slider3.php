<?php
  session_start();
  $title= 'Ajouter logo';
  
  if(isset($_SESSION['username']))
  {
    include 'includes/header.php';
    include 'includes/connect.php';
    include 'includes/navbar.php';


  
  if(isset($_POST['submit']))
  {
    $nom_produit = htmlentities($_POST['nom_produit']);
    $nom_image = htmlentities($_POST['nom_image']);


    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image_produit"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    
    // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["image_produit"]["tmp_name"]);
        if($check !== false) {
            echo "Le fichier est une image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "Votre fichier n'est pas un fichier image.";
            $uploadOk = 0;
        }
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Desolé, votre fichier existe deja.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["image_produit"]["size"] > 3000000) {
        echo "Desolé, la taille du fichier est tres grande.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Desolé, seulement JPG, JPEG, PNG & GIF files sont acceptes.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Desolé, votre fichier n'a pas pu etre telechargé.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["image_produit"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["image_produit"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }





    $sql = $connect->prepare("SELECT * FROM produits WHERE name_produit='img_slider3'");
    $sql->execute(array($nom_produit));

    $row = $sql->rowCount();
    if($row == 0)
    {
      $sql= $connect->prepare("INSERT INTO produits(name_produit,nom_image) VALUES ('$nom_produit','$nom_image')");
      $sql->execute();
    }else
    {
      $erreur =  'Cette image existe deja, veuillez supprimer image slider1 ensuite ajouter la nouvelle image';  
    }
  }
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
  <div class="row">
    <div class="col-md-3 xs-hidden"></div>
    <div class="col-md-6 col-xs-12">
      <div class="panel panel-primary">
        <div class="panel panel-heading">
          <h3>Ajouter image Slider</h3>
        </div>
        <div class="panel panel-body">
          <div class="form-group"></div>
            <input type="hidden" name="nom_produit" value="img_slider3" class="form-control">
            
            <label>Le nom de l'image:</label>
            <input type="text" name="nom_image" class="form-control">
            <label>Importer l'image:</label>
            <input type="file" name="image_produit" id="image_produit">
        </div>
        <div class="panel panel-footer" align="right">
          <input type="submit" name="submit" value="Ajouter" class="btn btn-primary">
        </div>
      </div>
    </div>
  </div>

</form>

<?php 
  if(!empty($erreur))
  {
    echo "<div class='container'>";
    echo "<div class='alert alert-info'>". $erreur ."</div>";
    echo "</div>";
  }
 ?>


<?php
  include 'includes/footer.php';
}else
{
  header('location:../index.php');
}
?>