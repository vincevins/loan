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
    <link rel="stylesheet" href="../../styles/toast.css">
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
            <table id="under_review">
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="list">
                </tbody>
            </table>

        </div>
        <div id="modalView" class="modal" style="display:none;">
            <div class="modal-content">
                <div class="modal-header">
                    <h1>Loan Application Details</h1>
                    <button class="close" onclick="closeModal()">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="section">
                        <div class="section-title">Personal Information</div>
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-label">Full Name</div>
                                <div class="info-value" id="fullName"></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Email Address</div>
                                <div class="info-value" id="detailEmail"></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Phone Number</div>
                                <div class="info-value" id="detailPhone"></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Address</div>
                                <div class="info-value" id="detailAddress"></div>
                            </div>
                        </div>
                    </div>

                    <div class="section">
                        <div class="section-title">Financial Information</div>
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-label">Annual Income</div>
                                <div class="info-value" id="detailAnnualincome"></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Loan Amount Requested</div>
                                <div class="info-value" id="detailLoanAmount"></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Loan Purpose</div>
                                <div class="info-value" id="detailPurpose"></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Loan Term</div>
                                <div class="info-value" id="detailLoanTerm"></div>
                            </div>
                        </div>
                    </div>

                    <div class="id-images-section">
                        <div class="section-title">Verification Documents</div>
                        <div class="id-images-container">
                            <div class="id-image-wrapper">
                                <img id="idImageFront" src="" alt="Valid ID - Front" />
                                <p>ID Front Side</p>
                            </div>
                            <div class="id-image-wrapper">

                                <img id="idImageBack" src="" alt="Valid ID - back" />
                                <p>ID Back Side</p>
                            </div>
                            <div class="id-image-wrapper">
                                <img id="idSelfie" src="" alt="Selfie with ID" />
                                <p>Selfie with ID</p>
                            </div>
                            <div class="id-image-wrapper">
                                <img id="proofIncome" src="" alt="Proof of Income" />
                                <p>Proof of Income</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="imgModal" class="img-modal" style="display:none;">
            <span class="closePreview">&times;</span>
            <img class="imgPreviewContent" id="modalImg">
        </div>
        <div class="toast-container" id="toastContainer"></div>
    </main>
    <script src="../../js/underReview.js"></script>
    <script src="../../js/underReviewModal.js"></script>
</body>

</html>