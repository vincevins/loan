<link rel="stylesheet" href="../../styles/header_admin.css">
<link rel="stylesheet" href="../../styles/modalProfile.css">
<header class="main-header">
    <h1>Welcome Back, <?php echo $_SESSION['user_first_name'] ?></h1>
    <div class="user-info">
        <div class="notification-container">
            <i class="notification-bell fas fa-bell"></i>
            <div class="notification-dropdown">
                <p>No new notifications</p>
            </div>
        </div>
        <div class="profile-container">
            <div class="profile-dropdown">
                <button class="profile-btn" onclick="toggleProfileDropdown()">
                    <?php
                    $firstName = $_SESSION['user_first_name'] ?? 'User';
                    $lastName = $_SESSION['user_last_name'] ?? 'Name';
                    if (!empty($_SESSION['profile_picture'])) {
                        $base64 = base64_encode($_SESSION['profile_picture']);
                        echo '<img src="data:image/jpeg;base64,' . $base64 . '"  alt="Profile" class="navProfile-img" id="navProfile-img">';
                    } else {
                        $initials = strtoupper(substr($firstName, 0, 1) . substr($lastName, 0, 1));
                        echo '<div class="profile-initials">' . $initials . '</div>';
                    }
                    ?>
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
                        <a href="logout.php" style="text-decoration: none;">
                            <i class="fa fa-sign-out-alt"></i> Log Out
                        </a>
                    </button>
                </div>
                <div id="profileModal" class="modal" style="display:none;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1>Loan Application Details</h1>
                            <button class="btnClose" onclick="closeModal()">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="section">
                                <div class="section-title">Personal Information</div>
                                <div class="info-grid">
                                    <div class="info-item">
                                        <div class="info-label">Full Name</div>
                                        <div class="info-value" id="detail-fullName"><?php echo  $_SESSION['user_last_name'] . ", " . $_SESSION['user_first_name'] ?></div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">Email Address</div>
                                        <div class="info-value" id="detail-Email"><?php echo $_SESSION['user_email'] ?></div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">Phone Number</div>
                                        <div class="info-value" id="detail-Phone"><?php echo  $_SESSION['user_contact_no'] ?></div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">Address</div>
                                        <div class="info-value" id="detail-Address"><?php echo  $_SESSION['user_address']. ", " .  $_SESSION['user_city'] . ", " . 
                                        $_SESSION['user_province'] . "," . $_SESSION['user_zip_code'] ?></div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</header>
<script src="../../js/profileAdmin.js"></script>
<script>
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
    const dropdownMenu = document.querySelector('.profile-dropdown-menu');
    if (dropdownMenu) {
        dropdownMenu.addEventListener('click', function(event) {
            event.stopPropagation();
        });
    }
</script>