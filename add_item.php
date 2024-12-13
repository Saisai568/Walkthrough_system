<?php
require "load.php";

// 接收表單數據
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $itemName = $_POST['ItemName'];
    $occaption = $_POST['Occaption'];
    $itemProper = $_POST['ItemProper'];

    // 避免 SQL 注入攻擊
    $itemName = $mydb->real_escape_string($itemName);
    $itemProper = $mydb->real_escape_string($itemProper);

    // 插入資料的 SQL 語句
    $sql = "INSERT INTO item (itemname, occuptionid, Itemproper) VALUES ('$itemName', '$occaption', '$itemProper')";

    if ($mydb->query($sql) === TRUE) {
        echo "道具新增成功！";?>
        <a href="new-character.php">再次新增</a>
        <a href="index.php">回首頁</a><?php
    } else {
        echo "新增失敗: " . $mydb->error;
    }
}

// 關閉連線
$mydb->close();

?>