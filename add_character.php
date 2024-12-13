<?php
header("Content-Type: text/html; charset=utf-8");

$db_server = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "Walkthrough_system";

$mydb = new mysqli($db_server, $db_user, $db_password, $db_name);

if ($mydb->connect_error) {
    die("連接失敗 " . $mydb->connect_error);
}

if (!$mydb->set_charset("utf8mb4")) {
    die("設置字體失敗: " . $mydb->error);
}
// 檢查是否是表單提交
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $charterName = $_POST['CharterName'];
    $lv = $_POST['LV'];
    $hp = $_POST['HP'];
    $mp = $_POST['MP'];
    $physiAtt = $_POST['PhysiAtt'];
    $magicAtt = $_POST['MagicAtt'];
    $physiDef = $_POST['PhysiDef'];
    $magicDef = $_POST['MagicDef'];
    $occuptionid = $_POST['Occupation'];
    $weaponid = $_POST['Weapon'];
    // 武器設定

    $sql = "SELECT WeaponMultiplier FROM weapon WHERE weaponId = $weaponid";

    $result = $mydb->query($sql);

    if ($result->num_rows > 0) {
        // 輸出結果
        $row = $result->fetch_assoc();
        $itemmultipier = $row['WeaponMultiplier'];
    } else {
        echo "No weapon found with ID: $$weaponid";
    }
    $damage = ($physiAtt + $magicAtt) * $itemmultipier;
    // SQL 新增語句
    $sql = "INSERT INTO charter (CharterName, LV, HP, MP, PhysiAtt, MagicAtt, PhysiDef, MagicDef, Damage, Occuptionid, Weaponid) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // 預備語句防止 SQL 注入
    $stmt = $mydb->prepare($sql);
    $stmt->bind_param("siiiiiiiiii", $charterName, $lv, $hp, $mp, $physiAtt, $magicAtt, $physiDef, $magicDef, $damage, $occuptionid, $weaponid);

    // 執行新增資料
    if ($stmt->execute()) {
        echo "角色新增成功！"; ?>
        <a href="new-character.php">再次新增</a>
        <a href="index.php">回首頁</a><?php
    } else {
        echo "新增失敗: " . $stmt->error;
    }

    // 關閉語句
    $stmt->close();
}

?>