<?php
session_start();
include __DIR__ . '/../config/config.php';
header('Content-Type: application/json');
class MarkNotifications extends Database {
    public function markAllAsRead($accountId) {
        $sql = "UPDATE loan_notifications SET is_read = 1 WHERE account_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $accountId);
        return $stmt->execute();
    }
}

if (!isset($_SESSION['user_account_id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

$accountId = $_SESSION['user_account_id'];
$notif = new MarkNotifications();

if ($notif->markAllAsRead($accountId)) {
    echo json_encode(['success' => true, 'message' => 'All notifications marked as read']);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Failed to update notifications']);
}