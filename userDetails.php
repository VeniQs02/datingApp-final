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

$query = "SELECT nickname, email, password, firstname, lastname, gender, interest FROM users WHERE user_id = :userID";
$stmt = $db->prepare($query);
$stmt->bindParam(':userID', $userID);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$nickname = $user['nickname'];
$email = $user['email'];
$password = $user['password'];
$firstName = $user['firstname'];
$lastName = $user['lastname'];
$gender = $user['gender'];
$interest = $user['interest'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User details</title>
    <link rel="stylesheet" href="main.css">
    <link rel="shortcut icon" href="images/firelogo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="script.js"></script>
    <style>
        .personalInfoForm {
            display: none;
            color: white;
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 20px;
            padding: 30px;
            margin-top: 20px;
            transition: display 0.5s ease;
        }

        .personalInfoForm.show {
            display: block;
        }
    </style>
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
<main class="mainPart userDetailsPart">
    <section class="mainPageSection userDetailsSection">
        <p>Avatar: <a href="#"> <img src="images/firelogo.png" alt="awatar" style="width: 50px"></a></p>
        <p>User: <?php echo $nickname; ?> </p>
        <label for="userPassword">Password:</label>
        <input type="password" id="userPassword" name="userPassword" value="<?php echo $password; ?>">
        <label>
            <input type="checkbox" onclick="showUserPassword()"> Show Password
        </label>
        <br><br>
        <form method="POST" action="update_password.php">
            <label for="newPassword">Change Password:</label>
            <input type="password" id="newPassword" name="newPassword" required>
            <input type="submit" value="Update Password">
        </form>
        <p>Email: <?php echo $email; ?> </p>
        <p>First Name: <?php echo $firstName; ?> </p>
        <p>Last Name: <?php echo $lastName; ?> </p>
        <p>Gender: <?php echo $gender; ?> </p>
        <p>Interest: <?php echo $interest; ?> </p>
        <br>
        <p style="font-size:40px; cursor: pointer; color: white; background-color: rgba(0, 0, 0, 0.7); border-radius: 20px; padding:30px;"
           onmouseover="this.style.backgroundColor='rgba(0, 0, 0, 0.9)'"
           onmouseout="this.style.backgroundColor='rgba(0, 0, 0, 0.7)'"
           onclick="togglePersonalInfoForm()">Change personal info:</p>
        <form method="POST" action="update_profile.php" class="personalInfoForm" style="color: white; background-color: rgba(0, 0, 0, 0.7); border-radius: 20px; padding:30px;">
            <label for="firstName">First Name:  </label><br>
            <input type="text" id="firstName" name="firstName" value="<?php echo $firstName; ?>" required><br>
            <label for="lastName">Last Name:  </label><br>
            <input type="text" id="lastName" name="lastName" value="<?php echo $lastName; ?>" required><br>
            <label for="gender">Gender:  </label><br>
            <input type="text" id="gender" name="gender" value="<?php echo $gender; ?>" required><br>
            <label for="interest">Interest:  </label><br>
            <input type="text" id="interest" name="interest" value="<?php echo $interest; ?>" required><br>
            <input type="submit" value="Update Profile">
        </form>
    </section>
</main>

<footer>
    <h4>Befriending people never was so easy!</h4>
    <label>
        <button onclick="alert('Bonk!');">Horny?</button>
    </label>
</footer>
<script>
    function togglePersonalInfoForm() {
        const form = document.querySelector('.personalInfoForm');
        form.classList.toggle('show');
    }
</script>

</body>
</html>
