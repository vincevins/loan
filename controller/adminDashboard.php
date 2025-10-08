<?php
require_once '../config/config.php';
header("Content-Type: application/json; charset=UTF-8");
class AdminDashboard extends Database{
    public function countActive(){
        $activeLoan = "SELECT COUNT(hasLoan) AS count FROM loan_accounts WHERE hasLoan  = 1";
        $stmt = $this->conn->prepare($activeLoan);
        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $res =  $result->fetch_assoc();
        return json_encode($res);
    }
    public function getPending(){
        $activeLoan = "SELECT COUNT(*) AS pending FROM loan_information WHERE application_status = 'pending' or application_status_for_admin = 'under_review'";
        $stmt = $this->conn->prepare($activeLoan);
        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $count = [];
        $res = $result->fetch_assoc();
        $count = $res;
        return json_encode($count);
    }
    public function getApproved(){
        $activeLoan = "SELECT COUNT(*) AS approved FROM loan_information WHERE application_status = 'approved' and application_status_for_admin = 'approved'";
        $stmt = $this->conn->prepare($activeLoan);
        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $count = [];
        $res = $result->fetch_assoc();
        $count = $res;
        return json_encode($count);
    }
}
$active = new AdminDashboard();
$activeCountJson = $active->countActive();
$countPending = $active->getPending();
$approved = $active->getApproved();
$approvedCount = json_decode($approved, true);
$activeCount = json_decode($activeCountJson, true);
$pendingCount = json_decode($countPending, true);
echo json_encode(['active' => $activeCount,'pending' => $pendingCount, 'approved' => $approvedCount]);


