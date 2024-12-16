<?php
require "load.php";
// 獲取角色 ID
$id = $_GET['id'];

// 刪除角色資料
$sql = "DELETE FROM weapon WHERE weaponId = $id";
if ($mydb->query($sql) === TRUE) {
    echo "武器資料已刪除";
    header("Location: manage_stuff.php"); 
} else {
    echo "錯誤: " . $mydb->error;
}
?>
