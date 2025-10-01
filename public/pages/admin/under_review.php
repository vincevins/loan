<?php
include 'sidebar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Loans</title>
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
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="under_review.css">
</head>
<body>
<main class="main-content">
    <header class="main-header">
        <h1>Under Review</h1>
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
<table id="loansTable" class="display nowrap" style="width:100%">
    <thead>
        <tr>
            <th>Loan ID</th>
            <th>Borrower</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Date Applied</th>
            <th>Reviewer</th>
            <th>Review Date</th>
            <th>Documents Submitted</th>
            <th>Remarks</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Kurakot 1</td>
            <td>Zeldy Co</td>
            <td>₱454,000,000</td>
            <td>Under Review</td>
            <td>2025-09-01</td>
            <td>Admin</td>
            <td>2025-09-02</td>
            <td>0</td>
            <td>Initial hearing</td>
            <td>
                <button class="btn-approve"><i class="fa fa-check"></i></button>
                <button class="btn-reject"><i class="fa fa-times"></i></button>
                <button class="btn-view"><i class="fa fa-eye"></i></button>
            </td>
        </tr>
        <tr>
            <td>Kurakot 2</td>
            <td>Sarah Discaya</td>
            <td>₱454,000,000</td>
            <td>Under Review</td>
            <td>2025-09-05</td>
            <td>Admin</td>
            <td>2025-09-06</td>
            <td>0</td>
            <td>Initial hearing</td>
            <td>
                <button class="btn-approve"><i class="fa fa-check"></i></button>
                <button class="btn-reject"><i class="fa fa-times"></i></button>
                <button class="btn-view"><i class="fa fa-eye"></i></button>
            </td>
        </tr>
        <tr>
            <td>Kurakot 3</td>
            <td>Engr. Alcantara</td>
            <td>₱454,000,000</td>
            <td>Under Review</td>
            <td>2025-09-10</td>
            <td>Admin</td>
            <td>2025-09-11</td>
            <td>0</td>
            <td>Initial hearing</td>
            <td>
                <button class="btn-approve"><i class="fa fa-check"></i></button>
                <button class="btn-reject"><i class="fa fa-times"></i></button>
                <button class="btn-view"><i class="fa fa-eye"></i></button>
            </td>
        </tr>
    </tbody>
</table>

    </div>
</main>
<script>
$(document).ready(function () {
    // database table
    const table = $('#loansTable').DataTable({
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

    // Action button functionalities
    $('#loansTable tbody').on('click', '.btn-approve', function () {
        let btn = $(this);
        let loanID = btn.closest('tr').find('td:first').text();
        Swal.fire({
            title: 'Are you sure?',
            text: `You are approving Loan ID: ${loanID}`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#27ae60',
            cancelButtonColor: '#e74c3c',
            confirmButtonText: 'Yes, Approve!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire('Approved!', `Loan ID: ${loanID} has been approved.`, 'success');
                btn.closest('tr').find('td:eq(3)').text('Approved').addClass('status-approved');
            }
        });
    });

    $('#loansTable tbody').on('click', '.btn-reject', function () {
        let btn = $(this);
        let loanID = btn.closest('tr').find('td:first').text();
        Swal.fire({
            title: 'Are you sure?',
            text: `You are rejecting Loan ID: ${loanID}`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e74c3c',
            cancelButtonColor: '#3498db',
            confirmButtonText: 'Yes, Reject!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire('Rejected!', `Loan ID: ${loanID} has been rejected.`, 'error');
                btn.closest('tr').find('td:eq(3)').text('Rejected').addClass('status-rejected');
            }
        });
    });

    $('#loansTable tbody').on('click', '.btn-view', function () {
        let rowData = $(this).closest('tr').find('td').map(function () { return $(this).text(); }).get();
        Swal.fire({
            title: `Loan Details: ${rowData[0]}`,
            html: `
                <strong>Borrower:</strong> ${rowData[1]}<br>
                <strong>Amount:</strong> ${rowData[2]}<br>
                <strong>Status:</strong> ${rowData[3]}<br>
                <strong>Date Applied:</strong> ${rowData[4]}<br>
                <strong>Reviewer:</strong> ${rowData[5]}<br>
                <strong>Review Date:</strong> ${rowData[6]}<br>
                <strong>Documents Submitted:</strong> ${rowData[7]}<br>
                <strong>Remarks:</strong> ${rowData[8]}
            `,
            icon: 'info',
            confirmButtonColor: '#3498db'
        });
    });
});
</script>
</body>
</html>
