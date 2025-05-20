<?php
session_start();
include 'dbConnection.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode($_POST['myData'], true);
    $username = $data['username'];
    $newPassword = $data['newPassword'];

    // Check if user exists
    $stmt = $conn->prepare("SELECT * FROM tbl_userinformation WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo "Username not found.";
    } else {
        // Hash the new password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update the password in the database
        $updateStmt = $conn->prepare("UPDATE tbl_userinformation SET password = ? WHERE username = ?");
        $updateStmt->bind_param("ss", $hashedPassword, $username);

        if ($updateStmt->execute()) {
            echo "Password reset successful.";
        } else {
            echo "Failed to reset password.";
        }

        $updateStmt->close();
    }

    $stmt->close();
    $conn->close();
    exit();
}
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Forgot Your Password</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- jQuery and Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/forgot.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  </head>
  <body>
    <div class="form-container">
        <h4 class="mb-4 text-center">Reset Password</h4>
        <form onsubmit="sendJSON(); return false;">
            <div class="form-group">
                <div class="input-container">
                    <i class="fas fa-user input-icon"></i>
                    <input type="text" class="form-control" id="username" placeholder="Username" required>
                </div>
            </div>
            <div class="form-group">
                <div class="input-container">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" class="form-control" id="new_password" placeholder="New Password" required>
                    <i class="fas fa-eye toggle-password"></i>
                </div>
            </div>
            <div class="form-group">
                <div class="input-container">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" class="form-control" id="confirm_password" placeholder="Confirm Password" required>
                    <i class="fas fa-eye toggle-password"></i>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
        </form>
    </div>

    <script>
    function sendJSON() {
        const username = document.getElementById("username").value.trim();
        const newPassword = document.getElementById("new_password").value.trim();
        const confirmPassword = document.getElementById("confirm_password").value.trim();

        if (!username || !newPassword || !confirmPassword) {
            alert("Please fill out all fields.");
            return;
        }

        if (newPassword !== confirmPassword) {
            alert("Passwords do not match.");
            return;
        }

        const jsonData = JSON.stringify({ username, newPassword });

        $.ajax({
            url: "", // This file handles the POST request
            type: "POST",
            data: { myData: jsonData },
            success: function(response) {
                alert(response);
                if (response.includes("Password reset successful")) {
                    window.location.href = "main.php"; // Redirect after success
                }
            },
            error: function() {
                alert("An error occurred.");
            }
        });
    }

    // Add password toggle functionality
    document.querySelectorAll('.toggle-password').forEach(function(toggle) {
        toggle.addEventListener('click', function() {
            const input = this.previousElementSibling;
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    });
    </script>
  </body>
</html>