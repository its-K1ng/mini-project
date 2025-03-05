<?php
class AuthController {
    private $db;
    private $userModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
        require_once 'app/models/user.php';
        $this->userModel = new User($this->db);
    }

    //metode untuk login
    public function login() {
        require_once 'app/helpers/AuthMiddleware.php';
        AuthMiddleware::isGuest();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // ambil data dari form login
            $email = $_POST['email'];
            $password = $_POST['password'];

            //memanggil metode login pada metode user
            if($this->userModel->login($email, $password)) {
                //jika berhasil login, user akan di arahkan ke home
                header('Location: home');
                exit();
            }
        }
        require_once 'app/views/login.php';
    }

      //metode untuk register
    public function register() {
        require_once 'app/helpers/AuthMiddleware.php';
        AuthMiddleware::isGuest();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            //user pertama akan menjadi admin dan setelahnya akan menjadi user 
            $role = $this->isFirstUser() ? 'admin' : 'user';

            if($this->userModel->register($name, $email, $password, $role)) {
                header('Location: login');
                exit();
            }
        }
        require_once 'app/views/register.php';
    }

    // Metode untuk mengecek apakah ini adalah pengguna pertama
    private function isFirstUser() {
        // Query untuk menghitung jumlah pengguna dalam tabel
        $query = "SELECT COUNT(*) as count FROM users";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        // Kembalikan true jika tabel kosong (pengguna pertama)
        return $result['count'] === 0;
    }

    // Metode untuk logout
    public function logout() {
    // Hancurkan semua data sesi pengguna
        session_destroy();
        //arahkan pengguna kembali k halaman login
        header('Location: login');
        exit();
    }
}