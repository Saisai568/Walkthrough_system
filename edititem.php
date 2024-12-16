<?php
require "load.php";
// 獲取角色 ID
$id = $_GET['id'];
// 查詢角色資料
$sql = "SELECT * FROM item WHERE ItemId = $id";
$result = $mydb->query($sql);
$row = $result->fetch_assoc();
// 更新角色資料
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['ItemName'];
    $level = $_POST['ItemProper'];
    $hp = $_POST['OccuptionId'];

    // 更新資料庫
    $update_sql = "UPDATE item SET ItemName='$name', ItemProper ='$level', OccuptionId='$hp' WHERE ItemId=$id";
    if ($mydb->query($update_sql) === TRUE) {
        echo "道具資料更新成功";
        header("Location: manage_stuff.php"); // 更新後跳回角色列表頁
    } else {
        echo "錯誤: " . $mydb->error;
    }
}
?>

<form method="POST">
    <label for="ItemName">道具名稱</label>
    <input type="text" name="ItemName" value="<?php echo $row['ItemName']; ?>" required><br>

    <label for="ItemProper">屬性</label>
    <input type="text" name="ItemProper" value="<?php echo $row['ItemProper']; ?>" required><br>

    <label for="OccuptionId">職業</label>
    <input type="number" name="OccuptionId" value="<?php echo $row['OccuptionId']; ?>" required><br>

    <button type="submit">更新角色</button>
</form>
