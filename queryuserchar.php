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

try {
    $pdo = new PDO("mysql:host=$db_server;dbname=$db_name;charset=utf8", $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $input = json_decode(file_get_contents('php://input'), true);
    if (!$input || !isset($input['username'])) {
        throw new Exception('Invalid JSON input or missing Username.');
    }
    $username = $input['username'];
    // 使用预处理语句查询CharterId
    $stmt = $mydb->prepare("SELECT userId FROM user WHERE username = ?");
    $stmt->bind_param("s", $username); // "s" 表示绑定字符串

    // 执行查询
    $stmt->execute();
    $result = $stmt->get_result();

    // 检查查询结果
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $userid = $row["userId"];
        }
    } else {
        echo "未找到对应的UserId";
    }
    // Prepare the SQL statement with a placeholder
    $stmt = $pdo->prepare("SELECT U.UserName, C.CharterName
FROM User U
JOIN Record R ON U.UserId = R.player_id
JOIN Charter C ON C.CharterId = R.ally_character_1_id
   OR C.CharterId = R.ally_character_2_id
   OR C.CharterId = R.ally_character_3_id
   OR C.CharterId = R.ally_character_4_id
   OR C.CharterId = R.ally_character_5_id
WHERE U.UserId = :id ;");

    // Bind the id parameter
    $stmt->bindParam(':id', $userid, PDO::PARAM_INT);

    // Execute the query
    $stmt->execute();

    // Fetch all results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($results) {
        // Output the result as JSON
        echo json_encode($results, JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode(['message' => 'No records found.']);
    }

} catch (PDOException $e) {
    echo json_encode(['error' => '資料庫連線失敗：' . $e->getMessage()]);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}

?>
