<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ganapp";

$conn = new mysqli($servername, $username, $password, $database);

function insertUser($conn, $eventName, $eventDateTime, $eventVenue, $orgID, $eventInfo) {
    $sql = "INSERT INTO tbl_eventstracker (eventName, eventDateTime, eventVenue, orgID, eventInfo, dateCreated, dateUpdated) 
        VALUES ('$eventName', '$eventDateTime', '$eventVenue', '$orgID', '$eventInfo', NOW(), NOW())";

    if ($conn->query($sql) === TRUE) {
        return "Event added successfully";
    } else {
        return "Error: " . $conn->error;
    }
}
?>
