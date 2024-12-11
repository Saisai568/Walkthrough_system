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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form inputs
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate inputs
    if (empty($username) || empty($email) || empty($password)) {
        echo "All fields are required!";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format!";
        exit;
    }

    // Check if the username or email already exists
    $checkSql = "SELECT * FROM user WHERE username = ? OR email = ?";
    $stmt = $mydb->prepare($checkSql);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Username or email already exists!";
        $stmt->close();
        $mydb->close();
        exit;
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Insert the new user
    $sql = "INSERT INTO user (username, email, password) VALUES (?, ?, ?)";
    $stmt = $mydb->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        echo "Registration successful! You can now <a href='register_login.php'>log in</a>.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$mydb->close();
?>
