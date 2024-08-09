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

$id = $_GET['id'];
$status = $_GET['status'];

$sql = "UPDATE contbl SET status=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $status, $id);

if ($stmt->execute()) {
    header("Location: /admin/index.php?users");
    // echo "Record updated successfully";
} else {
    echo "Error updating record: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
