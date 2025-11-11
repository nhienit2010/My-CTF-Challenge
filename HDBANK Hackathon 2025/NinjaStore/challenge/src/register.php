<?php require 'config.php';

    if (!empty($_SESSION['username']) && !empty($_SESSION['uid']) )
        header('Location: index.php');
    
    if ( $_SERVER['REQUEST_METHOD'] !== "POST" )
        die(<<<EOF
            <!doctype html>
            <html lang="vi">
            <head>
              <meta charset="utf-8" />
              <meta name="viewport" content="width=device-width,initial-scale=1" />
              <title>Register</title>
              <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;600&display=swap" rel="stylesheet">
              <style>
                body {
                  font-family: 'Noto Sans JP', sans-serif;
                  margin: 0; padding: 0;
                  background: #f5f5f5;
                }
                header {
                  background: #222; color: #fff; padding: 16px;
                  text-align: center;
                }
                header h1 {margin: 0; font-size: 22px;}
                main {
                  max-width: 400px; margin: 40px auto;
                  background: #fff; padding: 20px;
                  border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);
                }
                form {display: flex; flex-direction: column; gap: 16px;}
                label {font-weight: 600; text-align: left;}
                input {
                  padding: 10px; border: 1px solid #ccc;
                  border-radius: 4px; font-size: 14px;
                }
                input:focus {border-color: #007bff; outline: none;}
                .btn-submit {
                  padding: 10px; font-size: 15px;
                  background: #007bff; color: #fff; border: none;
                  border-radius: 4px; cursor: pointer;
                  transition: background 0.2s;
                }
                .btn-submit:hover {background: #0056b3;}
                .note {margin-top: 10px; font-size: 14px; text-align: center;}
                .note a {color: #007bff; text-decoration: none;}
                .note a:hover {text-decoration: underline;}
              </style>
            </head>
            <body>
              <header>
                <h1>Register</h1>
              </header>

              <main>
                <form action="register.php" method="post">
                  <div>
                    <label for="username">Username: </label>
                    <input type="text" id="username" name="username" required>
                  </div>
                  <div>
                    <label for="fullname">Fullname: </label>
                    <input type="text" id="fullname" name="fullname" required>
                  </div>
                  <div>
                    <label for="password">Password: </label>
                    <input type="password" id="password" name="password" required>
                  </div>
                  <button type="submit" class="btn-submit">Register</button>
                </form>
                <p class="note">Have an account? <a href="login.php">Login</a></p>
              </main>
            </body>
            </html>
        EOF);

    foreach (array("username", "password", "fullname") as $value) {
        if (empty($_POST[$value])) die("<aside>Missing parameter!</aside>");
        waf($_POST[$value]);
    }
    if (strlen($_POST["username"]) > 15) die("<aside>Username too long<aside>");
    if (strlen($_POST["fullname"]) > 10) die("<aside>Fullname too long<aside>");
    
    // check account is exists
    if ( $connection->query(sprintf('SELECT * FROM users WHERE username="%s" and password="%s"', $_POST["username"], md5($_POST["password"])))->fetch_assoc()["uid"] )
        die("<strong>User is exists</strong>");

    $result = $connection->query(sprintf('INSERT INTO users(username, password, fullname) VALUES ("%s", "%s", "%s")', $_POST["username"], md5($_POST["password"]), $_POST["fullname"]));

    if ($result) {
        $uid = $connection->query(sprintf('SELECT uid FROM users WHERE username="%s" and password="%s" limit 0,1', $_POST["username"], md5($_POST["password"])))->fetch_assoc()["uid"];
        if ($uid) {
            if ($connection->query(sprintf('INSERT INTO coins(coin, uid, update_count) VALUES (100, %d, 0)', (int)$uid)))
                die(<<<EOF
                    <strong>User created successfully</strong>
                    <script>
                        setTimeout(() => {
                            window.location = "index.php";
                        }, 3000);
                    </script>
                EOF);
        }
    } else die("<strong>Something went wrong! Try again!</strong>");
?>