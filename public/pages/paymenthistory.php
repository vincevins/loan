<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'navbar.php';
?>
<link rel="stylesheet" href="../../styles/pages.css">

<div class="page-container">
    <h2>Payment History</h2>
    <table class="styled-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Amount Paid</th>
                <th>Method</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>2025-09-15</td>
                <td>₱2,500</td>
                <td>Bank Transfer</td>
                <td><span class="paid">Paid</span></td>
            </tr>
        </tbody>
    </table>
</div>
