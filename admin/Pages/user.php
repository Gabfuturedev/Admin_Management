<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applicants List</title>
    <style>
        /* Add your CSS styling here */
        .applicant-container {
            width: 80%;
            margin: auto;
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
            background-color: white;
        }
        th {
            background-color: #f2f2f2;
        }@media (max-width: 768px) {
            h1{
                font-size: 20px;
                margin-left: 5%;
            }
        }
    </style>
</head>
<body>
    <div class="applicant-container">
        <div class="applicant-list">
            <h1 style="margin-left: 40%;" >Applicants</h1>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // Enable error reporting
                    ini_set('display_errors', 1);
                    ini_set('display_startup_errors', 1);
                    error_reporting(E_ALL);

                    // Establish a database connection
                    $con = mysqli_connect('localhost', 'root', '', 'user');

                    // Check connection
                    if (!$con) {
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    // Fetch users with status '2'
                    $sql = mysqli_query($con, "SELECT * FROM `users` WHERE `status` = '2'");

                    // Loop through each user and display their information in a table row
                    while ($row = mysqli_fetch_array($sql)) {
                        // Escape output to prevent XSS
                        $fullname = htmlspecialchars($row['fullname'], ENT_QUOTES, 'UTF-8');
                        $email = htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8');
                        $status = htmlspecialchars($row['status'], ENT_QUOTES, 'UTF-8');

                        echo "<tr>
                            <td>$fullname</td>
                            <td>$email</td>
                            <td>$status</td>
                            <td><a '>Approve</a></td>
                        </tr>";
                    }

                    // Close the database connection
                    mysqli_close($con);
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
