<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <title>GanApp - Create Event</title>
</head>
<body>
    <div class="corner-logo-user">
        <img src="images/logo.png" alt="Corner Logo">
        <span class="corner-text">GanApp</span>
    </div>

    <div class="container">
        <div class="profile-section">
            <div class="profile-icon">
                <i class="fas fa-user"></i>
            </div>
            <div class="profile-info">
                <h1 class="welcome-text">Welcome, User</h1>    
            </div>
        </div>

        <form action="" method="post">

                <h2>Event Registration</h2>
                <div class="event-name">
                    <i class="fas fa-calendar-alt input-icon"></i>
                    <input type="text" class="form-control" id="eventname" name="event" placeholder="Enter Event Name" required>
                </div>
                
                <div class="event-dt">
                    <label>Event Date/Time:</label>
                    <i class="fas fa-clock input-icon"></i>
                    <input type="date" class="form-control" id="eventdate" name="eventdate" required>
                </div>
                
                <div class="event-venue">
                    <i class="fas fa-map-marker-alt input-icon"></i>
                    <input type="text" class="form-control" id="eventvenue" name="eventvenue" placeholder="Enter Event Venue" required>
                </div>

                <button type="submit" class="btn btn-primary">Submit Event</button>

        </form>
        
        <div style="text-align:center; margin-top: 20px;">
            <a href="Main.php" class="btn">Back to Main</a>
        </div>
    </div>
    
    <div class="footer">

    </div>
    
</body>
</html>