<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['userId']) && isset($data['message'])) {
    $userId = $data['userId'];
    $message = $data['message'];

    // Establish a database connection
    $con = mysqli_connect('localhost', 'root', '', 'user');

    // Check connection
    if (!$con) {
        die(json_encode(['success' => false, 'message' => 'Connection failed: ' . mysqli_connect_error()]));
    }

    // Insert the message into the database
    $stmt = $con->prepare("INSERT INTO messages (user_id, message) VALUES (?, ?)");
    $stmt->bind_param("is", $userId, $message);
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to send message']);
    }

    // Close the statement and the database connection
    $stmt->close();
    mysqli_close($con);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
}
?>
