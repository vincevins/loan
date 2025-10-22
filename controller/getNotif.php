<?php
session_start();
include __DIR__ . '/../config/config.php';
header('Content-Type: application/json');
class GetNotif extends Database {
    public function fetchReminder() {
        $id = $_SESSION['user_account_id'];
        $sql = "SELECT id, title, message, is_read, created_at FROM loan_notifications WHERE account_id = ? ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $notifications = [];
        while ($row = $result->fetch_assoc()) {
            $notifications[] = $row;
        }
        return $notifications;
    }
}

$notif = new GetNotif();
$data = $notif->fetchReminder();

header('Content-Type: application/json');
echo json_encode(["notifications" => $data]);