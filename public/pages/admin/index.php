<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


</head>
<body>
    <div class="dashboard-container">
        <nav class="sidebar">
            <div class="sidebar-header">
                <h2>Loan Admin</h2>
            </div>
            <ul class="sidebar-nav">
                <li><a href="index.php" class="active"><i class="icon-dashboard"></i>Dashboard</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-loans"></i>Loan Application
                        <span class="dropdown-arrow">▼</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Pending</a></li>
                        <li><a href="#">Under Review</a></li>
                        <li><a href="#">Approved</a></li>
                        <li><a href="#">Rejected</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-loans"></i>Active Loan
                        <span class="dropdown-arrow">▼</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Payment History</a></li>
                        <li><a href="#">Overdue</a></li>
                        <li><a href="#">Paid Loans</a></li>
                        <li><a href="#">Pending Loans</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-loans"></i>Fully Paid/Closed
                        <span class="dropdown-arrow">▼</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Employee's Loan</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="main-content">
            <header class="main-header">
                <h1>Dashboard Overview</h1>
                <div class="user-info">
                    <div class="notification-container">
                        <img src="pictures/notification.gif" alt="Notifications" class="notification-bell">
                        <div class="notification-dropdown">
                            <p>No new notifications</p>
                        </div>
                    </div>
                    <div class="profile-container">
                        <i class="fa-solid fa-user-circle profile-icon"></i>
                        <div class="profile-dropdown">
                            <a href="#">My Profile</a>
                            <a href="#">Settings</a>
                            <a href="../loan.php">Logout</a>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-info">
                        <i class="fa-solid fa-sack-dollar stat-icon"></i>
                        <h3>Total Active Loans</h3>
                        <span class="stat-number">0</span>
                        <h3>Amount (Without Interest)</h3>
                        <span class="stat-number">0</span>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-info">
                        <i class="fa-solid fa-hourglass-half stat-icon"></i>
                        <h3>Pending Application</h3>
                        <span class="stat-number">0</span>
                        <h3>Amount (Without Interest)</h3>
                        <span class="stat-number">0</span>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-info">
                        <i class="fa-solid fa-circle-check stat-icon"></i>
                        <h3>Approved Application</h3>
                        <span class="stat-number">0</span>
                        <h3>Amount (Without Interest)</h3>
                        <span class="stat-number">0</span>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-info">
                        <i class="fa-solid fa-hand-holding-dollar stat-icon"></i>
                        <h3>Zero-Interest Loan Repayment</h3>
                        <span class="stat-number">0</span>
                        <h3>Amount (Without Interest)</h3>
                        <span class="stat-number">0</span>
                    </div>
                </div>
            </div>


            <!-- Charts Section -->
            <div class="charts-container">
                <div class="chart-box">
                    <canvas id="barChartLeft"></canvas>
                </div>
                <div class="chart-box">
                    <canvas id="barChartRight"></canvas>
                </div>
            </div>
        </main>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Dropdown logic
    const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
    dropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', function (e) {
            e.preventDefault();
            const menu = this.nextElementSibling;
            menu.classList.toggle('show');
        });
    });

    // Notifications
    const bell = document.querySelector('.notification-bell');
    const dropdown = document.querySelector('.notification-dropdown');
    bell.addEventListener('click', function (e) {
        e.stopPropagation();
        dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
    });
    document.addEventListener('click', function () {
        dropdown.style.display = 'none';
    });
    // Profile ICON
    const profileIcon = document.querySelector('.profile-icon');
    const profileDropdown = document.querySelector('.profile-dropdown');

    profileIcon.addEventListener('click', function(e) {
        e.stopPropagation();
        profileDropdown.style.display = 
            profileDropdown.style.display === 'block' ? 'none' : 'block';
    });

    document.addEventListener('click', function() {
        profileDropdown.style.display = 'none';
    });


    // Charts
    const ctxLeft = document.getElementById('barChartLeft').getContext('2d');
    const ctxRight = document.getElementById('barChartRight').getContext('2d');

    new Chart(ctxLeft, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Application Monthly Rate',
                data: [5, 10, 20, 30, 40, 10, 20, 30, 40,5, 10, 20],
                borderColor: 'rgba(52, 152, 219, 1)',
                backgroundColor: 'rgba(52, 152, 219, 0.2)',
                fill: true,
                tension: 0.3,
                pointBackgroundColor: 'rgba(52, 152, 219, 1)',
                pointRadius: 5
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: true } },
            scales: { y: { beginAtZero: true } }
        }
    });

    new Chart(ctxRight, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Revenue',
                data: [5, 10, 20, 30, 40, 10, 20, 30, 40,5, 10, 20],
                borderColor: 'rgba(52, 152, 219, 1)',
                backgroundColor: 'rgba(52, 152, 219, 0.2)',
                fill: true,
                tension: 0.3,
                pointBackgroundColor: 'rgba(52, 152, 219, 1)',  
                pointRadius: 5
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: true } },
            scales: { y: { beginAtZero: true } }
        }
    });

    console.log('Line charts initialized ✅');
});
</script>


</body>
</html>