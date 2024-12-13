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
    
    
    // Prepare the SQL statement with a placeholder
    $stmt = $pdo->prepare("SELECT C.chartername, O.OccuptionName
FROM Charter C
JOIN Occuption O ON C.occuptionID = O.OccuptionId  
;");

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
