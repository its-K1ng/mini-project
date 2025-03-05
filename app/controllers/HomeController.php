<?php
class HomeController {
    private $db;
    private $savingModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
        //membuat model Saving
        require_once 'app/models/Saving.php';
        $this->savingModel = new Saving($this->db);
    }

    //metode untuk menampilkan halaman utama user
    public function index() {
        require_once 'app/helpers/AuthMiddleware.php';
        AuthMiddleware::isAuthenticated(); // Pastikan user login
        //mengambil ID pengguna dari sesi untuk menampilkan data yang sesuai
        $userId = AuthMiddleware::getuserId();
        //memeriksa apakah pengguna memiliki peran admin (diambil dari sesi)
        $isAdmin = $_SESSION['user_role'] === 'admin';
        //mengambil data tabungan hanya milik pengguna yang sedang login
        $savings = $this->savingModel->getByuserId($userId); // Admin & user hanya lihat setorannya sendiri
        //menampilkan halaman utama
        require_once 'app/views/home.php';
    }
    
    
    //metode untuk menampilkan halaman admin
    public function admin()
    {
        //memastikan hanya admin yang dapat mengakses halaman ini
        require_once 'app/helpers/AuthMiddleware.php';
        AuthMiddleware::isAdmin();
        //mengambil semua data tabungan untuk admin
        $savings = $this->savingModel->getAll();
        //menampilkan halaman admin
        require_once 'app/views/admin.php';
    }
}