<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Sign Up</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../styles/login.css">
    <link rel="stylesheet" href="../../styles/toast.css">
</head>


<body>
    <div class="container" id="container">
        <div class="form-container login-container">
            <form class="login-form" id="loginForm" action="" method="POST">
                <h2 class="form-title">Welcome Back</h2>
                <div class="input-group">
                    <i data-feather="mail"></i>
                    <input type="email" name="email" placeholder="Email Address" >
                </div>
                <div class="input-group">
                    <i data-feather="lock"></i>
                    <input type="password" name="password" placeholder="Password" >
                </div>
                <button type="submit" class="submit-btn">Login</button>
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
                        <input type="text" name="first_name" placeholder="First Name" >
                    </div>
                    <div class="input-group">
                        <i data-feather="user"></i>
                        <input type="text" name="middle_name" placeholder="Middle Name" >
                    </div>
                </div>

                <div class="form-row">
                    <div class="input-group">
                        <i data-feather="user"></i>
                        <input type="text" name="last_name" placeholder="Last Name" >
                    </div>
                    <div class="input-group">
                        <i data-feather="calendar"></i>
                        <input type="number" name="age" placeholder="Age" min="13" max="120" >
                    </div>
                </div>

                <div class="input-group">
                    <i data-feather="phone"></i>
                    <input type="tel" name="contact" placeholder="Contact Number" >
                </div>

                <div class="input-group">
                    <i data-feather="mail"></i>
                    <input type="email" name="email" placeholder="Email Address" >
                </div>

                <div class="input-group">
                    <i data-feather="lock"></i>
                    <input type="password" name="password" placeholder="Password" >
                </div>

                <div class="input-group">
                    <i data-feather="lock"></i>
                    <input type="password" name="confirm_password" placeholder="Confirm Password" >
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
    <div class="toast-container" id="toastContainer"></div>
    <div id="loginSpinner" style="display: none;">
        <div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); display: flex; justify-content: center; align-items: center; z-index: 9999;">
            <div class="spinner-border"></div>
        </div>
    </div>
    <style>
        .spinner-border {
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
    <script>
    </script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="../../js/auth.js"></script>
    <script>
        feather.replace();
    </script>

</body>

</html>