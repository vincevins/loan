<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    session_unset();
    session_destroy();
    header("location: http://localhost/casestudy-loan/loan/public/pages/user/index.php");
    exit();
}
$role = $_SESSION['user_role'];
if ($role != 'admin') {
    header("location: http://localhost/casestudy-loan/loan/public/pages/user/index.php");
    exit();
}
?>
<link rel="stylesheet" href="../../styles/admin_style.css">
<link rel="icon" type="image/png" href="../../img/logo1.1.png">
<nav class="sidebar">
    <div class="sidebar-header">
        <img src="../../img/logo1.1.png" alt="Company Logo">
        <h1>F.L.O.W</h1>
    </div>
    <ul class="sidebar-nav">
        <div class="menu-title">Main</div>
            <li><a href="index.php" class="active"><i class="fas fa-border-all"></i>Dashboard</a></li>
        <div class="menu-title">Application Form</div>
            <li><a href="under_review.php"><i class="fas fa-clipboard-list"></i>Under Review</a></li>
            
            <li><a href="approved.php"><i class="fas fa-clipboard-check"></i>Approved</a></li>
            <li><a href="rejected.php"><i class="fas fa-times-circle"></i> Rejected</a></li>
        <div class="menu-title">Payment</div>
            <li><a href="paymenthistory.php"><i class="fas fa-wallet"></i>Payment History</a></li>
        <div class="menu-title">Active Loan</div>
            <li><a href="../admin/overdue.php"><i class="fa-solid fa-clock"></i>Overdue</a></li>
            <li><a href="paidloans.php"><i class="fas fa-piggy-bank"></i>Paid Loans</a></li>
            <li><a href="listloan.php"><i class="fa-solid fa-clock"></i>List Loan Details</a></li>
    </ul>
</nav>
<script src="../../js/sidebar.js"></script>