<?php
// session_start();

// Check if the user is logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$userId = $_SESSION['id']; // Use the session variable correctly

// Database connection
$conn = mysqli_connect("localhost", "root", "", "announcementDB");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update profile
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validate input
    if (empty($fullname) || empty($email) || empty($username) || empty($password)) {
        die("All fields are required.");
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare update query
    $stmt = $conn->prepare("UPDATE admins SET fullname = ?, email = ?, username = ?, password = ? WHERE id = ?");
    
    // Check if prepare failed
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ssssi", $fullname, $email, $username, $hashed_password, $userId);

    // Execute query
    if ($stmt->execute()) {
        // Redirect with a success message
        header("Location: /admin/index.php?settings&status=success");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<style>
.setting-container {
    width: 80%;
    /* max-width: 800px; */
    background-color: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 10px 10px rgba(0, 0, 0, 0.25);
}

.setting-nav {
    display: flex;
    justify-content: space-around;
    margin-bottom: 20px;
}

.tab-button {
    background-color: transparent;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    font-size: 16px;
    border-bottom: 2px solid transparent;
}

.tab-button.active {
    border-bottom: 2px solid black;
    font-weight: bold;
}

.setting-content {
    display: none;
}

.setting-content.active {
    display: block;
}

.account-setting-content {
    padding: 20px;
    background-color: white;
    border: 1px solid black;
    border-radius: 10px;
    box-shadow: 0 10px 10px rgba(0, 0, 0, 0.25);
}

.account-setting-form {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    width: 100%;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.label {
    font-weight: bold;
    font-size: 14px;
    margin-bottom: 5px;
}

.input {
    width: 100%;
    padding: 10px;
    border: 1px solid black;
    border-radius: 5px;
    font-size: 14px;
}.update-profile-btn{
    width: 100%;
    padding: 10px;
    border: 1px solid black;
    border-radius: 5px;
    font-size: 14px;
    background-color: green;
    color: white;
    cursor: pointer;
    transition: background-color 0.3s ease;
}.update-profile-btn:hover{
    background-color: darkgreen;
}.login-activity-item{
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
    padding: 10px;
    border: 1px solid black;
    border-radius: 5px;
    font-size: 14px;
    background-color: white;
    color: black;
}
</style>
<body>
    <div class="setting-container">
        <div class="setting-nav">
            <button class="tab-button active" onclick="showTab('account-setting-content')">Account Settings</button>
            <button class="tab-button" onclick="showTab('login-activity-content')">Account Login Activity</button>
        </div>
        <div id="account-setting-content" class="setting-content active">
            <div class="account-setting-content">
                <form action="" method="post" class="account-setting-form">
                    <div class="form-group">
                        <label for="fullname" class="label">Full Name</label>
                        <input type="text" class="input" placeholder="Enter Full Name" name="fullname">
                    </div>
                    <div class="form-group">
                        <label for="email" class="label">Email</label>
                        <input type="email" class="input" placeholder="Juan@example.com" name="email">
                    </div>
                    <div class="form-group">
                        <label for="username" class="label">Username</label>
                        <input type="text" class="input" placeholder="juan123" name="username">
                    </div>
                    <div class="form-group">
                        <label for="password" class="label">Password</label>
                        <input type="password" class="input" placeholder="********" name="password">
                    </div>
                    <button type="submit" class="update-profile-btn" >Update Profile</button>
                </form>
                
            </div>
        </div>
        <div id="login-activity-content" class="setting-content">
            <!-- Content for Account Login Activity -->
            <?php 
            
            // $_SESSION['id'] = $user_id;
            $conn = mysqli_connect("localhost", "root", "", "announcementDB");

            $sql = "SELECT * FROM admins";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {

                    echo "<div class='login-activity-item'>";
                    echo "<p><strong>Admin ID:</strong> " . $row['id'] . "</p>";
                    echo "<p><strong>User ID:</strong> " . $row['username'] . "</p>";
                    // echo "<p><strong>Password:</strong> " . $row['password'] . "</p>";
                    echo "<p><strong>ip</strong> " . $row['ip_address'] . "</p>";
                    echo "<p><strong>login time</strong> " . $row['login_time'] . "</p>";
                    echo "<hr>";
                    echo "</div>";
                }
            } else {
                echo "No login activity found.";
            }
            
            
            
            ?>
        </div>
    </div>
    <script>
        function showTab(tabName) {
    const tabs = document.querySelectorAll('.setting-content');
    const buttons = document.querySelectorAll('.tab-button');

    tabs.forEach(tab => {
        tab.classList.remove('active');
    });

    buttons.forEach(button => {
        button.classList.remove('active');
    });

    document.getElementById(tabName).classList.add('active');
    document.querySelector(`[onclick="showTab('${tabName}')"]`).classList.add('active');
}

    </script>
</body>
</html>
