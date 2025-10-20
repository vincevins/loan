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
        <div id="modalView" class="modal" style="display: none;">
            <div class="modal-content">
                <h1>View Details</h1>
                <span class="close">&times;</span>
                <div class="modal-body">
                    <div class="content-field">
                        <p><strong>Name:</strong> <span id="fullName"></span></p>
                        <p><strong>Email:</strong> <span id="detailEmail"></span></p>
                        <p><strong>Phone:</strong> <span id="detailPhone"></span></p>
                        <p><strong>Address:</strong> <span id="detailAddress"></span></p>
                       
                    </div>

                    <div class="id-images-section">
                        <h3>Valid ID Images</h3>
                        <div class="id-images-container">
                            <div class="id-image-wrapper">
                                <img id="idImageFront" src="" alt="Valid ID - Front" />
                                <p>Front Side</p>
                            </div>
                            <div class="id-image-wrapper">
                                <img id="idImageBack" src="" alt="Valid ID - Back" />
                                <p>Back Side</p>
                            </div>
                            <div class="id-image-wrapper">
                                <img id="idSelfie" src="" alt="Valid ID - Back" />
                                <p>Selfie with ID</p>
                            </div>
                            <div class="id-image-wrapper">
                                <img id="proofIncome" src="" alt="Valid ID - Back" />
                                <p>Proof of Income</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="toast-container" id="toastContainer"></div>
    </main>
    <script src="../../js/underReview.js"></script>
    <script src="../../js/underReviewModal.js"></script>
</body>

</html>