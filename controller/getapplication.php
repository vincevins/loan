<?php
session_start();
include __DIR__ . '/../config/config.php';
header('Content-Type: application/json');
class Getapplication extends Database
{
    public function getinfo()
    {
        $getQuery = "SELECT * FROM `loan_information`";
        $stmt = $this->conn->prepare($getQuery);
        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $information = [];
        while ($row = $result->fetch_assoc()) {
            $information[] = $row;
            $_SESSION['loan_id'] = $row['loanID'];
            $_SESSION['start_Date'] = $row['approval_date'];
            $_SESSION['no_interest'] = $row['monthly_payment_no_interest'];
            $_SESSION['with_interest'] = $row['monthly_payment'];
            $_SESSION['term'] = $row['loan_term'];
            $_SESSION['amount_loan'] = $row['loan_amount'];
            $_SESSION['loan_id'] = $row['loanID'];
            $_SESSION['total_interest'] = $row['interest'];
            $_SESSION['user_address'] = $row['address'];
            $_SESSION['user_city'] = $row['city'];
            $_SESSION['user_province'] = $row['province'];
            $_SESSION['user_zip_code'] = $row['zip_code'];

        }
        return $information;
    }
}
$getResched = new Getapplication();

echo json_encode($getResched->getinfo());
