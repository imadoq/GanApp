<?php
session_start(); // The whole php is commenteed remove the comment to work
include 'dbConnection.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode($_POST['myData']);

    // Sanitize and assign
    $username = $data->username;
    $firstName = $data->Fname;
    $lastName = $data->Lname;
    $emailAddress = $data->email;
    $studentNo = $data->studentNo;
    $password = password_hash($data->password, PASSWORD_DEFAULT);

    $dateCreated = date('Y-m-d H:i:s');
    $dateUpdated = date('Y-m-d H:i:s');

    // Check if username or email already exists
    $checkStmt = $conn->prepare("SELECT * FROM tbl_userinformation WHERE username = ? OR emailAddress = ?");
    $checkStmt = $conn->prepare("SELECT * FROM tbl_userinformation WHERE username = ?");
    $checkStmt->execute([$username]);
    $userExists = $checkStmt->fetch();
    
    if ($userExists) {
        echo "Username already exists!";
        exit;
    }
    
    // Proceed with inserting the user
    $stmt = $conn->prepare("INSERT INTO tbl_userinformation 
        (username, firstName, lastName, emailAddress, password, studentNo, dateCreated, dateUpdated) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    if ($stmt->execute([$username, $firstName, $lastName, $emailAddress, $password, $studentNo, $dateCreated, $dateUpdated])) {
        echo "Registration Successful!";
    } else {
        echo "An error occurred during registration.";
    }
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/createPage.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
    <script src="js/createPage.js"></script>
    <title>GanApp - Create Account</title>
</head>
<body>
    <div class="container">
        <div class="form-section">
            <div class="logo">
                <img src="images/Logo.png" alt="GanApp Logo">
                <h1>GanApp</h1>
            </div>

            <div class="form-content">
                <h2>Create an account</h2>
                <p class="subtitle">Please fill in your details to register</p>

                <form id="register-form">


                    <div class="input-row">
                        <div class="input-container">
                            <i class="fas fa-user input-icon"></i>
                            <input type="text" name="Fname" placeholder="First Name" required>
                        </div>

                        <div class="input-container">
                            <i class="fas fa-user input-icon"></i>
                            <input type="text" name="Lname" placeholder="Last Name" required>
                        </div>
                    </div>

                    <div class="input-container">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" name="email" placeholder="Email Address" required>
                    </div>

                    <div class="input-container">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="text" name="username" placeholder="Username" required>
                    </div>

                    <div class="input-container">
                        <i class="fas fa-phone input-icon"></i>
                        <input type="text" name="studentNo" placeholder="Contact No." required>
                    </div>
                    
                    <div class="input-container">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" name="password" placeholder="Password" required>
                        <i class="fas fa-eye toggle-password"></i>
                    </div>
                    
                    <div class="input-container">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                    </div>
                    
                    <button type="button" class="submit-btn" onclick="sendJSON()">Sign up</button>
                    
                    <p class="login-link">
                        Already have an account? <a href="Main.php">Log in</a>
                    </p>
                </form>
            </div>
        </div>
        <div class="pattern-background">
            <!-- Pattern background will be created with CSS -->
        </div>
    </div>
</body>
</html>
