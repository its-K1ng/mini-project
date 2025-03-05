<?php
class User {
    private $conn;
    private $table = 'users';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function register($name, $email, $password, $role = 'user') {
        //hash password untuk keamanan
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        //query untuk menyimpan data pengguna baru
        $query = "INSERT INTO " . $this->table . " (name, email, password, role) 
                  VALUES (:name, :email, :password, :role)";
        $stmt = $this->conn->prepare($query);
        
        //bind parameter untuk mencegah SQL Injection
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':role', $role);
        
        //eksekusi query, jika berhasil kembalikan true
        if($stmt->execute()) {
            return true;
        }
        //jika gagal kembalikan false
        return false;
    }

    public function login($email, $password) {
        //query untuk mencari data pengguna berdasarkan email
        $query = "SELECT * FROM " . $this->table . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

            //mengambil hasil query jika ada
        if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            //memverifikasi password yang diinput dengan password yang tersimpan di database
            if(password_verify($password, $row['password'])) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_name'] = $row['name'];
                $_SESSION['user_role'] = $row['role'];
                return $row;
            }
        }
        return false;
    }
    // Fungsi untuk mendapatkan semua data pengguna
    public function getAllUsers() {
        // Query untuk mengambil data pengguna dengan beberapa kolom penting
        $query = "SELECT id, name, email, role, created_at FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}