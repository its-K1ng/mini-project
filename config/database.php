<?php
class Database {
     // Properti untuk menyimpan konfigurasi koneksi ke database
    private $host = 'localhost'; // host database 
    private $db_name = 'tabungan_db'; //nama database
    private $username = 'root'; // username untuk mengakses database (default: 'root' untuk XAMPP)
    private $password = ''; // password untuk mengakses database (default kosong untuk XAMPP)
    private $conn; //properti untuk menyimpan koneksi ke database

    // Metode untuk membuat koneksi ke database
    public function connect() {
        try {
            // membuat koneksi PDO ke database menggunakan konfigurasi yang telah ditentukan
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name}",
                $this->username,
                $this->password
            );
            // mengatur mode error pada koneksi PDO agar menampilkan exception jika terjadi kesalahan
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // mengembalikan objek koneksi PDO jika berhasil
            return $this->conn;
        } catch(PDOException $e) {
            // Menangkap dan menampilkan pesan kesalahan jika koneksi gagal
            echo "Connection Error: " . $e->getMessage();
            // Mengembalikan null sebagai tanda kegagalan koneksi
            return null;
        }
    }
}