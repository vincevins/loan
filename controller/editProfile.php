<?php
session_start();
require_once '../config/config.php';
header("Content-Type: application/json; charset=UTF-8");
class EditProfile extends Database{
    public function updateProfile($profileData, $id){
        $updateProf = "UPDATE loan_accounts SET profile_pic = ? WHERE account_id = ?";
        $stmt = $this->conn->prepare($updateProf);
        $stmt->bind_param('ss', $profileData, $id);
        if ($stmt->execute()) {
            http_response_code(200);
            echo json_encode(["status" => "success", "message" => "Profile updated successfully."]);
        } else {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => "Failed to update profile: " . $stmt->error]);
        }
    }
}

if (isset($_FILES['profile_picture']) && is_uploaded_file($_FILES['profile_picture']['tmp_name'])) {
    $imageData = file_get_contents($_FILES['profile_picture']['tmp_name']); 
    $id = $_SESSION['user_account_id'];
    $_SESSION['profile_picture'] = $imageData;

    $profile = new EditProfile();
    $profile->updateProfile($imageData, $id);
}
