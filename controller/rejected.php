<?php
session_start();
require_once '../config/config.php';
header("Content-Type: application/json; charset=UTF-8");
class Rejected extends Database{
    public function rejectedApplications($id){
        $updateStatus = "UPDATE `loan_information` SET `approval_date` = ?,`application_status_for_admin` = ?, `assigned_admin` = ? WHERE `id` = ?";
        $stmt = $this->conn->prepare($updateStatus);
        $status = "Rejected";
        $approval_date = date("Y-m-d H:i:s");
        $fName = $_SESSION['user_first_name'];
        $lName = $_SESSION['user_last_name'];
        $assigned_admin = $lName . ", " . $fName;
        $stmt->bind_param("sssi",   $approval_date, $status, $assigned_admin, $id);
        if ($stmt->execute()) {
            http_response_code(200);
            $response = ["status" => "success", "message" => "Application Rejected successfully."];
        } else {
            http_response_code(500);
            $response = ["status" => "error", "message" => "Failed to reject record."];
        }
        return $response;
    }
    public function hasLoan(){
        $hasLoan = false;
        $id = $_SESSION['accountID_info'];
        $updateStatus = "UPDATE `loan_accounts` SET hasLoan = ? where account_id = ?";
        $stmt = $this->conn->prepare($updateStatus);
        $stmt->bind_param('ss',$hasLoan,$id);
        if ($stmt->execute()) {
            http_response_code(200);
            $response = ["status" => "success", "message" => "Record updated successfully."];
        }else {
            http_response_code(500);
            $response = ["status" => "error", "message" => "Failed to update record."];
        }
        return $response;
    }
}
$approval = new Rejected();
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $rejectedApplications = $approval->rejectedApplications($id);
    echo json_encode(["info" => $rejectedApplications,$approval->hasLoan()]); 
}
