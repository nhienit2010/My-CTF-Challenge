<?php

require 'config.php';

if (isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password']) ) {
  $username = $conn->real_escape_string($_POST['username']);
  $password = $conn->real_escape_string($_POST['password']);

  $data = $conn->query("SELECT password FROM users where username='$username' limit 1");
  if ($data->num_rows < 0)
    $msg = "User not exists";
  else {
    if (md5($password) === $data->fetch_assoc()['password']) {
      $_SESSION['user'] =  $conn->real_escape_string($username);
      echo "<script>window.location='home.php'</script>";
    }
    else 
      $msg = "Wrong username or password";
  }

} else {
  echo "<script>";
  echo "alert('Blank field!!!')";
  echo "location = 'login.php'";
  echo "</script";
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Simple Shop</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link href="./static/css/login.css" rel="stylesheet" id="bootstrap-css">
    </head>
    <body>
      <div class="wrapper fadeInDown">
        <div id="formContent">
          <!-- Tabs Titles -->

          <!-- Icon -->
          <div class="fadeIn first">
            <img src="https://img.icons8.com/bubbles/50/000000/user.png"/>
          </div>

          <!-- Login Form -->
          <form action="login.php" method="POST">
            <input type="text" id="username" class="fadeIn second" name="username" placeholder="username">
            <input type="text" id="password" class="fadeIn third" name="password" placeholder="password">
            <input type="submit" class="fadeIn fourth" value="Log In">
          </form>

          <!-- Remind Passowrd -->
          <div id="formFooter">
            <a class="underlineHover" href="register.php">Register</a>
          </div>

          <h2><?php if(!empty($msg)) echo $msg; ?></h2>

        </div>
      </div>
    </body>
</html>