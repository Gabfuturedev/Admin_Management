<?php 
$con = mysqli_connect('localhost', 'root', '', 'course_creation');
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Lessons</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php 
    $sql = "SELECT * FROM videolessons";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $videoId = $row['videoId'];
        $url = $row['videoPath'];
    
        echo "<div class='video-item'>
        <video controls>
            <source src='$url' type='video/mp4'>
        </video>
        <button onclick='reportVideo($videoId)'>Report</button>
        </div>";
    }
    ?>
    <script>
        function reportVideo(videoId) { 
            Swal.fire({ 
                title: 'Report Video',
                html: '<form id="reportForm" action="report_base_video.php" method="GET">' +
                      '<input type="hidden" name="videoId" value="' + videoId + '">' +
                      '<label for="timestamp">Reportable Part (timestamp):</label>' +
                      '<input type="text" id="timestamp" name="timestamp" placeholder="e.g., 1:23" required>' +
                       '<label for="reason">Reason  for Reporting:</label>' +
                      '<select id="reason" name="reason" required>' +
                      '<option value="Inappropriate Content">Inappropriate Content</option>' +
                      '<option value="Copyright Violation">Copyright Violation</option>' +
                      '<option value="Other">Other</option>' +
                      '</select>' +
                      '<button type="submit">Submit</button>' +
                      '</form>',
                showConfirmButton: false
            });
        }
    </script>
</body>
</html>
