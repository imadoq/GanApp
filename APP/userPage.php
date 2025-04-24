<?php
include("userPageFunction.php");

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
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="UserPageStyle.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Bootstrap demo</title>
  </head>

  <body>
    <nav class="navbar navbar-expand-lg" style="background-color: beige;">
        <div class="container-fluid">

            <i class="fas fa-user-circle"></i>
            <!--
            <img src="images/logo.png" alt="Corner Logo">
            -->
        
            <a class="navbar-brand" href="#">GanAPP</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                
                <!--
                <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
                </li>
                -->

            </ul>
            </div>
        </div>
    </nav>

    <div class="main-body">

    <div class="user-container">
        <div class ="profile-picture">
            <i class="fas fa-user-circle"></i>
        </div>
        <div class="welcome-header">
                <h1 class="welcome-text">Welcome, User</h1>    
        </div>
    </div>

    <br>

    <div class="registration-container">
        <h2>Event Registration</h2>
        <br>

        <div class="event-name icon-group">
            <i class="fas fa-pen"></i>
            <input type="text" id="eventName" name="event" placeholder="Event Name" maxlength="50" required>
        </div>
            <div id="eventNameCounter" class="char-counter">50 characters remaining</div>
        <br>

        <div class="event-datetime icon-group">
            <i class="fas fa-calendar-alt input-icon"></i>
            <input type="datetime-local" id="eventDateTime" name="eventdatetime" required>
        </div>
        <br>

        <div class="event-venue icon-group">
            <i class="fas fa-map-marker-alt input-icon"></i>
            <input type="text" id="eventVenue" name="eventvenue" placeholder="Event Venue" maxlength="50" required>
        </div>
            <div id="eventVenueCounter" class="char-counter">50 characters remaining</div>
        <br>

        <div class="event-org icon-group">
            <i class="fas fa-user-friends input-icon"></i>
            <input type="number" id="orgID" name="orgid" placeholder="Organization ID" min="1" max="11" maxlength="11" required/>
        </div>
        <br>

        <div class="event-info icon-group">
            <i class="fas fa-info-circle"></i>
            <textarea id="eventInfo" name="eventinfo" placeholder="Event Information" rows="4" maxlength="250" required></textarea>
        </div>
            <div id="eventInfoCounter" class="char-counter">250 characters remaining</div>
        <br>

        <button class="submit-button" type="submit" onclick="sendAddData()">Submit</button>
    </div>

    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="UserPageScript.js"></script>
  </body>
</html>


