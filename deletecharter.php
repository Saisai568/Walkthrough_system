<?php
require "load.php";
// 獲取角色 ID
$id = $_GET['id'];

// 刪除角色資料
$sql = "DELETE FROM charter WHERE CharterId = $id";
if ($mydb->query($sql) === TRUE) {
    echo "角色資料已刪除";
    header("Location: index.php"); // 刪除後跳回角色列表頁
} else {
    echo "錯誤: " . $mydb->error;
}
?>
