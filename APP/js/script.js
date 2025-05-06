//FOR ADMINPAGE


document.addEventListener('DOMContentLoaded', function() {
    // Tab switching functionality
    const navItems = document.querySelectorAll('.nav-item');
    const tabContents = document.querySelectorAll('.tab-content');
    
    navItems.forEach(item => {
        item.addEventListener('click', function() {
            // Remove active class from all nav items and tabs
            navItems.forEach(nav => nav.classList.remove('active'));
            tabContents.forEach(tab => tab.classList.remove('active'));
            
            // Add active class to clicked item
            this.classList.add('active');
            
            // Show corresponding tab content
            const tabId = this.getAttribute('data-tab');
            document.getElementById(tabId).classList.add('active');
        });
    });
    
    // Initialize Event Status chart when page loads since it's now part of the Event Manager tab
    initEventStatusChart();
    
    // Search functionality for event table
    const eventSearch = document.getElementById('event-search');
    if(eventSearch) {
        eventSearch.addEventListener('input', function() {
            filterTable('event-table', this.value);
        });
    }
    
    // Search functionality for user table
    const userSearch = document.getElementById('user-search');
    if(userSearch) {
        userSearch.addEventListener('input', function() {
            filterTable('user-table', this.value);
        });
    }
});

// Filter table rows based on search input
function filterTable(tableId, query) {
    const table = document.getElementById(tableId);
    if(!table) return;
    
    const rows = table.querySelectorAll('tbody tr');
    const lowercaseQuery = query.toLowerCase();
    
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(lowercaseQuery) ? '' : 'none';
    });
}

// Initialize all charts (keeping this for backward compatibility)
function initCharts() {
    initEventStatusChart();
}

// Event Status Distribution Chart
function initEventStatusChart() {
    const ctx = document.getElementById('eventStatusChart');
    if(!ctx) return;
    
    // Destroy existing chart if it exists
    if(window.eventStatusChartInstance) {
        window.eventStatusChartInstance.destroy();
    }
    
    // Sample data - replace with real data
    const data = {
        labels: ['Approved', 'Pending', 'Rejected'],
        datasets: [{
            data: [1, 2, 3],
            backgroundColor: ['#36A2EB', '#FFCD56', '#FF6384'],
            borderColor: ['#36A2EB', '#FFCD56', '#FF6384'],
            borderWidth: 1
        }]
    };
    
    window.eventStatusChartInstance = new Chart(ctx, {
        type: 'doughnut',
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
}

// Events by Organization Chart
function initOrgEventsChart() {
    const ctx = document.getElementById('orgEventsChart');
    if(!ctx) return;
    
    // Destroy existing chart if it exists
    if(window.orgEventsChartInstance) {
        window.orgEventsChartInstance.destroy();
    }
    
    // Sample data - replace with real data
    const data = {
        labels: ['Org 1', 'Org 2', 'Org 3', 'Org 4', 'Org 5', 'Org 6', 'Org 7', 'Org 8'],
        datasets: [{
            label: 'Events',
            data: [12, 8, 7, 5, 4, 3, 2, 1],
            backgroundColor: '#E11B22',
            borderWidth: 0,
            borderRadius: 4
        }]
    };
    
    window.orgEventsChartInstance = new Chart(ctx, {
        type: 'bar',
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });
}

// Monthly Events Chart
function initMonthlyEventsChart() {
    const ctx = document.getElementById('monthlyEventsChart');
    if(!ctx) return;
    
    // Destroy existing chart if it exists
    if(window.monthlyEventsChartInstance) {
        window.monthlyEventsChartInstance.destroy();
    }
    
    // Sample data - replace with real data
    const data = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
            label: 'Events',
            data: [4, 6, 3, 8, 5, 10, 7, 3, 5, 6, 9, 4],
            borderColor: '#36A2EB',
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            fill: true,
            tension: 0.4
        }]
    };
    
    window.monthlyEventsChartInstance = new Chart(ctx, {
        type: 'line',
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });
}     
