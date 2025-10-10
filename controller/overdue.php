<?php
require_once '../config/config.php';
header("Content-Type: application/json; charset=UTF-8");
date_default_timezone_set('Asia/Manila');
class Overdue extends Database{
    public function sendReminders(){

    }
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
    public function setDuedate(){
        $res = $this->checkDueDate();
        $today = date('Y-m-d'); 

    }
}