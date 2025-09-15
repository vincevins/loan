<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Sign Up</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="container" id="container">
        <div class="form-container login-container">
            <form class="login-form" action="login.php" method="POST">
                <h2 class="form-title">Login to Your Account</h2>
                <div class="input-group">
                    <i data-feather="user"></i>
                    <input type="text" name="username" placeholder="Username or Email" required>
                </div>
                <div class="input-group">
                    <i data-feather="lock"></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="submit-btn">Login</button>
                <div class="form-footer">
                    <p>Don't have an account? <a href="#signup" id="show-signup">Sign Up</a></p>
                </div>
            </form>
        </div>
        
        <div class="form-container signup-container">
            <form class="signup-form" action="signup.php" method="POST">
                <h2 class="form-title">Create Account</h2>
                <div class="input-group">
                    <i data-feather="user"></i>
                    <input type="text" name="fullname" placeholder="Full Name" required>
                </div>
                <div class="input-group">
                    <i data-feather="mail"></i>
                    <input type="email" name="email" placeholder="Email Address" required>
                </div>
                <div class="input-group">
                    <i data-feather="lock"></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="input-group">
                    <i data-feather="lock"></i>
                    <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                </div>
                <button type="submit" class="submit-btn">Sign Up</button>
                <div class="form-footer">
                    <p>Already have an account? <a href="#" id="show-login">Login</a></p>
                </div>
            </form>
        </div>
        
        <div class="welcome-container">
            <div class="decoration-circle circle-1"></div>
            <div class="decoration-circle circle-2"></div>
            <div class="welcome-text">
                <h2>Hello, Kaibigan!</h2>
                <p>Enter your personal details and start your long loaning journey</p>
                <button class="toggle-btn" id="toggle-btn">Sign Up</button>
            </div>
        </div>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script>
        feather.replace();
        
        const container = document.getElementById('container');
        const toggleBtn = document.getElementById('toggle-btn');
        const mobileToggleBtn = document.getElementById('mobile-toggle-btn');
        const showSignup = document.getElementById('show-signup');
        const showLogin = document.getElementById('show-login');
        
        function toggleForm() {
            container.classList.toggle('active');
            if (container.classList.contains('active')) {
                toggleBtn.textContent = 'Login';
                mobileToggleBtn.textContent = 'Login';
            } else {
                toggleBtn.textContent = 'Sign Up';
                mobileToggleBtn.textContent = 'Sign Up';
            }
        }
        
        toggleBtn.addEventListener('click', toggleForm);
        mobileToggleBtn.addEventListener('click', toggleForm);
        showSignup.addEventListener('click', toggleForm);
        showLogin.addEventListener('click', toggleForm);
        
        // Form validation
        const loginForm = document.querySelector('.login-form');
        const signupForm = document.querySelector('.signup-form');
        
        loginForm.addEventListener('submit', function(e) {
            const username = this.querySelector('input[name="username"]').value;
            const password = this.querySelector('input[name="password"]').value;
            
            if (username.trim() === '' || password.trim() === '') {
                e.preventDefault();
                alert('Please fill in all fields');
            }
        });
        
        signupForm.addEventListener('submit', function(e) {
            const fullname = this.querySelector('input[name="fullname"]').value;
            const email = this.querySelector('input[name="email"]').value;
            const password = this.querySelector('input[name="password"]').value;
            const confirmPassword = this.querySelector('input[name="confirm_password"]').value;
            
            if (fullname.trim() === '' || email.trim() === '' || password.trim() === '' || confirmPassword.trim() === '') {
                e.preventDefault();
                alert('Please fill in all fields');
                return;
            }
            
            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Passwords do not match');
                return;
            }
            
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                e.preventDefault();
                alert('Please enter a valid email address');
            }
        });
        
    </script>
</body>
</html>
