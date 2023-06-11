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

$userID = $_SESSION['user_id'];
$newPassword = $_POST['newPassword'];

$query = "UPDATE users SET password = :newPassword WHERE user_id = :userID";
$stmt = $db->prepare($query);
$stmt->bindParam(':newPassword', $newPassword);
$stmt->bindParam(':userID', $userID);
$stmt->execute();

header('Location: userDetails.php');
exit();
