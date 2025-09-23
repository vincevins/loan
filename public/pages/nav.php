<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>
.container {
width: 100%;
max-width: 1200px;
margin: 0 auto;
padding: 0 20px;
}

header {
background: #fff;
box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
position: sticky;
top: 0;
z-index: 100;
}

.header-content {
display: flex;
justify-content: space-between;
align-items: center;
padding: 20px 0;
}

.logo {
display: flex;
align-items: center;
gap: 10px;
}

.logo i {
color: #4361ee;
font-size: 28px;
}

.logo h1 {
font-weight: 700;
color: #4361ee;
}

nav ul {
display: flex;
list-style: none;
gap: 30px;
margin-top: 10px;
margin-left: 10px
}

nav a {
text-decoration: none;
color: #333;
font-weight: 500;
transition: color 0.3s;
margin-top: -100px
}

nav a:hover {
color: #4361ee;
}

.hero {
padding: 80px 0;
text-align: center;
}

.hero h2 {
font-size: 2.5rem;
margin-bottom: 20px;
color: #333;
}

.hero p {
font-size: 1.2rem;
max-width: 700px;
margin: 0 auto 40px;
color: #555;
}

.btn {
display: inline-block;
background: #4361ee;
color: white;
padding: 12px 30px;
border-radius: 50px;
text-decoration: none;
font-weight: 600;
transition: all 0.3s;
border: none;
cursor: pointer;
}

.btn:hover {
background: #3a56d4;
transform: translateY(-3px);
box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}
    </style>
        <header>
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <i class="fas fa-hand-holding-usd"></i>
                    <h1>F.L.O.W</h1>
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
                        <?php 
                       echo '<li><a href="http://localhost/casestudy-loan/loan/controller/logout.php" class="btn">Log out</a></li>'
                       ?>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
</body>
</html>