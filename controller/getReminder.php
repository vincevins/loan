<?php
session_start();
include __DIR__ . '/../config/config.php';
header('Content-Type: application/json');
class GetReminder extends Database{
    public function fetchReminder(){
        $id = $_SESSION['user_account_id'];
        $reminder = "SELECT * FROM loan_reminder WHERE account_id =? ";
        $stmt = $this->conn->prepare($reminder);
        $stmt->bind_param('s',$id);
        $stmt->execute();
        $result = $stmt->get_result();
        $information = [];
        while ($row = $result->fetch_assoc()) {
            $information[] = $row;
        }
        return $information;
    }
}
$remind = new GetReminder();
$getRemind = $remind->fetchReminder();
echo json_encode(["info" => $getRemind]); 