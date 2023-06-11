<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Contact</title>
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
            <h3>Contact Page</h3>
        </div>
        <div class="mainPageText">
            <span class = "contactPageSection">
                You can contact us through: <br>
                - <a href="#">whattsapp</a> <img src="images/whatsapp.png" alt="whattsapp"> <br>
                - <a href="#">telegram</a> <img src="images/telegram.webp" alt="telegram"> <br>
                - <a href="#">discord</a> <img src="images/discord.jpg" alt="discord"> <br>
                - <a href="#">facebook</a> <img src="images/fb.png" alt="facebook"> <br>
                - <a href="#">linkedIn</a> <img src="images/linkedIN.png" alt="linkedin"> <br>
                - <a href="#">tiktok</a> <img src="images/tiktok-ikona.png" alt="tiktok"> <br>
                - <a href="#">instagram</a> <img src="images/Instagram.jpg" alt="instagram"> <br>
                - <a href="#">snapchat</a> <img src="images/snap.png" alt="snapchat"> <br>
                - <a href="#">youtube</a> <img src="images/youtube.png" alt="youtube"> <br>
                - <a href="#">tinder</a> <img src="images/tinder.png" alt="tinder"> <br>
                - <a href="#">nasza klasa</a> <img src="images/naszaklasa.png" alt="nasza klasa"> <br>
                - <a href="#">msn</a> <img src="images/msn.jpg" alt="msn"> <br>
                - <a href="#">aol</a> <img src="images/aolwebp.webp" alt="aol"> <br>
                - <a href="#">yandex</a> <img src="images/yandex.png" alt="yandex"> <br>
                - <a href="#">baidu</a> <img src="images/baidou.jpg" alt="baidu"> <br>
                - <a href="#">onlyfans</a> <img src="images/onlyfans.webp" alt="onlyfans"> <br>

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