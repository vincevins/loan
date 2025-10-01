<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="public/styles/setPassword.css">
  <link rel="stylesheet" href="../styles/toast.css">
  <title>Set Password</title>
</head>

<body>
  <div class="form-container setPassword-container">
    <form id="setPasswordForm" method="POST">
      <h2 class="form-title">Set your New Password</h2>
      <div class="input-group">
        <input type="password" name="set_password" id="set_password" placeholder="New Password" required>
      </div>
      <div class="input-group">
        <input type="password" name="set_confirm_password" id="set_confirm_password" placeholder="Confirm Password" required>
      </div>
      <button type="submit" name="btnSetPassword" class="submit-btn">Save Password</button>
    </form>
  </div>
  <div class="toast-container" id="toastContainer"></div>
  <script src="../js/authSetpassword.js"></script>
</body>

</html>