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
    <link rel="stylesheet" href="../styles/profile.css">
</head>
<body>
    <buttona id="btnPaymentSched">test</button>
   <div id="personalInfoModal" style="display:block;">
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
                                <p><?php echo $_SESSION['user_id'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
            </div>
        </div>
    </div>
<script>
      const btnPersonalInfo = document.getElementById('btnPersonalInfo')
  const paymentSchedModal = document.getElementById('paymentSchedModal')

 
  btnPersonalInfo.addEventListener("click", () => {
    personalInfoModal.style.display = "block";
    paymentSchedModal.style.display = "none";

  });
</script>
</body>
</html>