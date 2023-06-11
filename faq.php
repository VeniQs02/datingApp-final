<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>FAQ</title>
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
<main class="mainPart mainPartFaq">
    <section class="mainPageSection">
        <div class="mainPageHeaders">
            <h3>Frequently asked questions:</h3>
        </div>
        <div class="mainPageText faqPageText">
            <h5>1. What is the SUCCess guarantee of relationship goals in your app? </h5>
            <p>There are none success guarantees, but we hope you have fun.</p>
            <h5>2. What is the age floor of this app?</h5>
            <p>If you're legal, then were legally able to put you on this website!</p>
            <h5>3. Will this amazing app run on my desktop?</h5>
            <p>It depends.</p>
            <h5>4. Will i ever find someone that matches my education level in this country?</h5>
            <p>If youre so sharp then you're surely gonna figure it out.</p>
            <h5>5. How much does it cost!</h5>
            <p>It's free real estate!</p>
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