<?php
session_start();
header('Content-Type: application/json');
include '../config/config.php';

$db = new Database();
$conn = $db->conn;

if (!isset($conn) || $conn === null) {
    echo json_encode(["error" => "Database connection not found."]);
    exit;
}

if (!isset($_SESSION['user_account_id'])) {
    echo json_encode(["error" => "User not logged in."]);
    exit;
}

$account_id = $_SESSION['user_account_id'];

$query = "
    SELECT 
        payment_date,
        payment_amount,
        payment_method,
        payment_reference,
        payment_status
    FROM loan_payments
    WHERE account_id = ?
    ORDER BY payment_date DESC
";

$stmt = $conn->prepare($query);
$stmt->bind_param("s", $account_id);
$stmt->execute();
$result = $stmt->get_result();

$payments = [];

while ($row = $result->fetch_assoc()) {
    switch ($row['payment_status']) {
        case 'completed':
            $statusLabel = 'Paid';
            break;
        case 'pending':
            $statusLabel = 'Pending';
            break;
        default:
            $statusLabel = 'Overdue';
            break;
    }

    $payments[] = [
        "payment_date" => $row['payment_date'],
        "payment_amount" => $row['payment_amount'],
        "payment_method" => $row['payment_method'] ?: 'N/A',
        "payment_reference" => $row['payment_reference'] ?: 'N/A',
        "payment_status" => $statusLabel
    ];
}

echo json_encode($payments);

$stmt->close();
$conn->close();
?>
