<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Sign Up</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/login.css">
</head>
<body>
    <div class="container" id="container">
        <div class="form-container login-container">
            <form class="login-form" id="loginForm" action="" method="POST">
                <h2 class="form-title">Welcome Back</h2>
                <div class="input-group">
                    <i data-feather="mail"></i>
                    <input type="email" name="email" placeholder="Email Address" required>
                </div>
                <div class="input-group">
                    <i data-feather="lock"></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit"  class="submit-btn">Login</button>
                <div class="form-footer">
                    <p>Don't have an account? <a href="#" id="show-signup">Sign up</a></p>
                </div>
            </form>
        </div>

        <div class="form-container signup-container">
            <form class="signup-form" id="signupform" action="" method="POST">
                <h2 class="form-title">Create Account</h2>
                <div class="form-row">
                    <div class="input-group">
                        <i data-feather="user"></i>
                        <input type="text" name="first_name" placeholder="First Name" required>
                    </div>
                    <div class="input-group">
                        <i data-feather="user"></i>
                        <input type="text" name="middle_name" placeholder="Middle Name" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="input-group">
                        <i data-feather="user"></i>
                        <input type="text" name="last_name" placeholder="Last Name" required>
                    </div>
                    <div class="input-group">
                        <i data-feather="calendar"></i>
                        <input type="number" name="age" placeholder="Age" min="13" max="120" required>
                    </div>
                </div>

                <div class="input-group">
                    <i data-feather="phone"></i>
                    <input type="tel" name="contact" placeholder="Contact Number" required>
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
                <h2>Hello, Friend!</h2>
                <p>Enter your personal details and start your journey with us</p>
                <button class="toggle-btn" id="welcome-toggle">Sign Up</button>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="../js/auth.js"></script>
     <script>
        feather.replace();
     </script>
     
</body>

</html>