<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: mainpage.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nickname = $_POST['nickname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConfirmation = $_POST['passwordConfirmation'];

    if ($password !== $passwordConfirmation) {
        $error_message = "Password and confirmation password do not match.";
    } else {
        $dsn = 'mysql:host=localhost;dbname=dating_app_db';
        $username = 'root';
        $password_db = '';

        try {
            $db = new PDO($dsn, $username, $password_db);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "SELECT COUNT(*) FROM users WHERE nickname = :nickname OR email = :email";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':nickname', $nickname);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            if ($stmt->fetchColumn() > 0) {
                $error_message = "Nickname or email already exists.";
            } else {
                $query = "INSERT INTO users (nickname, email, password) VALUES (:nickname, :email, :password)";
                $stmt = $db->prepare($query);
                $stmt->bindParam(':nickname', $nickname);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $password);
                $stmt->execute();

                $_SESSION['user_id'] = $db->lastInsertId();
                header('Location: mainpage.php');
                exit();
            }
        } catch (PDOException $e) {
            $error_message = "Database connection error: " . $e->getMessage();
        }
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
            <label for="nickname">Nickname</label>
            <br>
            <input type="text" id="nickname" name="nickname">
            <br>
            <label for="email">Email</label>
            <br>
            <input type="email" id="email" name="email">
            <br>
            <label for="password">Password</label>
            <br>
            <input type="password" id="password" name="password">
            <br>
            <label for="passwordConfirmation">Confirm Password</label>
            <br>
            <input type="password" id="passwordConfirmation" name="passwordConfirmation">
            <br>
            <button type="submit" class="registerButton">Register</button>
            <p class="logInNowParagraph">Already have an account? <a href="login.php">Log in!</a></p>
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