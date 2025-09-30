<?php
include 'sidebar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Loan Applications</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="emp_loan.css">
</head>
<body>
<main class="main-content">
    <header class="main-header">
        <h1>Employee Loan Applications</h1>
        <div class="user-info">
            <div class="notification-container">
                <img src="pictures/notification.gif" alt="Notifications" class="notification-bell">
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
        <table id="employeeLoansTable" class="display nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Loan ID</th>
                    <th>Borrower</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Date Applied</th>
                    <th>Reviewer</th>
                    <th>Review Date</th>
                    <th>Remarks</th>
                    <th>Payment Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Example rows -->
                <tr>
                    <td>Loan-201</td>
                    <td>Ana Santos</td>
                    <td>₱400,000</td>
                    <td class="status-approved">Approved</td>
                    <td>2025-09-10</td>
                    <td>Admin</td>
                    <td>2025-09-12</td>
                    <td>All requirements complete</td>
                    <td class="payment-paid">Paid</td>
                    <td><button class="btn-view"><i class="fa fa-eye"></i></button></td>
                </tr>
                <tr>
                    <td>Loan-202</td>
                    <td>Juan Dela Cruz</td>
                    <td>₱250,000</td>
                    <td class="status-pending">Pending</td>
                    <td>2025-09-15</td>
                    <td>Admin</td>
                    <td>-</td>
                    <td>Waiting for documents</td>
                    <td class="payment-unpaid">Not Paid</td>
                    <td><button class="btn-view"><i class="fa fa-eye"></i></button></td>
                </tr>
                <tr>
                    <td>Loan-203</td>
                    <td>Maria Lopez</td>
                    <td>₱600,000</td>
                    <td class="status-rejected">Rejected</td>
                    <td>2025-09-18</td>
                    <td>Admin</td>
                    <td>2025-09-19</td>
                    <td>Incomplete requirements</td>
                    <td class="payment-unpaid">Not Paid</td>
                    <td><button class="btn-view"><i class="fa fa-eye"></i></button></td>
                </tr>
            </tbody>
        </table>
    </div>
</main>

<script>
$(document).ready(function () {
    const table = $('#employeeLoansTable').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        responsive: true,
        dom: 'Bfrtip',
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        buttons: [
            { extend: 'copy', text: '<i class="fa fa-copy"></i>' },
            { extend: 'excel', text: '<i class="fa fa-file-excel"></i>' },
            { extend: 'pdf', text: '<i class="fa fa-file-pdf"></i>' },
            { extend: 'print', text: '<i class="fa fa-print"></i>' }
        ]
    });

    // Loan Details Popup
    $('#employeeLoansTable tbody').on('click', '.btn-view', function () {
        let rowData = $(this).closest('tr').find('td').map(function () {
            return $(this).text();
        }).get();

        Swal.fire({
            title: `Loan Details: ${rowData[0]}`,
            html: `
                <strong>Borrower:</strong> ${rowData[1]}<br>
                <strong>Amount:</strong> ${rowData[2]}<br>
                <strong>Status:</strong> ${rowData[3]}<br>
                <strong>Date Applied:</strong> ${rowData[4]}<br>
                <strong>Reviewer:</strong> ${rowData[5]}<br>
                <strong>Review Date:</strong> ${rowData[6]}<br>
                <strong>Remarks:</strong> ${rowData[7]}<br>
                <strong>Payment Status:</strong> ${rowData[8]}
            `,
            icon: 'info',
            confirmButtonColor: '#3498db'
        });
    });
});
</script>
</body>
</html>
