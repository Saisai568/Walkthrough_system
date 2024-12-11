<?php
session_start(); // 啟動 session
unset($_SESSION['username']); // 刪除 session 中的 username
http_response_code(200); // 回傳成功狀態碼
header("Location: index.php");
?>
