<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <button id="messageButton" data-user-id="1"><i class='bx bx-message-dots'></i></button>   

    <div id="messageContainer" style="display: none" >
        <?php 
        $con = mysqli_connect('localhost', 'root', '', 'user');
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT message, sent_at FROM messages WHERE user_id = 1 ORDER BY sent_at DESC";
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<p>" . $row['message'] . " - " . $row['sent_at'] . "</p>";
        }
        ?>

    </div>

    
</body>
<script>
    document.getElementById('messageButton').addEventListener('click', function() {
        if(document.getElementById('messageContainer').style.display == 'none'){
            document.getElementById('messageContainer').style.display = 'block';
        }else{
            document.getElementById('messageContainer').style.display = 'none';
        }
        
       
    })
</script>
</html>
