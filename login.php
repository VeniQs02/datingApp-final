<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: mainpage.php');
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nickname = $_POST['nickname'];
    $password = $_POST['password'];
    echo $password." ".$nickname;

    $dsn = 'mysql:host=localhost;dbname=dating_app_db';
    $username = 'root';
    $password_db = '';

    try {
        $db = new PDO($dsn, $username, $password_db);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "SELECT user_id, password FROM users WHERE nickname = :nickname";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':nickname', $nickname);
        $stmt->execute();


        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $password_from_db = $row['password'];

            if ($password == $password_from_db) {
                $_SESSION['user_id'] = $row['user_id'];
                header('Location: mainpage.php');
                exit();
            } else {
                $error_message = "Invalid credentials. Please try again.";
            }
        } else {
            $error_message = "Invalid credentials. Please try again.";
        }
    } catch (PDOException $e) {
        $error_message = "Database connection error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Log In</title>
    <link rel="stylesheet" href="main.css">
    <link rel="shortcut icon" href="images/firelogo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<nav class="navMain">
    <div class="navHeader">
        <h1><a href="index.php"><img class="navImage" src="images/firelogo.png" alt="logo">Tender</a></h1>
        <h2>Cozy place for cozy people</h2>
    </div>
    <ul>
        <li class="LIST"><a href="mainpage.php">Main page</a></li>
        <li class="LIST"><a href="download.php">Download</a></li>
        <li class="LIST"><a href="contact.php">Contact</a></li>
        <li class="LIST"><a href="faq.php">FAQ</a></li>
    </ul>
</nav>
<main class="mainPart mainPartLogIn">
    <section class="logInNowSection">
        <form action="" method="POST">
            <label for="nickname" class="logInNowLabel">Nickname</label>
            <br>
            <input type="text" id="nickname" name="nickname">
            <br>
            <label for="password" class="logInNowLabel">Password</label>
            <br>
            <input type="password" id="password" name="password">
            <br>
            <button type="submit" class="logInNowButton">Log in</button>
            <br>
            <p class="logInNowParagraph">Not registered? <a href="register.php">Register now!</a></p>
        </form>
        <?php if (isset($error_message)) : ?>
        <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
    </section>
</main>
<footer>
    <h4>Befriending people never was so easy!</h4>
    <label>
        <button onclick="alert('Bonk!');">Horny?</button>
    </label>
</footer>
</body>
</html>