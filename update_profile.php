<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: notLoggedInPage.php');
    exit();
}

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $gender = $_POST['gender'];
    $interest = $_POST['interest'];

    $query = "UPDATE users SET firstname = :firstName, lastname = :lastName, gender = :gender, interest = :interest WHERE user_id = :userID";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':firstName', $firstName);
    $stmt->bindParam(':lastName', $lastName);
    $stmt->bindParam(':gender', $gender);
    $stmt->bindParam(':interest', $interest);
    $stmt->bindParam(':userID', $userID);
    $stmt->execute();

    header('Location: userDetails.php');
    exit();
} else {
    header('Location: userDetails.php');
    exit();
}

