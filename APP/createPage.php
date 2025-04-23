<?php
    session_start();
    include 'dbconnection.php'; // Include your database connection file

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode($_POST['myData']);
    
        $firstName = $data->Fname;
        $lastName = $data->Lname;
        $emailAddress = $data->email;
        $password = password_hash($data->password, PASSWORD_DEFAULT); // Secure password hash

        $dateCreated = date('Y-m-d H:i:s');
        $dateUpdated = date('Y-m-d H:i:s');
        $stmt = $conn->prepare("INSERT INTO tbl_userinformation (firstName, lastName, emailAddress, password, dateCreated, dateUpdated) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$firstName, $lastName, $emailAddress, $password, $dateCreated, $dateUpdated]);
    
    
        echo "Registration Successful!";
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src ="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
    <script src ="js/createPage.js"></script>
    <title>GanApp - Registration</title>
</head>
<body>
    <div class="corner-logo">
        <img src="images/logo.png" alt="Corner Logo">
        <span class="corner-text">GanApp</span>
    </div>

    <div class="container">
        <div class="content">
            <form id="login" class="fade-in-up" action="" method="post">
                <div class="login-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <h1>Create Account</h1>
                <p class="subtitle">Please fill in your details to register</p>

                <div class="input-container">
                    <i class="fas fa-user input-icon"></i>
                    <input type="text" name="username" placeholder="Username" required>
                </div>

                <div class="input-container">
                    <i class="fas fa-user input-icon"></i>
                    <input type="text" name="Fname" placeholder="First Name" required>
                </div>

                <div class="input-container">
                    <i class="fas fa-user input-icon"></i>
                    <input type="text" name="Lname" placeholder="Last Name" required>
                </div>

                <div class="input-container">
                    <i class="fas fa-user input-icon"></i>
                    <input type="text" name="studentNo" placeholder="Student Number" required>
                </div>
                
                <div class="input-container">
                    <i class="fas fa-envelope input-icon"></i>
                    <input type="email" name="email" placeholder="Email Address" required>
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
                
                <button type="button" class="submit-btn" onclick= "sendJSON()">Create Account</button>
                
                <p style="margin-top: 20px;">
                    Already have an account? <a href="Main.php">Login here</a>
                </p>
            </form>
        </div>
    </div>

    </div>
</body>
</html>