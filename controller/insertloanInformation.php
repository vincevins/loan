<?php
session_start();
require_once '../config/config.php';
header("Content-Type: application/json; charset=UTF-8");
class InsertloanInformation extends Database
{
    public function insertData($employeeID, $applicationId, $loanID, $accountId, $firstName, $middleName, $lastName, $email,
            $phone, $dob, $address, $city, $province, $zipCode, $employment, $employerName, $employmentLength,
            $income, $loanAmount, $loanPurpose, $loanTerm, $interestRate, $totalInterest, $monthlyPaymentNoInterest,
            $monthlyPayment, $applicationStatus, $assigned_hr, $remarks, $hr_approval_date, $appDate, $assigned_admin,
            $application_status_for_admin, $approval_date, $employee_position, $date_hired, $company_name,
            $department, $company_address, $employer_contact_person, $employer_phone_number, $employer_email){
            $insertQuery = "INSERT INTO `loan_information` (
            `student_no`, `application_id`, `loanID`, `account_id`, `first_name`, `middle_name`, `last_name`, `email`, 
            `contact_no`, `dob`, `address`, `city`, `province`, `zip_code`, `employment_status`, `employer_name`, 
            `employment_length`, `annual_income`, `loan_amount`, `loan_purpose`, `loan_term`, `interest_rate`,  
            `interest`, `monthly_payment_no_interest`, `monthly_payment`, `application_status`, `assigned_hr`, 
            `remarks`, `hr_approval_date`, `application_date`, `assigned_admin`, `application_status_for_admin`, 
            `approval_date`, `employee_position`, `date_hired`, `company_name`, `department`, `company_address`, 
            `employer_contact_person`, `employer_phone_number`, `employer_email`
            ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

        $stmt = $this->conn->prepare($insertQuery);
        $stmt->bind_param('ssssssssssssssssssdssddddssssssssssssssss',
            $employeeID, $applicationId, $loanID, $accountId, $firstName, $middleName, $lastName, $email,
            $phone, $dob, $address, $city, $province, $zipCode, $employment, $employerName, $employmentLength,
            $income, $loanAmount, $loanPurpose, $loanTerm, $interestRate, $totalInterest, $monthlyPaymentNoInterest,
            $monthlyPayment, $applicationStatus, $assigned_hr, $remarks, $hr_approval_date, $appDate, $assigned_admin,
            $application_status_for_admin, $approval_date, $employee_position, $date_hired, $company_name,
            $department, $company_address, $employer_contact_person, $employer_phone_number, $employer_email
        );

        if ($stmt->execute()) {
            http_response_code(200);
            return json_encode(["status" => "success", "message" => "Record inserted successfully."]);
        } else {
            http_response_code(500);
            return json_encode(["status" => "error", "message" => "Failed to insert data: " . $stmt->error]);
        }
    }
    public function insertDocu($loanID,$ValidIDFront,$ValidIDBack,$selfieId,$proofIncome){
        $documments ="INSERT INTO `documents`(`loanID`, `valid_id_front`, `valid_id_back`, `selfie_id`, `proof_income`) 
        VALUES (?,?,?,?,?)";
        $stmt = $this->conn->prepare($documments);
        $stmt->bind_param('sssss',$loanID,$ValidIDFront,$ValidIDBack,$selfieId,$proofIncome);
        if ($stmt->execute()) {
            http_response_code(200);
            return json_encode(["status" => "success", "message" => "Record inserted successfully."]);
        } else {
            http_response_code(500);
            return json_encode(["status" => "error", "message" => "Failed to insert data: " . $stmt->error]);
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
    $income = $_POST['monthlySalary'] ?? null;
    $loanAmount = $_POST['loanAmount'] ?? null;
    $loanPurpose = $_POST['loanPurpose'] ?? null;
    $loanTerm = $_POST['loanTerm'] ?? null;
    $interestRate = $_POST['percentageInterest'] ?? 1.3;
    $monthlyPaymentNoInterest = $_POST['RateNoInterest'];
    $monthlyPayment = $_POST['withInterest'];
    $totalInterest = $_POST['totalInterest'];
    $employeeID = $_POST['employeeId'];
    $applicationStatus = 'Pending';
    $assigned_hr = null;
    $remarks = null;
    $hr_approval_date = null;
    $assigned_admin = null;
    $application_status_for_admin = 'Pending';
    $approval_date = null;
    $employee_position = $_POST['position']; 
    $date_hired = $_POST['dateHired'];
    $company_name = $_POST['companyName'];
    $department = $_POST['department'];
    $company_address = $_POST['companyAddress'];
    $employer_contact_person = $_POST['employerContactPerson'];
    $employer_phone_number = $_POST['employerContactNumber'];
    $employer_email = $_POST['employerEmail'];

    $uploadDir = __DIR__ . '/uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $ValidIDFrontName = time() . '_front_' . basename($_FILES['idFront']['name']);
    $ValidIDBackName = time() . '_back_' . basename($_FILES['idBack']['name']);
    $selfieIdName = time() . '_selfie_' . basename($_FILES['selfieId']['name']);
    $proofIncomeName = time() . '_income_' . basename($_FILES['proofIncome']['name']);

    $ValidIDFrontPath = $uploadDir . $ValidIDFrontName;
    $ValidIDBackPath = $uploadDir . $ValidIDBackName;
    $selfieIdPath = $uploadDir . $selfieIdName;
    $proofIncomePath = $uploadDir . $proofIncomeName;

    move_uploaded_file($_FILES['idFront']['tmp_name'], $ValidIDFrontPath);
    move_uploaded_file($_FILES['idBack']['tmp_name'], $ValidIDBackPath);
    move_uploaded_file($_FILES['selfieId']['tmp_name'], $selfieIdPath);
    move_uploaded_file($_FILES['proofIncome']['tmp_name'], $proofIncomePath);

    $ValidIDFront = 'uploads/' . $ValidIDFrontName;
    $ValidIDBack = 'uploads/' . $ValidIDBackName;
    $selfieId = 'uploads/' . $selfieIdName;
    $proofIncome = 'uploads/' . $proofIncomeName;
    

    $infoInsert = $loan->insertData($employeeID, $applicationId, $loanID, $accountId, $firstName, $middleName, $lastName, $email,
            $phone, $dob, $address, $city, $province, $zipCode, $employment, $employerName, $employmentLength,
            $income, $loanAmount, $loanPurpose, $loanTerm, $interestRate, $totalInterest, $monthlyPaymentNoInterest,
            $monthlyPayment, $applicationStatus, $assigned_hr, $remarks, $hr_approval_date, $appDate, $assigned_admin,
            $application_status_for_admin, $approval_date, $employee_position, $date_hired, $company_name,
            $department, $company_address, $employer_contact_person, $employer_phone_number, $employer_email);
   $docuInsert =$loan->insertDocu($loanID,$ValidIDFront,$ValidIDBack,$selfieId,$proofIncome);

   echo json_encode (["data" => $infoInsert, $docuInsert]);
}