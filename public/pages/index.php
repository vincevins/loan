<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F.L.O.W</title>
    <link rel="stylesheet" href="../styles/landingpage.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    </link>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/png" href="../img/logo1.1.png">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <img src="../img/logo1.1.png" alt=" Company Logo" style="width: 35px; height: 35px; object-fit: contain; display:block;">
                <h1>F.L.O.W</h1>
            </div>
            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#features">Features</a></li>
                <li><a href="#rates">Rates</a></li>
                <li><a href="#footer">Contact</a></li>
                <li><a href="http://localhost/casestudy-loan/loan/public/pages/user/index.php">Login</a></li>
            </ul>
        </nav>
    </header>

    <section class="hero" id="home">
        <div class="hero-content">
            <div class="hero-text">
                <h1>Get The Funds You Need Quickly
                    <span></span>
                </h1>
                <p>Our online loan application process is fast, secure, and designed to get you the money you need with competitive rates and flexible terms.</p>
                <div class="cta-buttons">
                    <a href="http://localhost/casestudy-loan/loan/public/pages/user/index.php" class="btn-primary">Apply Now</a>
                    <a href="http://localhost/casestudy-loan/loan/public/pages/user/index.php" class="btn-secondary">Download Our Application</a>

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
    <footer>
        <div class="container" id="footer">
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
                <br>
                <p>&copy; 2025 F.L.O.W. All rights reserved.</p>
            </div>
    </footer>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="../js/landingpage.js"></script>

</body>

</html>