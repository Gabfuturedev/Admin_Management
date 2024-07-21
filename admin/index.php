<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</head>
<style>
    @media (max-width: 768px) {
.main-container{
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}.vertical-nav, form{
    width: 5%;
    height: 100%; 
    background-image: linear-gradient(#FFE08F, #DEC4AC); 
    display: flex;
    flex-direction: column;
    align-items: center; 
    /* justify-content: space-between;  */
    margin-left: 5px;
    
}
.logo-container{
    width: 20%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    /* background-color: rgba(0, 0, 0, 0); */
}.logo{
    width: 100%;
    height: 100%;
    font-weight: 600;
    font-size: 30px;
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    color: #333;
    font-size: 1.50em;
}.logo2{
    background: url(grass.jpg);
    background-size: contain;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    -webkit-background-clip: text;
    width: 100%;
    height: 100%;
    font-size: 0.8em;
    
}.logo,.logo2{
    font-size: 1em;
    margin-left: 4%;
}.logo-container{
    width: 30%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-left: 1%;
    background-color: white;
    padding-left: 14px;
    border-radius: 10px;
    margin-top:2%;
    margin-left: 2%;
}
    }
</style>
<body>
<div class="logo-container">
<div class="logo">Agri-<span class="logo2">learn</span></div> 
</div>
 <div class="container">
 <?php 
    session_start(); // Start the session

    if (!isset($_SESSION['username']) || !isset($_SESSION['id'])) {
        // If the user is not logged in, redirect to the login page
        header("Location: login.php");
        exit();
    }
    
    $username = $_SESSION['username'];
    $userid = $_SESSION['id']; // Use $_SESSION['id'] instead of $id
    // echo "Welcome, " . htmlspecialchars($username) . " (ID: " . htmlspecialchars($userid) . ")";
?>

    
<!-- will contain the vertical nav bar  -->
<div class="vertical-nav">
    <form action="" method="get" >
    <a href="index.php?Pages/dashboard.php" class="nav-item">
            <i class='bx bxs-dashboard'></i>
            <span class="tooltip">Dashboard</span>
        </a>
        <a href="index.php?users" class="nav-item">
            <i class='bx bxs-user'></i>
            <span class="tooltip">Users</span>
        </a>
        <a href="index.php?jobs" class="nav-item">
            <i class='bx bxs-briefcase'></i>
            <span class="tooltip">Jobs</span>
        </a>
        <a href="index.php?announcement" class="nav-item">
            <i class='bx bxs-megaphone'></i>
            <span class="tooltip">Announcements</span>
        </a>
        <a href="index.php?monitor_vids" class="nav-item">
            <i class='bx bxs-show'></i>
            <span class="tooltip">Monitor Videos</span>
        </a>
        <a href="index.php?settings" class="nav-item">
            <i class='bx bxs-cog'></i>
            <span class="tooltip">Settings</span>
        </a>
        <a href="logout.php" class="nav-item">
            <i class='bx bxs-exit'></i>
            <span class="tooltip">Logout</span>
        </a>
    </form>
      
</div>
<div class="main-container">
    <!-- this will be the space for other php page content -->
     <?php 
     if(isset($_GET['Pages/dashboard.php'])){
        include 'dashboard.php';
     }elseif(isset($_GET['users'])){
        include 'Pages/user.php';
     }elseif(isset($_GET['jobs'])){
        include 'Pages/jobs.php';
     }elseif(isset($_GET['announcement'])){
        include 'Pages/announcement.php';
     }elseif(isset($_GET['monitor_vids'])){
        include 'Pages/monitor_vids.php';
     }elseif(isset($_GET['settings'])){
        include 'Pages/settings.php';
     }elseif(isset($_GET['Logout'])){
        header("Location:logout.php") ;
     }else{
        include 'Pages/dashboard.php';
     }
     ?> 

</div>
</div>

</body>

</html>