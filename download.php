<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Download</title>
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
<main class="mainPart">
    <section class="downloadPageDowdnloadSection">
        <a href="images/funny-man.png" download="funny-man.png" class="downloadPageDowdnloadButton">
            DOWNLOAD <img src="images/down-arrow.png" alt="download arrow">
        </a>
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