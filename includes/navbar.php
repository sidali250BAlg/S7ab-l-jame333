<?php 
        $sql = $connect->prepare("SELECT * FROM header");
        $sql->execute();
        $row = $sql->rowCount();
        if($row > 0)
        {
            $cats= $sql->fetch();
            ?>
                <div class="row">
                  <div class="col-sm-12">
                      <div style="text-align: center; float: center;overflow: hidden">
                          <img class="img-responsive" src="admin/uploads/header/<?php echo $cats['header']; ?>">    
                      </div>
                  </div>
                </div>
            <?php
        }
?>
    

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Tripole</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php">Home</a></li>
      <?php 
            $sql = $connect->prepare("SELECT * FROM categories");
            $sql->execute();
            $cats=$sql->fetchAll();
            foreach ($cats as $cat) {
                  echo "
                        <li class='dropdown'>
                              <a class='dropdown-toggle' data-toggle= 'dropdown' href='#'> ".$cat['name_categorie']."<span class='caret'></span>
                              </a>
                              <ul class='dropdown-menu'>";
                  $sql = $connect->prepare('SELECT * FROM sous_categories WHERE name_cat=?');
                  $sql->execute(array($cat['name_categorie']));
                  $s_cats=$sql->fetchAll();
                  foreach ($s_cats as $s_cat) 
                  {
                              echo "<li><a href='produit.php?id_sous_cat=".$s_cat['id_sous_cat']."'>".$s_cat['name_sous_cat']."</a></li>";                  
                  }      
                        echo "</ul>
                        </li>";
            }
      ?>
      
    </ul>

    <?php
      if(!empty($_SESSION['username']))
      {
        echo '<ul class="nav navbar-nav navbar-right">';
            echo'<li><a href="panier.php">Panier</a></li>';

            echo "<li class='dropdown'><a href='#' class='dropdown-toggle' data-toggle='dropdown'>" .$_SESSION['username']. "<span class='caret'> </span>    </a>";
                          echo "<ul class='dropdown-menu'>";  
                              echo "    <li><a href='produit.php'>Profile</a></li>";          
                              echo "    <li><a href='logout.php'>Logout</a></li>";
                          echo "</ul>";
            echo "</li>";
      }else
      {
        echo '
          <ul class="nav navbar-nav navbar-right">
              <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
              <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
          </ul>


        ';
      }

     ?>
  </div>
</nav>