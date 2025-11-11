<?php require 'config.php'; ?>

<?php
if (empty($_SESSION['username']) || empty($_SESSION['uid']) )
    die(<<<EOF
        <meta http-equiv="refresh" content="0;url=login.php" />
    EOF);

if ( isset($_GET["buy"]) ) {
    
    // Check if product is available
    $character = $connection->prepare("SELECT * FROM ninja WHERE slug_name = ?");
    $character->bind_param("s", $_GET["buy"]);
    $character->execute();
    $result = $character->get_result()->fetch_assoc();
    // var_dump($result);

    if (!$result) die("<aside>Product not available yet</aside>");
    // Get user balance
    $coin = $connection->query(sprintf("SELECT coin FROM coins WHERE uid=%d limit 0,1", (int)$_SESSION["uid"]))->fetch_assoc()["coin"];

    if ($result["slug_name"] === "flag") {
        if ( (int)$coin === 1337) { 
            $connection->query(sprintf("UPDATE coins SET coin=%d-1337 WHERE uid=%d", (int)$coin, (int)$_SESSION["uid"]));
            die("<strong>Nice brooo!! Are you a millionaire??? Here your flag: $FLAG</strong>");
        } 
        else 
            die("<strong>Try harder!!! =))) </strong>");
    } else {
        if ( (int)$coin >= (int)$result["price"]) {
            $result = $connection->query(sprintf("UPDATE coins SET coin=%d-%d WHERE uid=%d", (int)$coin, (int)$result["price"], (int)$_SESSION["uid"]));
            if ($result) 
                die(sprintf("<strong>Buy successfully!!!</strong>"));
        }
        else 
            die("<strong>Coin do not enough!! =(( </strong>");
    }
}
?>

<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>NinjaShop — Sản phẩm</title>
  <style>
    body {font-family: Arial, sans-serif; margin: 0; padding: 0; background: #f5f5f5;}
    header {
      background: #222; 
      color: #fff; 
      padding: 16px; 
      display: flex; 
      justify-content: space-between; 
      align-items: center;
    }
    header .title {
      text-align: left;
    }
    header h1 {margin: 0; font-size: 20px;}
    header p {margin: 4px 0 0; font-size: 14px; color: #ccc;}
    .nav-buttons {
      display: flex;
      gap: 10px;
    }
    .nav-buttons a {
      color: #fff;
      text-decoration: none;
      background: #444;
      padding: 6px 12px;
      border-radius: 4px;
      font-size: 14px;
      transition: background 0.2s;
    }
    .nav-buttons a:hover {
      background: #666;
    }
    .container {padding: 20px;}
    .grid {display: grid; grid-template-columns: repeat(auto-fit,minmax(200px,1fr)); gap: 16px;}
    .card {background: #fff; border-radius: 8px; padding: 16px; text-align: center; box-shadow: 0 2px 5px rgba(0,0,0,0.1);}
    .thumb {font-size: 60px; margin-bottom: 10px;}
    .name {font-weight: bold; font-size: 18px; margin-bottom: 6px;}
    .price {color: #d9534f; font-weight: bold; margin-bottom: 10px;}
    .btn-buy {display: inline-block; padding: 8px 12px; background: #007bff; color: #fff; text-decoration: none; border-radius: 4px; font-size: 14px;}
    .btn-buy:hover {background: #0056b3;}
  </style>
</head>
<body>
  <header>
    <div class="title">
        <h1>NinjaShop</h1>
        <p>Bán Ninja nhưng không bán PoC</p>
    </div>
    <div class="nav-buttons">
      <a href="profile.php">Profile</a>
      <a href="logout.php">Logout</a>
    </div>
  </header>

  <main class="container">
    <section class="grid">
      <?php
        
        $products = $connection->query("SELECT * FROM ninja");
        while($row = $products->fetch_assoc()) {
          echo <<<EOF
            <div class="card">
              <div class="thumb"><img width=100px height=100px src="./imgs/{$row["slug_name"]}.png"></div>
              <div class="name">{$row["ninja_name"]}</div>
              <div class="price">{$row["price"]} 💰</div>
              <a href="index.php?buy={$row["slug_name"]}" class="btn-buy">Mua ngay</a>
            </div>
          EOF;
        }
      ?>
    </section>
  </main>
</body>
</html>