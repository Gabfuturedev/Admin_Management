<?php 
    session_start(); 
    // Start the session

    if (!isset($_SESSION['username']) || !isset($_SESSION['id'])) {
        // If the user is not logged in, redirect to the login page
        header("Location: login.php");
        exit();
    }
    
    $username = $_SESSION['username'];
    $userid = $_SESSION['id'];
    //  Use $_SESSION['id'] instead of $id
    // echo "Welcome, " . htmlspecialchars($username) . " (ID: " . htmlspecialchars($userid) . ")";
?>
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
    .vertical-nav, form{
    width: 5%;
    height: 100%; 
    /* background-image: linear-gradient(#FFE08F, #FFE08F);  */
    display: flex;
    flex-direction: column;
    align-items: center; 
    justify-content: space-between; 
     padding: 5%;
     /* background-image: linear-gradient(#FFE08F, #DEC4AC); */
     
}
  .nav-item{
    text-align: center;
    margin: 10px 0;
    width: 50px;
    height: 50px;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #333;
    border-radius: 50%;
    text-decoration: none;
    position: relative;
     
    
}.nav-item i{
    font-size: 1.5rem;
    background-image: linear-gradient(45deg, #f7eb73, #f7a873);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    color: transparent;
   
}.tooltip {
    position: absolute;
    left: 50px;
    top: 50%;
    transform: translateY(-50%);
    background-color: #333;
    color: #fff;
    padding: 5px 10px;
    border-radius: 4px;
    opacity: 0;
    white-space: nowrap;
    pointer-events: none;
    transition: opacity 0.3s;
    font-size: 1.2rem;
}

.nav-item:hover .tooltip {
    opacity: 1;
} 
    @media (max-width: 768px) {
        .burger-menu {
        display: block;
        cursor: pointer;
        position: absolute;
        top: 40px;
        left: 20px;
        width: 30px;
        height: 24px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
}

.burger-menu .line {
    width: 100%;
    height: 4px;
    background-color: #333;
    transition: all 0.3s ease;
}

.burger-menu.active .line1 {
    transform: rotate(45deg) translate(4px, 10px);
}

.burger-menu.active .line2 {
    opacity: 0;
}

.burger-menu.active .line3 {
    transform: rotate(-45deg) translate(4px, -10px);
}
 .vertical-nav.active {
                display: flex;
                left: 0;
                width: 20%;
                
                
                               
    }.vertical-nav {
                width: 0;
    height: 100%;
    overflow: hidden;
    position: absolute;
    top: 10%;
    left: -250px;
    background: rgba(255, 255, 255, 0.1); /* Semi-transparent white background */
    backdrop-filter: blur(10px); /* Adds the glass blur effect */
    border: 1px solid rgba(255, 255, 255, 0.2); /* Optional border for better visibility */
    transition: width 0.5s ease-in-out, left 0.5s ease-in-out;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 20px;
    padding: 5%;
    border-radius: 10px;
    z-index: 999;
                
                
                
            }.vertical-nav,form{
                background: rgba(255, 255, 255, 0.1); /* Semi-transparent white background */
    backdrop-filter: blur(10px); /* Adds the glass blur effect */
            }
.main-container{
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}.tooltip {
    position: absolute;
    left: 50px;
    top: 50%;
    transform: translateY(-50%);
    background-color: #333;
    color: #fff;
    padding: 5px 10px;
    border-radius: 4px;
    opacity: 0;
    white-space: nowrap;
    pointer-events: none;
    transition: opacity 0.3s;
    font-size: 1rem;
}
.nav-item{
    text-align: center;
    margin: 10px;
    width: 30px;
    height: 30px;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #333;
    border-radius: 50%;
    text-decoration: none;
    position: relative;
     
    
}.nav-item i{
    font-size: 1rem;
    background-image: linear-gradient(45deg, #f7eb73, #f7a873);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    color: transparent;
   
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
 

    
<!-- will contain the vertical nav bar  -->
<div class="burger-menu">
    <div class="line line1"></div>
    <div class="line line2"></div>
    <div class="line line3"></div>
</div>

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
        include 'Pages/lists_applications.php';
     }elseif(isset($_GET['jobs'])){
        include 'Pages/jobs.php';
     }elseif(isset($_GET['announcement'])){
        include 'Pages/announcement.php';
     }elseif(isset($_GET['monitor_vids'])){
        include 'Pages/reported_videos.php';
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
<script>
 
  document.querySelector('.burger-menu').addEventListener('click', function() {
    this.classList.toggle('active');
    document.querySelector('.vertical-nav').classList.toggle('active');
});
</script>
</html>