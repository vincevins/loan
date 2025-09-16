<?php
session_start();           
session_unset();           
session_destroy();         
header("location: http://localhost/final-loan/loan/public/pages/index.php"); 
exit;
