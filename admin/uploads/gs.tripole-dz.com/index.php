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
    if (isset($_POST['login'])) {
        $uname = $_POST['uname'];
        $psw = $_POST['psw'];
        if ($uname && $psw) {
            $sql = $connect->prepare('SELECT * FROM users WHERE username=? AND password=?');
            $sql->execute(array($uname ,$psw));
            $count1 = $sql->rowCount();
            //echo $count1;
            if ($count1 > 0) {
                $_SESSION['uname'] = $uname;
                header('location: dashboard.php');
            }else{
                $error = 'Sorry! Account not existing !, Or <a href="signUp.php">Register here</a>';
            }
        }else{
            $error = 'You have to fill all fields!';
            echo $error;
        }
    }



  ?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

button:hover {
    opacity: 0.8;
}

.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
}

img.avatar {
    width: 40%;
    border-radius: 50%;
}

.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}
</style>
</head>
<body>

<h2>Login Form</h2>

<form  method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
  <div class="imgcontainer">
    <img src="img_avatar2.png" alt="Avatar" class="avatar">
  </div>

  <div class="container">
    <label for="uname"><b>Pseudo</b></label>
      <input type="text" placeholder="Enter Username" name="uname" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>
        
      <button type="submit" name="login">Login</button>
      <label>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn"><a href="SignUp.php">registre</a></button>
  </div>
</form>

</body>
</html>
