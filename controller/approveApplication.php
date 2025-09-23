<?php
session_start();
require_once '../config/config.php';
header("Content-Type: application/json; charset=UTF-8");
class ApproveApplication extends Database{
    public function approveApplications($id){
        $updateStatus = "UPDATE `loan_information` SET `application_status` = ?, `approval_date` = ?, `hr_approval_date` = ?, `application_status_for_admin` = ?, `assigned_admin` = ?
        WHERE `id` = ?";
        $stmt = $this->conn->prepare($updateStatus);
        $status = "Approved";
        $approval_date = date("Y-m-d H:i:s");
        $fName = $_SESSION['user_first_name'];
        $lName =$_SESSION['user_last_name'];
        $assigned_admin = $lName . ", " . $fName;
        $stmt->bind_param("sssssi", $status, $approval_date, $approval_date, $status, $assigned_admin, $id);
        if ($stmt->execute()) {
            http_response_code(200);
            $response = ["status" => "success", "message" => "Record updated successfully."];
        }else {
            http_response_code(500);
            $response = ["status" => "error", "message" => "Failed to update record."];
        }
        return $response;
    }
    public function setSched(){
        $total_interest = $_SESSION['total_interest'];
        $loanID = $_SESSION['loan_id'];
        $noInterest = $_SESSION['no_interest'];
        $withInterest =  $_SESSION['with_interest'];
        $term = $_SESSION['term'];
        $balance = $withInterest * $term;
        $payment_number = 0;
        $status = "unpaid";
        $approval_date = date("Y-m-d H:i:s");
        $schedules = [];
        for ($i = 1; $i <= $term; $i++) {
            $payment_number++;
            $schedID = 'SCHEDULE-' . bin2hex(random_bytes(8));
            $dueDate = date("Y-m-d H:i:s", strtotime("+$i months", strtotime($approval_date)));
            $endBalance = $balance - $withInterest;
            $setSchedule = "INSERT INTO `loan_payment_schedule`(`schedule_id`, `loanID`, `payment_number`, `due_date`, `monthly_payment_no_interest`,`interest`, `total_payment_due`, `beginning_balance`, `ending_balance`, `payment_status`)  
            VALUES (?,?,?,?,?,?,?,?,?,?)";
            $stmt = $this->conn->prepare($setSchedule);
            $stmt->bind_param('ssisddddds', $schedID, $loanID, $payment_number, $dueDate, $noInterest,$total_interest, $withInterest, $balance, $endBalance, $status);
            $stmt->execute();
             $schedules[] = [
                "schedule_id" => $schedID,
                "loanID" => $loanID,
                "payment_number" => $payment_number,
                "due_date" => $dueDate,
                "monthly_payment_no_interest" => $noInterest,
                "total_payment_due" => $withInterest,
                "total_interest" => $withInterest,
                "beginning_balance" => $balance,
                "ending_balance" => $endBalance,
                "payment_status" => $status
             ];
            $balance = $endBalance;
        }
        $response = ["status" => "success", "message" => "Record sched successfully", "data" => $schedules ];
        return $response;
    }
}
$approval = new ApproveApplication();
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $approvalData = $approval->approveApplications($id); 
    $schedData = $approval->setSched();
    echo json_encode(["approval"=> $approvalData,"schedule" => $schedData]);
}
