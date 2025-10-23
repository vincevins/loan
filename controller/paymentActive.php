<?php
require_once '../config/config.php';
header("Content-Type: application/json; charset=UTF-8");
class PaymentActive extends Database{
    public function fetchPayments(){
        $getPayments = "SELECT t.*, i.last_name, i.first_name, i.hasLoan, s.due_date FROM loan_payments AS t INNER JOIN  loan_accounts AS i ON t.account_id  = i.account_id
        INNER JOIN loan_payment_schedule as s on t.schedule_id  = s.schedule_id ";
        $stmt = $this->conn->prepare($getPayments);
        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $information = [];
        while ($row = $result->fetch_assoc()) {
            $information[] = $row;
        }
        return json_encode($information);
    }
}
$activeLoan = new PaymentActive();
$payments = json_decode($activeLoan->fetchPayments());
echo json_encode($payments);