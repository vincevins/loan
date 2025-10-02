<?php
include 'sidebar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overdue Loans</title>
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
        <h1>Overdue Loans</h1>
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
        <!-- Overdue Loans Table -->
        <table id="overdueLoansTable" class="dataTable display nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Loan ID</th>
                    <th>Borrower</th>
                    <th>Loan Amount</th>
                    <th>Due Date</th>
                    <th>Days Overdue</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>LOAN-3001</td>
                    <td>Juan Dela Cruz</td>
                    <td>₱50,000</td>
                    <td>2025-08-15</td>
                    <td>45</td>
                    <td><span class="status-overdue">Overdue</span></td>
                    <td><button class="btn-reject" onclick="sendReminder('Juan Dela Cruz')">Send Reminder</button></td>
                </tr>
                <tr>
                    <td>LOAN-3002</td>
                    <td>Maria Santos</td>
                    <td>₱120,000</td>
                    <td>2025-09-01</td>
                    <td>30</td>
                    <td><span class="status-overdue">Overdue</span></td>
                    <td><button class="btn-reject" onclick="sendReminder('Maria Santos')">Send Reminder</button></td>
                </tr>
                <tr>
                    <td>LOAN-3003</td>
                    <td>Pedro Reyes</td>
                    <td>₱75,000</td>
                    <td>2025-09-10</td>
                    <td>20</td>
                    <td><span class="status-overdue">Overdue</span></td>
                    <td><button class="btn-reject" onclick="sendReminder('Pedro Reyes')">Send Reminder</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</main>

<script>
$(document).ready(function () {
    $('#overdueLoansTable').DataTable({
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

// SweetAlert Reminder
function sendReminder(borrower) {
    Swal.fire({
        title: 'Send Reminder?',
        text: 'Do you want to send a payment reminder to ' + borrower + '?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, Send it!',
        cancelButtonText: 'Cancel',
        confirmButtonColor: '#e74c3c',
        cancelButtonColor: '#95a5a6'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                'Reminder Sent!',
                'A payment reminder has been sent to ' + borrower + '.',
                'success'
            )
        }
    });
}
</script>
</body>
</html>
