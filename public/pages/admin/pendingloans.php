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
     <?php
        include 'header.php'
      ?>

    <div class="page-content">
        <!-- Pending Loans Table -->
        <table id="pendingLoansTable" class="dataTable display nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Loan ID</th>
                    <th>Borrower</th>
                    <th>Loan Amount</th>
                    <th>Date Applied</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>PENDING-1001</td>
                    <td>Juan Dela Cruz</td>
                    <td>₱80,000</td>
                    <td>2025-09-15</td>
                    <td><span class="status-pending">Pending</span></td>
                    <td>
                        <button class="btn-approve" onclick="approveLoan('PENDING-1001','Juan Dela Cruz')">Approve</button>
                        <button class="btn-reject" onclick="rejectLoan('PENDING-1001','Juan Dela Cruz')">Reject</button>
                    </td>
                </tr>
                <tr>
                    <td>PENDING-1002</td>
                    <td>Maria Santos</td>
                    <td>₱150,000</td>
                    <td>2025-09-18</td>
                    <td><span class="status-pending">Pending</span></td>
                    <td>
                        <button class="btn-approve" onclick="approveLoan('PENDING-1002','Maria Santos')">Approve</button>
                        <button class="btn-reject" onclick="rejectLoan('PENDING-1002','Maria Santos')">Reject</button>
                    </td>
                </tr>
                <tr>
                    <td>PENDING-1003</td>
                    <td>Pedro Reyes</td>
                    <td>₱65,000</td>
                    <td>2025-09-20</td>
                    <td><span class="status-pending">Pending</span></td>
                    <td>
                        <button class="btn-approve" onclick="approveLoan('PENDING-1003','Pedro Reyes')">Approve</button>
                        <button class="btn-reject" onclick="rejectLoan('PENDING-1003','Pedro Reyes')">Reject</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</main>

<script>
$(document).ready(function () {
    $('#pendingLoansTable').DataTable({
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

// Approve Loan
function approveLoan(loanId, borrower) {
    Swal.fire({
        title: 'Approve Loan?',
        text: 'Do you want to approve the loan of ' + borrower + ' (' + loanId + ')?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, Approve',
        cancelButtonText: 'Cancel',
        confirmButtonColor: '#27ae60',
        cancelButtonColor: '#95a5a6'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                'Approved!',
                borrower + ' loan has been approved.',
                'success'
            )
        }
    });
}

// Reject Loan
function rejectLoan(loanId, borrower) {
    Swal.fire({
        title: 'Reject Loan?',
        text: 'Do you want to reject the loan of ' + borrower + ' (' + loanId + ')?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, Reject',
        cancelButtonText: 'Cancel',
        confirmButtonColor: '#e74c3c',
        cancelButtonColor: '#95a5a6'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                'Rejected!',
                borrower + ' loan has been rejected.',
                'error'
            )
        }
    });
}
</script>
</body>
</html>
