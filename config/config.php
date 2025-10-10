<?php
class Database {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $schema = "casestudy_loan";
    public $conn;

    public function __construct() {
        $this->databaseInit();
        error_log("Database connection initialized."); 
    }

    public function databaseInit() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->schema);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        error_log("Connected successfully");
    }
}
?>