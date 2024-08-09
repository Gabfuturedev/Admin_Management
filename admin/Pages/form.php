<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Form</title>
</head>
<body>
    <h2>Application Form</h2>
    <form action="submit_application.php" method="POST" enctype="multipart/form-data">
        <label for="firstName">First Name:</label>
        <input type="text" name="firstName" id="firstName" required><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>

        <label for="conNum">Contact Number:</label>
        <input type="text" name="conNum" id="conNum" required><br><br>

        <label for="streetAddress">Street Address:</label>
        <input type="text" name="streetAddress" id="streetAddress" required><br><br>

        <label for="city">City:</label>
        <input type="text" name="city" id="city" required><br><br>

        <label for="province">Province:</label>
        <input type="text" name="province" id="province" required><br><br>

        <label for="zipCode">Zip Code:</label>
        <input type="text" name="zipCode" id="zipCode" required><br><br>

        <label for="appLetter">Application Letter:</label>
        <input type="file" name="appLetter" id="appLetter" required><br><br>

        <label for="cv">CV:</label>
        <input type="file" name="cv" id="cv" required><br><br>

        <label for="picture">Picture:</label>
        <input type="file" name="picture" id="picture" required><br><br>

        <label for="valId">Valid ID:</label>
        <input type="file" name="valId" id="valId" required><br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
