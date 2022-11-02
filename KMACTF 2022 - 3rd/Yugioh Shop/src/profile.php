<?php
require 'config.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}

$data = $conn->query("SELECT * from users where username='".$_SESSION['user']."'");
$data = $data->fetch_assoc();

$utils = new Utils();

if (isset($_FILES['file'])) {
    $result = $utils->uploadFile($_FILES['file']);

    if ($result[0]) {
        $conn->query("UPDATE users SET avatar='".$result[2]."' WHERE username='".$_SESSION['user']."'");
    }
}
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
        <div class="container mt-5">
            <div class="row d-flex justify-content-center">
                <div class="col-md-7">
                    <div class="card p-3 py-4">
                        <div class="text-center">
                            <img src="/uploads/<?= $data['avatar'] ?>" width="100" class="rounded-circle">
                        </div>
                        <div class="text-center mt-3">
                            <span class="bg-secondary p-1 px-4 rounded text-white">Pro</span>
                            <h5 class="mt-2 mb-0"><?= $data['username'] ?></h5>
                            <div class="px-4 mt-1">
                                <p class="fonts">Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                            </div>
                            <div class="buttons">
                                <button class="btn btn-outline-primary px-4">
                                    <form action="profile.php" method="post" enctype="multipart/form-data">
                                      <input type="file" name="file" id="file">
                                      <input type="submit" value="Upload Image" name="submit">
                                    </form>
                                </button>
                                <button class="btn btn-primary px-4 ms-3">Contact</button>
                            </div>
                            <div class="px-4 mt-1">
                                <?php if(isset($result)) echo $result[1];  ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>