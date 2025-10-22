<?php require_once '../config/config.php';
header("Content-Type: application/json; charset=UTF-8");
date_default_timezone_set('Asia/Manila');
class Overdue extends Database{
    public function checkDueDate(){
        $duedate = 'SELECT * FROM `loan_payment_schedule`';
        $stmt = $this->conn->prepare($duedate);
        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }


    public function dueDate(){
        $timestamp = time();
        $randomNumber = mt_rand(1000, 9999);
        $uniqueId = $timestamp . $randomNumber;
        $res = $this->checkDueDate();
        $today = date('Y-m-d');
        $updateMonthly = "UPDATE loan_payment_schedule set monthly_payment_no_interest = ?, total_payment_due  = ?, days_overdue =?, updated_at =? where schedule_id  =?";
        $stmt = $this->conn->prepare($updateMonthly);
        while ($payment = $res->fetch_assoc()) {
            $accountid = $payment['account_id'];
            $loanID = $payment['loanID'];
            $id = $payment['schedule_id'];
            $due_date = $payment['due_date'];
            $late_payment = $payment['late_payment'];
            $total_payment_due = $payment['total_payment_due'];
            $monthly_payment_no_interest = $payment['monthly_payment_no_interest'];
            $days_overdue = $payment['days_overdue'];
            $paymentMonthly = $late_payment + $monthly_payment_no_interest;
            $totalDue = $late_payment + $total_payment_due;
            $dayDue = $days_overdue + 1;
            $updated_at = $payment['updated_at'];
            $setUpdate = $today;
            $message = "Hello, this is a reminder that your" . '₱ '. $paymentMonthly . 'day overdue: ' .$dayDue .
            'Please remind the finance department to process your loan and settle the payment as soon as possible. Thank you for your cooperation';
            if ($due_date < $today) {
                if ($updated_at !== $today) {
                   $insertReminder = "INSERT INTO `loan_reminder`(`reminder_id`, `loanID`, `schedule_id`, `account_id`, `message`) VALUES (?,?,?,?,?)";
                   $stmtReminder = $this->conn->prepare($insertReminder);
                   $stmtReminder->bind_param('sssss', $uniqueId, $loanID, $id, $accountid, $message);
                   $stmtReminder->execute();

                   $stmt->bind_param('ddsss', $paymentMonthly, $totalDue, $dayDue, $setUpdate, $id);
                   $stmt->execute();
                }
            }
        }
        if ($stmt->close()) {
            http_response_code(200);
            return json_encode(["status" => "success", "message" => "updated successfully."]);
        } else {
            http_response_code(500);
            return json_encode(["status" => "error", "message" => "Failed to update: " . $stmt->error]);
        }
    }
}
$overduepayments = new Overdue();
$sched = $overduepayments->dueDate();
echo json_encode([$sched]);
