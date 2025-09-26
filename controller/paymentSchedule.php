<?php
require_once '../config/config.php';
session_start();
class PaymentSchedule extends Database{
    public function getSchedule($id) {
    $getQuery = "SELECT * FROM `loan_payment_schedule` WHERE `account_id` = ?";
    $stmt = $this->conn->prepare($getQuery);
    if (!$stmt) {
        die("Prepare failed: " . $this->conn->error);
    }
    $stmt->bind_param('i', $id);
    if (!$stmt->execute()) {
        die("Execute failed: " . $stmt->error);
    }
    $result = $stmt->get_result();
    $Schedule = [];
    while ($row = $result->fetch_assoc()) {
        $Schedule[] = $row;
    }
    echo json_encode($Schedule);
    $stmt->close();
}

}
$id=  $_SESSION['user_account_id'];
$getResched = new PaymentSchedule();
$getResched->getSchedule($id);