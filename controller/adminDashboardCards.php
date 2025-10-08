<?php
require_once '../config/config.php';
header("Content-Type: application/json; charset=UTF-8");
class AdminDashboardCards extends Database{
    public function fetchPayments(){
        $getPayments = "SELECT t.*, i.last_name, i.first_name FROM loan_payments AS t INNER JOIN  loan_information AS i ON t.student_no = i.student_no";
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
$adminCards = new AdminDashboardCards();
$payments = json_decode($adminCards->fetchPayments());
echo json_encode($payments);

