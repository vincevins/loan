<?php
include 'nav.php';
if (!isset($_SESSION['logged_in'])) {
    header("location: http://localhost/casestudy-loan/loan/public/pages/index.php");
    exit();
}
$role = $_SESSION['user_role'];
if ($role != 'user') {
    header("location: http://localhost/casestudy-loan/loan/public/pages/index.php");
    exit();
}   
$id =   $_SESSION['user_account_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Tracker - Paluwagan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="../styles/payment_tracker.css">
</head>
<body>
    <section class="dashboard">
        <div class="container">
            <div class="dashboard-header">
                <h2>Loan Payment Dashboard</h2>
                <p>Track your loan payments and manage your account</p>
            </div>

            <div class="loan-summary">
                <div class="summary-card">
                    <h3>Total Loan Amount</h3>
                    <div class="amount" id="totalLoanAmount">15,000.00</div>
                </div>
                <div class="summary-card">
                    <h3>Remaining Balance</h3>
                    <div class="amount" id="remainingBalance">12,500.00</div>
                </div>
                <div class="summary-card">
                    <h3>Next Payment Due</h3>
                    <div class="amount" id="nextPaymentDate">Dec 15, 2023</div>
                </div>
                <div class="summary-card">
                    <h3>Next Payment Amount</h3>
                    <div class="amount" id="nextPaymentAmount">350.00</div>
                </div>
            </div>

            <div class="payment-schedule">
                <div class="schedule-header">
                    <h3>Payment Schedule</h3>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Due Date</th>
                            <th>Amount Due</th>
                            <th>Principal</th>
                            <th>Interest</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="paymentScheduleBody">
                    </tbody>
                </table>
            </div>

            <div class="make-payment">
                <h3>Make a Payment</h3>
                <form id="paymentForm" action="process-payment.php" method="POST">
                    <div class="form-group">
                        <label for="paymentAmount">Payment Amount ($)</label>
                        <input type="number" id="paymentAmount" name="paymentAmount" class="form-control" required min="1" step="0.01">
                    </div>
                    <div class="form-group">
                        <label for="paymentMethod">Payment Method</label>
                        <select id="paymentMethod" name="paymentMethod" class="form-control" required>
                            <option value="">Select Payment Method</option>
                            <option value="credit_card">Credit Card</option>
                            <option value="debit_card">Debit Card</option>
                            <option value="bank_transfer">Bank Transfer</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="paymentDate">Payment Date</label>
                        <input type="date" id="paymentDate" name="paymentDate" class="form-control" required>
                    </div>
                    <button type="submit" class="btn">Submit Payment</button>
                </form>
            </div>

            <div class="payment-history">
                <h3>Payment History</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Method</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="paymentHistoryBody">
                    </tbody>
                </table>
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
                <p>&copy; 2023 Paluwagan ni Carlos. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        document.getElementById('navToggle').addEventListener('click', function() {
            document.getElementById('mainNav').classList.toggle('active');
        });

        document.getElementById('paymentDate').valueAsDate = new Date();

        const paymentSchedule = [
            { dueDate: '2023-11-15', amount: 350.00, principal: 250.00, interest: 100.00, status: 'paid' },
            { dueDate: '2023-12-15', amount: 350.00, principal: 255.00, interest: 95.00, status: 'pending' },
            { dueDate: '2024-01-15', amount: 350.00, principal: 260.00, interest: 90.00, status: 'pending' },
            { dueDate: '2024-02-15', amount: 350.00, principal: 265.00, interest: 85.00, status: 'pending' },
            { dueDate: '2024-03-15', amount: 350.00, principal: 270.00, interest: 80.00, status: 'pending' }
        ];
        const paymentHistory = [
            { date: '2023-11-15', amount: 350.00, method: 'Credit Card', status: 'completed' },
            { date: '2023-10-15', amount: 350.00, method: 'Bank Transfer', status: 'completed' },
            { date: '2023-09-15', amount: 350.00, method: 'Debit Card', status: 'completed' }
        ];

        function populatePaymentSchedule() {
            const scheduleBody = document.getElementById('paymentScheduleBody');
            scheduleBody.innerHTML = '';

            paymentSchedule.forEach(payment => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${formatDate(payment.dueDate)}</td>
                    <td>$${payment.amount.toFixed(2)}</td>
                    <td>$${payment.principal.toFixed(2)}</td>
                    <td>$${payment.interest.toFixed(2)}</td>
                    <td class="status-${payment.status}">${payment.status.charAt(0).toUpperCase() + payment.status.slice(1)}</td>
                `;
                scheduleBody.appendChild(row);
            });
        }

        function populatePaymentHistory() {
            const historyBody = document.getElementById('paymentHistoryBody');
            historyBody.innerHTML = '';

            paymentHistory.forEach(payment => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${formatDate(payment.date)}</td>
                    <td>$${payment.amount.toFixed(2)}</td>
                    <td>${payment.method}</td>
                    <td class="status-${payment.status}">${payment.status.charAt(0).toUpperCase() + payment.status.slice(1)}</td>
                `;
                historyBody.appendChild(row);
            });
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('en-US', { 
                year: 'numeric', 
                month: 'short', 
                day: 'numeric' 
            });
        }
        document.getElementById('paymentForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const paymentAmount = parseFloat(formData.get('paymentAmount'));
            const paymentMethod = formData.get('paymentMethod');
            const paymentDate = formData.get('paymentDate');

            alert(`Payment of $${paymentAmount.toFixed(2)} via ${paymentMethod} scheduled for ${paymentDate} has been processed successfully!`);
            
            this.reset();
            document.getElementById('paymentDate').valueAsDate = new Date();
            
        });

        document.addEventListener('DOMContentLoaded', function() {
            populatePaymentSchedule();
            populatePaymentHistory();
        });
    </script>
</body>
</html>