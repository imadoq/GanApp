<?php
session_start();
include 'dbConnection.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['reject'])) {
    $eventID = intval($_GET['reject']);
    $conn->query("DELETE FROM tbl_eventstracker WHERE eventID = $eventID");
    header("Location: adminPage.php");
    exit();
}

if (isset($_POST['update_role'])) {
    $userID = intval($_POST['userID']);
    $newRoleID = intval($_POST['roleID']);
    $conn->query("UPDATE tbl_userinformation SET roleID = $newRoleID WHERE userID = $userID");
    header("Location: adminPage.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GanApp</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="css/adminPage.css" />
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="sidebar">
        <div class="app-header">
            <img src="images/Logo.png" alt="GanApp Logo" class="app-logo" />
            <span class="app-title">GanApp</span>
        </div>
        <ul class="nav-menu">
            <li class="nav-item active" data-tab="event-manager">Event Manager</li>
            <li class="nav-item" data-tab="user-analysis">User Analysis</li>
            <li class="nav-item" data-tab="logout"><a href="main.php">Logout</a></li>
        </ul>
    </div>

    <div class="content-area">
        <div class="tab-content active" id="event-manager">
            <div class="table-header">
                <h2 class="table-title"><i class="fas fa-user"></i> Welcome, <?php echo htmlspecialchars($_SESSION['firstName'] ?? 'Admin'); ?></h2>
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" class="search-input" id="event-search" placeholder="Search">
                </div>
            </div>

            <table class="data-table" id="event-table">
                <thead>
                    <tr>
                        <th><i class="fa-regular fa-calendar-days"></i> Event Name</th>
                        <th><i class="fa-solid fa-newspaper"></i> Description</th>
                        <th><i class="fas fa-id-card"></i> Org ID</th>
                        <th><i class="fa-regular fa-clock"></i> Event Date/Time</th>
                        <th><i class="fas fa-map-marker-alt"></i> Venue</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT eventID, eventName, eventInfo, eventVenue, eventDateTime, orgID FROM tbl_eventstracker";
                    $result = $conn->query($sql);

                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . htmlspecialchars($row["eventName"]) . "</td>
                                    <td>" . htmlspecialchars($row["eventInfo"]) . "</td>
                                    <td>" . htmlspecialchars($row["orgID"]) . "</td>
                                    <td>" . htmlspecialchars($row["eventDateTime"]) . "</td>
                                    <td>" . htmlspecialchars($row["eventVenue"]) . "</td>
                                </tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="tab-content" id="user-analysis">
            <div class="table-header">
                <h2 class="table-title"><i class="fas fa-user"></i> Welcome, <?php echo htmlspecialchars($_SESSION['firstName'] ?? 'Admin'); ?></h2>
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" class="search-input" id="user-search" placeholder="Search">
                </div>
            </div>

            <table class="data-table" id="user-table">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Username</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email Address</th>
                        <th>Student No</th>
                        <th>Role ID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $userSql = "SELECT userID, username, firstName, lastName, emailAddress, studentNo, roleID FROM tbl_userinformation";
                    $userResult = $conn->query($userSql);

                    if ($userResult && $userResult->num_rows > 0) {
                        while ($user = $userResult->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . htmlspecialchars($user["userID"]) . "</td>
                                    <td>" . htmlspecialchars($user["username"]) . "</td>
                                    <td>" . htmlspecialchars($user["firstName"]) . "</td>
                                    <td>" . htmlspecialchars($user["lastName"]) . "</td>
                                    <td>" . htmlspecialchars($user["emailAddress"]) . "</td>
                                    <td>" . htmlspecialchars($user["studentNo"]) . "</td>
                                    <td>
                                        <form method='post' style='display: inline;'>
                                            <input type='hidden' name='userID' value='" . $user["userID"] . "'>
                                            <input type='number' name='roleID' value='" . htmlspecialchars($user["roleID"]) . "' style='width: 50px;'>
                                            <button type='submit' name='update_role' class='edit-btn'>Save</button>
                                        </form>
                                    </td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No user data found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const navItems = document.querySelectorAll('.nav-item');
            const tabContents = document.querySelectorAll('.tab-content');

            navItems.forEach(item => {
                item.addEventListener('click', function () {
                    navItems.forEach(nav => nav.classList.remove('active'));
                    tabContents.forEach(tab => tab.classList.remove('active'));

                    this.classList.add('active');
                    const tabId = this.getAttribute('data-tab');
                    document.getElementById(tabId).classList.add('active');
                });
            });

            $(document).ready(function () {
                $('#event-table').DataTable({
                    "searching": true,
                    "lengthChange": false,
                    "info": false,
                    "paging": true
                });

                $('#user-table').DataTable({
                    "searching": true,
                    "lengthChange": false,
                    "info": false,
                    "paging": true
                });

                $("#event-search").on("keyup", function () {
                    $("#event-table").DataTable().search($(this).val()).draw();
                });

                $("#user-search").on("keyup", function () {
                    $("#user-table").DataTable().search($(this).val()).draw();
                });
            });
        });
    </script>
</body>
</html>
