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


try {
    $pdo = new PDO("mysql:=$db_server;dbname=$db_name;charset=utf8", $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $input = json_decode(file_get_contents('php://input'), true);
    $charterName = $input['charterName'];

    // 獲取角色 ID
    $stmt = $pdo->prepare("SELECT CharterId FROM Charter WHERE CharterName = ?");
    $stmt->execute([$charterName]);
    $charter = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$charter) {
        echo json_encode(['error' => '角色不存在！']);
        exit;
    }

    $charterId = $charter['CharterId'];

    // 查詢角色在所有紀錄中的登場次數與總戰鬥數
    $stmt = $pdo->prepare("
        SELECT 
            (SUM(
                (ally_character_1_id = :id) + 
                (ally_character_2_id = :id) + 
                (ally_character_3_id = :id) + 
                (ally_character_4_id = :id) + 
                (ally_character_5_id = :id) + 
                (enemy_character_1_id = :id) + 
                (enemy_character_2_id = :id) + 
                (enemy_character_3_id = :id) + 
                (enemy_character_4_id = :id) + 
                (enemy_character_5_id = :id)
            )) AS appearance_count,
            COUNT(*) AS total_battles
        FROM Record
    ");
    $stmt->execute(['id' => $charterId]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($data['total_battles'] > 0) {
        $appearanceRate = ($data['appearance_count'] / ($data['total_battles'] * 10)) * 100;
        echo json_encode(['appearanceRate' => round($appearanceRate, 2)]);
    } else {
        echo json_encode(['error' => '沒有戰鬥紀錄！']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => '資料庫連線失敗：' . $e->getMessage()]);
}
?>
