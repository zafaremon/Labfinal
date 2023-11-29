<?php
// Check if the form is submitted using the POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection credentials
    $servername = "localhost"; // Replace with your server name
    $username = "root"; // Replace with your MySQL username
    $password = ""; // Replace with your MySQL password
    $dbname = "brta"; // Replace with your database name

    // Create a connection to the database
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check if the connection was successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data and sanitize inputs
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // SQL query to insert data into the table
    $sql = "INSERT INTO subscriptions (name, email) VALUES ('$name', '$email')";

    // Execute the query and check for success
    if ($conn->query($sql) === TRUE) {
        echo "Subscription successful!";
        header("refresh:2; url=index.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>