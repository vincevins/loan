<?php
session_start();
require_once '../config/config.php';
header("Content-Type: application/json; charset=UTF-8");
class ApproveApplication extends Database{
    public function loanInformatio($id){
        $getQuery = "SELECT * FROM `loan_information` WHERE `id` = ?";
        $stmt = $this->conn->prepare($getQuery);
        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if ($row) {
            $_SESSION['loan_id'] = $row['loanID'];
            $_SESSION['start_Date'] = $row['approval_date'];
            $_SESSION['no_interest'] = $row['monthly_payment_no_interest'];
            $_SESSION['with_interest'] = $row['monthly_payment'];
            $_SESSION['term'] = $row['loan_term'];
            $_SESSION['amount_loan'] = $row['loan_amount'];
            $_SESSION['total_interest'] = $row['interest'];
            $_SESSION['accountID_info'] = $row['account_id'];
            $_SESSION['userstudent_no'] = $row['student_no'];
        }

        return $row;
    }
    public function approveApplications($id){
        $updateStatus = "UPDATE `loan_information` SET `approval_date` = ?,`application_status_for_admin` = ?, `assigned_admin` = ? WHERE `id` = ?";
        $stmt = $this->conn->prepare($updateStatus);
        $status = "Approved";
        $approval_date = date("Y-m-d H:i:s");
        $fName = $_SESSION['user_first_name'];
        $lName =$_SESSION['user_last_name'];
        $assigned_admin = $lName . ", " . $fName;
        $stmt->bind_param("sssi",   $approval_date, $status, $assigned_admin, $id);
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
        $studentNo = $_SESSION['userstudent_no'];
        $accountID =  $_SESSION['accountID_info'];
        $total_interest = $_SESSION['total_interest'];
        $loanID = $_SESSION['loan_id'];
        $noInterest = $_SESSION['no_interest'];
        $withInterest =  $_SESSION['with_interest'];
        $term = $_SESSION['term'];
        $balance = $withInterest * $term;
        $payment_number = 0;
        $status = "unpaid";
        $late_payment = 30;
        $approval_date = date("Y-m-d H:i:s");
        $schedules = [];
        for ($i = 1; $i <= $term; $i++) {
            $payment_number++;
            $schedID = 'SCHEDULE-' . bin2hex(random_bytes(8));
            $dueDate = date("Y-m-d H:i:s", strtotime("+$i months", strtotime($approval_date)));
            $endBalance = $balance - $withInterest;
            $setSchedule = "INSERT INTO `loan_payment_schedule`(`student_no`,`schedule_id`, `loanID`, `account_id`, `payment_number`, `due_date`, `monthly_payment_no_interest`,`interest`, `total_payment_due`, `beginning_balance`, `ending_balance`, `payment_status`,`late_payment`)  
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $stmt = $this->conn->prepare($setSchedule);
            $stmt->bind_param('ssssisdddddsd', $studentNo,$schedID, $loanID,$accountID, $payment_number, $dueDate, $noInterest,$total_interest, $withInterest, $balance, $endBalance, $status,$late_payment);
            $stmt->execute();
             $schedules[] = [
                "Student_no" => $studentNo,
                "schedule_id" => $schedID,
                "loanID" => $loanID,
                "account_id" => $accountID,
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
    $fetchInfo = $approval->loanInformatio($id);
    $approvalData = $approval->approveApplications($id); 
    $schedData = $approval->setSched();
    echo json_encode(["info" => $fetchInfo,"approval" => $approvalData, "schedule" => $schedData]);
}
