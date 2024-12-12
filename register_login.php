<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>註冊/登入</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input {
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 4px;
        }
        button:hover {
            background-color: #45a049;
        }
        .switch {
            text-align: center;
            margin-top: 10px;
        }
        .switch a {
            color: #4CAF50;
            text-decoration: none;
        }
        .switch a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container" id="form-container">
        <div id="login-form">
            <h2>登入</h2>
            <form action="login.php" method="POST">
                <input type="text" name="username" placeholder="用戶名" required>
                <input type="password" name="password" placeholder="密碼" required>
                <button type="submit">登入</button>
            </form>
            <a href="index.php"回首頁</a>
            <div class="switch">
                尚未註冊？<a href="#" onclick="switchToRegister()">註冊</a>
            </div>
        </div>
        <div id="register-form"  style="display: none;">
            <h2>註冊</h2>
            <form action="register.php" method="POST">
                <input type="text" name="username" placeholder="用戶名" required>
                <input type="email" name="email" placeholder="電子郵件" required>
                <input type="password" name="password" placeholder="密碼" required>
                <input type="nickname" name="nickname" placeholder="暱稱">
                <button type="submit">註冊</button>
            </form>
            <a href="index.php">回首頁</a>
            <div class="switch">
                已有帳戶？<a href="#" onclick="switchToLogin()">登入</a>
            </div>
        </div>
        
    </div>

    <script>
        function switchToLogin() {
            document.getElementById('register-form').style.display = 'none';
            document.getElementById('login-form').style.display = 'block';
        }

        function switchToRegister() {
            document.getElementById('login-form').style.display = 'none';
            document.getElementById('register-form').style.display = 'block';
        }
    </script>
</body>
</html>