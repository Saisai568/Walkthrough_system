<?php
require "load.php";

session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form inputs
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validate inputs
    if (empty($username) || empty($password)) {
        echo "All fields are required!";
        exit;
    }

    // Check if the username or email exists
    $sql = "SELECT * FROM user WHERE username = ? ";
    $stmt = $mydb->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $mydb->error);
    }
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo "Invalid username or password!";
        $stmt->close();
        $mydb->close();
        exit;
    }

    // Fetch the user record
    $user = $result->fetch_assoc();
    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    // Verify the password
    if ($password == $user['Password']) {

        // 設定 Session，表示用戶已登入
        $_SESSION['username'] = $username;
        echo "Login successful! Welcome, " . htmlspecialchars($user['UserName']) . "!";
        header("Location: index.php");
        // You can redirect to another page or set session variables here
    } else {
        echo "Invalid username or password!";?>
        <a href="index.php">回首頁</a>
    <?php
    }

    $stmt->close();
}

$mydb->close();
?>
