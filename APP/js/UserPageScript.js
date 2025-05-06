function sendAddData() {
    event.preventDefault()
    var jsonData = {
        eventName: document.getElementById("eventName").value.trim(),
        eventDateTime: document.getElementById("eventDateTime").value.trim(),
        eventVenue: document.getElementById("eventVenue").value.trim(),
        orgID: document.getElementById("orgID").value.trim(),
        eventInfo: document.getElementById("eventInfo").value.trim(),
        
    };
document.addEventListener('DOMContentLoaded', function() {
    console.log("DOM fully loaded");
    
    // Tab switching functionality
    const navItems = document.querySelectorAll('.nav-item');
    const tabContents = document.querySelectorAll('.tab-content');
    
    console.log("Nav items:", navItems.length);
    console.log("Tab contents:", tabContents.length);
    
    // Ensure only the active tab is shown initially
    tabContents.forEach(tab => {
        tab.style.display = 'none';
    });
    
    const activeTab = document.querySelector('.tab-content.active');
    if (activeTab) {
        console.log("Active tab found:", activeTab.id);
        activeTab.style.display = 'block';
    }
    
    navItems.forEach(item => {
        item.addEventListener('click', function() {
            const tabId = this.getAttribute('data-tab');
            console.log("Tab clicked:", tabId);
            
            // Remove active class from all nav items and tabs
            navItems.forEach(nav => nav.classList.remove('active'));
            tabContents.forEach(tab => {
                tab.classList.remove('active');
                tab.style.display = 'none';
            });
            
            // Add active class to clicked item
            this.classList.add('active');
            
            // Show corresponding tab content
            const tabContent = document.getElementById(tabId);
            if (tabContent) {
                tabContent.classList.add('active');
                tabContent.style.display = 'block';
                console.log("Tab activated:", tabId);
            } else {
                console.error("Tab content not found:", tabId);
            }
        });
    });
    
    // Mobile menu toggle button
    const sidebarToggle = document.querySelector('.toggle-sidebar');
    const sidebar = document.querySelector('.sidebar');
    
    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('active');
        });
    }
    
    // Search functionality
    const myEventsSearch = document.getElementById('my-events-search');
    if (myEventsSearch) {
        myEventsSearch.addEventListener('input', function() {
            filterTable('my-events-table', this.value);
        });
    }
    
    // Set up character counters
    setupCharCounter("eventName", "eventNameCounter", 50);
    setupCharCounter("eventVenue", "eventVenueCounter", 50);
    setupCharCounter("eventInfo", "eventInfoCounter", 250);
    
    // Initial counter updates
    updateCounter("eventName", "eventNameCounter", 50);
    updateCounter("eventVenue", "eventVenueCounter", 50);
    updateCounter("eventInfo", "eventInfoCounter", 250);
    
    // Simulate some event data for the My Events table
    loadSampleEventData();
});

// Filter table rows based on search input
function filterTable(tableId, query) {
    const table = document.getElementById(tableId);
    if (!table) return;
    
    const rows = table.querySelectorAll('tbody tr');
    const lowercaseQuery = query.toLowerCase();
    
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(lowercaseQuery) ? '' : 'none';
    });
}

function sendAddData() {
    event.preventDefault();
    
    // Form validation
    const eventName = document.getElementById("eventName").value.trim();
    const eventDateTime = document.getElementById("eventDateTime").value.trim();
    const eventVenue = document.getElementById("eventVenue").value.trim();
    const orgID = document.getElementById("orgID").value.trim();
    const eventInfo = document.getElementById("eventInfo").value.trim();
    
    if (!eventName || !eventDateTime || !eventVenue || !orgID || !eventInfo) {
        swal({
            title: "Error",
            text: "Please fill in all required fields",
            icon: "error",
        });
        return;
    }
    
    var jsonData = {
        eventName: eventName,
        eventDateTime: eventDateTime,
        eventVenue: eventVenue,
        orgID: orgID,
        eventInfo: eventInfo,
    };

    var jsonString = JSON.stringify(jsonData);

    $.ajax({
        url: "userPage.php",
        type: 'POST',
        data: {myData : jsonString},
        success: function(response) {
            swal({
                title: "Response",
                text: response,
                icon: response.includes("successfully") ? "success" : "error",
            });
            
            if (response.includes("successfully")) {
                // Add the event to the My Events table
                addEventToTable(eventName, eventInfo, orgID, eventDateTime, eventVenue);
                
                // Clear the form
                document.getElementById("eventName").value = "";
                document.getElementById("eventDateTime").value = "";
                document.getElementById("eventVenue").value = "";
                document.getElementById("orgID").value = "";
                document.getElementById("eventInfo").value = "";
                
                // Update counters
                updateCounter("eventName", "eventNameCounter", 50);
                updateCounter("eventVenue", "eventVenueCounter", 50);
                updateCounter("eventInfo", "eventInfoCounter", 250);
            }
        },
        error: function(xhr, status, error){
            swal({
                title: "Error",
                text: "An error occurred: " + error,
                icon: "error",
            });
        }
    });
}

function setupCharCounter(inputId, counterId, maxLength) {
    const input = document.getElementById(inputId);
    const counter = document.getElementById(counterId);
    
    if (!input || !counter) {
        console.error(`Element not found: ${inputId} or ${counterId}`);
        return;
    }

    input.addEventListener("input", function() {
        updateCounter(inputId, counterId, maxLength);
    });
    
    input.addEventListener("keyup", function() {
        updateCounter(inputId, counterId, maxLength);
    });
}

function updateCounter(inputId, counterId, maxLength) {
    const input = document.getElementById(inputId);
    const counter = document.getElementById(counterId);
    
    if (!input || !counter) return;
    
    const remaining = maxLength - input.value.length;
    if (counterId === "eventInfoCounter") {
        counter.textContent = `${input.value.length}/${maxLength}`;
    } else {
        counter.textContent = `${remaining} characters remaining`;
    }
    
    // Add visual indicator when approaching limit
    if (remaining <= 10) {
        counter.style.color = "#E11B22"; // Red when close to limit
    } else {
        counter.style.color = ""; // Reset to default
    }
}

// Add a new event to the My Events table
function addEventToTable(name, description, orgID, datetime, venue) {
    const table = document.getElementById('my-events-table');
    if (!table) return;
    
    const tbody = table.querySelector('tbody');
    const row = document.createElement('tr');
    
    row.innerHTML = `
        <td>${name}</td>
        <td>${description}</td>
        <td>${orgID}</td>
        <td>${datetime}</td>
        <td>${venue}</td>
        <td><span class="status-pending"><i class="fas fa-clock"></i> Pending</span></td>
    `;
    
    tbody.appendChild(row);
    
    // Switch to the My Events tab
    document.querySelector('.nav-item[data-tab="my-events"]').click();
}

// Load sample event data for the My Events table
function loadSampleEventData() {
    const table = document.getElementById('my-events-table');
    if (!table) return;
    
    const tbody = table.querySelector('tbody');
    if (tbody.children.length > 0) return; // Don't add sample data if table already has events
    
    const sampleEvents = [
        {
            name: "Annual Charity Run",
            description: "Fundraising event for local children's hospital",
            orgID: "3",
            datetime: "2023-11-15 08:00:00",
            venue: "City Park",
            status: "approved"
        },
        {
            name: "Tech Conference 2023",
            description: "Networking and learning event for tech professionals",
            orgID: "5",
            datetime: "2023-12-10 09:30:00",
            venue: "Convention Center",
            status: "pending"
        },
        {
            name: "Holiday Food Drive",
            description: "Collecting food donations for local shelters",
            orgID: "2",
            datetime: "2023-12-20 10:00:00",
            venue: "Community Center",
            status: "rejected"
        }
    ];
    
    sampleEvents.forEach(event => {
        const row = document.createElement('tr');
        const statusClass = `status-${event.status}`;
        const statusIcon = event.status === 'approved' ? 'check-circle' : (event.status === 'rejected' ? 'times-circle' : 'clock');
        
        row.innerHTML = `
            <td>${event.name}</td>
            <td>${event.description}</td>
            <td>${event.orgID}</td>
            <td>${event.datetime}</td>
            <td>${event.venue}</td>
            <td><span class="${statusClass}"><i class="fas fa-${statusIcon}"></i> ${event.status.charAt(0).toUpperCase() + event.status.slice(1)}</span></td>
        `;
        
        tbody.appendChild(row);
    });
}
    var jsonString = JSON.stringify(jsonData);

    console.log(jsonString);

    $.ajax({
        url: "UserPage.php",
        type: 'POST',
        data: {myData : jsonString},
        success: function(response) {
            swal({
                text: response,
            });

        },
        error: function(response){

        }

    });
}


setupCharCounter("eventName", "eventNameCounter", 50);
setupCharCounter("eventVenue", "eventVenueCounter", 50);
setupCharCounter("eventInfo", "eventInfoCounter", 250);

function setupCharCounter(inputId, counterId, maxLength) {
    const input = document.getElementById(inputId);
    const counter = document.getElementById(counterId);

    input.addEventListener("input", () => {
        const remaining = maxLength - input.value.length;
        counter.textContent = `${remaining} characters remaining`;
    });
}
