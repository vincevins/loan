<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../../vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    // Gmail SMTP settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
        $mail->Username = 'baenavinceiverson.bsit@gmail.com'; // ⬅️ Your Gmail
        $mail->Password = 'bicr vmlu ozpj mpds';   
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Recipients
    $mail->setFrom('your_email@gmail.com', 'Your Name');
    $mail->addAddress('recipient_email@gmail.com', 'Recipient Name'); // test email

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Test Email from PHPMailer';
    $mail->Body    = '<h3>This is a test email sent using Gmail App Password and PHPMailer.</h3>';
    $mail->AltBody = 'This is a test email sent using Gmail App Password and PHPMailer.';

    $mail->send();
    echo '✅ Test email sent successfully!';
} catch (Exception $e) {
    echo "❌ Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
