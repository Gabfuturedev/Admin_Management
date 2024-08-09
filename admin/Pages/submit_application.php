<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contest";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle file uploads
function uploadFile($file, $targetDir) {
    // Ensure the target directory exists, and create it if not
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $targetFilePath = $targetDir . basename($file["name"]);
    if (move_uploaded_file($file["tmp_name"], $targetFilePath)) {
        return $targetFilePath;
    } else {
        return null;
    }
}

$firstName = $_POST['firstName'];
$email = $_POST['email'];
$conNum = $_POST['conNum'];
$streetAddress = $_POST['streetAddress'];
$city = $_POST['city'];
$province = $_POST['province'];
$zipCode = $_POST['zipCode'];
$date = date('Y-m-d'); // Current date

$appLetterPath = uploadFile($_FILES['appLetter'], './application_form/appLetter/');
$cvPath = uploadFile($_FILES['cv'], './application_form/cv/');
$picturePath = uploadFile($_FILES['picture'], './application_form/picture/');
$valIdPath = uploadFile($_FILES['valId'], './application_form/valId/');

if ($appLetterPath && $cvPath && $picturePath && $valIdPath) {
    $stmt = $conn->prepare("INSERT INTO contbl (firstName, email, conNum, streetAddress, city, province, zipCode, appLetter, cv, picture, valId, date, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0)");
    $stmt->bind_param("ssssssssssss", $firstName, $email, $conNum, $streetAddress, $city, $province, $zipCode, $appLetterPath, $cvPath, $picturePath, $valIdPath, $date);

    if ($stmt->execute()) {
        echo "Application submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "File upload failed!";
}

$conn->close();
?>
