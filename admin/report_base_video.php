<?php
$con = mysqli_connect('localhost', 'root', '', 'course_creation');
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['videoId']) && isset($_GET['timestamp'])) {
    $videoId = mysqli_real_escape_string($con, $_GET['videoId']);
    $timestamp = mysqli_real_escape_string($con, $_GET['timestamp']);
    $reason = mysqli_real_escape_string($con, $_GET['reason']);

    $sql = "INSERT INTO video_reports (videoId, timestamp, reason) VALUES ('$videoId', '$timestamp', '$reason')";
    
    if (mysqli_query($con, $sql)) {
        echo "Report submitted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
}
mysqli_close($con);
?>
