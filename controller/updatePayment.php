<?php
// ✅ Debug settings
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('error_log', __DIR__ . '/error_log.txt');
header("Content-Type: application/json");
date_default_timezone_set('Asia/Manila');
// ✅ Include config and connect to DB
include '../config/config.php';
$db = new Database();
$conn = $db->conn;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../vendor/autoload.php';

// ✅ Get JSON input
$rawInput = file_get_contents("php://input");
$input = json_decode($rawInput, true);

if (!$input || !isset($input["schedule_id"]) || !isset($input["paypal_order_id"])) {
    echo json_encode(["success" => false, "message" => "Invalid request payload.", "raw" => $rawInput]);
    exit;
}

$id = $conn->real_escape_string($input["schedule_id"]); // numeric ID from JS
$paypal_order_id = $conn->real_escape_string($input["paypal_order_id"]);

// ✅ Get full schedule data (including schedule_id string)
$sql = "SELECT * FROM loan_payment_schedule WHERE id = '$id' LIMIT 1";
$result = $conn->query($sql);

if (!$result || $result->num_rows == 0) {
    echo json_encode(["success" => false, "message" => "Payment schedule not found."]);
    exit;
}

$row = $result->fetch_assoc();
$schedule_id = $conn->real_escape_string($row["schedule_id"]); // actual string ID like SCHEDULE-xxxx

// ✅ Update payment status
$updateSql = "UPDATE loan_payment_schedule SET payment_status = 'paid' WHERE id = '$id'";
if (!$conn->query($updateSql)) {
    echo json_encode(["success" => false, "message" => "Failed to update schedule.", "error" => $conn->error]);
    exit;
}

// ✅ Insert into loan_payments
$student_no = $conn->real_escape_string($row["student_no"]);
$loanID = $conn->real_escape_string($row["loanID"]);
$account_id = $conn->real_escape_string($row["account_id"]);
$monthly_no_interest = $conn->real_escape_string($row["monthly_payment_no_interest"]);
$interest_paid = $conn->real_escape_string($row["interest"]);
$total_payment = $conn->real_escape_string($row["total_payment_due"]);

$insertSql = "INSERT INTO loan_payments (
    student_no, payment_id, loanID, schedule_id, account_id,
    payment_amount, payment_date, payment_method,
    monthly_payment_no_interest, interest_paid,
    payment_reference, payment_status, created_at
) VALUES (
    '$student_no', '$paypal_order_id', '$loanID', '$schedule_id', '$account_id',
    '$total_payment', NOW(), 'PayPal',
    '$monthly_no_interest', '$interest_paid',
    '$paypal_order_id', 'completed', NOW()
)";

if (!$conn->query($insertSql)) {
    echo json_encode(["success" => false, "message" => "Failed to record payment.", "error" => $conn->error]);
    exit;
}
$randomNumber = mt_rand(1000, 9999);
$timestamp = time();
$loanID = $row['loanID'];
$id = $row['schedule_id'];
$accountid = $row['account_id'];
$uniqueId = $timestamp . $randomNumber;
$message = "Payment of " . "₱" . $total_payment . " completed successfully on" . date('Y-m-d');;
$insertReminder = "INSERT INTO `loan_notifications`(`notif_id`, `loanID`, `schedule_id`, `account_id`, `message`) VALUES (?,?,?,?,?)";
$stmtReminder = $conn->prepare($insertReminder);
$stmtReminder->bind_param('sssss', $uniqueId, $loanID, $id, $accountid, $message);         
$stmtReminder->execute();




$emailQuery = "
    SELECT 
        email, 
        TRIM(CONCAT(COALESCE(first_name, ''), ' ', COALESCE(last_name, ''))) AS full_name
    FROM loan_accounts
    WHERE account_id = '$account_id'
    LIMIT 1
";
$emailResult = $conn->query($emailQuery);
$user = $emailResult->fetch_assoc();

if ($user && !empty($user['email'])) {
    $recipient = $user['email'];
    $fullname = $user['full_name'];

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'baenavinceiverson.bsit@gmail.com';
        $mail->Password = 'bicr vmlu ozpj mpds';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('baenavinceiverson.bsit@gmail.com', 'Loan Payment System');
        $mail->addAddress($recipient, $fullname);
        $mail->isHTML(true);
        $mail->Subject = 'F.L.O.W';
        $mail->Body = '
        <div style="background-color: #ffffff; padding: 20px;">
        <h2 style="margin: 0 0 15px 0; font-size: 26px; font-weight: 600; color: #3b5bfd;">
            Payment Successful!
        </h2>

        <p>Dear <strong>' . $fullname . '</strong>,</p>
        <p>We have successfully received your payment. Here are the details:</p>

        <ul style="list-style-type: none; padding: 0;">
            <li><strong>Loan ID:</strong> ' . $loanID . '</li>
            <li><strong>Schedule ID:</strong> ' . $schedule_id . '</li>
            <li><strong>Amount Paid:</strong> ₱' . $total_payment . '</li>
            <li><strong>Transaction ID:</strong> ' . $paypal_order_id . '</li>
            <li><strong>Payment Method:</strong> PayPal</li>
        </ul>

        <p>Thank you for your payment!</p>
        </div>
        ';
        $mail->send();
        $email_sent = true;
    } catch (Exception $e) {
        error_log("Email failed: " . $mail->ErrorInfo);
    }
}
echo json_encode([
    "success" => true,
    "message" => "Payment recorded successfully!",
    "email_sent" => isset($email_sent) && $email_sent === true
]);
exit;
?>
