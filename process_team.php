<?php
// 獲取 POST 傳入的 JSON 資料
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// 檢查傳入的資料是否包含有效的小隊成員
if (isset($data['team']) && is_array($data['team']) && isset($data['enemyTeam']) && is_array($data['enemyTeam'])) {
    // 獲取我方和敵方隊伍的成員
    $my_team = $data['team'];
    $enemy_team = $data['enemyTeam'];
    echo $my_team ; 
    // 輸出我方和敵方的成員
    echo "\n我方成員是：" . implode(", ", $my_team);
    echo "\n敵方成員是：" . implode(", ", $enemy_team);

    // 重定向到 index.php 頁面
    header("index.php");
    exit; // 確保指令碼結束執行，避免後續的輸出
} else {
    echo "提交的資料格式錯誤！";
}
?>
