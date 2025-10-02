<?php
include 'sidebar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paid Loans</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

    <!-- Icons + SweetAlert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom Table CSS -->
    <link rel="stylesheet" href="../../styles/table.css">
</head>
<body>
<main class="main-content">
    <header class="main-header">
        <h1>Paid Loans</h1>
        <div class="user-info">
            <div class="notification-container">
                <img src="../../img/notification.gif" alt="Notifications" class="notification-bell">
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

    <div class="page-content">
        <!-- Paid Loans Table -->
        <table id="paidLoansTable" class="dataTable display nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Loan ID</th>
                    <th>Borrower</th>
                    <th>Loan Amount</th>
                    <th>Date Paid</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>PAID-5001</td>
                    <td>Juan Dela Cruz</td>
                    <td>₱50,000</td>
                    <td>2025-09-20</td>
                    <td><span class="status-approved">Paid</span></td>
                    <td><button class="btn-view" onclick="viewReceipt('PAID-5001','Juan Dela Cruz','₱50,000','2025-09-20')">View Receipt</button></td>
                </tr>
                <tr>
                    <td>PAID-5002</td>
                    <td>Maria Santos</td>
                    <td>₱120,000</td>
                    <td>2025-09-25</td>
                    <td><span class="status-approved">Paid</span></td>
                    <td><button class="btn-view" onclick="viewReceipt('PAID-5002','Maria Santos','₱120,000','2025-09-25')">View Receipt</button></td>
                </tr>
                <tr>
                    <td>PAID-5003</td>
                    <td>Pedro Reyes</td>
                    <td>₱75,000</td>
                    <td>2025-09-28</td>
                    <td><span class="status-approved">Paid</span></td>
                    <td><button class="btn-view" onclick="viewReceipt('PAID-5003','Pedro Reyes','₱75,000','2025-09-28')">View Receipt</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</main>

<script>
$(document).ready(function () {
    $('#paidLoansTable').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        responsive: true,
        dom: 'Bfrtip',
        lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ], 
        buttons: [
            { extend: 'excel', text: '<i class="fa fa-file-excel"></i>', className: 'dt-button' },
            { extend: 'pdf', text: '<i class="fa fa-file-pdf"></i>', className: 'dt-button' },
            { extend: 'print', text: '<i class="fa fa-print"></i>', className: 'dt-button' }
        ]
    });
});

// SweetAlert View Receipt
function viewReceipt(loanId, borrower, amount, date) {
    Swal.fire({
        title: 'Payment Receipt',
        html: `
            <p><strong>Loan ID:</strong> ${loanId}</p>
            <p><strong>Borrower:</strong> ${borrower}</p>
            <p><strong>Amount Paid:</strong> ${amount}</p>
            <p><strong>Date Paid:</strong> ${date}</p>
        `,
        icon: 'info',
        confirmButtonText: 'Close',
        confirmButtonColor: '#3498db'
    });
}
</script>
</body>
</html>
