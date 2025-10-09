<?php
include 'sidebar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejected Applications</title>
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
    <link rel="stylesheet" href="../../styles/table.css">
</head>
<body>
<main class="main-content">
     <?php
        include 'header.php'
     ?>

    <div class="page-content">
        <table id="rejectedTable" class="display nowrap" style="width:100%">
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
                    <td>Loan-201</td>
                    <td>Juan Dela Cruz</td>
                    <td>₱250,000</td>
                    <td class="status-rejected">Rejected</td>
                    <td>2025-08-20</td>
                    <td>Admin</td>
                    <td>2025-08-22</td>
                    <td>2</td>
                    <td>Insufficient collateral</td>
                    <td>
                        <button class="btn-view"><i class="fa fa-eye"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>Loan-202</td>
                    <td>Maria Clara</td>
                    <td>₱400,000</td>
                    <td class="status-rejected">Rejected</td>
                    <td>2025-08-25</td>
                    <td>Admin</td>
                    <td>2025-08-27</td>
                    <td>3</td>
                    <td>Low credit score</td>
                    <td>
                        <button class="btn-view"><i class="fa fa-eye"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>Loan-203</td>
                    <td>Pedro Penduko</td>
                    <td>₱150,000</td>
                    <td class="status-rejected">Rejected</td>
                    <td>2025-09-01</td>
                    <td>Admin</td>
                    <td>2025-09-02</td>
                    <td>1</td>
                    <td>Incomplete documents</td>
                    <td>
                        <button class="btn-view"><i class="fa fa-eye"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</main>

<script>
    $(document).ready(function () {
    const table = $('#rejectedTable').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        responsive: true,
        dom: 'Bfrtip',
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        buttons: [
            { extend: 'excel', text: '<i class="fa fa-file-excel"></i>', attr: { title: 'Export to Excel' } },
            { extend: 'pdf', text: '<i class="fa fa-file-pdf"></i>', attr: { title: 'Export to PDF' } },
            { extend: 'print', text: '<i class="fa fa-print"></i>', attr: { title: 'Print Table' } }
        ]
    });

    $('#rejectedTable tbody').on('click', '.btn-view', function () {
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
                <strong>Documents Submitted:</strong> ${rowData[7]}<br>
                <strong>Remarks:</strong> ${rowData[8]}
            `,
            icon: 'error',
            confirmButtonColor: '#e74c3c'
        });
    });
});

</script>
</body>
</html>
