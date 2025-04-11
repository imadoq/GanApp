<?php
//include 'dbConnection.php';
<?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>GanApp</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src ="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
  </head>
  <body>
      <h1>Registration Form</h1>
        <form id="regForm" method="POST" action="index.php">
            <div class="form-group">
                <label for="IDno">Organization Name:</label>
                <input type="text" class="form-control" id="IDno" name="IDno" required>
            </div>
            <div class="form-group">
                <label for="Fname">First Name:</label>
                <input type="text" class="form-control" id="Fname" name="Fname" required>
            </div>
            <div class="form-group">
                <label for="Lname">Last Name:</label>
                <input type="text" class="form-control" id="Lname" name="Lname" required>
            </div>
            <div class="form-group">
                <label for="Add">Address:</label>
                <input type="text" class="form-control" id="Add" name="Add" required>
            </div>
            <button type="button" class="btn btn-primary" onclick="sendJSON()">Submit</button>
        </form>
  </body>
</html>