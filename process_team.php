<?php
// 获取 POST 传入的 JSON 数据
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// 检查传入的数据是否包含有效的小队成员
if (isset($data['team']) && is_array($data['team']) && isset($data['enemyTeam']) && is_array($data['enemyTeam'])) {
    // 获取我方和敌方队伍的成员
    $my_team = $data['team'];
    $enemy_team = $data['enemyTeam'];

    // 输出我方和敌方的成员
    echo "我方成员是：" . implode(", ", $my_team) . "<br>";
    echo "敌方成员是：" . implode(", ", $enemy_team);

    // 重定向到 index.php 页面
    header("index.php");
    exit; // 确保脚本结束执行，避免后续的输出
} else {
    echo "提交的数据格式错误！";
}
?>
