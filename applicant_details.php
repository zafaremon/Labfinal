<?php
session_start();
// Check if the user is logged in, if not, redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
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

if (isset($_GET['id'])) {
    $applicant_id = $_GET['id'];

    // Retrieve applicant details by ID
    $sql = "SELECT * FROM license_applications WHERE id = $applicant_id";
    $result = $conn->query($sql);

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
                <li><div id=""><a href="dashboard.php">Back</a></div></li>
            </ul> 
        </nav>
    </header>
    <section class="detailes">
    <h1>Detailes of Applicants</h1>
    <table>
        <tbody id="view">
            <?php
            if ($result->num_rows == 1) {
                $applicant = $result->fetch_assoc();

                echo '<tr>';
                echo "<p>Name: " . $applicant['name'] . "</p>";
                echo '</tr>';
                echo '<tr>';
                echo "<p>Email: " . $applicant['email'] . "</p>";
                echo '</tr>';
                echo '<tr>';
                echo "<p>NID: " . $applicant['nid'] . "</p>";
                echo '</tr>';
                echo '<tr>';
                echo "<p>Vehicle No: " . $applicant['vehicle_no'] . "</p>";
                echo '</tr>';
                echo '<tr>';
                echo "<p>Chassis No: " . $applicant['chassis_no'] . "</p>";
                echo '</tr>';
                echo '<tr>';
                echo "<p>Passport Size Photo: <img src='" . $applicant['photo_path'] . "'height='100px' width='100px' alt='Photo'></p>";
                echo '</tr>';
                echo '<tr>';
                echo "<p>NID Soft Copy: <a href='" . $applicant['nid_copy_path'] . "'>View NID Copy</a></p>";
                echo '</tr>';
                echo '<tr>';
                echo "<p>Present Address: " . $applicant['present_address'] . "</p>";
                echo '</tr>';
                echo '<tr>';
                echo "<p>Permanent Address: " . $applicant['permanent_address'] . "</p>";
                echo '</tr>';
                
            }
            else {
                echo "Invalid request";
            }
    
            $conn->close();
        }
            ?>
            
        </tbody>
    </table>
    </section>
</body>
</html>