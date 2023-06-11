<?php
session_start();

$dsn = 'mysql:host=localhost;dbname=dating_app_db';
$username = 'root';
$password_db = '';

try {
    $db = new PDO($dsn, $username, $password_db);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $error_message = "Database connection error: " . $e->getMessage();
}

if (isset($_SESSION['user_id'])) {
    $adminId = $_SESSION['user_id'];
    $userId = $_POST['userId'];

    $query = "DELETE FROM users WHERE user_id = :userId";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();

    header('Location: userReports.php');
    exit();
} else {
    header('Location: notLoggedInPage.php');
    exit();
}
