<?php
require "load.php";

// 接收表單數據
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $WeaponName = $_POST['WeaponName'];
    $WeaponMultiplier = $_POST['WeaponMultiplier'];

    // 避免 SQL 注入攻擊
    $WeaponName = $mydb->real_escape_string($WeaponName);
    $WeaponMultiplierr = $mydb->real_escape_string($WeaponMultiplier);

    // 插入資料的 SQL 語句
    $sql = "INSERT INTO weapon (WeaponName, WeaponMultiplier) VALUES ('$WeaponName', '$WeaponMultiplier')";

    if ($mydb->query($sql) === TRUE) {
        echo "武器新增成功！";?>
        <a href="new-character.php">再次新增</a>
        <a href="index.php">回首頁</a><?php
    } else {
        echo "新增失敗: " . $mydb->error;
    }
}

// 關閉連線
$mydb->close();

?>