<?php require 'config.php';

if (empty($_SESSION['username']) || empty($_SESSION['uid']) )
    die(<<<EOF
        <meta http-equiv="refresh" content="0;url=login.php" />
    EOF);
?>

<head>
  <style>
    body {font-family: 'Noto Sans JP', sans-serif; margin: 0; background: #f5f5f5;}
    header {
      background: #222; color: #fff; padding: 16px;
      display: flex; justify-content: space-between; align-items: center;
    }
    header h1 {margin: 0; font-size: 22px;}
    .nav-buttons {display: flex; gap: 10px;}
    .nav-buttons a {
      color: #fff; text-decoration: none; background: #444;
      padding: 6px 12px; border-radius: 4px; font-size: 14px;
      transition: background 0.2s;
    }
    .nav-buttons a:hover {background: #666;}
    main {
      max-width: 400px; margin: 40px auto; background: #fff;
      padding: 20px; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      text-align: center;
    }
    .username {font-size: 22px; font-weight: 600; margin-bottom: 10px;}
    .coin {font-size: 18px; color: #d9534f; font-weight: 600;}
  </style>
</head>
<body>
  <header>
    <h1>Profile</h1>
    <div class="nav-buttons">
      <a href="index.php">Shop</a>
      <a href="logout.php">Logout</a>
    </div>
  </header>

  <main>
    <div class="username">👤 Full Name: <?php 
        $fullname = $connection->query(sprintf("SELECT fullname FROM users WHERE username='%s' limit 0,1", $_SESSION["username"]));
        var_dump(sprintf("SELECT fullname FROM users WHERE username='%s' limit 0,1", $_SESSION["username"]));

        if (gettype($fullname) !== "boolean") 
            echo $fullname->fetch_assoc()["fullname"];
        else 
            echo "Anonymous";
    ?></div>
    <div class="coin">💰 Your coin: <?php 
        $coin = $connection->query(sprintf("SELECT * FROM coins WHERE uid=%d limit 0,1", (int)$_SESSION["uid"]))->fetch_assoc()["coin"];
        echo $coin;
    ?>
    </div>
  </main>
</body>
</html>


<?php

// Ran out of money?? No need to worry, you can reset carefree!! But only limited from 1-99 coins =)))
if ( isset($_GET["new_balance"]) and waf($_GET["new_balance"]) ) {
    $count = (int) $connection->query(sprintf("SELECT update_count FROM coins WHERE uid=%d", (int) $_SESSION['uid']))->fetch_assoc()["update_count"];
    
    if ($count >= 5 || strlen($_GET["new_balance"]) > 2 || preg_match('/^[a-zA-Z]+$/', $_GET["new_balance"]) )  {
        die("<strong>0ops!!! Coin update has failed</strong>");
    }

    $result = $connection->query(sprintf("UPDATE coins SET coin=%s,update_count=%d WHERE uid=%d", $_GET["new_balance"], $count+1, (int) $_SESSION['uid']));

        var_dump(sprintf("UPDATE coins SET coin=%s,update_count=%d WHERE uid=%d", $_GET["new_balance"], $count+1, (int) $_SESSION['uid']));
    
    if ($result) 
        die("<strong>Your coin has been updated</strong>");
    else 
        die("<strong>0ops!!! Coin update has failed</strong>");

} 

?>