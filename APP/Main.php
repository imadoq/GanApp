<?php
session_start();
include 'dbConnection.php'; // Your database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode($_POST['myData'], true);
    $username = $data['username'];
    $password = $data['password']; 

    $stmt = $conn->prepare("SELECT * FROM tbl_userinformation WHERE username = ?");
    $stmt ->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            echo "Login successful!";
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "Username not found!";
    }

    $stmt->close();
    $conn->close();
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>RegForm</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <script src="js/main.js"></script>
</head>
<body>
    <div class="corner-logo">
        <img src="images/Logo.png" alt="Corner Logo">
        <span class="corner-text">GanApp</span>
    </div>

    <div class="content">
        <div id="login" class="fade-in-up">
            <div class="login-icon">
                <i class="fas fa-sign-in-alt"></i>
            </div>
            <h1>GanApp</h1>
            <p class="subtitle">Event Tracker</p>

            <form>
                <div class="input-container">
                    <i class="fas fa-envelope input-icon"></i>
                    <input type="text" id="username" name="username" placeholder="Username" required>
                </div>
                <div class="input-container">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                </div>
                <button type="button" class="submit-btn" onclick="sendJSON()">Login</button>
            </form>
            <a href="createPage.php">Don't Have an Account?</a>
        </div>
    </div>
</body>
</html>
