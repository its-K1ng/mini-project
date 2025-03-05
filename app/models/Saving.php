<?php
class Saving {
    private $conn;
    private $table = 'savings';

    public function __construct($db) {
        $this->conn = $db;
    }

    //Fungsi untuk membuat (menambah) data tabungan baru
    public function create($user_id, $amount, $message) {
        //Query untuk menambahkan data ke tabel savings
        $query = "INSERT INTO " . $this->table . " (user_id, amount, message) VALUES (:user_id, :amount, :message)";
        $stmt = $this->conn->prepare($query);
        
        //Bind parameter untuk mencegah SQL injection
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':message', $message);
        
        //mengeksekusi query, jika berhasil kembalikan true
        if($stmt->execute()) {
            return true;
        }
        return false;
    }
   
    //fungsi untuk mendapatkan semua data tabungan
    public function getAll() {
        $userId = $_SESSION['user_id'];
        $isAdmin = $_SESSION['user_role'] === 'admin';
    
        if ($isAdmin) {
            //jika pengguna adalah admin, ambil semua data tabungan dari semua pengguna
            $query = "SELECT d.*, u.name FROM " . $this->table . " d
                      JOIN users u ON d.user_id = u.id
                      ORDER BY d.created_at DESC";//mengurutkan berdasarkan tanggal terbaru
            $stmt = $this->conn->prepare($query);
        } else {
            //jika pengguna bukan admin, ambil hanya data tabungan milik pengguna tersebut
            $query = "SELECT d.*, u.name FROM " . $this->table . " d
                      JOIN users u ON d.user_id = u.id
                      WHERE d.user_id = :user_id
                      ORDER BY d.created_at DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        }
    
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); //kembalikan semua data sebagai array asosiatif
    }
    public function getByUserId($userId) {
        $query = "SELECT d.*, u.name FROM " . $this->table . " d
                  JOIN users u ON d.user_id = u.id
                  WHERE d.user_id = :user_id
                  ORDER BY d.created_at DESC";
        $stmt = $this->conn->prepare($query); // Ubah dari $this->db ke $this->conn
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}