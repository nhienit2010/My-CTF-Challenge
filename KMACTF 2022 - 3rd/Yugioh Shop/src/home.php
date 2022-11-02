<?php

require 'config.php';

if (!isset($_SESSION['user'])) {
	header("Location: login.php");
}

if (!$data = $conn->query("SELECT * FROM shop"))
	die("No data");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Yu-Gi-Oh! Shop</title>
        <link href="../static/css/styles.css" rel="stylesheet" />
        <link href="../static/css/shop.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="/">Yu-Gi-Oh! Shop</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="/profile.php">Profile</a></li>
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="/logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page content-->
        <section class="section-products">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-md-8 col-lg-6">
                        <div class="header">
                            <h2>Popular Products</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php  while($row = $data->fetch_assoc()) {?>
                    <!-- Single Product -->
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div id='product-<?=$row["id"]?>' class="single-product">
	                        	<style type="text/css">
								    .section-products #product-<?=$row["id"]?> .part-1::before {
								        background: url(<?=$row["url"]?>) no-repeat center;
								        background-size: contain;
								        transition: all 0.3s;
								    }
								</style>
                                <div class="part-1">
                                    <ul>
                                            <li><a href="#"><i class="fas fa-shopping-cart"></i></a></li>
                                            <li><a href="#"><i class="fas fa-heart"></i></a></li>
                                            <li><a href="#"><i class="fas fa-plus"></i></a></li>
                                            <li><a href="#"><i class="fas fa-expand"></i></a></li>
                                    </ul>
                                </div>
                                <div class="part-2">
                                        <h3 class="product-title"><a style="color: blue;" href='/item.php?id=<?=$row["id"]?>'><?=$row["name"]?></a></h3>
                                        <h4 class="product-price">$<?=$row["price"]?></h4>
                                </div>
                        </div>
                    </div>
                    <!-- Single Product -->
                    <?php } ?>
                </div>
            </div>
        </section>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="../static/js/scripts.js"></script>
    </body>
</html>

