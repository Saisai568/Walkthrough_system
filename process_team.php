<?php
    header("Content-Type: text/html; charset=utf-8");

    
    $db_server = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "Walkthrough_system";

    $mydb = new mysqli($db_server, $db_user, $db_password, $db_name);

    if ($mydb->connect_error) {
        die("連接失敗 " . $mydb->connect_error);
    }

    if (!$mydb->set_charset("utf8mb4")) {
        die("設置字體失敗: " . $mydb->error);
    }

    session_start();

    // 獲取 POST 傳入的 JSON 資料
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    // 檢查傳入的資料是否包含有效的小隊成員
    if (isset($data['team']) && is_array($data['team']) && isset($data['enemyTeam']) && is_array($data['enemyTeam'])) {
    // 獲取我方和敵方隊伍的成員
    $my_team = $data['team'];
    $enemy_team = $data['enemyTeam'];

    // 輸出我方和敵方的成員
    echo "\n我方成員是：" . implode(", ", $my_team);
    echo "\n敵方成員是：" . implode(", ", $enemy_team);
    
    // 預處理角色陣列，確保長度為 5，若不足則填 NULL
    $my_team = array_pad($my_team, 5, null);
    $enemy_team = array_pad($enemy_team, 5, null);
    
    // 確保 Session 中有 username
    if (isset($_SESSION['username'])) {
        $session_username = $_SESSION['username'];

        // 防止 SQL 注入
        $stmt = $mydb->prepare("SELECT userid FROM user WHERE username = ?");
        $stmt->bind_param("s", $session_username);

        // 執行查詢
        $stmt->execute();
        $stmt->bind_result($userid);

        if ($stmt->fetch()) {
            $player_id = (int)$userid;
        } else {
            echo "沒有找到對應的用戶";
        }

        // 關閉語句
        $stmt->close();
    } else {
        echo "Session 中沒有 username，請先登入";
    }

    // 插入資料的 SQL 語句
    $sql = "INSERT INTO Record (
        player_id,
        ally_character_1_id, ally_character_2_id, ally_character_3_id, ally_character_4_id, ally_character_5_id,
        enemy_character_1_id, enemy_character_2_id, enemy_character_3_id, enemy_character_4_id, enemy_character_5_id
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

    // 預備語句
    $stmt = $mydb->prepare($sql);
    if (!$stmt) {
        die("預備語句失敗: " . $mydb->error);
    }

    

    // 綁定參數
    $stmt->bind_param(
        "iiiiiiiiiii",
        $player_id,
        $my_team[0], $my_team[1], $my_team[2], $my_team[3], $my_team[4],
        $enemy_team[0], $enemy_team[1], $enemy_team[2], $enemy_team[3], $enemy_team[4]
    );

    // 執行語句
    if ($stmt->execute()) {
        echo "\n戰鬥記錄插入成功";
    } else {
        echo "插入失敗: " . $stmt->error;
    }

    // 關閉語句和連線
    $stmt->close();

    // 重定向到 index.php 頁面
    header("index.php");
    exit; // 確保指令碼結束執行，避免後續的輸出

    } else {
        echo "提交的資料格式錯誤！";
    }

?> 