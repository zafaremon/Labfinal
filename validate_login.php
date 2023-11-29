<?php
session_start(); // Start session to persist login status

// Check if the form is submitted with POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    

    // Connect to your database (replace database credentials accordingly)
    $servername = "localhost"; 
    $username = "root"; 
    $password = "";
    $dbname = "brta"; 

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $_POST["username"];
    $password = $_POST["password"];
    // Validate user credentials
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Valid credentials - Set session and redirect to dashboard or home page
            $_SESSION['username'] = $username;
            header("Location: dashboard.php"); // Redirect to dashboard or home page
            exit();
        }
    }

    // Invalid credentials - Redirect back to login with an error message
    header("Location: login.html?error=1");
    exit();
} else {
    // Redirect if accessed directly without form submission
    header("Location: login.html");
    exit();
}
?>