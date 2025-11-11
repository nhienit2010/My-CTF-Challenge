<?php 
    require 'config.php';

    if (!empty($_SESSION['username']) && !empty($_SESSION['uid']) )
        header('Location: index.php');

    if ( $_SERVER['REQUEST_METHOD'] !== "POST" )
        die(<<<EOF
            <!doctype html>
            <html lang="vi">
            <head>
              <meta charset="utf-8" />
              <meta name="viewport" content="width=device-width,initial-scale=1" />
              <title>Login</title>
              <style>
                :root{--bg:#f6f8fa;--card:#fff;--accent:#2563eb;--muted:#667085}
                *{box-sizing:border-box;font-family:Inter,ui-sans-serif,system-ui,-apple-system,Segoe UI,Roboto,'Helvetica Neue',Arial}
                body{margin:0;min-height:100vh;display:flex;align-items:center;justify-content:center;background:linear-gradient(180deg,#eef2ff 0,#f6f8fa 100%)}
                .card{width:340px;background:var(--card);padding:24px;border-radius:12px;box-shadow:0 6px 20px rgba(32,33,36,0.08);text-align:center}
                h1{margin:0 0 8px;font-size:20px}
                p.lead{margin:0 0 18px;color:var(--muted);font-size:13px}
                .field{margin-bottom:12px;text-align:left}
                label{display:block;font-size:13px;margin-bottom:6px;color:#111827}
                input[type="text"],input[type="password"]{
                  width:100%;padding:10px 12px;border-radius:8px;border:1px solid #e6e9ef;font-size:14px
                }
                .btn{
                  display:inline-block;width:100%;padding:10px 12px;border-radius:8px;border:0;background:var(--accent);
                  color:#fff;font-weight:600;cursor:pointer;font-size:14px;margin-top:8px;
                }
                .hint{font-size:12px;color:var(--muted);margin-top:10px}
                .error{color:#b91c1c;font-size:13px;margin-top:8px}
                .small-link{font-size:13px;color:var(--accent);text-decoration:none}
                .row{display:flex;gap:8px}
                .flex-1{flex:1}
              </style>
            </head>
            <body>
              <main class="card" role="main">
                <h1>Đăng nhập</h1>
                <p class="lead">Vào thôi</p>

                <form id="loginForm" method="POST" action="login.php" novalidate>
                  <div class="field">
                    <label for="username">Username</label>
                    <input id="username" name="username" type="text" autocomplete="username" required />
                  </div>

                  <div class="field">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required />
                  </div>

                  <div id="error" class="error" aria-live="polite" style="display:none"></div>

                  <button type="submit" class="btn">Đăng nhập</button>

                  <p class="hint">Chưa có tài khoản? <a href="register.php" class="small-link">Đăng ký</a></p>
                </form>
              </main>
            </body>
            </html>
        EOF
    );
    
    foreach (array("username", "password") as $value) {
        if (empty($_POST[$value])) die("<aside>Missing parameter!</aside>");
        waf($_POST[$value]);
    }

    if (strlen($_POST["username"]) > 26) die("<aside>Username too long<aside>");
    $result = $connection->query(sprintf('SELECT * FROM users WHERE username="%s" AND password="%s" limit 0,1', $_POST["username"], md5($_POST["password"])))->fetch_assoc();
    if(empty($result))
        die(<<<EOF
            <strong>Username or password is wrong</strong>
            <meta http-equiv="refresh" content="1;url=login.php" />
        EOF);
    else {
        $_SESSION["username"] = $result['username'];
        $_SESSION["uid"] = $result['uid'];
        die(<<<EOF
            <strong>Welcome brooo!! Buy flag with me !!!! </strong>
            <meta http-equiv="refresh" content="1;url=index.php" />
        EOF);
    }

?>
    