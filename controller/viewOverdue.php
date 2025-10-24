<?php
require_once '../config/config.php';
header("Content-Type: application/json; charset=UTF-8");
class viewOverdue extends Database{
    public function viewPaid($id){
        $getActive = "SELECT s.*, i.first_name,i.middle_name, i.last_name FROM loan_payment_schedule as s INNER JOIN loan_information as i ON s.loanID = i.loanID WHERE s.id = ?";
        $stmt = $this->conn->prepare($getActive);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $res =  $stmt->get_result();
        $information = [];
        while($row = $res->fetch_assoc()){
            $information = $row;
        }
        return $information;
    }
}
$view = new viewOverdue();
$id = intval($_POST['id']);
echo json_encode([$view->viewPaid($id)]);
