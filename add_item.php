<?php
require "load.php";

// 檢查是否是表單提交
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $ItemName = $_POST['ItemName'];
    $Occuption = $_POST['Occaption'];
    $ItemProper = $_POST['ItemProper'];

    // SQL 新增語句
    $sql = "INSERT INTO item (ItemName, ItemProper, Occupation) 
            VALUES (?, ?, ?)";

    // 預備語句防止 SQL 注入
    $stmt = $mydb->prepare($sql);
    $stmt->bind_param("sss", $ItemName, $ItemProper, $Occuption);

    // 執行新增資料
    if ($stmt->execute()) {
        echo "道具新增成功！"; ?>
        <a href="new-character.php">再次新增</a>
        <a href="index.php">回首頁</a><?php
    } else {
        echo "新增失敗: " . $stmt->error;
    }

    // 關閉語句
    $stmt->close();
}

?>