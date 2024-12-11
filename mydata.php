<?php
header("Content-Type: text/html; charset=utf-8");
session_start();

$db_server = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "Walkthrough_system";

$mydb = new mysqli($db_server, $db_user, $db_password, $db_name);

if ($mydb->connect_error) {
    die("連接失敗: " . $mydb->connect_error);
}

if (!$mydb->set_charset("utf8mb4")) {
    die("設置字體失敗: " . $mydb->error);
}
// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: register_login.php");
    exit;
}

// Fetch user data
$username = $_SESSION['username'];
$sql = "SELECT * FROM user WHERE username = ?";
$stmt = $mydb->prepare($sql);
if (!$stmt) {
    die("SQL 預處理失敗: " . $mydb->error);
}

$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "找不到用戶。";
    
    $stmt->close();
    $mydb->close();
    exit;
}

$user = $result->fetch_assoc();

$stmt->close();
$mydb->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>我的個人檔案</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .profile-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        p {
            font-size: 16px;
            color: #666;
            line-height: 1.6;
        }
        .logout {
            display: block;
            text-align: center;
            margin-top: 20px;
            padding: 10px 20px;
            background: #ff4d4d;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }
        .logout:hover {
            background: #ff1a1a;
        }
    </style>
    <script>
        function logout() {
            // Send logout request using fetch
            fetch("logout.php", { method: "POST" })
                .then(response => {
                    if (response.ok) {
                        // Redirect to index.php
                        window.location.href = "index.php";
                    } else {
                        alert("登出失敗，請稍後重試。");
                    }
                })
                .catch(error => {
                    console.error("登出過程中發生錯誤:", error);
                });
        }
    </script>
</head>
<body>
    <div class="profile-container">
        <h1>歡迎, <?php echo htmlspecialchars($user['UserName'], ENT_QUOTES, 'UTF-8'); ?>!</h1>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p><strong>暱稱:</strong> <?php echo htmlspecialchars($user['Nickname'], ENT_QUOTES, 'UTF-8'); ?></p>
        <a href="#" class="logout" onclick="logout()">登出</a>
    </div>
</body>
</html>
