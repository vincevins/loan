<?php
require_once '../config/config.php';
header("Content-Type: application/json; charset=UTF-8");
class UpdateStatusPayment extends Database{
    public function updateStatus(){
        $paymentStatus = "UPDATE loan_payments SET payment_status = 'completed'";
        $stmt = $this->conn->prepare($paymentStatus);
        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }
        if ($stmt->execute()) {
            http_response_code(200);
            return json_encode(["status" => "success", "message" => "updated successfully."]);
        } else {
            http_response_code(500);
            return json_encode(["status" => "error", "message" => "Failed to update: " . $stmt->error]);
        }
    }
    public function payments(){
        $getPayments = "SELECT * FROM `loan_payments`";
        $stmt = $this->conn->prepare($getPayments);
        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
    public function updateStatusSched(){
        $result = $this->payments();
        $updatestatus = "UPDATE loan_payment_schedule set payment_status = 'paid' where schedule_id  =?";
        $stmt = $this->conn->prepare($updatestatus);
        while($payment = $result->fetch_assoc()) {
            $id = $payment['schedule_id'];
            if (!$stmt) {
                die("Prepare failed: " . $this->conn->error);
            }
            $stmt->bind_param('s', $id);
            $stmt->execute();
        }
        if($stmt->close()) {
            http_response_code(200);
            return json_encode(["status" => "success", "message" => "updated successfully."]);
        }else {
            http_response_code(500);
            return json_encode(["status" => "error", "message" => "Failed to update: " . $stmt->error]);
        }
    }
}
$status = new UpdateStatusPayment();
$payment = $status->updatestatus();
$sched = $status->updateStatusSched();
echo json_encode([$payment,$sched]);
