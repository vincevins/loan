<?php
require_once '../config/config.php';
session_start();
class Application extends Database{
    
    public function getApplication($id){
        $getQuery = "SELECT * FROM `loan_information` WHERE account_id = ?";
        $stmt = $this->conn->prepare($getQuery);
        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }
        $stmt->bind_param('s',$id);
        $stmt->execute();
        $result = $stmt->get_result();
        $information = [];
        while ($row = $result->fetch_assoc()) {
            $information[] = $row;
        }
        echo json_encode($information);
    }
}
$id = $_SESSION['user_account_id'];
$application = new Application();
$application->getApplication($id);