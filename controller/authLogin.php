<?php
require_once '../config/config.php';
header('Content-Type: application/json');
session_start();
class AuthLogin extends Database
{
    public function login($user_email, $user_password)
    {
        $loginQuery = "SELECT * FROM `tbl_accounts` WHERE email = ?";
        $stmt = $this->conn->prepare($loginQuery);
        if (!$stmt) {
            return json_encode(['success' => false, 'message' => 'Database error: ' . $this->conn->error]);
        }
        $stmt->bind_param('s', $user_email);
        $stmt->execute();
        $res  = $stmt->get_result();
        $user = $res->fetch_assoc();
        if (!$user) {
            return json_encode(['success' => false, 'message' => 'Invalid email or password.']);
        }
        if (!empty($user['tmp_password']) && password_verify($user_password, $user['tmp_password'])) {
            $_SESSION['set_user_id'] = $user['id'];
            $_SESSION['set_user_email'] = $user['email'];
            return json_encode(['success' => true, 'reset_required' => true, 'message' => 'Temporary password please set a new password.']);
        }
        if (password_verify($user_password, $user['password'])) {
            $_SESSION['logged_in'] = true;
            $_SESSION['user_id']  = $user['id'];
            $_SESSION['user_account_id'] = $user['account_id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_first_name'] = $user['first_name'];
            $_SESSION['user_middle_name'] = $user['middle_name'];
            $_SESSION['user_last_name'] = $user['last_name'];
            $_SESSION['user_contact_no'] = $user['contact_no'];
            $_SESSION['user_birthdate'] = $user['birthdate'];
            $_SESSION['user_role'] = $user['role'];
            $_SESSION['user_status_loan'] = $user['hasLoan'];
            return json_encode(["status" => "success", 'reset_required' => false, 'message' => 'Login successful', "role" => $user['role']]);
        }
        return json_encode(['status' => "error", 'message' => 'Invalid email or password.']);
    }
}
$auth = new AuthLogin();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $user_email = trim($_POST['email']);
    $user_password = $_POST['password'];
    $loginResult = $auth->login($user_email, $user_password);
    echo $loginResult;
    exit;
}
