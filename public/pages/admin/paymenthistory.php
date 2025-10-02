<?php
include 'sidebar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment History</title>
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

    <!-- Icons + Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../../styles/table.css">
</head>
<body>
<main class="main-content">
    <header class="main-header">
        <h1>Payment History</h1>
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
        <!-- Payment History Table -->
        <table id="paymentHistoryTable" class="dataTable display nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Payment ID</th>
                    <th>Loan ID</th>
                    <th>Borrower</th>
                    <th>Amount Paid</th>
                    <th>Payment Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>PAY-1001</td>
                    <td>Kurakot 1</td>
                    <td>Zeldy Co</td>
                    <td>₱100,000</td>
                    <td>2025-09-15</td>
                    <td><span class="status-approved">Approved</span></td>
                </tr>
                <tr>
                    <td>PAY-1002</td>
                    <td>Kurakot 2</td>
                    <td>Sarah Discaya</td>
                    <td>₱250,000</td>
                    <td>2025-09-20</td>
                    <td><span class="status-approved">Approved</span></td>
                </tr>
                <tr>
                    <td>PAY-1003</td>
                    <td>Kurakot 3</td>
                    <td>Engr. Alcantara</td>
                    <td>₱500,000</td>
                    <td>2025-09-25</td>
                    <td><span class="status-rejected">Rejected</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</main>

<script>
$(document).ready(function () {
    $('#paymentHistoryTable').DataTable({
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
</script>
</body>
</html>
