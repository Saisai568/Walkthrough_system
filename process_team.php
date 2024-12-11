<?php
// 獲取 POST 傳入的 JSON 數據
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (isset($data['team']) && is_array($data['team'])) {
    $team = $data['team'];
    echo "你的小隊成員是：" . implode(", ", $team);
    header("index.php");
} else {
    echo "提交的數據格式錯誤！";
}
?>
