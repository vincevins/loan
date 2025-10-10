<?php
session_start();
require_once '../config/config.php';
header("Content-Type: application/json; charset=UTF-8");
class InsertloanInformation extends Database{
    public function insertData($employeeID,$applicationId, $loanID, $accountId, $firstName, $middleName, $lastName, $email, $phone, $dob, $address, $city, $province, $zipCode, $employment, $employerName, $employmentLength, $income, $housing, $loanAmount, $loanPurpose, $loanTerm, $interestRate,$totalInterest, $monthlyPaymentNoInterest, $monthlyPayment, $appDate){
        $insertQuery = "INSERT INTO `loan_information` (`student_no`,`application_id`, `loanID`, `account_id`, `first_name`, `middle_name`, `last_name`, `email`, `contact_no`, `dob`, `address`, `city`, `province`, `zip_code`, `employment_status`, `employer_name`, `employment_length`, `annual_income`, `housing_payment`, `loan_amount`, `loan_purpose`, `loan_term`, `interest_rate`,`interest`, `monthly_payment_no_interest`, `monthly_payment`, `application_date`) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($insertQuery);
        $stmt->bind_param('sssssssssssssssssdddsddddds',$employeeID,$applicationId,$loanID,$accountId,$firstName,$middleName,$lastName,$email,$phone,$dob,$address,$city,
            $province,$zipCode,$employment,$employerName,$employmentLength,$income,$housing,$loanAmount,$loanPurpose,$loanTerm,$interestRate,$totalInterest,$monthlyPaymentNoInterest,$monthlyPayment,$appDate);
        if ($stmt->execute()) {
            http_response_code(200);
            echo json_encode(["status" => "success", "message" => "Record inserted successfully."]);
        } else {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => "Failed to insert data: " . $stmt->error]);
        }
    }

}

$loan = new InsertloanInformation();
$timestamp = time();
$randomNumber = mt_rand(1000, 9999);
$loanID = $timestamp . $randomNumber;
$applicationId = 'APPLICATION-' . $timestamp;
date_default_timezone_set('Asia/Manila');
$appDate = date('Y-m-d H:i:s');
$accountId = $_SESSION['user_account_id'];
if (isset($_POST['firstName'])) {
    $firstName = $_POST['firstName'] ?? null;
    $middleName = $_POST['middleName'] ?? null;
    $lastName = $_POST['lastName'] ?? null;
    $email = $_POST['email'] ?? null;
    $phone = $_POST['phone'] ?? null;
    $dob = $_POST['dob'] ?? null;
    $address = $_POST['address'] ?? null;
    $city = $_POST['city'] ?? null;
    $province = $_POST['province'] ?? null;
    $zipCode = $_POST['zipCode'] ?? null;
    $employment = $_POST['employment'] ?? null;
    $employerName = $_POST['employerName'] ?? null;
    $employmentLength = $_POST['employmentLength'] ?? null;
    $income = $_POST['income'] ?? null;
    $housing = $_POST['housing'] ?? null;
    $loanAmount = $_POST['loanAmount'] ?? null;
    $loanPurpose = $_POST['loanPurpose'] ?? null;
    $loanTerm = $_POST['loanTerm'] ?? null;
    $interestRate = $_POST['percentageInterest'] ?? 1.3;
    $monthlyPaymentNoInterest = $_POST['RateNoInterest'];
    $monthlyPayment = $_POST['withInterest'];
    $totalInterest = $_POST['totalInterest'];
    $employeeID = $_POST['employeeID'];
    $loan->insertData($employeeID,$applicationId,$loanID,$accountId,$firstName,$middleName,$lastName,$email,$phone,$dob,$address,$city,$province,$zipCode,
        $employment,$employerName,$employmentLength,$income,$housing,$loanAmount,$loanPurpose,$loanTerm,$interestRate,$totalInterest,$monthlyPaymentNoInterest,$monthlyPayment,$appDate);

}
