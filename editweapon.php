<?php
require "load.php";
// 獲取角色 ID
$id = $_GET['id'];
// 查詢角色資料
$sql = "SELECT * FROM weapon WHERE weaponId = $id";
$result = $mydb->query($sql);
$row = $result->fetch_assoc();
// 更新角色資料
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['weaponName'];
    $level = $_POST['WeaponMultiplier'];

    // 更新資料庫
    $update_sql = "UPDATE weapon SET weaponName='$name', WeaponMultiplier ='$level' WHERE weaponId=$id";
    if ($mydb->query($update_sql) === TRUE) {
        echo "武器資料更新成功";
        header("Location: manage_stuff.php"); // 更新後跳回角色列表頁
    } else {
        echo "錯誤: " . $mydb->error;
    }
}
?>

<form method="POST">
    <label for="weaponName">武器名稱</label>
    <input type="text" name="weaponName" value="<?php echo $row['weaponName']; ?>" required><br>

    <label for="WeaponMultiplier">武器加成</label>
    <input type="text" name="WeaponMultiplier" value="<?php echo $row['WeaponMultiplier']; ?>" required><br>

    <button type="submit">更新角色</button>
</form>
