<?php
// File: koneksi.php

class Koneksi {
    private $host = "localhost";
    private $username = "root";
    private $password = ""; 
    private $db_name = "DB_UAS_PBO_TI1C_NadiaRizkyRahmadani"; 
    protected $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            // Mengatur error mode PDO ke Exception untuk memudahkan debugging
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Koneksi database gagal: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>