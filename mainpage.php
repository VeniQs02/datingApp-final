<?php
session_start();

if (!isset($_SESSION['user_id'])) {
header('Location: login.php');
exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Main page</title>
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
<main class="mainPageMainPart">
    <section class="mainPageSection">
        <div class="mainPageHeaders">
            <h3>Welcome to Tender!</h3>
            <h4>Let's get started!</h4>
        </div>
        <div class="mainPageText">
            <span>
                Tender is an application that allows you to meet amazing people.
                It was tested by German scientists, that 99.9% of Tender users get what they want!
                <br>
                <br>
                You can start anytime! Using our app is much prefered, but the website is all you need!
                The app is aviable <a href="download.php">here</a> and its really great.
                <br>
                <br>
                Really you should get the
                app instead (its over <a href="download.php">here</a>). Are you not intrested? there are little kittens and sweet dogs in there, what more
                do you want? I REALLY REAAALLYY advice you to check out that <a href="download.php">app</a>, and not use the web.
                <br>
                <br>
                <br>
                the app is <a href="download.php">here</a> if you haven't already noticed
            </span>
        </div>
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