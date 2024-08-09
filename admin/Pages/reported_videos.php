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
    <title>Reported Videos</title>
    <style>
       
        h1 {
            text-align: center;
        }
        .report-item {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }
        .video-container {
            position: relative;
            width: auto;
            height: 500px;
            overflow: hidden;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        .video-container video {
            width: 100%;
            height: 100%;
        }
        .description {
            text-align: center;
            margin: 10px 0;
            font-size: 1.2em;
        }
        .actions {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 10px 0;
        }
        .actions button {
            background-color: transparent;
            border: none;
            cursor: pointer;
            font-size: 1.5em;
        }
        .actions button.approve {
            color: green;
        }
        .actions button.delete {
            color: red;
        }
        .reason {
            background-color: #eee;
            padding: 10px;
            border-radius: 8px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <!-- <h1>Reported Videos</h1> -->
    <?php 
    $sql = "SELECT vr.videoId, vr.timestamp, vr.reportTime, vl.videoPath, vr.reason
            FROM video_reports vr
            JOIN videolessons vl ON vr.videoId = vl.videoId
            WHERE vr.status = 0";
    $result = mysqli_query($con, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $videoId = $row['videoId'];
            $timestamp = $row['timestamp'];
            $videoPath = $row['videoPath'];
            $reason = $row['reason'];

            // Convert the timestamp to seconds
            list($minutes, $seconds) = explode(':', $timestamp);
            $startTime = ($minutes * 60) + $seconds;
        ?>
        <div class="report-item">
            <div class="video-container">
                <video id="video_<?php echo $videoId; ?>" controls>
                    <source src="<?php echo $videoPath; ?>" type="video/mp4">
                </video>
            </div>
            <div class="description">
                <button onclick="playVideoFromTimestamp(<?php echo $videoId; ?>, <?php echo $startTime; ?>)">Play from <?php echo $timestamp; ?></button>
            </div>
            <div class="actions">
                <button class="approve" onclick="approveReport(<?php echo $videoId; ?>)">&#10004;</button>
                <button class="delete" onclick="deleteReport(<?php echo $videoId; ?>)">&#128465;</button>
            </div>
            <div class="reason"><?php echo $reason; ?></div>
        </div>
        <?php
        }
    } else {
        echo "Error: " . mysqli_error($con);
    }
    ?>
    <script>
        function playVideoFromTimestamp(videoId, startTime) {
            var video = document.getElementById('video_' + videoId);
            video.currentTime = startTime;
            video.play();
        }

        function approveReport(videoId) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'Ajax/approve_report.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        if (xhr.status === 200) {
            alert('Report approved for video ID: ' + videoId);
            location.reload(); // Reload the page to reflect changes
        } else {
            alert('Error approving report');
        }
    };
    xhr.send('videoId=' + videoId);
}

function deleteReport(videoId) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'Ajax/delete_report.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        if (xhr.status === 200) {
            alert('Report deleted for video ID: ' + videoId);
            location.reload(); // Reload the page to reflect changes
        } else {
            alert('Error deleting report');
        }
    };
    xhr.send('videoId=' + videoId);
}

    </script>
</body>
</html>
<?php 
mysqli_close($con);
?>
