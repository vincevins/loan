<?php
include 'sidebar.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Loans</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <link rel="stylesheet" href="../../styles/admin_style.css">
    <link rel="stylesheet" href="../../styles/table.css">
</head>

<body>
    <main class="main-content">
        <?php
        include 'header.php'
        ?>
        <div class="page-content">
            <div class="exportBtn">
                <input type="text" placeholder="Search..." class="searchField">
                <button id="exportExcel"><i class="fa-regular fa-file-excel" style="font-size:20px"></i></button>
                <button id="exportPdf"><i class="fa-solid fa-file" style="font-size:20px"></i></button>
            </div>
            <table id="overdue">
                <thead>
                    <tr>
                        <th>Loan ID</th>
                        <th>Borrower</th>
                        <th>Total Payment Due</th>
                        <th>Due Date</th>
                        <th>Days Overdue</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody class="listOverdue">

                </tbody>
            </table>

        </div>

        <div id="modalOverdue" class="modal" style="display:none;">
            <div class="modal-content">
                <div class="modal-header">
                    <h1>Loan Application Details</h1>
                    <span class="BTNclose">&times;</span>
                </div>
                <div class="modal-body">
                    <div class="section">
                        <div class="section-title">Payment Information</div>
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-label">Borrower</div>
                                <div class="info-value" id="overdueFname"></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Total Payment Due</div>
                                <div class="info-value" id="total-paymentdue"></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Due Date</div>
                                <div class="info-value" id="payment-duedate"></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Days Overdue</div>
                                <div class="info-value" id="days-overdue"></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Late payment penalty</div>
                                <div class="info-value" id="latepayment"></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Payment Status</div>
                                <div class="info-value" id="paystatus"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <script src="../../js/overdue.js"></script>

</body>

</html>