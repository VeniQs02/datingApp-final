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

$query = "SELECT user_id, nickname, registration_date, report_reason FROM users WHERE report_reason IS NOT NULL";
$stmt = $db->prepare($query);
$stmt->execute();
$userReports = $stmt->fetchAll(PDO::FETCH_ASSOC);

$query2 = "SELECT user_id, nickname, registration_date, report_reason FROM users WHERE report_reason IS NULL";
$stmt2 = $db->prepare($query2);
$stmt2->execute();
$userReports2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User reports</title>
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
<main class="mainPart repotPagePart" style="display: flex; flex-direction: column; flex-wrap:wrap;">
    <h4 style="font-size: 30px; color: white; background-color: rgba(0, 0, 0, 0.7); border-radius: 20px;  padding:30px; height: auto">Reported Users:</h4>
    <div style="width:auto; display:flex; flex-wrap: wrap;">

    <?php foreach ($userReports as $report): ?>
        <section class="reportPageSection mainPageSectionREPORTRE" style="color: white; background-color: rgba(0, 0, 0, 0.7);  border-radius: 20px; padding:30px; height: auto; max-width: 30%">
            <h4>User: <br><?php echo $report['nickname']; ?></h4>
            <p>Registration date: <br><?php echo $report['registration_date']; ?></p>
            <p>Report title: <br><?php echo $report['report_reason']; ?></p>
            <form method="POST" action="remove_user.php">
                <input type="hidden" name="userId" value="<?php echo $report['user_id']; ?>">
                <input type="submit" value="Remove">
            </form>
        </section>
    <?php endforeach; ?>
    </div>
    <h4 style="font-size: 30px; color: white; background-color: rgba(0, 0, 0, 0.7); border-radius: 20px; padding:30px; height: auto">non-Reported Users:</h4>
    <div style="width:auto; display:flex; flex-wrap: wrap;">

    <?php foreach ($userReports2 as $report): ?>
        <section class="reportPageSection mainPageSectionREPORTRE" style="color: white; background-color: rgba(0, 0, 0, 0.7);  border-radius: 20px;  padding:30px; height: auto">
            <h4>User: <br><?php echo $report['nickname']; ?></h4>
            <p>Registration date: <br><?php echo $report['registration_date']; ?></p>
            <form method="POST" action="remove_user.php">
                <input type="hidden" name="userId" value="<?php echo $report['user_id']; ?>">
                <input type="submit" value="Remove">
            </form>
        </section>
    <?php endforeach; ?>
    </div>
</main>
<footer>
    <h4>Befriending people never was so easy!</h4>
    <label>
        <button onclick="alert('Bonk!');">Horny?</button>
    </label>
</footer>
</body>
</html>