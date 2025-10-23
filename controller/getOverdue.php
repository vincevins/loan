<?php
require_once '../config/config.php';
header("Content-Type: application/json; charset=UTF-8");
class GetOverdue extends Database{
    public function overdue(){
        $getQuery = "SELECT L.*, A.hasLoan, A.first_name, A.last_name FROM loan_payment_schedule AS L INNER JOIN loan_accounts AS A ON L.account_id  = A.account_id;";
        $stmt = $this->conn->prepare($getQuery);
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
$get = new GetOverdue();
$payments = json_decode($get->overdue());
echo json_encode($payments);