<?php
// Database connection
$announcement_con = mysqli_connect("localhost", "root", "", "announcementDB");

if (!$announcement_con) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        $announcementId = $_POST['id'];

        if ($action == 'publish') {
            $sql = "UPDATE announcement SET status = 1 WHERE id = '$announcementId'";
        } elseif ($action == 'edit') {
            // Implement edit logic here
            // Example: $newTitle = $_POST['new_title'];
            // $newContent = $_POST['new_content'];
            // $sql = "UPDATE announcement SET title = '$newTitle', announcement_content = '$newContent' WHERE id = '$announcementId'";
        } elseif ($action == 'delete') {
            $sql = "DELETE FROM announcement WHERE id = '$announcementId'";
        }

        if (mysqli_query($announcement_con, $sql)) {
            echo json_encode(['status' => 'success', 'message' => ucfirst($action) . 'ed successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error: ' . mysqli_error($announcement_con)]);
        }
    }
}

mysqli_close($announcement_con);
?>
