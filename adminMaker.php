<?php
session_start(); // Start session to maintain login status

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.html"); // Redirect to login if not logged in
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
</head>
<body>
    <header>
        <a href="#"><img src="images/logo.png" class="logo" Salt=""></a>
        <nav>
            <ul id="navbar">
                <li><a class="active" href="#"><?php echo $_SESSION['username']; ?></a></li>
                <li><div id=""><a href="dashboard.php">Back</a></div></li>
            </ul> 
        </nav>
    </header>

  <main>
    <form id="registerForm" action="register.php" method="post">
        <div class="form-group">
            <label for="username">Username: </label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Make As Admin</button>
    </form>
  </main>
<script src="script.js"></script>
<script src="script2.js"></script>
</body>
</html>