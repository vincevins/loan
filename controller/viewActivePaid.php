<?php
require_once '../config/config.php';
header("Content-Type: application/json; charset=UTF-8");
class ViewActivePaid extends Database{
    public function viewPaid($id){
        $getActive = "SELECT * FROM loan_payments where id =?";
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
$view = new ViewActivePaid();
$id = intval($_POST['id']);
echo json_encode([$view->viewPaid($id)]);
