<?php session_start();
$role = $_SESSION['user_role'];
if ($role != 'user') {
    header("location: http://localhost/casestudy-loan/loan/public/pages/user/index.php");
    exit();
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/profile.css">
    <link rel="stylesheet" href="../../styles/nav.css">
    <link rel="stylesheet" href="../../styles/notif.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=AdDwOSNHNw7Jgf0uorqdXP-gCDnqVVv7D4kejfs1GfhN5A4RYuLCFSJdNX8navTUCToLOmKoHK7Q1Sl5&currency=PHP"></script>
    <link rel="icon" type="image/png" href="../../img/logo1.1.png">
    <title>Document</title>
</head>

<body>
    <header>
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <img src="../../img/logo1.1.png" alt=" Company Logo" style="width: 35px; height: 35px; object-fit: contain; display:block;">
                    <h1>F.L.O.W</h1>
                </div>
                <button class="responsive-nav-toggle" id="navToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <nav id="mainNav">
                    <ul class="navCenter">
                        <li><a href="loan.php">Home</a></li>
                        <li><a href="#features">Features</a></li>
                        <li><a href="#rates">Rates</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#contact">Contact</a></li>

                    </ul>
                </nav>
                <div class="notification-dropdown">
                    <button class="notification-btn" id="notifBtn">
                        <i class="fas fa-bell" style="font-size: 27px;"></i>
                        <span id="notifBadge" class="notification-badge" style="display: none;">0</span>
                    </button>

                    <div class="notification-dropdown-menu" id="notifDropdown">
                        <div class="notification-header">
                            <h3>Notifications</h3>
                            <button id="markAllRead" class="mark-all-read">Mark all as read</button>
                        </div>
                        <div id="notifList" class="notification-list">
                            <p style="text-align:center; color:#777; padding:20px;">Loading...</p>
                        </div>
                        <div class="notification-footer">

                        </div>
                    </div>
                </div>
                <div class="profile-dropdown">
                    <button class="profile-btn" onclick="toggleProfileDropdown()">
                        <div class="profile-initials"><?php
                                                        $firstName = $_SESSION['user_first_name'] ?? 'User';
                                                        $lastName = $_SESSION['user_last_name'] ?? 'Name';
                                                        if (!empty($_SESSION['profile_picture'])) {
                                                            $base64 = base64_encode($_SESSION['profile_picture']);
                                                            echo '<img src="data:image/jpeg;base64,' . $base64 . '"  alt="Profile" class="navProfile-img" id="navProfile-img">';
                                                        } else {
                                                            $initials = strtoupper(substr($firstName, 0, 1) . substr($lastName, 0, 1));
                                                            echo '<div class="profile-initials">' . $initials . '</div>';
                                                        }
                                                        ?></div>
                    </button>
                    <div class="profile-dropdown-menu">
                        <button id="btnProfile" class="dropdown-item">
                            <i class="fa fa-user"></i> Profile
                        </button>
                        <button onclick="window.location.href='settings'" class="dropdown-item">
                            <i class="fa fa-cogs"></i> Settings
                        </button>
                        <hr class="dropdown-divider">
                        <button class="dropdown-item logout">

                            <a href="http://localhost/casestudy-loan/loan/controller/logout.php" style="text-decoration: none;">
                                <i class="fa fa-sign-out-alt"></i> Log Out
                            </a>

                        </button>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </header>


    <div id="profileModal" class="modal">
        <div id="personalInfoModal" style="display: block;">
            <div class="personal-information">
                <div class="loan-summary">
                    <div class="summary-card">
                        <h3>Total Loan Amount</h3>
                        <div class="amount" id="totalLoanAmount"></div>
                    </div>
                    <div class="summary-card">
                        <h3>Remaining Balance</h3>
                        <div class="amount" id="remainingBalance"></div>
                    </div>
                    <div class="summary-card">
                        <h3>Next Payment Due</h3>
                        <div class="amount" id="nextPaymentDate"></div>
                    </div>
                    <div class="summary-card">
                        <h3>Next Payment Amount</h3>
                        <div class="amount" id="nextPaymentAmount"></div>
                    </div>
                </div>
                <hr>
                <div class="settings-container-profile">
                    <div class="personal-information-sidebar">
                        <div>
                            <div class="profile-wrapper">
                                <label for="file-upload">
                                    <?php
                                    $firstName = $_SESSION['user_first_name'] ?? 'User';
                                    $lastName = $_SESSION['user_last_name'] ?? 'Name';
                                    // $profilePicture = $_SESSION['profile_picture'] ?? null;
                                    if (!empty($_SESSION['profile_picture'])) {
                                        $base64 = base64_encode($_SESSION['profile_picture']);
                                        echo '<img src="data:image/jpeg;base64,' . $base64 . '"  alt="Profile" class="profile-img" id="profile-img"
                                        >';
                                    } else {
                                        $initials = strtoupper(substr($firstName, 0, 1) . substr($lastName, 0, 1));
                                        echo '<div class="profile-initials">' . $initials . '</div>';
                                    }
                                    ?>
                                </label>
                            </div>
                            <input type="file" id="file-upload" name="profile_picture" accept="image/*" style="display:none;">
                            <div class="user-info">
                                <h2><?php $fName = $_SESSION['user_first_name'];
                                    $lName = $_SESSION['user_last_name'];
                                    $name = $lName . ", " . $fName;
                                    echo $name ?>
                                </h2>
                                <h3><?php echo $_SESSION['user_email'] ?></h3>
                            </div>
                        </div>
                        <hr>
                        <div class="content">
                            <ul class="personal-information-sidebar">
                                <li>
                                    <button id="btnPersonalInfo" class="tab-btn active">
                                        <i class="fa-solid fa-table-columns"></i> Personal Information
                                    </button>
                                </li>
                                <li>
                                    <button id="btnPaymentSched" class="tab-btn">
                                        <i class="fa-solid fa-list"></i> Payment Schedule
                                    </button>
                                </li>
                                <li>
                                    <button id="btnPaymentHistory" class="tab-btn">
                                        <i class="fa-solid fa-list"></i> Payment History
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="main-content">
                        <div class="content-container active">
                            <h1>Personal Information</h1>
                            <div class="personal-information-container">
                                <div>
                                    <h2>First Name</h2>
                                    <p><?php echo $_SESSION['user_first_name'] ?></p>
                                </div>
                                <div>
                                    <h2>Middle Name</h2>
                                    <p><?php echo  $_SESSION['user_middle_name'] ?></p>
                                </div>
                                <div>
                                    <h2>Last Name</h2>
                                    <p><?php echo $_SESSION['user_last_name'] ?></p>
                                </div>
                                <div>
                                    <h2>Email</h2>
                                    <p><?php echo $_SESSION['user_email'] ?></p>
                                </div>
                                <div>
                                    <h2>Contact Number</h2>
                                    <p><?php echo $_SESSION['user_contact_no'] ?></p>
                                </div>
                                <div>
                                    <h2>Age</h2>
                                    <p><?php echo $_SESSION['user_age'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                </div>
            </div>
        </div>
        <div id="paymentSchedModal" style="display: none;">
            <div class="personal-information">
                <div class="settings-container-profile">
                    <div class="personal-information-sidebar">
                        <div>
                            <div class="profile-wrapper">
                                <label for="file-upload">
                                    <?php
                                    $firstName = $_SESSION['user_first_name'] ?? 'User';
                                    $lastName = $_SESSION['user_last_name'] ?? 'Name';
                                    if (!empty($_SESSION['profile_picture'])) {
                                        $base64 = base64_encode($_SESSION['profile_picture']);
                                        echo '<img src="data:image/jpeg;base64,' . $base64 . '" alt="Profile" class="profile-img" id="profile-img">';
                                    } else {
                                        $initials = strtoupper(substr($firstName, 0, 1) . substr($lastName, 0, 1));
                                        echo '<div class="profile-initials">' . $initials . '</div>';
                                    }
                                    ?>
                                </label>
                            </div>
                            <form method="POST" enctype="multipart/form-data" id="upload-form">
                                <input
                                    type="file"
                                    id="file-upload"
                                    name="profile_picture"
                                    accept="image/*"
                                    required
                                    onchange="previewImage(event)"
                                    style="display:none;">
                                <button type="submit" id="submit-btn" class="btn" style="display:none; margin-top:10px;">
                                    Change Profile
                                </button>
                            </form>

                            <div class="user-info">
                                <h2><?php $fName = $_SESSION['user_first_name'];
                                    $lName = $_SESSION['user_last_name'];
                                    $name = $lName . ", " . $fName;
                                    echo $name ?>
                                </h2>
                                <h3><?php echo $_SESSION['user_email'] ?></h3>
                            </div>
                        </div>
                        <hr>
                        <div class="content">
                            <ul class="personal-information-sidebar">
                                <li>
                                    <button id="btnPersonalInformation" class="tab-btn active">
                                        <i class="fa-solid fa-table-columns"></i> Personal Information
                                    </button>
                                </li>
                                <li>
                                    <button id="btnPaymentSched" class="tab-btn">
                                        <i class="fa-solid fa-list"></i> Payment Schedule
                                    </button>
                                </li>
                                <li>
                                    <button id="btnPaymentHistory" class="tab-btn">
                                        <i class="fa-solid fa-list"></i> Payment History
                                    </button>
                                </li>
                            </ul>
                            <div class="loan-summary">
                                <div class="summary-card">
                                    <h3>Total Loan Amount</h3>
                                    <div class="amount" id="totalLoanAmountSched"></div>
                                </div>
                                <div class="summary-card">
                                    <h3>Remaining Balance</h3>
                                    <div class="amount" id="remainingBalanceSched"></div>
                                </div>
                                <div class="summary-card">
                                    <h3>Next Payment Due</h3>
                                    <div class="amount" id="nextPaymentDateSched"></div>
                                </div>
                                <div class="summary-card">
                                    <h3>Next Payment Amount</h3>
                                    <div class="amount" id="nextPaymentAmountSched"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="main-content">
                        <div class="content-container active">
                            <div class="payment-schedule">
                                <div class="schedule-header">
                                    <h3>Payment Schedule</h3>
                                </div>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Due Date</th>
                                            <th>Amount Due</th>
                                            <th>Principal</th>
                                            <th>Interest</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="paymentScheduleBody"> </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- PAYMENT HISTORY DITO -->
        <div id="paymentHistoryModal" style="display: none;">
            <div class="personal-information">
                <div class="settings-container-profile">
                    <div class="personal-information-sidebar">
                        <div>
                            <div class="profile-wrapper">
                                <label for="file-upload">
                                    <?php
                                    $firstName = $_SESSION['user_first_name'] ?? 'User';
                                    $lastName = $_SESSION['user_last_name'] ?? 'Name';
                                    if (!empty($_SESSION['profile_picture'])) {
                                        $base64 = base64_encode($_SESSION['profile_picture']);
                                        echo '<img src="data:image/jpeg;base64,' . $base64 . '" alt="Profile" class="profile-img" id="profile-img">';
                                    } else {
                                        $initials = strtoupper(substr($firstName, 0, 1) . substr($lastName, 0, 1));
                                        echo '<div class="profile-initials">' . $initials . '</div>';
                                    }
                                    ?>
                                </label>
                            </div>

                            <div class="user-info">
                                <h2><?php echo $_SESSION['user_last_name'] . ", " . $_SESSION['user_first_name']; ?></h2>
                                <h3><?php echo $_SESSION['user_email']; ?></h3>
                            </div>
                        </div>
                        <hr>
                        <div class="content">
                            <ul class="personal-information-sidebar">
                                <li>
                                    <button id="btnPersonalInfo3" class="tab-btn">
                                        <i class="fa-solid fa-table-columns"></i> Personal Information
                                    </button>
                                </li>
                                <li>
                                    <button id="btnPaymentSched3" class="tab-btn">
                                        <i class="fa-solid fa-list"></i> Payment Schedule
                                    </button>
                                </li>
                                <li>
                                    <button id="btnPaymentHistory3" class="tab-btn active">
                                        <i class="fa-solid fa-clock-rotate-left"></i> Payment History
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="main-content">
                        <div class="content-container active">
                            <div class="payment-schedule">
                                <div class="schedule-header">
                                    <h3>Payment History</h3>
                                </div>

                                <table>
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Payment Date</th>
                                            <th>Amount Paid</th>
                                            <th>Payment Method</th>
                                            <th>Reference / Transaction ID</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="paymentHistoryBody">
                                        <tr>
                                            <td colspan="6" style="text-align:center;">Loading payment history...</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <script>
        function toggleProfileDropdown() {
            const dropdown = document.querySelector('.profile-dropdown');
            dropdown.classList.toggle('active');
        }

        document.addEventListener('click', function(event) {
            const dropdown = document.querySelector('.profile-dropdown');
            if (dropdown && !dropdown.contains(event.target)) {
                dropdown.classList.remove('active');
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const dropdownMenu = document.querySelector('.profile-dropdown-menu');
            if (dropdownMenu) {
                dropdownMenu.addEventListener('click', function(event) {
                    event.stopPropagation();
                });
            }

            const btnPaymentSched = document.getElementById("btnPaymentSched");
            const btnPersonalInfo = document.getElementById("btnPersonalInfo");
            const personalInfoModal = document.getElementById("personalInfoModal");
            const paymentSchedModal = document.getElementById("paymentSchedModal");


            btnPersonalInfo.addEventListener("click", () => {
                personalInfoModal.style.display = "block";
                paymentSchedModal.style.display = "none";
            });
            btnPaymentSched.addEventListener("click", () => {
                paymentSchedModal.style.display = "block";
                personalInfoModal.style.display = "none";
            });
            const btnPaymentHistory = document.getElementById("btnPaymentHistory");
            const paymentHistoryModal = document.getElementById("paymentHistoryModal");

            btnPaymentHistory.addEventListener("click", () => {
                personalInfoModal.style.display = "none";
                paymentSchedModal.style.display = "none";
                paymentHistoryModal.style.display = "block";
                loadPaymentHistory();
            });

            const modal = document.getElementById("profileModal");
            const btn = document.getElementById("btnProfile");
            btn.addEventListener("click", () => {
                modal.style.display = "block";
                dropdownMenu.style.display = "none";
            });
            window.addEventListener("click", (event) => {
                if (event.target === modal) {
                    modal.style.display = "none";
                }
            });

            function loadPaymentHistory() {
                fetch("http://localhost/casestudy-loan/loan/controller/paymentHistory.php")
                    .then(res => res.json())
                    .then(data => {
                        const tbody = document.querySelector(".paymentHistoryBody");
                        tbody.innerHTML = "";

                        if (!data || data.length === 0) {
                            tbody.innerHTML = `<tr><td colspan="6" style="text-align:center;">No payment history found.</td></tr>`;
                            return;
                        }

                        data.forEach((row, i) => {
                            const tr = document.createElement("tr");
                            tr.innerHTML = `
          <td>${i + 1}</td>
          <td>${row.payment_date}</td>
          <td>₱${Number(row.payment_amount).toLocaleString()}</td>
          <td>${row.payment_method || 'N/A'}</td>
          <td>${row.payment_reference || 'N/A'}</td>
          <td class="${
            row.payment_status === 'Paid' ? 'status-paid' :
            row.payment_status === 'Pending' ? 'status-pending' :
            'status-overdue'
          }">${row.payment_status}</td>
        `;
                            tbody.appendChild(tr);
                        });
                    })
                    .catch(err => {
                        console.error("Error loading payment history:", err);
                        document.querySelector(".paymentHistoryBody").innerHTML =
                            `<tr><td colspan="6" style="text-align:center;color:red;">Error loading payment history.</td></tr>`;
                    });
            }
            const btnPersonalInfo3 = document.getElementById("btnPersonalInfo3");
            const btnPaymentSched3 = document.getElementById("btnPaymentSched3");
            const btnPaymentHistory3 = document.getElementById("btnPaymentHistory3");

            if (btnPersonalInfo3 && btnPaymentSched3 && btnPaymentHistory3) {
                btnPersonalInfo3.addEventListener("click", () => {
                    paymentHistoryModal.style.display = "none";
                    paymentSchedModal.style.display = "none";
                    personalInfoModal.style.display = "block";
                });

                btnPaymentSched3.addEventListener("click", () => {
                    paymentHistoryModal.style.display = "none";
                    personalInfoModal.style.display = "none";
                    paymentSchedModal.style.display = "block";
                });

                btnPaymentHistory3.addEventListener("click", () => {
                    personalInfoModal.style.display = "none";
                    paymentSchedModal.style.display = "none";
                    paymentHistoryModal.style.display = "block";
                    loadPaymentHistory();
                });
            }

        });
    </script>
    <script src="../../js/profilePic.js"></script>
    <script src="../../js/paymentsched.js"></script>
    <script src="../../js/notif.js"></script>
    <script src="../../js/mark.js"></script>
</body>

</html>