<?php require_once '../config/config.php';
header("Content-Type: application/json; charset=UTF-8");
date_default_timezone_set('Asia/Manila');
class UpcomingDue extends Database{
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
    public function upcomingDue(){
        $res = $this->checkDueDate();
        $today = date('Y-m-d');
        $updateQuery = "UPDATE loan_payment_schedule SET updated_at_upcoming = ? WHERE schedule_id = ?";
        $stmtUpdate = $this->conn->prepare($updateQuery);
        while ($payment = $res->fetch_assoc()) {
            $due_date = $payment['due_date'];
            $updated_at = $payment['updated_at_upcoming'];
            $beforeDate = (strtotime($due_date) - strtotime($today)) / (60 * 60 * 24);
            if ($beforeDate > 0 && $beforeDate <= 3 && $updated_at !== $today) {
                $uniqueId = time() . mt_rand(1000, 9999);
                $message = "Your payment is due in $beforeDate day(s). Please make sure to pay on";
                $insertReminder = "INSERT INTO loan_notifications (notif_id, loanID, schedule_id, account_id, message) VALUES (?, ?, ?, ?, ?)";
                $stmtReminder = $this->conn->prepare($insertReminder);
                $stmtReminder->bind_param('sssss',$uniqueId, $payment['loanID'], $payment['schedule_id'], $payment['account_id'], $message);
                $stmtReminder->execute();
                $stmtUpdate->bind_param('ss', $today, $payment['schedule_id']);
                $stmtUpdate->execute();
            }
        }
        $stmtUpdate->close();
        http_response_code(200);
        return json_encode(["status" => "success", "message" => "Upcoming due reminders processed successfully."]);
    }
}
$checkUpcoming = new UpcomingDue();
$sched = $checkUpcoming->upcomingDue();
echo json_encode([$sched]);
