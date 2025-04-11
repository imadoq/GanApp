<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
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
                
                <button type="submit" class="submit-btn">Create Account</button>
                
                <p style="margin-top: 20px;">
                    Already have an account? <a href="Main.php">Login here</a>
                </p>
            </form>
        </div>
    </div>

    </div>
</body>
</html>