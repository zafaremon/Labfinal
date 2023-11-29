<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "brta";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Directory to store uploaded files
    $uploadDir = "uploads/";

    // Collect form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $nid = $_POST["nid"];
    $vehicleNo = $_POST["vehicleNo"];
    $chassisNo = $_POST["chassisNo"];
    $presentAddress = $_POST["presentAddress"];
    $permanentAddress = $_POST["permanentAddress"];

    // File upload handling
    $photoUpload = $_FILES["photo"];
    $nidCopyUpload = $_FILES["nidCopy"];

    // Handle photo upload
    $photoName = $photoUpload["name"];
    $photoTmpName = $photoUpload["tmp_name"];
    $photoPath = $uploadDir . basename($photoName);

    // Handle NID copy upload
    $nidCopyName = $nidCopyUpload["name"];
    $nidCopyTmpName = $nidCopyUpload["tmp_name"];
    $nidCopyPath = $uploadDir . basename($nidCopyName);

    // Move uploaded files to the designated directory
    if (move_uploaded_file($photoTmpName, $photoPath) && move_uploaded_file($nidCopyTmpName, $nidCopyPath)) {
        // Prepare SQL statement to insert data into the database
        $sql = "INSERT INTO license_applications (name, email, nid, vehicle_no, chassis_no, photo_path, nid_copy_path, present_address, permanent_address)
                VALUES ('$name', '$email', '$nid', '$vehicleNo', '$chassisNo', '$photoPath', '$nidCopyPath', '$presentAddress', '$permanentAddress')";

        if ($conn->query($sql) === TRUE) {
            // Display a success message
            echo "Form submitted successfully!";
            header("refresh:2; url=form.html");
            exit();
        } else {
            // Error handling if database insertion fails
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // Error handling if file uploads fail
        echo "Error uploading files.";
    }
} else {
    // Redirect if accessed directly without form submission
    header("Location: form.html");
    exit;
}

// Close database connection
$conn->close();
?>