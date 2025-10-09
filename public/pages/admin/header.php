<header class="main-header">
    <h1>Dashboard Overview</h1>
    <div class="user-info">
        <div class="notification-container">
            <i class="notification-bell fas fa-bell"></i>
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
</script>