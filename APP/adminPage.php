<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href= "css/adminPage.css">
    
    <title>GanApp</title>

</head> 
<body>
    
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="app-header">
            <img src="images/Logo.png" alt="GanApp Logo" class="app-logo">
            <span class="app-title">GanApp</span>
    </div> 
        
        <ul class="nav-menu">
            <li class="nav-item active" data-tab="event-manager">Event Manager</li>
            <li class="nav-item" data-tab="user-analysis">User Analysis</li>
        </ul>
    </div>
    
    <!-- Content Area -->
    <div class="content-area">
        <!-- Event Manager Tab -->
        <div class="tab-content active" id="event-manager">
            <div class="table-header">
                <h2 class="table-title"><i class="fas fa-user"></i>Welcome, <?php echo htmlspecialchars($_SESSION['username'] ?? 'Admin'); ?></h2>
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
                    <th><i class="fas fa-id-card"></i></i> Org ID</th>
                    <th><i class="fa-regular fa-clock"></i> Event Date/Time</th>
                        <th><i class="fas fa-map-marker-alt"></i> Venue</th>
                    <th><i class="fa-solid fa-list-check"></i> Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    if (isset($events) && method_exists($events, 'resetCounter') && method_exists($events, 'getLength') && method_exists($events, 'nextEvent')) {
                $events->resetCounter();
                for($i = 0; $i < $events->getLength(); $i++) { 
                    $event = $events->nextEvent();
                    ?>
                    <tr class="event-row">
                        <td><?php echo htmlspecialchars($event['name'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($event['description'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($event['org'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($event['datetime'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($event['venue'] ?? ''); ?></td>
                        <td>
                            <?php if(isset($event['status']) && $event['status'] == 'approved'): ?>
                                <div class="status-approved">
                                    <i class="fas fa-check-circle"></i> Approved
                                </div>
                            <?php elseif(isset($event['status']) && $event['status'] == 'rejected'): ?>
                                <div class="status-rejected">
                                    <i class="fas fa-times-circle"></i> Rejected
                                </div>
                            <?php else: ?>
                                <div class="action-dropdown">
                                    <form action="approveEvent.php" method="post" style="display: inline;">
                                        <input type="hidden" value="<?php echo htmlspecialchars($event['name'] ?? ''); ?>" name="eventName">
                                        <button type="submit" class="approve-btn">
                                                <i class="fas fa-check"></i> Approve
                                            </button>
                                        </form>
                                    <form action="rejectEvent.php" method="post" style="display: inline;">
                                        <input type="hidden" value="<?php echo htmlspecialchars($event['name'] ?? ''); ?>" name="eventName">
                                        <button type="submit" class="reject-btn">
                                                <i class="fas fa-times"></i> Reject
                                            </button>
                                        </form>
                                </div>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php 
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        
        <!-- User Analysis Tab -->
        <div class="tab-content" id="user-analysis">
            <div class="table-header">
                <h2 class="table-title"><i class="fas fa-user"></i>Welcome, <?php echo htmlspecialchars($_SESSION['username'] ?? 'Admin'); ?></h2>
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" class="search-input" id="user-search" placeholder="Search">
                </div>
            </div>
            
            <table class="data-table" id="user-table">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- User data would be populated here -->
            </tbody>
        </table>
        
    <script src="js/script.js"></script>
</body>
</html>