<?php
include 'sidebar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pending Loans</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
      
    }

    h2, h1 {
      text-align: center;
      margin-bottom: 20px;
      color: #1b2232;
    }

    /* 🔍 Search Bar */
    .search-container {
      display: flex;
      justify-content: center;
      margin: 20px 0;
      padding: 0 10px;
    }

    .search-container input {
      width: 100%;
      max-width: 400px;
      padding: 12px 15px;
      border: 2px solid #4a78a6;
      border-radius: 30px;
      font-size: 14px;
      outline: none;
      transition: 0.3s;
    }

    .search-container input:focus {
      border-color: #1b2232;
      box-shadow: 0 0 8px rgba(74, 120, 166, 0.4);
    }

    /* 📋 Table Wrapper */
    .table-wrapper {
      overflow-x: auto;
      margin-top: 10px;
    }

    .loan-table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      min-width: 600px;
    }

    .loan-table th, .loan-table td {
      padding: 14px;
      text-align: center;
      border-bottom: 1px solid #eee;
    }

    .loan-table th {
      background: #4a78a6;
      color: white;
      font-weight: bold;
      text-transform: uppercase;
    }

    .loan-table tr:hover {
      background: #f9fbfd;
    }

    /* 🎛️ Action Button */
    .action-btn {
      padding: 8px 18px;
      margin: 3px;
      border: none;
      border-radius: 25px;
      cursor: pointer;
      font-size: 13px;
      font-weight: bold;
      transition: all 0.3s ease;
      color: white;
      display: inline-block;
    }

    .remind {
       background: #28a745;
      color: #ffffffff;
    }
    .remind:hover {
      background: #e0a800;
      transform: scale(1.05);
    }

    /* 📱 Responsive */
    @media (max-width: 768px) {
      .loan-table th, .loan-table td {
        padding: 10px;
        font-size: 12px;
      }
      .action-btn {
        padding: 6px 12px;
        font-size: 12px;
      }
    }

    @media (max-width: 480px) {
      .search-container input {
        max-width: 100%;
      }
      h1 {
        font-size: 20px;
      }
    }
  </style>
</head>
<body>
  <!-- Main Content -->
  <main class="main-content">
    <header class="main-header">
      <h1>Pending Loans</h1>
      <div class="user-info">
        <div class="notification-container">
          <img src="pictures/notification.gif" alt="Notifications" class="notification-bell">
          <div class="notification-dropdown">
            <p>No new notifications</p>
          </div>
        </div>
        <div class="profile-container">
          <i class="fa-solid fa-user-circle profile-icon"></i>
          <div class="profile-dropdown">
            <a href="#">My Profile</a>
            <a href="#">Settings</a>
            <a href="../loan.php">Logout</a>
          </div>
        </div>
      </div>
    </header>

                <!-- 🔍 Search -->
                <div class="search-container">
                <input type="text" id="searchInput" placeholder="Search borrower...">
                </div>

            <!-- Pending Loans Table -->
            <div class="table-wrapper">
            <table class="loan-table" id="loanTable">
                <thead>
                <tr>
                    <th>Loan ID</th>
                    <th>Borrower</th>
                    <th>Loan Date</th>
                    <th>Due Date</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <!-- Sample Data -->
                <tr>
                    <td>3001</td>
                    <td>Juan Dela Cruz</td>
                    <td>2025-09-01</td>
                    <td>2025-12-01</td>
                    <td>₱20,000</td>
                    <td style="color:orange; font-weight:bold;">Pending</td>
                    <td><button class="action-btn remind" onclick="sendReminder('Juan Dela Cruz')">Send Reminder</button></td>
                </tr>
                <tr>
                    <td>3002</td>
                    <td>Maria Santos</td>
                    <td>2025-09-05</td>
                    <td>2025-12-05</td>
                    <td>₱15,000</td>
                    <td style="color:orange; font-weight:bold;">Pending</td>
                    <td><button class="action-btn remind" onclick="sendReminder('Maria Santos')">Send Reminder</button></td>
                </tr>
                <tr>
                    <td>3003</td>
                    <td>Pedro Reyes</td>
                    <td>2025-09-10</td>
                    <td>2025-12-10</td>
                    <td>₱12,000</td>
                    <td style="color:orange; font-weight:bold;">Pending</td>
                    <td><button class="action-btn remind" onclick="sendReminder('Pedro Reyes')">Send Reminder</button></td>
                </tr>
                </tbody>
            </table>
            </div>

    <script>
      // 🔍 Search bar filter (Borrower column = 1)
      document.getElementById("searchInput").addEventListener("keyup", function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll("#loanTable tbody tr");

        rows.forEach(row => {
          let borrower = row.cells[1].textContent.toLowerCase();
          row.style.display = borrower.includes(filter) ? "" : "none";
        });
      });

      // 📩 SweetAlert - Send Reminder
      function sendReminder(name) {
        Swal.fire({
          title: 'Send Reminder?',
          text: "Do you want to remind " + name + " about their pending loan?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#ffc107',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, Send Reminder'
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire(
              'Reminder Sent!',
              'Reminder has been sent to ' + name + '.',
              'success'
            )
          }
        });
      }
    </script>
  </main>
</body>
</html>
