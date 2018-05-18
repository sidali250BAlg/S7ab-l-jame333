
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Tripole</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php">Home</a></li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Consulter
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="categorie_consulter.php">Categories</a></li>
          <li><a href="sous_categorie_consulter.php">Sous categories</a></li>
          <li><a href="ajout_produit.php">Produits</a></li>
        	<li><a href="users_consulter.php">Users</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Inserer
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="logo.php">Logo</a></li>
          <li><a href="img_header.php">Image Header</a></li>
          <li><a href="panneau_index.php">panneau index</a></li>
          <li><a href="#">Menu secondaire</a></li>
          <li><a href="#">Page de contact</a></li>
          <li><a href="#">footer</a></li>
          
        </ul>
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Slider
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="img_slider1.php">Inserer image 1</a></li>
          <li><a href="img_slider2.php">Inserer image 2</a></li>
          <li><a href="img_slider3.php">Inserer image 3</a></li>
        </ul>
      </li>

      
    </ul>

<?php
      if(!empty($_SESSION['username']))
      {
        echo '<ul class="nav navbar-nav navbar-right">';
            echo "<li class='dropdown'><a href='#' class='dropdown-toggle' data-toggle='dropdown'>" .$_SESSION['username']. "<span class='caret'> </span>    </a>";
                          echo "<ul class='dropdown-menu'>";  
                              echo "    <li><a href='produit.php'>Profile</a></li>";          
                              echo "    <li><a href='../logout.php'>Logout</a></li>";
                          echo "</ul>";
            echo "</li>";
      }else
      {
        echo '
          <ul class="nav navbar-nav navbar-right">
              <li><a href="../signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
              <li><a href="../login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
          </ul>


        ';
      }

?>






  </div>
</nav>