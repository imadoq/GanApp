<?php
    //session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <title>RegForm</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src ="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
  </head>
  <body>
        <div class="corner-logo">
        <img src="images/" alt="Corner Logo">
        <span class="corner-text">GanApp</span>
    </div>

    <div class="content">
        <div id="login" class="fade-in-up">
            <div class="login-icon">
                <i class="fas fa-sign-in-alt"></i>
            </div>
            <h1>GanApp</h1>
            <p class="subtitle">Event Tracker</p>
            
            <form method="post" action="UserPage.php">
                <div class="input-container">
                    <i class="fas fa-envelope input-icon"></i>
                    <input type="text" name="username" placeholder="Username" required>
                </div>
                <div class="input-container">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="submit-btn">
                    Login
                </button>
            </form>
            <a href="Create.php">Don't Have an Account?</a>

  </body>
</html>
