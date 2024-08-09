<?php 
$con = mysqli_connect('localhost','root','','user');
if(!$con){
    die("connection failed".mysqli_connect_error());
}
// counting all the user 
$sql = "SELECT COUNT(*) as total_count FROM `users`";
$result = mysqli_query($con, $sql);

// Fetch the result as an associative array
$row = mysqli_fetch_assoc($result);

// Get the total count from the array
$totalnumber = $row["total_count"];

// Output the total number
// counting active students
$sqlstudent = "SELECT COUNT(*) as total_student FROM `users` WHERE `status` = '0'";
$resultstudent = mysqli_query($con, $sqlstudent);

// Fetch the result as an associative array
$rowstudent = mysqli_fetch_assoc($resultstudent);

// Get the total count from the array
$totalstudents = $rowstudent["total_student"];

//counting all the professor
$sqlprofessor = "SELECT COUNT(*) as total_professor FROM `users` WHERE `status` = '1'";
$resultprofessor = mysqli_query($con, $sqlprofessor);
$rowprofessor = mysqli_fetch_assoc($resultprofessor);
$totalprofessor = $rowprofessor["total_professor"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
.dashboard-container{
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10%;
    margin-top: 5%;
    font-family: Arial, Helvetica, sans-serif;
   
    
}.dashboard{
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    gap: 10px;
    padding: 20px;
}.graph-container{
    width: 50%;
    height: 50%;
    display: flex;
    justify-content: space-between;
    flex-direction: row;
    /* background-color: wheat; */
}.graph1,.graph2{
    width: auto;
    height: 300px;
    background-color: white;
    /* border: 1px solid black; */
    border-radius: 10px;
    /* justify-content: space-between; */
    display: flex;
    margin: 10%;
    box-shadow: 0 10px 10px rgba(0,0,0,0.25) ;
}.user-container{
    width: 100%;
    height: 50%;
    display: grid;
    grid-template-columns: repeat(4, 1fr); ;
    justify-content: space-between;
    flex-direction: row;
    /* background-color: wheat; */
    gap: 10px;
}.active-students,.overall-students,.active-professors,.number-of-applicants{
    width: 100%;
    height:150px;
    background-color: white;
    /* border: 1px solid black; */
    border-radius: 10px;
    justify-content: space-between;
    gap:2%;
    border-radius: 10px;
    box-shadow: 0 10px 10px rgba(0,0,0,0.25) ;
    padding: 10px;
    
}.announcement-container{
    width: 100%;
    height: 100%;
    /* border: 1px solid black; */
    border-radius: 10px;
    justify-content: center;;
    gap:5%;
    border-radius: 10px;
    padding: 20px;
    padding-bottom: 20px;
    
}.row1{
    width: 100%;
    height: 100%;
    /* background-color: white; */
    /* border: 1px solid black;  */
    border-radius: 10px;
    justify-content: space-between;
    gap:2%;
    border-radius: 10px;
    display: flex;
    flex-direction: row;
    margin-bottom: 2%;
}.chart-btn{
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: white;
    border-radius: 10px;
    box-shadow: inset 0 10px 10px rgba(0,0,0,0.25) ;
    padding: 3%;
    border: none;
}.chart-btn-container{
    display: flex;
    flex-direction: row;
    margin-left: 20%;
    gap: 8%;
    margin-top: 2%; 

}.chart-btn:hover{
    cursor: pointer;
    box-shadow:  0 10px 10px rgba(0,0,0,0.25) ;
}.chart-btn-active{
    box-shadow:  0 10px 10px rgba(0,0,0,0.25);
}.label-container{
    display: flex;
    flex-direction: column;
    gap: 10px;
    align-items: center;
    font-size: 20px;
}i{
    font-size: 35px;
    color: grey;
} .announcement-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* Three columns */
            gap: 20px; /* Space between announcements */
            padding: 20px;
        }

        .announcement {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            background-color: #fff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .announcement img {
            max-width: 100%;
            border-radius: 5px;
            height: auto;
            margin-left: 20%;
        }

        .announcement h1 {
            font-size: 1.5em;
            color: #333;
            text-align: center;
        }

        .announcement p {
            font-size: 1em;
            color: #555;
            
        }.announcement-image {
         width: 300px; /* Set your desired width */
         height: 200px; /* Set your desired height */
         object-fit: cover; /* This ensures the image covers the area without distorting */
          border-radius: 5px; /* Optional: add some border radius for styling */
}       

        /* Responsive layout */
        
/* small screen */
@media (max-width: 768px) {
    .dashboard-container{
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 2%;
        /* margin-top: 2%; */
        font-family: Arial, Helvetica, sans-serif;
        
    }.dashboard{
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        gap: 10px;
        padding: 20px;
    }.graph-container{
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        gap: 10px;
        /* background-color: wheat; */
    }.graph1,.graph2{
        width: auto;
        height: 130px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        gap: 10px;
        /* background-color: wheat; */
    }.user-container{
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        gap: 10px;
    }.announcement-container{
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        gap: 10px;
        display: flex;
    }.heading1{
    margin-top: 18%;
    }.announcement-container {
        display: flex;
        flex-direction: column;
        height: auto;
        gap: 20px; /* Space between announcements */
        padding: 20px;
    }

        .announcement {
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 15px;
        background-color: #fff;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        text-align: center; /* Center text */
    }

    .announcement img {
        max-width: 80%; /* Ensure the image does not exceed the width */
        height: auto; /* Maintain aspect ratio */
        border-radius: 5px; /* Optional: add some border radius for styling */
        margin: 0 auto; /* Center the image */
        display: block; /* Center the image as a block element */
    }

    .announcement h1 {
        font-size: 1.5em; /* Adjust font size for heading */
        color: #333;
        margin: 0; /* Remove default margin */
    }

    .announcement p {
        font-size: 1em; /* Adjust font size for paragraph */
        color: #555;
        margin: 0; /* Remove default margin */
    }.active-students,.overall-students,.active-professors,.number-of-applicants{
    width: 100%;
    height:auto;
    background-color: white;
    /* border: 1px solid black; */
    border-radius: 10px;
    justify-content: space-between;
    gap:2%;
    border-radius: 10px;
    box-shadow: 0 10px 10px rgba(0,0,0,0.25) ;
    padding: 10px;
    
}
}
    
    </style>
</head>
<body>
<div class="dashboard-container">
    <h1 class="heading">Statistics</h1>

    <div class="dashboard">
       
        
     

        <!-- number of users -->
        <div class="user-container" >
            <div class="active-students">
                <div class="label-container">
                <p>Active Students</p>
                <p style="color:green;font-size: 25px;" ><?php echo $totalstudents; ?></p>
                <i class='bx bxs-graduation'></i>
                </div>

            </div>
            <div class="overall-students">
            <div class="label-container">
                <p>Overall Students</p>
                <p  style="color:green;font-size: 25px;"><?php echo $totalnumber; ?></p>
                <i class='bx bxs-group'></i>
            </div>
            </div>
            <div class="active-professors" >
            <div class="label-container">
                <p>Active Professors</p>
                <p  style="color:green;font-size: 25px;" ><?php echo $totalprofessor; ?></p>
                <i class='bx bxs-chalkboard'></i>
                </div>
            </div>
            <div class="number-of-applicants">
            <div class="label-container">
                <p>Number of Applicants</p>
                <p  style="color:green;font-size: 25px;" >20</p>
                <i class='bx bxs-user'></i>
            </div>
            </div>

        </div>

        
    </div>
        <h1 class="heading1">Graph</h1>
        <div class="announcement-container">
            <!-- graph of users -->
        <div class="graph-container">
            <div class="graph1">
            <canvas id="chart1"></canvas>
              <div class="chart-btn-container">
              <!-- <button class="chart-btn" class="chart-btn-active" >7days</button>
               <button class="chart-btn">30days</button>
               <button class="chart-btn">1year</button> -->
              </div>
            </div>
            <div class="graph2">
            <canvas id="chart2"></canvas>
            <div class="chart-btn-container">
              <!-- <button class="chart-btn" class="chart-btn-active" >7days</button>
               <button class="chart-btn">30days</button>
               <button class="chart-btn">1year</button> -->
              </div>
            </div>
        </div>
</div>

       
  
        
</div>
    

 
        

    

</body>
<script>
    function showAnnouncement(id, title, announcement, date, image_path) {
    Swal.fire({
        html: `
            <h2>${title}</h2>
            <p style="float:left"><strong>Date:</strong> ${date}</p>
            <br>
            <p>${announcement}</p>
            <img src="${image_path}" alt="Announcement Image" style="max-width: 100%; height: auto; border-radius: 5px;">
        `,
        showCloseButton: true,
        width: '80%',
        padding: '3em',
        background: '#fff',
        backdrop: `
            rgba(0,0,123,0.4)
           
            left top
            no-repeat
        `
    });
}

    // Data and configuration for the first chart
    const ctx1 = document.getElementById('chart1').getContext('2d');
    const chart1 = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                label: 'Dataset 1',
                data: [10, 20, 30, 40, 50, 60, 70],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Data and configuration for the second chart
    const ctx2 = document.getElementById('chart2').getContext('2d');
    const chart2 = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ['August', 'September', 'October', 'November', 'December'],
            datasets: [{
                label: 'Dataset 2',
                data: [15, 25, 35, 45, 55],
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

</html>