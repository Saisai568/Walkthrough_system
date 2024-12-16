<?php
require "load.php";

try {
    $pdo = new PDO("mysql:host=$db_server;dbname=$db_name;charset=utf8", $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $input = json_decode(file_get_contents('php://input'), true);
    if (!$input || !isset($input['chartername'])) {
        throw new Exception('Invalid JSON input or missing occuptionname.');
    }
    $charterName = $input['chartername'];
    // 使用预处理语句查询CharterId
    $stmt = $mydb->prepare("SELECT CharterId FROM Charter WHERE CharterName = ?");
    $stmt->bind_param("s", $charterName); // "s" 表示绑定字符串

    // 执行查询
    $stmt->execute();
    $result = $stmt->get_result();

    // 检查查询结果
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $charid = $row["CharterId"];
        }
    } else {
        echo "未找到對應的CharterId";
    }
    // Prepare the SQL statement with a placeholder
    $stmt = $pdo->prepare("SELECT 
    C.CharterId,
    C.CharterName,
    Position,
    COUNT(*) AS AppearanceCount,
    ROUND(COUNT(*) * 1.0 / (SELECT COUNT(*) FROM Record), 4) AS AppearanceProbability
    FROM (
        SELECT ally_character_1_id AS CharterId, '我方位置 1' AS Position FROM Record
        UNION ALL
        SELECT ally_character_2_id AS CharterId, '我方位置 2' AS Position FROM Record
        UNION ALL
        SELECT ally_character_3_id AS CharterId, '我方位置 3' AS Position FROM Record
        UNION ALL
        SELECT ally_character_4_id AS CharterId, '我方位置 4' AS Position FROM Record
        UNION ALL
        SELECT ally_character_5_id AS CharterId, '我方位置 5' AS Position FROM Record
        UNION ALL
        SELECT enemy_character_1_id AS CharterId, '敵方位置 1' AS Position FROM Record
        UNION ALL
        SELECT enemy_character_2_id AS CharterId, '敵方位置 2' AS Position FROM Record
        UNION ALL
        SELECT enemy_character_3_id AS CharterId, '敵方位置 3' AS Position FROM Record
        UNION ALL
        SELECT enemy_character_4_id AS CharterId, '敵方位置 4' AS Position FROM Record
        UNION ALL
        SELECT enemy_character_5_id AS CharterId, '敵方位置 5' AS Position FROM Record
    ) AS CombinedPositions
    JOIN Charter C ON C.CharterId = CombinedPositions.CharterId WHERE C.CHARTERID = :id
    GROUP BY C.CharterId, C.CharterName, Position
    ORDER BY C.CharterId, Position;");

    // Bind the id parameter
    $stmt->bindParam(':id', $charid, PDO::PARAM_INT);

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
