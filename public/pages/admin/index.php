<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Admin Dashboard</title>
    <link rel="stylesheet" href="../../styles/admin_style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
    <div class="dashboard-container">
        <nav class="sidebar">
            <div class="sidebar-header">
                <img src="../../img/logo1.1.png" alt="Company Logo">
                <h1>F.L.O.W</h1>
            </div>
            <ul class="sidebar-nav">
                <li><a href="index.php" class="active"><i class="icon-dashboard"></i>Dashboard</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-loans"></i>Loan Application
                        <span class="dropdown-arrow">▼</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="pending.php">Pending</a></li>
                        <li><a href="under_review.php">Under Review</a></li>
                        <li><a href="approved.php">Approved</a></li>
                        <li><a href="rejected.php">Rejected</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-loans"></i>Active Loan
                        <span class="dropdown-arrow">▼</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="paymenthistory.php">Payment History</a></li>
                        <li><a href="overdue.php">Overdue</a></li>
                        <li><a href="paidloans.php">Paid Loans</a></li>
                        <li><a href="pendingloans.php">Pending Loans</a></li>
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
                        <img src="../../img/logo.png" alt="Notifications" class="notification-bell">
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
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Total Active Loans</h3>
                        <p id="totalActive">24,583</p>
                        <div class="stat-trend">
                            <i class="fas fa-arrow-up"></i>
                            <span>12.5%</span>
                        </div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Pending Application</h3>
                        <p id="pendingApplication">24,583</p>
                        <div class="stat-trend">
                            <i class="fas fa-arrow-up"></i>
                            <span>12.5%</span>
                        </div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fa-solid fa-file"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Approved Application</h3>
                        <p id="approvedApplication">24,583</p>
                        <div class="stat-trend">
                            <i class="fas fa-arrow-up"></i>
                            <span>12.5%</span>
                        </div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-coins"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Revenue</h3>
                        <p id="revenue">24,583</p>
                        <div class="stat-trend">
                            <i class="fas fa-arrow-up"></i>
                            <span>12.5%</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="charts-container">
                <div class="chart-box">
                    <div class="section-header">
                        <h3>Today's Applicant</h3>
                        <button class="view-all-btn">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="data-list" id="applicantList"></div>
                </div>

                <div class="chart-box">
                    <div class="section-header">
                        <h3>Recent Payments</h3>
                        <button class="view-all-btn">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="data-list" id="paymentList"></div>
                </div>
            </div>
        </main>
    </div>
    <script src="../../js/adminDashboard.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Dropdown Logic
            const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
            dropdownToggles.forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    const menu = this.nextElementSibling;
                    menu.classList.toggle('show');
                });
            });
            // Notifications
            const bell = document.querySelector('.notification-bell');
            const dropdown = document.querySelector('.notification-dropdown');
            bell.addEventListener('click', function(e) {
                e.stopPropagation();
                dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
            });
            document.addEventListener('click', function() {
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
            // const ctxLeft = document.getElementById('barChartLeft').getContext('2d');
            // const ctxRight = document.getElementById('barChartRight').getContext('2d');

            // new Chart(ctxLeft, {
            //     type: 'line',
            //     data: {
            //         labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
            //         datasets: [{
            //             label: 'Application Monthly Rate',
            //             data: [5, 10, 20, 30, 40, 10, 20, 30, 40, 5, 10, 20],
            //             borderColor: 'rgba(52, 152, 219, 1)',
            //             backgroundColor: 'rgba(52, 152, 219, 0.2)',
            //             fill: true,
            //             tension: 0.3,
            //             pointBackgroundColor: 'rgba(52, 152, 219, 1)',
            //             pointRadius: 5
            //         }]
            //     },
            //     options: {
            //         responsive: true,
            //         plugins: {
            //             legend: {
            //                 display: true
            //             }
            //         },
            //         scales: {
            //             y: {
            //                 beginAtZero: true
            //             }
            //         }
            //     }
            // });

            // new Chart(ctxRight, {
            //     type: 'line',
            //     data: {
            //         labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
            //         datasets: [{
            //             label: 'Revenue',
            //             data: [5, 10, 20, 30, 40, 10, 20, 30, 40, 5, 10, 20],
            //             borderColor: 'rgba(52, 152, 219, 1)',
            //             backgroundColor: 'rgba(52, 152, 219, 0.2)',
            //             fill: true,
            //             tension: 0.3,
            //             pointBackgroundColor: 'rgba(52, 152, 219, 1)',
            //             pointRadius: 5
            //         }]
            //     },
            //     options: {
            //         responsive: true,
            //         plugins: {
            //             legend: {
            //                 display: true
            //             }
            //         },
            //         scales: {
            //             y: {
            //                 beginAtZero: true
            //             }
            //         }
            //     }
            // });

            console.log('Line charts initialized ✅');
        });
    </script>


</body>

</html>