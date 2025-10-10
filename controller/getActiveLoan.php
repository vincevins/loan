<?php
session_start();
include __DIR__ . '/../config/config.php';
header('Content-Type: application/json');
class Getapplication extends Database{
    public function getinfo(){
        $getQuery = "SELECT t.*, i.hasLoan FROM loan_information AS t INNER JOIN loan_accounts  AS i ON t.account_id  = i.account_id";
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
$getResched = new Getapplication();
$application = json_decode($getResched->getinfo());
echo json_encode($application);
