<?php
require_once '../config/config.php';
header("Content-Type: application/json; charset=UTF-8");
class GetInformaionDocu extends Database {
    public function getDocu($id) {
        $fetchInfo = "SELECT i.*, d.*  FROM loan_information AS i INNER JOIN documents AS d ON i.loanID = d.loanID WHERE i.id = ?";
        $stmt = $this->conn->prepare($fetchInfo);
        if (!$stmt) {
            http_response_code(500);
            echo json_encode(["error" => "Prepare failed: " . $this->conn->error]);
            return;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $information = [];
        while ($row = $result->fetch_assoc()) {
            $information[] = $row;
        }
        $stmt->close();
        echo json_encode($information); 
    }
}
if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id = intval($_POST['id']);
    $getinfo = new GetInformaionDocu();
    $getinfo->getDocu($id);
} else {
    http_response_code(400);
    echo json_encode(["error" => "No ID provided"]);
}
?>