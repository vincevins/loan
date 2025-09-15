<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Application Submitted - Paluwagan</title>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css'>
        <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap' rel='stylesheet'>
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: 'Poppins', sans-serif;
            }
            
            body {
                background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 20px;
            }
            
            .success-container {
                background: white;
                border-radius: 10px;
                padding: 40px;
                box-shadow: 0 5px 30px rgba(0, 0, 0, 0.1);
                text-align: center;
                max-width: 600px;
                width: 100%;
            }
            
            .success-icon {
                color: #4caf50;
                font-size: 60px;
                margin-bottom: 20px;
            }
            
            h1 {
                color: #333;
                margin-bottom: 15px;
            }
            
            p {
                color: #666;
                margin-bottom: 30px;
                line-height: 1.6;
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
            }
            
            .btn:hover {
                background: #3a56d4;
                transform: translateY(-3px);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            }
            
            .application-details {
                background: #f8f9fa;
                padding: 20px;
                border-radius: 5px;
                text-align: left;
                margin: 30px 0;
            }
            
            .application-details h3 {
                margin-bottom: 15px;
                color: #333;
            }
            
            .application-details p {
                margin-bottom: 8px;
            }
        </style>
    </head>
    <body>
        <div class='success-container'>
            <i class='fas fa-check-circle success-icon'></i>
            <h1>Application Submitted Successfully!</h1>
            <p>Thank you for applying with SecureLoan. We have received your application and will review it shortly. One of our loan specialists will contact you within 24 hours.</p>
            
            <div class='application-details'>
                <h3>Application Summary</h3>
                <p><strong>Name:</strong> $firstName $lastName</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Phone:</strong> $phone</p>
                <p><strong>Loan Amount:</strong> $$loanAmount</p>
                <p><strong>Loan Purpose:</strong> $loanPurpose</p>
            </div>
            
            <a href='index.html' class='btn'>Return to Homepage</a>
        </div>
    </body>
    </html>

