<?php
include 'nav.php';
if (!isset($_SESSION['logged_in'])) {
    session_unset();
    session_destroy();
    header("location: http://localhost/casestudy-loan/loan/public/pages/user/index.php");
    exit();
}
$role = $_SESSION['user_role'];
if ($role != 'user') {
    header("http://localhost/casestudy-loan/loan/controller/logout.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paluwagan - Online Loan Application</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../styles/loan.css">
    <link rel="stylesheet" href="../../styles/progressApplication.css">
    <link rel="stylesheet" href="../../styles/toast.css">
</head>

<body>

    <section class="hero" id="home">
        <div class="hero-content">
            <div class="hero-text">
                <h1>Get The Funds You Need Quickly
                    <span></span>
                </h1>
                <p>Our online loan application process is fast, secure, and designed to get you the money you need with competitive rates and flexible terms.</p>
                <div class="cta-buttons">
                    <a href="#apply" class="btn-primary">Apply Now</a>
                </div>
            </div>
            <div class="calculator-container">
                <h3>Quick Loan Calculator</h3>
                <form id="loanForm">
                    <div class="form-group">
                        <label for="amount">Loan Amount (₱)</label>
                        <input type="number" id="amount" placeholder="10,000" min="1000" step="100" required>
                    </div>

                    <div class="form-group">
                        <label for="period">Repayment Period</label>
                        <select id="period" required>
                            <option value="12">12 months</option>
                            <option value="24">24 months</option>
                            <option value="36">36 months</option>
                            <option value="48">48 months</option>
                            <option value="60">60 months</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="rate">Interest Rate</label>
                        <input type="number" id="rate" placeholder="3.9" value="1.3" min="0.1" step="0.1" readonly>
                    </div>

                    <button type="submit" class="btn-calculate">Calculate Payment</button>
                </form>

                <div class="result-section" id="results">
                    <div class="result-item">
                        <span class="result-label">Monthly Payment:</span>
                        <span class="result-value highlight" id="monthlyPayment">$0.00</span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">Total Interest:</span>
                        <span class="result-value" id="totalInterest">$0.00</span>
                    </div>
                    <div class="result-item">
                        <span class="result-label">Total Amount:</span>
                        <span class="result-value" id="totalAmount">$0.00</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="sessionLoan" data-session-status="<?php echo htmlspecialchars($_SESSION['user_status_loan']) ?>"></div>
    <section class="features" id="features">
        <h2 class="section-title">Why Choose F.L.O.W?</h2>
        <p class="section-subtitle">We make borrowing simple, transparent, and convenient</p>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon"> <i class="fas fa-bolt"></i></div>
                <h3>Fast Approval</h3>
                <p>Get a decision in minutes and funds as soon as the next business day.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-lock"></i></div>
                <h3>Secure Process</h3>
                <p>Your information is protected with bank-level encryption technology.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-percent"></i></div>
                <h3>Competitive Rates</h3>
                <p>Enjoy competitive interest rates with no hidden fees or charges.</p>
            </div>
        </div>
    </section>

    <section id="faq">
        <h2>Frequently Asked Questions</h2>

        <div class="faq-item">
            <button class="faq-question">How long will it take to approve my loan?</button>
            <div class="faq-answer">
                <p>Approval time may vary depending on verification and loan officer review.</p>
            </div>
        </div>

        <div class="faq-item">
            <button class="faq-question">What are the requirements?</button>
            <div class="faq-answer">
                <p>A valid ID, selfie with ID, and proof of income are required to process your application.</p>
            </div>
        </div>

        <div class="faq-item">
            <button class="faq-question">How do I repay the loan?</button>
            <div class="faq-answer">
                <p>You can repay through bank transfer, e-wallet, or partner payment centers.</p>
            </div>
        </div>
        <div class="faq-item">
            <button class="faq-question">Is my personal information secure?</button>
            <div class="faq-answer">
                <p>Yes, your data is encrypted and securely reviewed only by authorized loan officers.</p>
            </div>
        </div>
    </section>

    <section class="application-section" id="apply">
        <div class="container">
            <div class="section-title">
                <h2>Online Loan Application</h2>
                <p>Complete our simple form to get started</p>
            </div>

            <div class="application-form" id="application-form">
                <div class="progress-bar">
                    <div class="progress-step step-active">
                        <div class="step-number">1</div>
                        <div class="step-label">Personal</div>
                    </div>
                    <div class="progress-step">
                        <div class="step-number">2</div>
                        <div class="step-label">Emoloyer Information</div>
                    </div>
                    <div class="progress-step">
                        <div class="step-number">3</div>
                        <div class="step-label">Loan Details</div>
                    </div>
                    <div class="progress-step">
                        <div class="step-number">4</div>
                        <div class="step-label">Attachment Documents</div>
                    </div>
                    <div class="progress-step">
                        <div class="step-number">5</div>
                        <div class="step-label">Review</div>
                    </div>
                </div>

                <form id="loanApplicationForm" method="POST">
                    <!-- Step 1: Personal Information -->
                    <div class="form-step form-step-active" id="step1">
                        <h3>Personal Information</h3>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="firstName">First Name</label>
                                <input type="text" id="firstName" name="firstName" class="form-control" value="<?php echo $_SESSION['user_first_name'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="middleName">Middle Name</label>
                                <input type="text" id="middleName" name="middleName" class="form-control" value="<?php echo $_SESSION['user_middle_name'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="lastName">Last Name</label>
                                <input type="text" id="lastName" name="lastName" class="form-control" value="<?php echo $_SESSION['user_last_name'] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" class="form-control" value="<?php echo $_SESSION['user_email'] ?>">
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="tel" id="phone" name="phone" class="form-control" value="<?php echo $_SESSION['user_contact_no'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="dob">Date of Birth</label>
                                <input type="date" id="dob" name="dob" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea id="address" name="address" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" id="city" name="city" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="province">Province</label>
                                <input type="text" id="province" name="province" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="zipCode">ZIP Code</label>
                                <input type="text" id="zipCode" name="zipCode" class="form-control" required>
                            </div>
                        </div>

                        <h3 style="margin-top: 30px;">Employment Information</h3>
                        <div class="form-group">
                            <label for="employeeId">Employee ID</label>
                            <input type="text" id="employeeId" name="employeeId" class="form-control" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="position">Position / Job Title</label>
                                <input type="text" id="position" name="position" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="monthlySalary">Monthly Salary / Income</label>
                                <input type="number" id="monthlySalary" name="monthlySalary" class="form-control" placeholder="₱" required>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="employmentLength">Length of Employment</label>
                            <select id="employmentLength" name="employmentLength" class="form-control" required>
                                <option value="">Select Employment Length</option>
                                <option value="less_than_1_year">Less than 1 year</option>
                                <option value="1_2_years">1-2 years</option>
                                <option value="3_5_years">3-5 years</option>
                                <option value="6_10_years">6-10 years</option>
                                <option value="more_than_10_years">More than 10 years</option>
                            </select>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="employmentStatus">Employment Status</label>
                                <select id="employmentStatus" name="employmentStatus" class="form-control" required>
                                    <option value="">Select Status</option>
                                    <option value="Regular">Regular</option>
                                    <option value="Probationary">Probationary</option>
                                    <option value="Contractual">Contractual</option>
                                    <option value="Part-time">Part-time</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="dateHired">Date Hired / Years of Service</label>
                                <input type="date" id="dateHired" name="dateHired" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-navigation">
                            <button type="button" class="btn" id="nextBtn">Next</button>
                        </div>
                    </div>
                    <!-- Step 2: Employment & Financial Information -->
                    <div class="form-step" id="step2">
                        <h4 style="margin-top: 25px; margin-bottom: 15px; color: #333;">Employer Information</h4>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="companyName">Company Name</label>
                                <input type="text" id="companyName" name="companyName" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="department">Department / Branch</label>
                                <input type="text" id="department" name="department" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="companyAddress">Company Address</label>
                            <textarea id="companyAddress" name="companyAddress" class="form-control" rows="3" required></textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="employerContactPerson">Employer Contact Person</label>
                                <input type="text" id="employerContactPerson" name="employerContactPerson" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="employerContactNumber">Employer Contact Number</label>
                                <input type="tel" id="employerContactNumber" name="employerContactNumber" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="employerEmail">Employer Contact Email</label>
                            <input type="email" id="employerEmail" name="employerEmail" class="form-control" required>
                        </div>

                        <div class="form-navigation">
                            <button type="button" class="btnLoan" id="prevBtn">Previous</button>
                            <button type="button" class="btnLoan" id="nextBtn2">Next</button>
                        </div>
                    </div>

                    <!-- Step 3: Loan Details -->
                    <div class="form-step" id="step3">
                        <h3>Loan Details</h3>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="loanAmount">Loan Amount ($)</label>
                                <input type="number" id="loanAmount" name="loanAmount" class="form-control" step="0.01" required>
                            </div>
                            <div class="form-group">
                                <label for="loanPurpose">Loan Purpose</label>
                                <select id="loanPurpose" name="loanPurpose" class="form-control" required>
                                    <option value="">Select Purpose</option>
                                    <option value="debt_consolidation">Debt Consolidation</option>
                                    <option value="home_improvement">Home Improvement</option>
                                    <option value="car_finance">Car Finance</option>
                                    <option value="medical">Medical Expenses</option>
                                    <option value="education">Education</option>
                                    <option value="business">Business</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="loanTerm">Loan Term (months)</label>
                                <select id="loanTerm" name="loanTerm" class="form-control" required>
                                    <option value="">Select Term</option>
                                    <option value="12">12 months</option>
                                    <option value="24">24 months</option>
                                    <option value="36">36 months</option>
                                    <option value="48">48 months</option>
                                    <option value="60">60 months</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="loanTerm">Payment Method</label>
                                <select id="paymentMethod" name="paymentMethod" class="form-control" required>
                                    <option value="">Select Term</option>
                                    <option value="payroll_deduction">Payroll Deduction</option>
                                    <option value="Paypal">Paypal</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="percentageInterest">Interest Rate (%)</label>
                                <input type="text" id="percentageInterest" name="percentageInterest" class="form-control" value="1.3" disabled required>
                            </div>
                            <div class="form-group">
                                <label for="totalInterest">Interest</label>
                                <input type="text" id="totalInterests" name="totalInterest" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="monthlyRateNoInterest">Monthly Payment (No Interest) (₱)</label>
                                <input type="text" id="monthlyRateNoInterest" name="RateNoInterest" readonly class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="wInterest">Monthly Payment (With Interest) (₱)</label>
                                <input type="text" id="wInterest" name="withInterest" readonly class="form-control" required>
                            </div>
                        </div>
                        <div class="form-navigation">
                            <button type="button" class="btnLoan" id="prevBtn2">Previous</button>
                            <button type="button" class="btnLoan" id="nextBtn3">Next</button>
                        </div>
                    </div>
                    <div class="form-step" id="step4">
                        <div class="file-upload-group">
                            <div class="file-upload-header">
                                <h4><i class="fas fa-clipboard-list"></i> Required Documents</h4>
                                <p>Please upload clear, readable copies of the following documents</p>
                            </div>

                            <div class="file-upload-item">
                                <div class="file-upload-label">
                                    <i class="fas fa-id-card icon"></i>
                                    <span>Valid Government ID (Front) <span class="required">*</span></span>
                                </div>
                                <div class="file-input-wrapper">
                                    <input type="file" id="idFront" name="idFront" accept="image/*,.pdf" required>
                                    <button type="button" class="file-upload-btn" onclick="document.getElementById('idFront').click()">
                                        <i class="fas fa-upload"></i>
                                        <span>Choose File</span>
                                    </button>
                                    <span class="file-name" id="idFrontName">No file chosen</span>
                                </div>
                            </div>

                            <div class="file-upload-item">
                                <div class="file-upload-label">
                                    <i class="fas fa-id-card-alt icon"></i>
                                    <span>Valid Government ID (Back) <span class="required">*</span></span>
                                </div>
                                <div class="file-input-wrapper">
                                    <input type="file" id="idBack" name="idBack" accept="image/*,.pdf" required>
                                    <button type="button" class="file-upload-btn" onclick="document.getElementById('idBack').click()">
                                        <i class="fas fa-upload"></i>
                                        <span>Choose File</span>
                                    </button>
                                    <span class="file-name" id="idBackName">No file chosen</span>
                                </div>
                            </div>

                            <div class="file-upload-item">
                                <div class="file-upload-label">
                                    <i class="fas fa-camera icon"></i>
                                    <span>Selfie with ID <span class="required">*</span></span>
                                </div>
                                <div class="file-input-wrapper">
                                    <input type="file" id="selfieId" name="selfieId" accept="image/*" required>
                                    <button type="button" class="file-upload-btn" onclick="document.getElementById('selfieId').click()">
                                        <i class="fas fa-upload"></i>
                                        <span>Choose File</span>
                                    </button>
                                    <span class="file-name" id="selfieIdName">No file chosen</span>
                                </div>
                            </div>

                            <div class="file-upload-item">
                                <div class="file-upload-label">
                                    <i class="fas fa-file-invoice-dollar icon"></i>
                                    <span>Proof of Income</span>
                                </div>
                                <div class="file-input-wrapper">
                                    <input type="file" id="proofIncome" name="proofIncome" accept="image/*,.pdf">
                                    <button type="button" class="file-upload-btn" onclick="document.getElementById('proofIncome').click()">
                                        <i class="fas fa-upload"></i>
                                        <span>Choose File</span>
                                    </button>
                                    <span class="file-name" id="proofIncomeName">No file chosen (Optional)</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-navigation">
                            <button type="button" class="btnLoan" id="prevBtn3">Previous</button>
                            <button type="button" class="btnLoan" id="nextBtn4">Next</button>
                        </div>
                    </div>


                    <!-- Step 4: Review Your Application -->
                    <div class="form-step" id="step5">
                        <h3>Review Your Application</h3>
                        <div id="reviewContent">
                            <!-- Review content will be populated by JavaScript -->
                        </div>
                        <div class="form-group">
                            <label class="checkbox-label">
                                <input type="checkbox" name="terms" required>
                                I agree to the <a href="#">Terms and Conditions</a> and <a href="#">Privacy Policy</a>
                            </label>
                        </div>

                        <div class="form-navigation">
                            <button type="button" class="btnLoan" id="prevBtn4">Previous</button>
                            <button type="submit" class="btnLoan">Submit Application</button>
                        </div>
                    </div>


                </form>
            </div>
            <div class="container-application" id="hasLoan" style="display:none;">
                <div id="applicationFormStatus">
                    <h1 style="text-align: center; margin-bottom:20px;">Application Status</h1>
                    <div class="progress-bar-application">
                        <div class="progress-step-application step-active-application" id="step1">
                            <div class="step-number-application">✔</div>
                            <div class="step-label-application">Submitted:</div>
                            <div class="step-label-application" id="submittedDate"></div>
                        </div>
                        <div class="progress-step-application step-active-application" id="step2">
                            <div class="step-number-application" id="step2Review"> <i class="fas fa-file-alt"></i>
                                <i class="fas fa-search"></i>
                            </div>
                            <div class="step-number-application" id="step2Approved" style="display: none;">✔</div>
                            <div class="step-label-application">HR Verification</div>
                            <div class="step-label-application" id="hrverifyStatus"></div>
                        </div>
                        <div class="progress-step-application step-active-application" id="step3">
                            <div class="step-number-application" id="step3Review"> <i class="fas fa-file-alt"></i>
                                <i class="fas fa-search"></i>
                            </div>
                            <div class="step-number-application" id="step3Approved" style="display: none;">✔</div>
                            <div class="step-label-application">Loan Officer Approval</div>
                            <div class="step-label-application" id="verifyStatus"></div>
                        </div>
                        <div class="progress-step-application step-active-application" id="step4">
                            <div class="step-number-application" id="step4Review"> <i class="fas fa-file-alt"></i>
                                <i class="fas fa-search"></i>
                            </div>
                            <div class="step-number-application" id="step4Approved" style="display: none;">✔</div>
                            <div class="step-label-application">Application Status</div>
                            <div class="step-label-application" id="step4Txt">Application Under Review</div>
                        </div>
                    </div>
                </div>

                <button type="button" class="viewApplication" id="viewApplication">View Application Details</button>

                <div id="ApplicationDetails">

                </div>
                <button type="button" class="ApplicationStatus" id="ApplicationStatus" style="display:none;">Back to Application Status</button>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>SecureLoan</h3>
                    <p>Providing fast and secure loan solutions to help you achieve your financial goals.</p>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="footer-column">
                    <h3>Loan Products</h3>
                    <ul>
                        <li><a href="#">Personal Loans</a></li>
                        <li><a href="#">Business Loans</a></li>
                        <li><a href="#">Debt Consolidation</a></li>
                        <li><a href="#">Home Improvement Loans</a></li>
                        <li><a href="#">Auto Loans</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Company</h3>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">How It Works</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Contact Us</h3>
                    <ul>
                        <li><i class="fas fa-map-marker-alt"></i> Lugar ng mga Pogi</li>
                        <li><i class="fas fa-phone"></i> 0969696969</li>
                        <li><i class="fas fa-envelope"></i> dawdasdawda</li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2025 F.L.O.W. All rights reserved.</p>
            </div>
        </div>
    </footer>
    <div class="toast-container" id="toastContainer"></div>
    <script src="../../js/btnViewApplication.js"></script>
    <script src="../../js/loan.js"></script>
    <script src="../../js/loanForm.js"></script>
</body>

</html>