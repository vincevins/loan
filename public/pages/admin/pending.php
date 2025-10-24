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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <link rel="stylesheet" href="../../styles/table.css">
</head>

<body>
    <main class="main-content">
        <?php
        include 'header.php'
        ?>
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