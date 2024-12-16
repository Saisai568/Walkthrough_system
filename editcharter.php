<?php
require "load.php";
// 獲取角色 ID
$id = $_GET['id'];
// 查詢角色資料
$sql = "SELECT * FROM charter WHERE CharterId = $id";
$result = $mydb->query($sql);
$row = $result->fetch_assoc();
// 更新角色資料
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['CharterName'];
    $level = $_POST['LV'];
    $hp = $_POST['HP'];
    $mp = $_POST['MP'];
    $job_id = $_POST['OccuptionId'];
    $weapon_id = $_POST['weaponId'];

    // 更新資料庫
    $update_sql = "UPDATE charter SET CharterName='$name', LV ='$level', HP='$hp', MP='$mp', OccuptionId='$job_id', weaponId='$weapon_id' WHERE CharterId=$id";
    if ($mydb->query($update_sql) === TRUE) {
        echo "角色資料更新成功";
        header("Location: manage_stuff.php"); // 更新後跳回角色列表頁
    } else {
        echo "錯誤: " . $mydb->error;
    }
}
?>

<form method="POST">
    <label for="character_name">角色名稱</label>
    <input type="text" name="CharterName" value="<?php echo $row['CharterName']; ?>" required><br>

    <label for="level">等級</label>
    <input type="number" name="LV" value="<?php echo $row['LV']; ?>" required><br>

    <label for="hp">HP</label>
    <input type="number" name="HP" value="<?php echo $row['HP']; ?>" required><br>

    <label for="mp">MP</label>
    <input type="number" name="MP" value="<?php echo $row['MP']; ?>" required><br>

    <label for="job_id">職業ID</label>
    <input type="number" name="OccuptionId" value="<?php echo $row['OccuptionId']; ?>" required><br>

    <label for="weapon_id">武器ID</label>
    <input type="number" name="weaponId" value="<?php echo $row['weaponId']; ?>" required><br>

    <button type="submit">更新角色</button>
</form>
