<?php
require_once '../config/config.php';
header("Content-Type: application/json; charset=UTF-8");

class InsertloanInformation extends Database{
    public function insertData($firstName, $lastName, $email, $phone, $dob, $employment, $income, $housing, $loanAmount, $loanPurpose, $loanTerm, $loanID){
        $insertQuery = "INSERT INTO `loan_information`(`first_name`, `last_name`, `email`, `contact_no`, `dob`, `employment_status`, `annual_income`, `housing_payment`, `loan_amount`, `loan_purpose`, `loan_term`, `loanID`) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($insertQuery);
        $stmt->bind_param( 'ssssssdddsds',$firstName, $lastName, $email, $phone, $dob, $employment, $income, $housing, $loanAmount, $loanPurpose, $loanTerm, $loanID);
        if ($stmt->execute()) {
            http_response_code(200);
            echo json_encode(["status" => "success","message" => "Record inserted successfully.",]);
        } else {
            http_response_code(500);
            echo json_encode(["status" => "error","message" => "Failed to insert data: " . $stmt->error]);
        }
    }
}
$loan = new InsertloanInformation();

$timestamp = time();
$randomNumber = mt_rand(1000, 9999);
$uniqueId = $timestamp . $randomNumber;
if (isset($_POST['firstName'])) {
    $firstName = $_POST['firstName'] ?? null;
    $lastName = $_POST['lastName'] ?? null;
    $email = $_POST['email'] ?? null;
    $phone = $_POST['phone'] ?? null;
    $dob = $_POST['dob'] ?? null;
    $employment = $_POST['employment'] ?? null;
    $income = $_POST['income'] ?? null;
    $housing = $_POST['housing'] ?? null;
    $loanAmount = $_POST['loanAmount'] ?? null;
    $loanPurpose = $_POST['loanPurpose'] ?? null;
    $loanTerm = $_POST["loanTerm"] ?? null;
    $loanID = $uniqueId;
    $loan->insertData($firstName, $lastName, $email, $phone, $dob, $employment, $income, $housing, $loanAmount, $loanPurpose, $loanTerm, $loanID);
}
