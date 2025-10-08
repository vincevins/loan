<?php
session_start();
require_once '../config/config.php';
header("Content-Type: application/json; charset=UTF-8");
class SetPassword extends Database{
    public function setPassword($password,$tmpPassword, $email){
        $passwordHashUser = password_hash($password, PASSWORD_DEFAULT);
        $setPasswordQuery = "UPDATE `loan_accounts` SET `password`= ?,`tmp_password`= ? WHERE email = ?";
        $stmt = $this->conn->prepare($setPasswordQuery);
        $stmt->bind_param('sss', $passwordHashUser,$tmpPassword, $email);
        if ($stmt->execute()) {
            http_response_code(200);
            return json_encode(["status" => "success", "loginform" => true,"message" => "Password updated successfully.",]);
        } else {
            http_response_code(500);
            return json_encode(["status" => "error","message" => "Failed to set password: " . $stmt->error]);
       }
    }
}
$auth = new SetPassword();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['set_password'])) {
    $email =  $_SESSION['set_user_email'];
    $password = $_POST['set_password'];
    $tmpPassword = null;
    $res =  $auth->setPassword($password,$tmpPassword, $email);
    echo $res;
    exit;
}
