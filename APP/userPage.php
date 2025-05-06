<?php
/*include("userPageFunction.php");

    try {
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $obj = json_decode($_POST["myData"]);

            $eventName = $obj->eventName;
            $eventDateTime = $obj->eventDateTime;
            $eventVenue = $obj->eventVenue;
            $orgID = $obj->orgID;
            $eventInfo = $obj->eventInfo;

            $namePattern = "/^[A-Za-z\-'.\s]{2,50}$/";
            $currentDateTime = date("Y-m-d H:i:s");

            if (empty($eventName)){
                echo "Event name is required.";
                exit;
            }

            if (empty($eventDateTime)){
                echo "Date and Time is required";
                exit;
            } else if ($eventDateTime < $currentDateTime) {
                echo "Please set an appropriate date and time";
                exit;
            }

            if (empty($eventVenue)){
                echo "Event venue is required.";
                exit;
            }
            
            if (empty($orgID)){
                echo "Please input the affiliated organization.";
                exit;
            }

            if (empty($eventInfo)){
                echo "Please input additional information about the event.";
                exit;
            }

            $response = insertUser($conn, $eventName, $eventDateTime, $eventVenue, $orgID, $eventInfo);

            echo $response;
            exit;
        }
    } catch(Exception $e) {
        echo "An error occurred: " . $e->getMessage();
        exit;
    }*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/userPage.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>GanApp - Event Registration</title>
</head>
<body>
    <!-- Mobile toggle button -->
    <button class="toggle-sidebar">
        <i class="fas fa-bars"></i>
    </button>
    
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="app-header">
            <img class="app-logo" src="images/Logo.png" alt="GanApp Logo">
            <span class="app-title">GanApp</span>
        </div>
        
        <ul class="nav-menu">
            <li class="nav-item active" data-tab="event-registration">Event Registration</li>
            <li class="nav-item" data-tab="my-events">My Events</li>
        </ul>
    </div>
    
    <!-- Content Area -->
    <div class="content-area">
        <!-- Event Registration Tab -->
        <div class="tab-content active" id="event-registration">
            <div class="table-header">
                <h2 class="table-title"><i class="fas fa-user"></i>Welcome, User</h2>
            </div>
            
            <div class="registration-container">
                <h3 class="form-title">Event Registration Form</h3>
                
                <div class="form-group">
                    <label for="eventName">Event Name</label>
                    <div class="input-wrapper">
                        <i class="fas fa-pen"></i>
                        <input type="text" id="eventName" name="event" placeholder="Event Name" maxlength="50" required>
                    </div>
                    <div id="eventNameCounter" class="char-counter">50/50</div>
                </div>
                
                <div class="form-group">
                    <label for="eventDateTime">Date and Time</label>
                    <div class="input-wrapper">
                        <i class="fas fa-calendar-alt"></i>
                        <input type="datetime-local" id="eventDateTime" name="eventdatetime" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="eventVenue">Event Venue</label>
                    <div class="input-wrapper">
                        <i class="fas fa-map-marker-alt"></i>
                        <input type="text" id="eventVenue" name="eventvenue" placeholder="Event Venue" maxlength="50" required>
                    </div>
                    <div id="eventVenueCounter" class="char-counter">50/50</div>
                </div>
                
                <div class="form-group">
                    <label for="orgID">Organization ID</label>
                    <div class="input-wrapper">
                        <i class="fas fa-user-friends"></i>
                        <input type="number" id="orgID" name="orgid" placeholder="Organization ID" min="1" max="11" maxlength="11" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="eventInfo">Event Information</label>
                    <div class="input-wrapper textarea-wrapper">
                        <i class="fas fa-info-circle info-icon"></i>
                        <textarea id="eventInfo" name="eventinfo" placeholder="Event Information" rows="4" maxlength="250" required></textarea>
                    </div>
                    <div id="eventInfoCounter" class="char-counter">250/250</div>
                </div>
                
                <button class="submit-button" type="submit" onclick="sendAddData()">
                    <i class="fas fa-paper-plane"></i> Submit
                </button>
            </div>
        </div>
        
        <!-- My Events Tab -->
        <div class="tab-content" id="my-events">
            <div class="table-header">
                <h2 class="table-title"><i class="fas fa-calendar-check"></i>My Events</h2>
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" class="search-input" id="my-events-search" placeholder="Search">
                </div>
            </div>
            
            <table class="data-table" id="my-events-table">
                <thead>
                    <tr>
                        <th><i class="fa-regular fa-calendar-days"></i> Event Name</th>
                        <th><i class="fa-solid fa-newspaper"></i> Description</th>
                        <th><i class="fas fa-id-card"></i> Org ID</th>
                        <th><i class="fa-regular fa-clock"></i> Date/Time</th>
                        <th><i class="fas fa-map-marker-alt"></i> Venue</th>
                        <th><i class="fa-solid fa-circle-info"></i> Status</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- This will be populated with user's events -->
                </tbody>
            </table>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="js/UserPageScript.js"></script>
</body>
</html>

