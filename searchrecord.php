<?php
require "load.php";


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

try {
    $pdo = new PDO("mysql:host=$db_server;dbname=$db_name", $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $input = json_decode(file_get_contents('php://input'), true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        http_response_code(400);
        echo json_encode(["error" => "Invalid JSON input"]);
        exit;
    }

    $query = "SELECT Recordid, player_id, created_at,
              CONCAT(ally_character_1_id, ',', ally_character_2_id, ',', ally_character_3_id, ally_character_3_id, ',', ally_character_4_id, ',', ally_character_5_id) AS allyCharacters,
              CONCAT(enemy_character_1_id, ',', enemy_character_2_id, ',', enemy_character_3_id, ',', enemy_character_4_id, ',', enemy_character_5_id) AS enemyCharacters
              FROM Record WHERE 1=1";
    $params = [];
    
    if (isset($input['character']) && !empty($input['character'])) {
        $query .= " AND (
            FIND_IN_SET((SELECT charterid FROM charter WHERE CharterName LIKE :character), CONCAT(ally_character_1_id, ',', ally_character_2_id, ',', ally_character_3_id, ',', ally_character_4_id, ',', ally_character_5_id)) > 0
            OR FIND_IN_SET((SELECT charterid FROM charter WHERE CharterName LIKE :character), CONCAT(enemy_character_1_id, ',', enemy_character_2_id, ',', enemy_character_3_id, ',', enemy_character_4_id, ',', enemy_character_5_id)) > 0
        )";
        
        $params[':character'] = $input['character'];
    }
    
    if (isset($input['player']) && !empty($input['player'])) {
        $query .= " AND player_id = (SELECT userid FROM user WHERE Username LIKE :player)";
        $params[':player'] = "%" . $input['player'] . "%";
    }
    
    if (isset($input['time']) && !empty($input['time'])) {
        if ($input['time'] === 'week') {
            $query .= " AND created_at >= DATE_SUB(NOW(), INTERVAL 1 WEEK)";
        } elseif ($input['time'] === 'month') {
            $query .= " AND created_at >= DATE_SUB(NOW(), INTERVAL 1 MONTH)";
        }
    }
   

    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($records as &$record) {
        $playerStmt = $pdo->prepare("SELECT username FROM user WHERE userid = :player_id");
        $playerStmt->execute([':player_id' => $record['player_id']]);
        $record['playerName'] = $playerStmt->fetchColumn() ?: 'Unknown';
    }

    echo json_encode($records);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => "Error: " . $e->getMessage()]);
}
?>
