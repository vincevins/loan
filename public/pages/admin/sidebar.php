<link rel="stylesheet" href="style.css">
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
                        <li><a href="emp_loan.php">Employee's Loan</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

<script>
document.addEventListener('DOMContentLoaded', function () {
        // Dropdown Logic
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
    console.log('Line charts initialized ✅');
});
</script>