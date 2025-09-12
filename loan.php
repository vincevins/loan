<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paluwagan - Online Loan Application</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="loan.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <i class="fas fa-hand-holding-usd"></i>
                    <h1>Paluwagan</h1>
                </div>
                <button class="responsive-nav-toggle" id="navToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <nav id="mainNav">
                    <ul>
                        <li><a href="loan.php">Home</a></li>
                        <li><a href="payment_tracker.php">Payment Tracker</a></li>
                        <li><a href="#">Loan Options</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#apply" class="btn">Apply Now</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <section class="hero">
        <div class="container">
            <h2>Get The Funds You Need Quickly & Securely</h2>
            <p>Our online loan application process is fast, secure, and designed to get you the money you need with competitive rates and flexible terms.</p>
            <a href="#apply" class="btn">Start Application</a>
        </div>
    </section>

    <section class="features">
        <div class="container">
            <div class="section-title">
                <h2>Why Choose Paluwagan ni Carlos?</h2>
                <p>We make borrowing simple, transparent, and convenient</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <i class="fas fa-bolt"></i>
                    <h3>Fast Approval</h3>
                    <p>Get a decision in minutes and funds as soon as the next business day.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-lock"></i>
                    <h3>Secure Process</h3>
                    <p>Your information is protected with bank-level encryption technology.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-percent"></i>
                    <h3>Competitive Rates</h3>
                    <p>Enjoy competitive interest rates with no hidden fees or charges.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="application-section" id="apply">
        <div class="container">
            <div class="section-title">
                <h2>Online Loan Application</h2>
                <p>Complete our simple form to get started</p>
            </div>
            
            <div class="application-form">
                <div class="progress-bar">
                    <div class="progress-step step-active">
                        <div class="step-number">1</div>
                        <div class="step-label">Personal</div>
                    </div>
                    <div class="progress-step">
                        <div class="step-number">2</div>
                        <div class="step-label">Financial</div>
                    </div>
                    <div class="progress-step">
                        <div class="step-number">3</div>
                        <div class="step-label">Loan Details</div>
                    </div>
                    <div class="progress-step">
                        <div class="step-number">4</div>
                        <div class="step-label">Review</div>
                    </div>
                </div>
                
                <form id="loanApplicationForm" action="process.php" method="POST">
                    <!-- Step 1-->
                    <div class="form-step form-step-active" id="step1">
                        <h3>Personal Information</h3>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="firstName">First Name</label>
                                <input type="text" id="firstName" name="firstName" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="lastName">Last Name</label>
                                <input type="text" id="lastName" name="lastName" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="dob">Date of Birth</label>
                            <input type="date" id="dob" name="dob" class="form-control" required>
                        </div>
                        <div class="form-navigation">
                            <button type="button" class="btn" id="nextBtn">Next</button>
                        </div>
                    </div>
                    
                    <!-- Step 2-->
                    <div class="form-step" id="step2">
                        <h3>Financial Information</h3>
                        <div class="form-group">
                            <label for="employment">Employment Status</label>
                            <select id="employment" name="employment" class="form-control" required>
                                <option value="">Select Employment Status</option>
                                <option value="employed">Employed</option>
                                <option value="self-employed">Self-Employed</option>
                                <option value="unemployed">Unemployed</option>
                                <option value="retired">Retired</option>
                                <option value="student">Student</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="income">Annual Income/label>
                            <input type="number" id="income" name="income" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="housing">Housing Payment</label>
                            <input type="number" id="housing" name="housing" class="form-control" required>
                        </div>
                        <div class="form-navigation">
                            <button type="button" class="btn" id="prevBtn">Previous</button>
                            <button type="button" class="btn" id="nextBtn2">Next</button>
                        </div>
                    </div>
                    
                    <!-- Step 3-->
                    <div class="form-step" id="step3">
                        <h3>Loan Details</h3>
                        <div class="form-group">
                            <label for="loanAmount">Loan Amount ($)</label>
                            <input type="number" id="loanAmount" name="loanAmount" class="form-control" required>
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
                        <div class="form-navigation">
                            <button type="button" class="btn" id="prevBtn2">Previous</button>
                            <button type="button" class="btn" id="nextBtn3">Next</button>
                        </div>
                    </div>
                    
                    <!-- Step 4 -->
                    <div class="form-step" id="step4">
                        <h3>Review Your Application</h3>
                        <div id="reviewContent">
                        </div>
                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="terms" required> 
                                I agree to the <a href="#">Terms and Conditions</a> and <a href="#">Privacy Policy</a>
                            </label>
                        </div>
                        <div class="form-navigation">
                            <button type="button" class="btn" id="prevBtn3">Previous</button>
                            <button type="submit" class="btn">Submit Application</button>
                        </div>
                    </div>
                </form>
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
                <p>&copy; 2025 Paluwagan ni Carlos. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Toggle mobile navigation
        document.getElementById('navToggle').addEventListener('click', function() {
            document.getElementById('mainNav').classList.toggle('active');
        });
        
        // Multi-step form functionality
        const formSteps = document.querySelectorAll('.form-step');
        const stepButtons = {
            nextBtn: document.getElementById('nextBtn'),
            nextBtn2: document.getElementById('nextBtn2'),
            nextBtn3: document.getElementById('nextBtn3'),
            prevBtn: document.getElementById('prevBtn'),
            prevBtn2: document.getElementById('prevBtn2'),
            prevBtn3: document.getElementById('prevBtn3')
        };
        
        const progressSteps = document.querySelectorAll('.progress-step');
        
        let currentStep = 0;
        
        // Update form steps
        function updateFormStep() {
            formSteps.forEach((step, index) => {
                step.classList.toggle('form-step-active', index === currentStep);
            });
            
            progressSteps.forEach((step, index) => {
                step.classList.toggle('step-active', index === currentStep);
            });
            
            // Update review content on the last step
            if (currentStep === 3) {
                updateReviewContent();
            }
        }
        
        // Next button event listeners
        stepButtons.nextBtn.addEventListener('click', function() {
            if (validateStep(0)) {
                currentStep = 1;
                updateFormStep();
            }
        });
        
        stepButtons.nextBtn2.addEventListener('click', function() {
            if (validateStep(1)) {
                currentStep = 2;
                updateFormStep();
            }
        });
        
        stepButtons.nextBtn3.addEventListener('click', function() {
            if (validateStep(2)) {
                currentStep = 3;
                updateFormStep();
            }
        });
        
        // Previous button event listeners
        stepButtons.prevBtn.addEventListener('click', function() {
            currentStep = 0;
            updateFormStep();
        });
        
        stepButtons.prevBtn2.addEventListener('click', function() {
            currentStep = 1;
            updateFormStep();
        });
        
        stepButtons.prevBtn3.addEventListener('click', function() {
            currentStep = 2;
            updateFormStep();
        });
        
        // Validate form step
        function validateStep(stepIndex) {
            const inputs = formSteps[stepIndex].querySelectorAll('input, select');
            let isValid = true;
            
            inputs.forEach(input => {
                if (!input.value.trim()) {
                    isValid = false;
                    input.style.borderColor = 'red';
                } else {
                    input.style.borderColor = '#ddd';
                }
            });
            
            if (!isValid) {
                alert('Please fill in all required fields.');
            }
            
            return isValid;
        }
        
        // Update review content
        function updateReviewContent() {
            const reviewContent = document.getElementById('reviewContent');
            const formData = new FormData(document.getElementById('loanApplicationForm'));
            
            let html = `
                <div style="background: #f8f9fa; padding: 20px; border-radius: 5px;">
                    <h4 style="margin-bottom: 15px;">Personal Information</h4>
                    <p><strong>Name:</strong> ${formData.get('firstName')} ${formData.get('lastName')}</p>
                    <p><strong>Email:</strong> ${formData.get('email')}</p>
                    <p><strong>Phone:</strong> ${formData.get('phone')}</p>
                    <p><strong>Date of Birth:</strong> ${formData.get('dob')}</p>
                    
                    <h4 style="margin: 20px 0 15px;">Financial Information</h4>
                    <p><strong>Employment:</strong> ${formData.get('employment')}</p>
                    <p><strong>Annual Income:</strong> $${formData.get('income')}</p>
                    <p><strong>Housing Payment:</strong> $${formData.get('housing')}</p>
                    
                    <h4 style="margin: 20px 0 15px;">Loan Details</h4>
                    <p><strong>Loan Amount:</strong> $${formData.get('loanAmount')}</p>
                    <p><strong>Loan Purpose:</strong> ${formData.get('loanPurpose')}</p>
                    <p><strong>Loan Term:</strong> ${formData.get('loanTerm')} months</p>
                </div>
            `;
            
            reviewContent.innerHTML = html;
        }
        
        // Form submission
        document.getElementById('loanApplicationForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Your application has been submitted successfully! We will review your information and contact you shortly.');

            this.reset();
            currentStep = 0;
            updateFormStep();
            window.scrollTo(0, 0);
        });
    </script>
</body>
</html>
