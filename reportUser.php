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

if (isset($_SESSION['user_id'])) {
    $userRole = $_SESSION['user_id'];

    if ($userRole != '13') {
        header('Location: notLoggedInPage.php');
        exit();
    }
} else {
    header('Location: notLoggedInPage.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reportedUserId = $_POST['user_id'];
    $reportReason = $_POST['report_reason'];

    $query = "SELECT report_reason FROM users WHERE user_id = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$reportedUserId]);
    $currentReportReason = $stmt->fetchColumn();

    if($currentReportReason !== false && $currentReportReason !== null){
        $finalReportReason = $currentReportReason.", ".$reportReason;
        $query = "UPDATE users SET report_reason = ? WHERE user_id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$finalReportReason, $reportedUserId]);
    } else{
        $query = "INSERT INTO users (user_id, report_reason) VALUES (?, ?)";
        $stmt = $db->prepare($query);
        $stmt->execute([$reportedUserId, $reportReason]);
    }

    header('Location: mainPage.php');
    echo '<script>alert("Report successful");</script>';
    exit();
}

$query = "SELECT user_id, nickname, registration_date FROM users";
$stmt = $db->prepare($query);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Report User</title>
    <link rel="stylesheet" href="main.css">
    <link rel="shortcut icon" href="images/firelogo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<nav class="navMain">
    <div class="navHeader">
        <h1><a href="index.php"><img class="navImage" src="images/firelogo.png" alt="logo">Tender</a></h1>
        <h2>Cozy place for cozy people</h2>
        <?php if (isset($_SESSION['user_id'])) : ?>
            <a class="navLog" href="logout.php">
                <button class="navLogIn">Log out</button>
            </a>
        <?php else : ?>
            <a class="navLog" href="login.php">
                <button class="navLogIn">Log in</button>
            </a>
        <?php endif; ?>
    </div>
    <ul>
        <li class="LIST"><a href="mainpage.php">Main page</a></li>
        <li class="LIST"><a href="download.php">Download</a></li>
        <li class="LIST"><a href="contact.php">Contact</a></li>
        <li class="LIST"><a href="faq.php">FAQ</a></li>
    </ul>
</nav>
<main class="mainPart repotPagePart" style="height: 300px">
    <h2>Report User</h2>
    <form method="POST" action="">
        <label for="reportedUser">Select a user to report:</label>
        <select name="user_id" id="reportedUser">
            <?php foreach ($users as $user): ?>
                <option value="<?php echo $user['user_id']; ?>"><?php echo $user['nickname']; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="reportReason">Reason for the report:</label>
        <textarea name="report_reason" id="reportReason" rows="4" cols="40"></textarea>
        <input type="submit" value="Report">
    </form>
</main>
<footer>
    <h4>Befriending people never was so easy!</h4>
    <label>
        <button onclick="alert('Bonk!');">Horny?</button>
    </label>
</footer>
</body>
</html>