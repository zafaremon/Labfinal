<?php
session_start(); // Start session to maintain login status

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.html"); // Redirect to login if not logged in
    exit();
}

// Connect to the database
// (Replace with your database credentials)
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "brta";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve list of applicants in descending order by submission date
$sql = "SELECT * FROM license_applications	 ORDER BY submitted_at DESC";
$result = $conn->query($sql);
// Display dashboard content for logged-in users
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <a href="#"><img src="images/logo.png" class="logo" Salt=""></a>
        <nav>
            <ul id="navbar">
                <li><a class="active" href="#"><?php echo $_SESSION['username']; ?></a></li>
                <li><div id=""><a href="logout.php">Logout</a></div></li>
            </ul> 
        </nav>
    </header>

    <h1>List of Applicants</h1>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>NID</th>
                <th>Vehicle No</th>
                <th>Time of Appling</th>
                <th>View Detailes</th>
                <!-- Add more table headers for other applicant information -->
            </tr>
        </thead>
        <tbody id="view">
            <?php
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['email'] . '</td>';
                echo '<td>' . $row['nid'] . '</td>';
                echo '<td>' . $row['vehicle_no'] . '</td>';
                echo '<td>' . $row['submitted_at'] . '</td>';
                echo '<td><a href="applicant_details.php?id=' . $row['id'] . '"> View </a></td>';

                // Add more table cells for other applicant information
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
<?php

// Retrieve list of applicants in descending order by submission date
$sql = "SELECT * FROM subscriptions";
$result = $conn->query($sql);
?>

    <br>
    <br>
    <br>
    <h1>List of Subscribers</h1>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>View Detailes</th>
                <!-- Add more table headers for other applicant information -->
            </tr>
        </thead>
        <tbody id="view">
            <?php
            while ($subscriber = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $subscriber['name'] . '</td>';
                echo '<td>' . $subscriber['email'] . '</td>';
                echo '<td><a href="adminMaker.php?id=' . $subscriber['id'] . '"> Admin </a></td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>

</body>
</html>