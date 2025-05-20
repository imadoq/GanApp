<?php
session_start();
include 'dbConnection.php'; // Your database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode($_POST['myData'], true);
    $username = $data['username'];
    $password = $data['password'];

    $stmt = $conn->prepare("SELECT userID, firstName, password, roleID FROM tbl_userinformation WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $hashedPassword = $user['password'];
        if (password_verify($password, $hashedPassword)) {
            // Password is correct, now check roleID
            $_SESSION['userID'] = $user['userID']; // Store userID in session (important for future use)
            $_SESSION['firstName'] = $user['firstName']; // Store roleID in session (important for future use)
            if ($user['roleID'] == 1) {
                echo "Login Successful - Redirecting to Admin Page";
            } elseif ($user['roleID'] == 2) {
                echo "Login Successful - Redirecting to User Page";
            } else {
                echo "Login Successful - Unknown role. Please contact administrator.";
            }
        } else {
            echo "Incorrect password!";
        }
    } else {
        echo "Username not found!";
    }

    $stmt->close();
    $conn->close();
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
    <script>
        function sendJSON(){
    var jsonData = {
        username: document.getElementById("username").value.trim(),
        password: document.getElementById("password").value.trim(),
    }

    var jsonString = JSON.stringify(jsonData);
    $.ajax({
        url: "",
        type: "POST",
        data: {myData: jsonString},
        success: function(result) {
            const trimmedResult = result.trim();
        if (trimmedResult === "Login Successful - Redirecting to Admin Page") {
        window.location.href = 'adminPage.php';
        } else if (trimmedResult === "Login Successful - Redirecting to User Page") {
        window.location.href = 'userPage.php';
        } else {
        alert(result);
    }
        },
        error: function(result){
            console.error("Error:", result);
            alert("An error occurred during login.");
        }
    })
}

$(document).ready(function() {
    $(".toggle-password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).prev("input"));
        if (input.attr("type") === "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
});
    </script>
    <title>GanApp - Login</title>
    <style>
        :root {
    --primary-color: #E11B22;
    --secondary-color: #F9F9F9;
    --shadow-color: rgba(0, 0, 0, 0.3);
    --text-color: #333333;
    --border-color: #EEEEEE;
    --text-light: #777777;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Montserrat', sans-serif;
}

body {
    min-height: 100vh;
    overflow-x: hidden;
    background-color: white;
}

.container {
    display: flex;
    min-height: 100vh;
    width: 100%;
}

/* Form Section */
.form-section {
    width: 40%;
    padding: 13rem 10rem;
    display: flex;
    flex-direction: column;
    background-color: white;
}

.logo {
    display: flex;
    align-items: center;
    margin-bottom: 2rem;
    justify-content: center;
}

.logo img {
    width: 70px;
    height: 70px;
    margin-right: 10px;
}

.logo h1 {
    color: var(--primary-color);
    font-size: 1.8rem;
    font-weight: 700;
    margin: 0;
}

.form-content {
    max-width: 450px;
    width: 100%;
    margin: 0 auto;
}

.form-content h2 {
    font-size: 1.75rem;
    color: var(--text-color);
    margin-bottom: 0.5rem;
    font-weight: 600;
}

.subtitle {
    color: var(--text-light);
    margin-bottom: 2rem;
    font-size: 0.95rem;
}

.input-container {
    position: relative;
    margin-bottom: 1.2rem;
    width: 100%;
}

.input-row {
    display: flex;
    gap: 1rem;
    margin-bottom: 0;
}

.input-row .input-container {
    flex: 1;
}

.input-icon {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: #999;
    z-index: 1;
}

.toggle-password {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: #999;
    cursor: pointer;
    z-index: 1;
}

input {
    width: 100%;
    padding: 0.8rem 1rem 0.8rem 2.5rem;
    border: 1px solid var(--border-color);
    border-radius: 4px;
    background-color: var(--secondary-color);
    font-size: 0.95rem;
    color: var(--text-color);
    transition: all 0.3s;
}

input:focus {
    outline: none;
    border-color: var(--primary-color);
    background-color: white;
}

input::placeholder {
    color: #999;
}

.submit-btn {
    width: 100%;
    padding: 0.9rem;
    margin-top: 1rem;
    background: linear-gradient(45deg, #E11B22, #ff4d4d);
    color: white;
    border: none;
    border-radius: 4px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(225, 27, 34, 0.2);
}

.submit-btn:hover {
    background: linear-gradient(45deg, #C41019, #E11B22);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(225, 27, 34, 0.3);
}

.submit-btn:active {
    transform: translateY(0);
    box-shadow: 0 4px 15px rgba(225, 27, 34, 0.2);
}

.login-link {
    margin-top: 1.5rem;
    text-align: left;
    font-size: 0.9rem;
    color: var(--text-light);
}

.login-link a {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 500;
}

.login-link a:hover {
    text-decoration: underline;
}

/* Background Pattern Section */
.pattern-background {
    flex: 1;
    background-color: var(--primary-color);
    position: relative;
    overflow: hidden;
}

.pattern-background::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: radial-gradient(
        rgba(255, 255, 255, 0.1) 2px,
        transparent 2px
    );
    background-size: 30px 30px;
}

.pattern-background::after {
    content: '';
    position: absolute;
    top: -10%;
    left: -10%;
    right: -10%;
    bottom: -10%;
    background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 0h20v20H0V0zm40 0h20v20H40V0zm40 0h20v20H80V0zm0 40h20v20H80V40zm0 40h20v20H80V80zM40 40h20v20H40V40zm0 40h20v20H40V80zm-40 0h20v20H0V80zm0-40h20v20H0V40z' fill='rgba(255,255,255,0.05)' fill-rule='evenodd'/%3E%3C/svg%3E");
    animation: patternFloat 30s linear infinite;
}

@keyframes patternFloat {
    0% {
        transform: rotate(0deg) scale(1);
    }
    50% {
        transform: rotate(5deg) scale(1.05);
    }
    100% {
        transform: rotate(0deg) scale(1);
    }
}

/* Responsive Styles */
@media (max-width: 1200px) {
    .form-section {
        padding: 2rem 3rem;
    }
}

@media (max-width: 992px) {
    .form-section {
        width: 50%;
        padding: 2rem;
    }
}

@media (max-width: 768px) {
    .container {
        flex-direction: column;
    }

    .form-section {
        width: 100%;
        padding: 2rem 1.5rem;
        order: 1;
    }

    .form-content {
        max-width: 100%;
    }

    .pattern-background {
        display: none;
    }

    body {
        background-color: var(--primary-color);
        background-image: radial-gradient(
            rgba(255, 255, 255, 0.1) 2px,
            transparent 2px
        );
        background-size: 30px 30px;
    }

    .logo {
        margin-bottom: 1.5rem;
    }

    .logo img {
        width: 70px;
        height: 70px;
    }
}

@media (max-width: 576px) {
    .input-row {
        flex-direction: column;
        gap: 0;
    }

    .form-content h2 {
        font-size: 1.5rem;
    }

    .subtitle {
        font-size: 0.85rem;
        margin-bottom: 1.5rem;
    }

    input {
        padding: 0.7rem 1rem 0.7rem 2.5rem;
    }

    .submit-btn {
        padding: 0.8rem;
    }

    .logo img {
        width: 35px;
        height: 35px;
    }
}
    </style>
</head>
<body>
    <div class="container">
        <div class="form-section">
            <div class="logo">
                <img src="images/Logo.png" alt="GanApp Logo">
                <h1>GanApp</h1>
            </div>

            <div class="form-content">
                <h2>Welcome Back</h2>
                <p class="subtitle">Sign in to continue to your account</p>

                <form id="login-form">
                    <div class="input-container">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="text" id="username" name="username" placeholder="Username" required>
                    </div>

                    <div class="input-container">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" id="password" name="password" placeholder="Password" required>
                        <i class="fas fa-eye toggle-password"></i>
                    </div>

                    <button type="button" class="submit-btn" onclick="sendJSON()">Login</button>

                    <p class="login-link">
                        Don't have an account? <a href="createPage.php">Create one</a><br>
                        <a href="ResetPage.php">Forgot your password?</a>
                    </p>
                </form>
            </div>
        </div>
        <div class="pattern-background">
            </div>
    </div>
</body>
</html>