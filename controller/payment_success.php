<?php
include '../config/config.php';

if (isset($_GET['payment_id'])) {
    $paymentId = $_GET['payment_id'];

    $update = $this->conn->prepare("UPDATE loan_payment_schedule SET payment_status='paid', updated_at=NOW() WHERE id=?");
    $update->bind_param("i", $paymentId);
    $update->execute();

    echo "success";
}
?>

