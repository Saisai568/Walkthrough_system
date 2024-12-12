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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $CharterName = $_POST['CharterName'];
    $LV = $_POST['LV'];
    $HP = $_POST['HP'];
    $MP = $_POST['MP'];
    $PhysiAtt = $_POST['PhysiAtt'];
    $MagicAtt = $_POST['MagicAtt'];
    $PhysiDef = $_POST['PhysiDef'];
    $MagicDef = $_POST['MagicDef'];
    $Occupation = $_POST['Occupation'];

    $sql = "INSERT INTO charter (CharterName, LV, HP, MP, PhysiAtt, MagicAtt, PhysiDef, MagicDef, Occupation) 
            VALUES ('$CharterName', $LV, $HP, $MP, $PhysiAtt, $MagicAtt, $PhysiDef, $MagicDef, '$Occupation')";

    if ($mydb->query($sql) === TRUE) {
        echo "New character added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $mydb->error;
    }

    $mydb->close();
}
?>
