<?php
    require "load.php";
    
    session_start();

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

    
    try {
        $pdo = new PDO("mysql:host=$db_server;dbname=$db_name", $db_user, $db_password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Fetch characters
        $stmt = $pdo->query("SELECT CharterName FROM charter");
        $characters = $stmt->fetchAll(PDO::FETCH_COLUMN);
        $stmt = $pdo->query("SELECT CharterId  FROM charter");
        $charactersid = $stmt->fetchAll(PDO::FETCH_COLUMN);
    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
}
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
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        header {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-align: center;
        }

        nav {
            background: #333;
            color: white;
            display: block;
            justify-content: flex-start;
            text-align: right;
        }

        nav a {
            background: #333;
            color: white;
            margin: 0 15px;
            text-decoration: none;
            font-size: 16px;
        }

        nav a:hover {
            text-decoration: underline;
        }

        .container {
            display: flex;
            width: 100%;
            height: 100vh; /* Full viewport height */
        }

        .main-content {
            width: 75%;
            padding: 20px;
            background-color: #f0f0f0;
            text-align: center;
        }

        .sidebar {
            width: 25%;
            height: 100vh; /* 高度設置為視窗高度 */
            padding: 20px;
            background-color: #ccc;
            text-align: center;
            position: fixed; /* 固定在頁面左側 */
            top: 0;
            right: 0;
        }


        main {
            padding: 20px;
            text-align: center;
        }

        .card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: inline-block;
            margin: 10px;
            padding: 10px;
            width: 950px;
        }

        .card h3 {
            margin-top: 0;
            color: #333;
        }

        .card a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        .card a:hover {
            background-color: #45a049;
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
    <div class="container">
        <div class="main-content">
            <h1>戰鬥紀錄</h1>
            <div class="records">
            <?php
            

            // 確保使用 PDO 查詢資料庫
            $sql = "SELECT Recordid, player_id, created_at, 
                        CONCAT(ally_character_1_id, ',', ally_character_2_id, ',', ally_character_3_id, ',', ally_character_4_id, ',', ally_character_5_id) AS allyCharacters,
                        CONCAT(enemy_character_1_id, ',', enemy_character_2_id, ',', enemy_character_3_id, ',', enemy_character_4_id, ',', enemy_character_5_id) AS enemyCharacters
                    FROM Record 
                    WHERE player_id = :player_id";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([':player_id' => $user["UserId"]]); // 綁定參數，使用 PDO 方法

            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // 處理紀錄資料
            foreach ($records as &$record) {
                $playerStmt = $pdo->prepare("SELECT username FROM user WHERE userid = :player_id");
                $playerStmt->execute([':player_id' => $record['player_id']]);
                $record['playerName'] = $playerStmt->fetchColumn() ?: 'Unknown';
            }

            // 檢查紀錄是否存在
            if (!empty($records)) {
                foreach ($records as $row) {
                    echo "<div class='card'>";
                    echo "<h3>" . htmlspecialchars($row["Recordid"], ENT_QUOTES, 'UTF-8') . "</h3>";
                    echo "<p><strong>建立時間:</strong> " . htmlspecialchars($row["created_at"], ENT_QUOTES, 'UTF-8') . "</p>";
                    echo "<p><strong>隊伍:</strong> " . htmlspecialchars($row["allyCharacters"], ENT_QUOTES, 'UTF-8') . "</p>";
                    echo "<p><strong>敵人:</strong> " . htmlspecialchars($row["enemyCharacters"], ENT_QUOTES, 'UTF-8') . "</p>";
                    echo "</div>";
                }
            } else {
                echo "<p>目前沒有紀錄。</p>";
            }
            ?>
            </div>
        </div>
        <div class="sidebar">
            <div class="profile-container">
                <h1>歡迎, <?php echo htmlspecialchars($user['UserName'], ENT_QUOTES, 'UTF-8'); ?>!</h1>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8'); ?></p>
                <p><strong>暱稱:</strong> <?php echo htmlspecialchars($user['Nickname'], ENT_QUOTES, 'UTF-8'); ?></p>
                <a href="#" class="logout" onclick="logout()">登出</a>
            </div>
        </div>
    </div>
</body>
</html>
