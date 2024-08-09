<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
            word-break: break-word;
        }
        th {
            background-color: #f2f2f2;
        }
        @media (max-width: 768px) {
            .applicant-container{
                margin-top: 20px;
            display: flex;
            flex-direction: column;
            margin-top: 20px;
            margin-bottom: 20px; 
            overflow: auto;
            }
                table {
                border: 0;
            }

            table thead {
                display: none;
            }

            table, 
            tbody, 
            tr, 
            td {
                display: block;
                width: 100%;
            }

            tr {
                margin-bottom: 10px;
                border-bottom: 2px solid #ddd;
            }

            td {
                position: relative;
                padding-left: 50%;
                border-bottom: 1px solid #ddd;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            td::before {
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 45%;
                padding-left: 10px;
                font-weight: bold;
                white-space: nowrap;
            }
        }
    </style>
</head>
<body>
    <div class="applicant-container">
        <div class="applicant-list">
            <h1 style="margin-left: 40%;">Instructor</h1>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                        <th>Message</th>
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

                    // Fetch users with status '1'
                    $sql = mysqli_query($con, "SELECT * FROM `users` WHERE `status` = '1'");

                    // Loop through each user and display their information in a table row
                    while ($row = mysqli_fetch_array($sql)) {
                        // Escape output to prevent XSS
                        $fullname = htmlspecialchars($row['fullname'], ENT_QUOTES, 'UTF-8');
                        $email = htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8');
                        $status = htmlspecialchars($row['status'], ENT_QUOTES, 'UTF-8');
                        $userId = $row['id']; // Assuming there's an 'id' column

                        echo "<tr>
                            <td data-label='Name'>$fullname</td>
                            <td data-label='Email' >$email</td>
                            <td data-label='Status'>$status</td>
                            <td data-label='Action'><a href='#'>Approve</a></td>
                            <td data-label='Message'><i type='button' style='font-size: 1.5rem' id='message-$userId' data-user-id='$userId' data-fullname='$fullname' class='bx bx-message-dots'></i></td>
                        </tr>";
                    }

                    // Close the database connection
                    mysqli_close($con);
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        document.querySelectorAll('.bx-message-dots').forEach(item => {
            item.addEventListener('click', event => {
                let userId = event.target.getAttribute('data-user-id');
                let fullname = event.target.getAttribute('data-fullname'); // Extract instructor's name

                Swal.fire({
                    title: `Send a message to ${fullname}`,
                    input: 'text',
                    inputPlaceholder: 'Type your message here...',
                    showCancelButton: true,
                    confirmButtonText: 'Send',
                    cancelButtonText: 'Cancel',
                    preConfirm: (message) => {
                        if (!message) {
                            Swal.showValidationMessage('Please enter a message');
                        } else {
                            // Send message to the server using AJAX
                            fetch('Ajax/send_message.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({ userId: userId, message: message })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire('Message sent!', '', 'success');
                                } else {
                                    Swal.fire('Failed to send message', '', 'error');
                                }
                            });
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
