<style>
.dashboard-container {
display: flex;
min-height: 100vh;
}

.sidebar {
    width: 250px;
    background: #ffffff; /* 🔹 whole sidebar white */
    color: #000;
    position: fixed;
    height: 100vh;
    overflow-y: auto;
    padding-top: 20px;
}

.sidebar-header {
padding: 20px;
border-bottom: 1px solid #34495e;
}

.sidebar-header h2 {
font-size: 1.5rem;
}

.sidebar-nav {
    list-style: none;
    padding: 0;
    background: none;
}

.sidebar-nav a {
    display: block;
    padding: 15px 20px;
    margin: 10px;           
    border-radius: 10px;       
    text-align: center;        
    color: #fff;            
    background: #3498db;     
    text-decoration: none;
    transition: all 0.3s ease;
}
.sidebar-nav .dropdown-toggle {
    display: block;                  /* like normal links */
    padding: 15px 20px;
    margin: 10px;
    border-radius: 10px;
    text-align: center;
    color: #fff;
    background: #3498db;
    text-decoration: none;
    transition: all 0.3s ease;
    cursor: pointer;
}

.sidebar-nav .dropdown-toggle:hover,
.sidebar-nav .dropdown-toggle.active {
    background: #2980b9;
    color: #fff;
}

.sidebar-nav li {
    border: none;
}

.sidebar-nav i {
margin-right: 10px;
width: 20px;
text-align: center;
}

.dropdown {
position: relative;
}


.dropdown-arrow {
    margin-left: 8px;
    transition: transform 0.3s ease;
}

.dropdown-menu {
    list-style: none;
    padding-left: 20px;
    margin: 0;
    overflow: hidden;              /* hide content while collapsing */
    max-height: 0;                 /* collapsed by default */
    transition: max-height 0.3s ease; /* smooth animation */
    border-radius: 5px;
}
.dropdown-menu.show {
    max-height: 500px; /* enough height to show all items */
}



.dropdown:hover .dropdown-menu {
display: block;
}

.dropdown:hover .dropdown-arrow {
transform: rotate(180deg);
}

.dropdown-menu li {
border-bottom: 1px solid #2c3e50;
}

.dropdown-menu a {
padding: 12px 15px;
font-size: 0.9rem;
}
  </style>
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
                        <li><a href="paymenthistory.php">Payment History</a></li>
                        <li><a href="../admin/overdue.php">Overdue</a></li>
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

<script>
        // Dropdown logic
    const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
    dropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', function (e) {
            e.preventDefault();
            const menu = this.nextElementSibling;
            menu.classList.toggle('show');
        });
    });
</script>