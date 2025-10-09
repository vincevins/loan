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
    <link rel="stylesheet" href="../../styles/table.css">
</head>

<body>
    <main class="main-content">
        <header class="main-header">
            <h1>Pending Loans</h1>
            <div class="user-info">
                <div class="notification-container">
                    <i class="notification-bell fas fa-bell"></i>
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
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </main>
    <script>
        $(document).ready(function() {
            $('#loansTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                responsive: true,
                dom: 'Bfrtip',
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"]
                ],
                buttons: [{
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel"></i>',
                        attr: {
                            title: 'Export to Excel'
                        }
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf"></i>',
                        attr: {
                            title: 'Export to PDF'
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        attr: {
                            title: 'Print Table'
                        }
                    }
                ]
            });
        });
    </script>
</body>

</html>