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
    <link rel="stylesheet" href="../../styles/admin_style.css">
    <link rel="stylesheet" href="../../styles/table.css">
    <link rel="stylesheet" href="../../styles/modal.css">
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
            <table id="paid">
                <thead>
                    <tr>
                        <th>Loan ID</th>
                        <th>Borrower</th>
                        <th>Total Payment Due</th>
                        <th>Due Date</th>
                        <th>Date Paid</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody class="listPaid">

                </tbody>
            </table>

        </div>
        <div id="modalActivePaid" class="modal" style="display:none;">
            <div class="modal-content">
                <div class="modal-header">
                    <h1>Loan Application Details</h1>
                     <span class="closeBTN">&times;</span>
                </div>
                <div class="modal-body">
                    <div class="section">
                        <div class="section-title">Payment Information</div>
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-label">Payment Amount</div>
                                <div class="info-value" id="payment-amount"></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Date of Payment</div>
                                <div class="info-value" id="date-payment"></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Payment without Interest</div>
                                <div class="info-value" id="without-interest"></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Interest paid</div>
                                <div class="info-value" id="interest-paid"></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Payment Reference #</div>
                                <div class="info-value" id="ref-payment"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="../../js/activeLoanPaid.js"></script>
</body>

</html>