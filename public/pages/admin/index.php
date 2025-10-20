<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Admin Dashboard</title>
    <link rel="stylesheet" href="../../styles/admin_style.css">
    <link rel="stylesheet" href="../../styles/table.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
    <div class="dashboard-container">
        <?php
        include 'sidebar.php';
        ?>
        <main class="main-content">
            <?php
            include 'header.php'
            ?>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Total Active Loans</h3>
                        <p id="totalActive"></p>
                        <div class="stat-trend">

                        </div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Pending Application</h3>
                        <p id="pendingApplication"></p>
                        <div class="stat-trend">

                        </div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fa-solid fa-file"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Approved Application</h3>
                        <p id="approvedApplication"></p>
                        <div class="stat-trend">

                        </div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-coins"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Total Profit</h3>
                        <p id="revenue"></p>
                        <div class="stat-trend">

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
            <div class="tblCard">
                 <h3>Upcoming Due date</h3>
                <div class="page-content" style="margin-top:15px">
                    <table id="overdue">
                        <thead>
                            <tr>
                                <th>Loan ID</th>
                                <th>Borrower</th>
                                <th>Total Payment Due</th>
                                <th>Due Date</th>
                                <th>Days Overdue</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody class="listOverdue">

                        </tbody>
                    </table>

                </div>
            </div>

        </main>
    </div>
    <script src="../../js/adminDashboard.js"></script>
    <script type="module" src="../../js/overdue.js"></script>
</body>

</html>