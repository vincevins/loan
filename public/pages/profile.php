<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Account</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<style>
    .payment-schedule {
background: white;
border-radius: 10px;
padding: 30px;
margin-bottom: 30px;
box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
}

.schedule-header {
display: flex;
justify-content: between;
align-items: center;
margin-bottom: 20px;
}

table {
width: 100%;
border-collapse: collapse;
}

th, td {
padding: 15px;
text-align: left;
border-bottom: 1px solid #eee;
}

th {
background: #f8f9fa;
font-weight: 600;
}

.status-paid {
color: #4caf50;
font-weight: 600;
}

.status-pending {
color: #ff9800;
font-weight: 600;
}

.status-overdue {
color: #f44336;
font-weight: 600;
}

    .loan-summary {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .summary-card {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        text-align: center;
    }

    .summary-card h3 {
        color: #666;
        font-size: 14px;
        margin-bottom: 10px;
    }

    .summary-card .amount {
        font-size: 24px;
        font-weight: 600;
        color: #4361ee;
    }

    .payment-schedule {
        background: white;
        border-radius: 10px;
        padding: 30px;
        margin-bottom: 30px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }

    .profile-img {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #e9ecef;
    }

    .profile-initials {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background: linear-gradient(135deg, #4361ee, #3a56d4);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 14px;
    }

    .profile-name {
        font-weight: 500;
        color: #333;
    }

    body {
        font-family: Arial, sans-serif;
        background: #f4f6f9;
        margin: 0;
        padding: 0;
        color: #333;
    }

    .personal-information {
        max-width: 1200px;
        margin: 30px auto;
        background: #fff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    }

    .personal-information-header {
        text-align: center;
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 20px;
        color: #2c3e50;
    }

    /* Layout */
    .settings-container-profile {
        display: flex;
        gap: 20px;
    }

    .personal-information-sidebar {
        width: 280px;
        background: #fdfdfd;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .profile-wrapper {
        display: flex;
        justify-content: center;
        margin: 15px 0;
    }

    .profile-picture {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #4361ee;
        cursor: pointer;
        transition: 0.3s;
    }

    .profile-picture:hover {
        transform: scale(1.05);
    }

    /* Button */
    .btn {
        margin-top: 10px;
        width: 100%;
        padding: 10px;
        background: #4361ee;
        border: none;
        color: white;
        border-radius: 6px;
        cursor: pointer;
        transition: background 0.3s;
    }

    .btn:hover {
        background: #2980b9;
    }

    /* User Info */
    .user-info {
        text-align: center;
        margin: 15px 0;
    }

    .user-info h2 {
        font-size: 20px;
        margin: 5px 0;
    }

    .user-info h3 {
        font-size: 14px;
        color: #666;
    }

    /* Sidebar Menu */
    .personal-information-sidebar ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .personal-information-sidebar ul li {
        padding: 12px;
        cursor: pointer;
        border-radius: 6px;
        margin: 6px 0;
        transition: 0.3s;
        font-size: 15px;
    }

    .personal-information-sidebar ul li:hover,
    .personal-information-sidebar ul li.active {
        background: #4361ee;
        color: white;
    }

    /* Main Content */
    .main-content {
        flex: 1;
        background: #fff;
        border-radius: 10px;
        padding: 20px;
    }

    .content-container {
        display: none;
    }

    .content-container.active {
        display: block;
    }

    .content-container h1 {
        font-size: 22px;
        color: #2c3e50;
        margin-bottom: 15px;
    }

    .personal-information-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 15px;
    }

    .personal-information-container div {
        background: #f9f9f9;
        padding: 12px;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    }

    .personal-information-container h2 {
        font-size: 14px;
        color: #555;
        margin-bottom: 4px;
    }

    .personal-information-container p {
        font-size: 16px;
        font-weight: bold;
        color: #2c3e50;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .settings-container-profile {
            flex-direction: column;
        }

        .personal-information-sidebar {
            width: 100%;
        }
    }
</style>

<body>
    <div class="personal-information">
        <h1 class="personal-information-header">My Profile</h1>
        <div class="settings-container-profile">
            <!-- Sidebar -->
            <div class="personal-information-sidebar">
                <div>
                    <div class="profile-wrapper">
                        <!-- Profile Picture -->
                        <label for="file-upload">
                            <?php
                            $firstName = $_SESSION['user_first_name'] ?? 'User';
                            $lastName = $_SESSION['user_last_name'] ?? 'Name';
                            $profilePicture = $_SESSION['profile_picture'] ?? null;

                            if ($profilePicture && file_exists($profilePicture)) {
                                echo '<img src="' . htmlspecialchars($profilePicture) . '" alt="Profile" class="profile-img">';
                            } else {
                                $initials = strtoupper(substr($firstName, 0, 1) . substr($lastName, 0, 1));
                                echo '<div class="profile-initials">' . $initials . '</div>';
                            }
                            ?>
                        </label>
                    </div>

                    <form method="POST" enctype="multipart/form-data" id="upload-form">
                        <input type="file" id="file-upload" name="profile_picture" accept="image/*" required onchange="previewImage(event)" style="display:none;">
                        <button type="submit" id="submit-btn" class="btn" style="display:none;">Change Profile</button>
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
                    <ul>
                        <li class="active"><i class="fa-solid fa-table-columns"></i> Personal Information</li>
                        <li><i class="fa-solid fa-list"></i> Payment Schedule</li>
                        <li><i class="fa-solid fa-list"></i> Payment History</li>
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
                            <p><?php echo $_SESSION['user_id'] ?></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="loan-summary">
            <div class="summary-card">
                <h3>Total Loan Amount</h3>
                <div class="amount" id="totalLoanAmount">₱15,000.00</div>
            </div>
            <div class="summary-card">
                <h3>Remaining Balance</h3>
                <div class="amount" id="remainingBalance">₱12,500.00</div>
            </div>
            <div class="summary-card">
                <h3>Next Payment Due</h3>
                <div class="amount" id="nextPaymentDate">Dec 15, 2025</div>
            </div>
            <div class="summary-card">
                <h3>Next Payment Amount</h3>
                <div class="amount" id="nextPaymentAmount">₱350.00</div>
            </div>
        </div>

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
                        </tr>
                    </thead>
                    <tbody class="paymentScheduleBody">
                    </tbody>
                </table>
            </div>
    </div>
    <script src="../js/paymentsched.js"></script>
</body>
</html>