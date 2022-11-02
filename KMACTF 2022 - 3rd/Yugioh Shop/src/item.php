<?php
require 'config.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}


if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $id = $conn->real_escape_string($_GET['id']);

    if (!$data = $conn->query("SELECT * FROM shop where id='$id'"))
        die("No data");
    $data = $data->fetch_assoc();
} else {
    die("No item id found!");
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
        <link href="../static/css/styles.css" rel="stylesheet" />
        <link href="../static/css/item.css" rel="stylesheet" />
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
        <div class="container d-flex justify-content-center">
            <figure class="card card-product-grid card-lg"> <a href="#" class="img-wrap" data-abc="true"> <img src='<?=$data["url"]?>'> </a>
            <figcaption class="info-wrap">
             <div class="row">
                 <div class="col-md-9 col-xs-9"> <a href="#" class="title" data-abc="true"><?=$data["name"]?></a></div>
             </div>
            </figcaption>
            <div class="bottom-wrap-payment">
             <figcaption class="info-wrap">
                 <div class="row">
                     <div class="col-md-9 col-xs-9"> <a href="#" class="title" data-abc="true">$<?=$data["price"]?></a></div>
                 </div>
             </figcaption>
            </div>
            <div class="bottom-wrap"> <a href="#" class="btn btn-primary float-right" data-abc="true" onclick="buy()"> Buy now </a>
             <div class="price-wrap"> <a href="#" class="btn btn-warning float-left" data-abc="true"> Cancel </a> </div>
            </div>
            </figure>
        </div>
    </body>

<script type="text/javascript">
    function buy() {
        data = "<item><name><?=$data["name"]?></name><price><?=$data["price"]?></price></item>";
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'buy.php', true);
        xhr.setRequestHeader('Content-type', 'text/plain');
        xhr.onload = function () {};
        xhr.onreadystatechange = function() {
            if(xhr.readyState == 4 && xhr.status == 200) {
                alert(xhr.responseText);
            }
        }
        xhr.send(data);
    }
</script>