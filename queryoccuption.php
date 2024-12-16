<?php
require "load.php";

try {
    $pdo = new PDO("mysql:host=$db_server;dbname=$db_name;charset=utf8", $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $input = json_decode(file_get_contents('php://input'), true);
    if (!$input || !isset($input['occuptionname'])) {
        throw new Exception('Invalid JSON input or missing occuptionname.');
    }

    $occuptionid = $input['occuptionname']; // Ensure this maps correctly from input

    // Prepare the SQL statement with a placeholder
    $stmt = $pdo->prepare("SELECT C.CharterName, O.OccuptionName
                           FROM Charter C
                           JOIN Occuption O ON C.occuptionid = O.OccuptionId
                           WHERE C.occuptionid = :id;");

    // Bind the id parameter
    $stmt->bindParam(':id', $occuptionid, PDO::PARAM_INT);

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
