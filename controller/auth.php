<?php
require_once '../config/config.php';
header("Content-Type: application/json; charset=UTF-8");
session_start();

class Auth extends Database {
    public function register($accountID, $first_name, $middle_name, $last_name, $age, $contact, $email, $password, $role) {
        $passwordHashUser = password_hash($password, PASSWORD_DEFAULT);
        $registerQuery = "INSERT INTO `tbl_accounts`(`account_id`, `first_name`, `middle_name`, `last_name`, `age`, `contact_no`, `email`, `tmp_password`, `role`)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($registerQuery);
        $stmt->bind_param('sssssssss', $accountID, $first_name, $middle_name, $last_name, $age, $contact, $email, $passwordHashUser, $role);
        if ($stmt->execute()) {
            http_response_code(200);
            echo json_encode([
                "status"  => "success",
                "message" => "Record inserted successfully."
            ]);
        } else {
            http_response_code(500);
            echo json_encode([
                "status"  => "error",
                "message" => "Failed to insert data: " . $stmt->error
            ]);
        }
    }
}

$auth = new Auth();
$timestamp = time();
$randomNumber = mt_rand(1000, 9999);
$uniqueId = $timestamp . $randomNumber;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $role = 'user';
    $first_name = $_POST['first_name'] ?? '';
    $middle_name = $_POST['middle_name'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    $age = $_POST['age'] ?? '';
    $contact = $_POST['contact'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $accountID = $uniqueId;
    $auth->register($accountID, $first_name, $middle_name, $last_name, $age, $contact, $email, $password, $role);
} else {
    http_response_code(400);
    echo json_encode([
        "status"  => "error",
        "message" => "Invalid request: missing required fields."
    ]);
}



