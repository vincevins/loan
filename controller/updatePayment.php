<?php
header("Content-Type: application/json");
include '../config/config.php';
$db = new Database();
$conn = $db->conn;
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['schedule_id'])) {
    echo json_encode(["success" => false, "message" => "Missing schedule_id"]);
    exit;
}

$schedule_id = intval($data['schedule_id']);
$paypal_order_id = isset($data['paypal_order_id']) ? $data['paypal_order_id'] : null;
$query = "UPDATE loan_payment_schedule 
          SET payment_status = 'paid', updated_at = NOW() 
          WHERE id = ?";

$stmt = $conn->prepare($query);

if (!$stmt) {
    echo json_encode(["success" => false, "message" => "Prepare failed: " . $conn->error]);
    exit;
}

$stmt->bind_param("i", $schedule_id);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Payment updated successfully"]);
} else {
    echo json_encode(["success" => false, "message" => "Database update failed: " . $conn->error]);
}

$stmt->close();
$conn->close();
?>
